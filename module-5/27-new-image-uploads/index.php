<!-- 

PROGRAM SPECS & FLOW: We're going to create a small website that has just two pages:

1. index.php: this is where the user will be given a form that prompts them to upload an image, along with a title and description. When the user submits the form, it will create two versions of the image (a 256x256 square thumbnail that retains the original aspect ratio and a 720p full version of the image).

2. gallery.php: this will fetch the thumbnails for each image and allow the user to view a larger version of each.

Our project directory will look like this:

/22-image-uploads
    /images
        /full
        /thumbs
    index.php
    gallery.php
    upload.php

... but the images/ folder and everything inside will only exist on the server.

We will also need a table (see `init.sql`) in order to store some metadata for each image.

 -->

 <?php
 
$page_title = "Upload Image Files";
include 'includes/header.php';

?>

<section class="row justify-content-center my-5">
    <div class="col-md-6">
        <h1 class="display-4">Upload Image Files</h1>
        <p class="lead">To add an image to our gallery, fill out the form below and choose an image file from your device to upload to our server.</p>
        <!-- Link to Gallery Page -->
        <a href="gallery.php" class="btn btn-dark my-5">View Gallery Page</a>

        <hr class="my-5">

        <!-- Error Message Box -->

        <!-- Preview: If there's a newly created image, we'll show a preview to the user. -->

        <!-- Upload Form -->

    </div>
</section>


<?php

include 'includes/footer.php';

?>