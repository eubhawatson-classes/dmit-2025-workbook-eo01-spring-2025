<?php

$page_title = "Image Gallery";
include 'includes/header.php';

?>

<section class="row justify-content-center my-5">
    <div class="col-md-6">
        <h1 class="display-4">Image Gallery</h1>
        <p class="lead">Welcome to our gallery of images, uploaded by users just like you. To add more images to the gallery, click the link below to be taken to the upload page.</p>
        <!-- Link to Upload Page -->
        <a href="index.php" class="btn btn-dark my-5">Upload Images</a>

        <hr class="my-5">
    </div>
</section>

<?php

$query = "SELECT * FROM gallery_prep ORDER BY `uploaded_on` DESC;";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) : ?>

    <section class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">

        <?php

        while ($row = mysqli_fetch_array($result)) {

            // We'll use the primary key to generate buttons that launch a specific modal window, all of which required a unique ID attribute. 
            $id = $row['image_id'];
            $title = $row['title'];
            $description = $row['description'];
            $filename = $row['filename'];
            $uploaded_on = $row['uploaded_on'];

        ?>

            <!-- Thumbnail Card -->
            <div class="col">
                <div class="card p-0 shadow-sm">
                    <img src="images/thumbs/<?= $filename; ?>" alt="<?= $description; ?>" class="card-img-top">
                    <div class="card-body">
                        <h2 class="fs-5"><?= $title; ?></h2>
                        <p class="card-text">Added On <?= $uploaded_on; ?></p>
                        <!-- The modal ID will look like: modal-1 -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-<?= $id; ?>">View</button>
                    </div> <!-- end of .card-body -->
                </div> <!-- end of .card -->
            </div> <!-- end of .col -->

            <!-- Modal Window -->
            <div class="modal fade" id="modal-<?= $id; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h3 class="modal-title display-6"><?= $title; ?></h3>
                            <!-- Dismiss Button -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="text-center">
                                <img src="images/full/<?= $filename; ?>" alt="<?= $description; ?>" class="img-fluid">
                            </div>
                            <p class="mt-4"><?= $description; ?></p>
                            <p>Added On <?= $uploaded_on; ?></p>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div> <!-- end of .modal-footer -->
                    </div> <!-- end of .modal-content -->
                </div> <!-- end of .modal-dialog -->
            </div> <!-- end of modal window -->
        <?php

        } // end of while loop

        ?>

    </section>

<?php else : ?>

    <!-- If there are no records found, we'll give the user an error message. -->
    <section class="row justify-content-center">
        <div class="col-md-6">
            <h2>Oops!</h2>
            <p>We weren't able to find any images in our gallery - but this is where you come in. Return to the <a href="index.php">upload page</a> to submit your own.</p>
        </div>
    </section>

<?php endif;

include 'includes/footer.php';

?>