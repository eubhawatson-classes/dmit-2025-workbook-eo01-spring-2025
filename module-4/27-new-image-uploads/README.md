# Uploading & Displaying Images in a PHP Application

## Table of Contents

- [The HTML Form for File Uploads](#the-html-form-for-file-uploads)
- [The File Input Type](#the-file-input-type)
- [The Files Superglobal Variable](#the-files-superglobal-variable)
- [Common Image Handling Scenarios](#common-image-handling-scenarios)

---

## The HTML Form for File Uploads

An image can be uploaded and displayed in our PHP websites in multiple ways. The most common method of achieving this is by uploading the image into a directory on the server and updating its name (and any other metadata we need) in the database. 

In order to do that, we need a `<form>` that will accept image files from the user. Below is an example of what this might look like:

```PHP
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
    <!-- File Input -->
    <label for="img-file">Image File</label>
    <input type="file" id="img-file" name="img-file" class="form-control" accept=".png, .jpg, .jpeg, .webp" required>

    <!-- Submit Button -->
    <input type="submit" id="submit" name="submit" value="Upload">
</form>
```

When creating a form to handle file uploads in a PHP application, there are a few key considerations to ensure the data is transmitted correctly and securely.

Let's start with the `<form>` element itself and all of its required attributes, then get into some of the unique properties of `<input type="file">` and how to handle user-provided files. Specifically, we'll look at the following:

- `$_POST` method requirement
- `enctype` attribute
- `<input type="file">`
- `accept` attribute
 
 
### Why Use the POST Method?

The POST method sends data in the body of the HTTP request rather than appending it to the URL (as is done with GET). This is crucial for file uploads because:

  - It allows for larger amounts of data to be transmitted.
  - It securely sends binary data (which images are) without URL encoding issues.
  
Using POST also ensures that sensitive file data isn’t exposed in the URL, which is important for maintaining data integrity and security.


### The `enctype` Attribute

The `enctype` attribute defines how the form data is encoded when submitted to the server. For file uploads, you must use `enctype="multipart/form-data"`. This encoding type allows binary data (like images) to be sent in separate parts, each with its own content-type header.

If you use the default encoding (`application/x-www-form-urlencoded`), the file data would be URL-encoded. This is not only inefficient for binary data but also can corrupt files and isn’t capable of handling large file sizes.


## The File Input Type

The `<input type="file">` element is a key HTML form control that allows users to select files from their local system for uploading to a server. Unlike other input types, file inputs have several unique attributes that help control which files can be selected and how they are handled.

### Key Attributes

#### **`accept`**  

The `accept` attribute specifies the types of files that the server accepts. It can be used to restrict the file selection dialog to certain MIME types[^1] or file extensions. For example:  

```HTML
<input type="file" accept=".png, .jpg, .jpeg, .webp">
```  

This ensures that the file picker only displays files with the extensions `.png`, `.jpg`, `.jpeg`, or `.webp`. However, because this is a front-end validation method, it can easily be defeated. As developers, we should always double-check that the file type on the back-end. 

#### **`multiple`**  

The `multiple` attribute allows users to select more than one file at a time. Without this attribute, the file input will only permit a single file selection. Example:  

```HTML
  <input type="file" multiple>
```
  
#### **`required`**  

Adding the `required` attribute forces the user to select a file before the form can be submitted. Example:  

```HTML
  <input type="file" required>
```

#### **`capture`**  

The `capture` attribute is used primarily on mobile devices. It instructs the device to use a specific media capture mechanism (such as the camera or microphone) when choosing a file. For instance, specifying `capture="environment"` can directly open the rear camera for taking a photo:

```HTML
<input type="file" accept="image/*" capture="environment">
```


---


## The Files Superglobal Variable

`＄_FILES` is a superglobal constant or predefined variable in PHP that can be used to associate array items that are uploaded through the HTTP POST method. It is a multi-dimensional array because the user may upload more than one file at a time. 

When you have two separate file inputs in your HTML form like this:

```HTML
<label for="first-file">File Number 1:</label>
<input type="file" id="first-file" name="first-file">

<label for="second-file">File Number 2:</label>
<input type="file" id="second-file" name="second-file">
```

... and the user uploads an image for each, the `$_FILES` superglobal will contain two top-level keys—one for each input field. Each of these keys maps to an associative array with details about the uploaded file. For example, the expanded structure may look something like this:

```PHP
$_FILES = array(
    'first-file' => array(
        'name'     => 'firstimage.jpg',
        'type'     => 'image/jpeg',
        'tmp_name' => '/tmp/phpYzdqkD',
        'error'    => 0,
        'size'     => 123456
    ),
    'second-file' => array(
        'name'     => 'secondimage.png',
        'type'     => 'image/png',
        'tmp_name' => '/tmp/phpABC123',
        'error'    => 0,
        'size'     => 654321
    )
);
```


### Key Properties of $_FILES

The file in the properties listed below is the name of the variable that contains the file.

＄_FILES['file']['name']: The original filename of the uploaded file..

＄_FILES['file']['type']: The MIME type of the file (as reported by the browser).

＄_FILES['file']['size']: This is the size of the file to be uploaded in bytes.

＄_FILES['file']['tmp_name']: The temporary file path on the server where the file is stored until PHP is finished handling the file (and it is deleted) or it is moved (which can be done with the `move_uploaded_file()` method).

＄_FILES['file']['error']: An error code that indicates whether the upload was successful. A value of 0 means there was no error.

The error codes are as follow[^2]:

```PHP
array(
  0 => 'There is no error, the file uploaded with success', // UPLOAD_ERR_OK
  1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini', // UPLOAD_ERR_INI_SIZE
  2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form', // UPLOAD_ERR_FORM_SIZE 
  3 => 'The uploaded file was only partially uploaded', // UPLOAD_ERR_PARTIAL
  4 => 'No file was uploaded', // UPLOAD_ERR_NO_FILE
  6 => 'Missing a temporary folder', // UPLOAD_ERR_NO_TMP_DIR
  7 => 'Failed to write file to disk.', // UPLOAD_ERR_CANT_WRITE
  8 => 'A PHP extension stopped the file upload.' // UPLOAD_ERR_EXTENSION
);
```


## PHP File Size Limits

By default, PHP limits file uploads to 2MB. You can change this limit by adjusting the `upload_max_filesize` and `post_max_filesize` values in your `php.ini` file. For example:

```ini
    upload_max_size = 10M
    post_max_filesize = 10M
```

To find out where your `php.ini` files are located, run `phpinfo()`.

---

## Common Image Handling Scenarios

### Assigning a File Name

It's extremely unlikely that you will encounter a filename collision using the uniqid() function since it is based on the current time in microseconds. However, it's still theoretically possible, especially if you're writing an app with millions upon millions of active users, all uploading everything all at once. To add an extra level of safety, you can use a do/while loop to check if a file with that name already exists, and if it does, generate a new name.

```PHP
    do {

    } while ();
```


### Cropping & Resizing

#### Aspect Ratio Challenges

If we're allowing our user to upload images to our platform, we don't necessarily know what dimensions or aspect ratio this image will be. Broadly, it can be one of three things: 

1. a square image (where the height and width are equal);
2. a portrait image (a tall image, where the height is greater than the width); or
3. a landscape image (a wide image, where the width is greater than the height).

Since users can upload images with any aspect ratio, you need to standardize them to a few fixed dimensions:

    Landscape Images: Typically resized to 1280×720.

    Portrait Images: Typically resized to 720×1280.

    Square Images: Typically resized to 720×720.

The "Cover" Technique:
This approach involves scaling the image so that it completely covers the target dimensions without stretching. Here’s how it works:

    Calculate Scaling Factors:
    Compute the scale factors for both width and height, then choose the larger factor. This ensures that after scaling, the image fills the target area.

    Resize the Image:
    Use imagecopyresampled() to resize the image based on the new dimensions.

    Center-Crop:
    Once the image is resized, determine the offset required to crop the center of the image so it exactly fits the target dimensions. This avoids any distortion or stretching, even if some parts of the image are cropped out.

Square-Cropping for Thumbnails:
When creating square thumbnails, the algorithm finds the smallest dimension (using min($width_orig, $height_orig)) to define the side length of the square. It then calculates the offsets to crop the image centrally, ensuring a balanced thumbnail without stretching.



### Square-Cropping Algorithm

To create a square thumbnail from an image, regardless of whether it's portrait, landscape, or already square, we need to figure out what the smallest dimension is. This is because a square has equal height and width, so we need to find the maximum square that fits inside the original image. We then crop the image to this square, so that it keeps the most important parts of the image (... errr, in most images. If the composition angles things a little differently, or falls on visual thirds or the golden ratio or whatever, we may not be so lucky), without stretching or squashing the image.

The min($width_orig, $height_orig) line is finding the smallest size between the width and height of the original image. This will be the size of the sides of our square crop.

The next two lines are calculating the starting point (top-left corner) for the cropping process. Essentially, we want to crop around the center of the image, so we need to figure out where to start cropping from.

If the image is wider than it is tall ($width_orig > $smaller_size), we start cropping from the center of the width, hence ($width_orig - $smaller_size) / 2. Otherwise, we start cropping from the left edge of the image, hence 0.

Similarly, if the image is taller than it is wide ($height_orig > $smaller_size), we start cropping from the center of the height, hence ($height_orig - $smaller_size) / 2. Otherwise, we start cropping from the top edge of the image, hence 0.


### Preserving Transparency

When working with PNG or WEBP images, preserving transparency is crucial. Use:

  - `imagealphablending($image, false);`
  - `imagesavealpha($image, true);`

These functions disable blending and ensure that the alpha channel (transparency) is saved when the image is output.

---

## Footnotes

[^1]: [Common MIME Types (MDN)](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/MIME_types/Common_types)

[^2]: [$_FILES Error Messages Explained (PHP.net)](https://www.php.net/manual/en/features.file-upload.errors.php)