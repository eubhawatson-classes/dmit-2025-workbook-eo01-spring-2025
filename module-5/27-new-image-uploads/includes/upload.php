<?php

// ternary statement: $message = isset($message) ? $message : "";
// null coalescing statement: $message = $message ?? "";
// ... and this is a null coalescing operator:
$message ??= "";

// All three of these achieve the exact same thing. We call this 'syntactical sugar', or just different ways of expressing something. 

// This will let us retain the text data in our forms.
$img_title = $_POST['img-title'] ?? "";
$img_description = $_POST['img-description'] ?? "";

// Here, we're not only checking to see if the user hit submit, but we're also looking inside of our $_FILES superglobal array to make sure that the user uploaded a file. 
if (isset($_POST['submit']) && !empty($_FILES['img-file']['name'])) {

    // In the real world, we'd also very much validate and sanitise our text-based inputs. For now, we'll focus on the images/files.

    $file_name = $_FILES['img-file']['name'];
    $file_temp_name = $_FILES['img-file']['temp_name'];
    $file_size = $_FILES['img-file']['size'];
    $allowed = array('avif', 'jpg', 'jpeg', 'png', 'webp');

    // The $_FILES['img-file']['error'] value contains an error code indicating the status of the file upload. A value of 0 (which corresponds to the constant UPLOAD_ERR_OK) means that no errors occured.
    if ($_FILES['img-file']['error'] === 0) {

        // Next, let's grab the uploaded file's extension (and make sure it's in lowercase).
        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_extension, $allowed)) {

            // This checks to see if the file size is below 2MB, in bytes (the default maximum upload size).
            if ($file_size < 2000000) {

                // This function will generate a unique filename for us, based upon microseconds. This helps us avoid data collisions / overwrites that can occur if we use the original file names. 

                /* uniqid() takes two arguments: 
                    
                    1. Do we want a prefix? 
                        ex. A Google Pixel phone names all of its images starting with: PXL_

                    2. Do we want further degrees of entropy? This can help us generate more complex strings (on really, really big platforms).
                */
                $file_name_new = uniqid('', TRUE) . ".$file_extension";
                $file_destination = "images/full/$file_name_new";

                // Let's make sure that the necessary directories (i.e. where we are going to store our images) exists and that PHP has read/write permissions.
                if (!is_dir('images/full/')) {
                    mkdir('images/full/', 0777, TRUE); // 0777 == code for full read/write permissions
                }
                if (!is_dir('images/thumbs/')) {
                    mkdir('images/thumbs/', 0777, TRUE);
                }

                // Let's move the uploaded file out of temporary files / storage and into the images/full directory now that we know it exists. 
                move_uploaded_file($file_temp_name, $file_destination);

                // The GD Image library uses different functions for different file types. Let's see what kind of file we're working with and create a working image resource from it.
                switch ($file_extension) {
                    case 'avif':
                        // requires PHP 8.1+ with GD built with AVIF support
                        $src_image = imagecreatefromavif($file_destination);
                        break;
                    case 'jpg':
                    case 'jpeg':
                        $src_image = imagecreatefromjpeg($file_destination);
                        break;
                    case 'png':
                        $src_image = imagecreatefrompng($file_destination);
                        break;
                    case 'webp':
                        $src_image = imagecreatefromwebp($file_destination);
                        break;
                    default:
                        exit("Unsupported file type. Please upload a AVIF, JPG, JPEG, PNG, or WebP file.");
                }

                /*
                    If we wanted to express our switch case as a match expression, we could use the following block: 

                    $src_image = match ($file_extension) {
                        'jpg', 'jpeg' => imagecreatefromjpeg($file_destination),
                        'png'         => imagecreatefrompng($file_destination),
                        'webp'        => imagecreatefromwebp($file_destination),
                        'avif'        => imagecreatefromavif($file_destination), // PHP 8.1+ with GD‑AVIF
                        default       => exit("Unsupported file type. Please upload a JPG, JPEG, PNG, WebP or AVIF file."),
                    };
                */

                /*
                    We're going to make a square thumbnail and a 'full-sized' version. Let's start with our full-sized image, which will be 720p.

                    This means our full-sized image will be one of the following dimensions:

                    1. Landscape: 1280 x 720
                    2. Portrait: 720 x 1280
                    3. Square: 720 x 720
                */

                // Let's see what its dimensions are.
                list($width_orig, $height_orig) = getimagesize($file_destination);

                if ($width_orig > $height_orig) {
                    // Landscape Orientation
                    $target_width = 1280;
                    $target_height = 720;
                } elseif ($height_orig > $width_orig) {
                    // Portrait Orientation
                    $target_width = 720;
                    $target_height = 1280;
                } else {
                    // Square
                    $target_width = 720;
                    $target_height = 720;
                }

                // We want the image to cover the new target area (our canvas) without skewing / distorting the image. Let's calculate our scaling factors.
                $scale_x = $target_width / $width_orig;
                $scale_y = $target_height / $height_orig;
                $scale = max($scale_x, $scale_y);

                

            } else {
                $message .= "The file size limit is 2MB. Please upload a smaller image file.";
            }
        } else {
            $message .= "Your image must be one of the following file types: AVIF, JPG, JPEG, PNG, or WebP.";
        }
    } else {
        $message .= "The was an error with your file. Please make sure it isn't corrupted and try uploading again later.";
    }
}
