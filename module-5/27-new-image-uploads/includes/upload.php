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
    $file_temp_name = $_FILES['img-file']['tmp_name'];
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

                // Now that we have the scaling factor, let's make sure the image we have will cover the image we're going to create (i.e. our canvas).
                $new_width = ceil($width_orig * $scale);
                $new_height = ceil($height_orig * $scale);

                // Finally, we get to resize the image (stretch or squish it to fill the 'canvas' properly), while maintaining the correct aspect ratio.
                $temp_image = imagecreatetruecolor($new_width, $new_height);

                // We've got all of our calculations and figured out how large our full-sized image will be and how to place it. So, let's make it.
                imagecopyresampled($temp_image, $src_image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);

                // The aspect ratio of the original image and the image we're creating may not match up. This means some cropping may occur. We're going to try to minimise the damage by centring the image. 
                $x_offest = floor(($new_width - $target_width) / 2);
                $y_offset = floor(($new_height - $target_height) / 2);

                // FINALLY, we can create our 720p image (our full-sized image).
                $final_image = imagecreatetruecolor($target_width, $target_height);
                imagecopy($final_image, $temp_image, 0, 0, $x_offest, $y_offset, $target_width, $target_height);


                switch ($file_extension) {
                    case 'avif':
                        imageavif($final_image, $file_destination);
                        break;
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($final_image, $file_destination);
                        break;
                    case 'png':
                        imagepng($final_image, $file_destination);
                        break;
                    case 'webp':
                        imagewebp($final_image, $file_destination);
                        break;
                    default:
                        exit("Unsupported file type. Please upload a AVIF, JPG, JPEG, PNG, or WebP file.");
                }

                // Now that we've output a full-sized image, we can move on and create our square thumbnail.
                $thumb_size = 512;
                $thumb_img = imagecreatetruecolor($thumb_size, $thumb_size);
                $smaller_side = min($width_orig, $height_orig);
                $src_x = ($width_orig - $smaller_side) / 2;
                $src_y = ($height_orig - $smaller_side) / 2;
                imagecopyresampled($thumb_img, $src_image, 0, 0, $src_x, $src_y, $thumb_size, $thumb_size, $smaller_side, $smaller_side);

                // Let's tell PHP where our thumbnail should go.
                $thumb_path = "images/thumbs/$file_name_new";

                switch ($file_extension) {
                    case 'avif':
                        imageavif($thumb_img, $thumb_path);
                        break;
                    case 'jpg':
                    case 'jpeg':
                        imagejpeg($thumb_img, $thumb_path);
                        break;
                    case 'png':
                        imagepng($thumb_img, $thumb_path);
                        break;
                    case 'webp':
                        imagewebp($thumb_img, $thumb_path);
                        break;
                    default:
                        exit("Unsupported file type. Please upload a AVIF, JPG, JPEG, PNG, or WebP file.");
                }

                // As always, we need to free up our memory resources, We currently have FOUR working image objects.
                imagedestroy($src_image);
                imagedestroy($temp_image);
                imagedestroy($final_image);
                imagedestroy($thumb_img);

                // As our last step, we need to insert all of our metadata into the database so that our gallery script can find everything that it needs to function. 
                $sql = "INSERT INTO gallery_prep (`title`, `description`, `filename`, `uploaded_on`) VALUES (?, ?, ?, NOW());";
                $statement = $connection->prepare($sql);
                $statement->bind_param("sss", $img_title, $img_description, $file_name_new);
                $statement->execute();

                // If you have issues with your image not being processed, you may want an extra if/else in here to handle potential prepared statement / execution errors. 
                $message = "Your image was successfully uploaded!";

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
