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

include 'includes/upload.php';

?>

<section class="row justify-content-center my-5">
    <div class="col-md-6">
        <h1 class="display-4">Upload Image Files</h1>
        <p class="lead">To add an image to our gallery, fill out the form below and choose an image file from your device to upload to our server.</p>
        <!-- Link to Gallery Page -->
        <a href="gallery.php" class="btn btn-dark my-5">View Gallery Page</a>

        <hr class="my-5">

        <?php if ($message != "") : ?>
            <!-- Error Message Box -->
            <div class="alert alert-secondary my-5" role="alert">
                <?= $message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($file_name_new)) : ?>
            <!-- Preview: If there's a newly created image, we'll show a preview to the user. -->
            <div class="card text-bg-dark">
                <img src="images/thumbs/<?= $file_name_new; ?>" alt="<?= $img_description; ?>">
                <div class="card-img-overlay">
                    <h2 class="card-title"><?= $img_title; ?></h2>
                    <p class="card-text"><?= $img_description; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Upload Form -->

        <!-- enctype attribute: This attribute is used to specify the encoding format, in which the data submitted in the form has to be encoded before sending it to the server. This attribute is very important and without specifying this, the image will not be uploaded to the server. -->
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <h2 class="fw-light fs-3 mb-4">Submission Form</h2>

            <!-- Image Title -->
            <div class="mb-3">
                <label for="img-title" class="form-label">Image Title</label>
                <input type="text" id="img-title" name="img-title" class="form-control" maxlength="50" value="<?= $img_title; ?>" required>
                <p class="form-text">Your title must be 50 characters or fewer.</p>
            </div>

            <!-- Image Description -->
            <div class="mb-3">
                <label for="img-description" class="form-label">Image Description</label>
                <input type="text" id="img-description" name="img-description" maxlength="255" class="form-control" value="<?= $img_description; ?>" required>
                <p class="form-text">Your description must be 255 characters or fewer.</p>
            </div>

            <!-- File Upload -->
            <div class="mb-3">
                <label for="img-file" class="form-label">Image File</label>
                <input type="file" id="img-file" name="img-file" class="form-control" accept=".avif, .jpg, .jpeg, .png, .webp" required>
                <p class="form-text">The following file types are accepted: AVIF, JPG, JPEG, PNG, WEBP</p>
            </div>

            <!-- Submit Button -->
            <input type="submit" name="submit" id="submit" value="Upload Image" class="btn btn-primary mt-5">
        </form>
    </div>
</section>


<?php

include 'includes/footer.php';

?>