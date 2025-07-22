<?php

// Instead of creating an image object from nothing, let's create an image object from a file that already exists. 
$image = imagecreatefromjpeg("originals/camera.jpg");

// This method changes the gamma in an image (i.e. the threshhold for how much light is or isn't present).
imagegammacorrect($image, 1.0, 3.0);

// Instead of outputting the final result to the browser, let's try saving the image this time.
imagejpeg($image, "img/image-output.jpeg");

// After running this in your browser, it should appear in the lesson files (in the specified directory).

// Let's destroy our working image object.
imagedestroy($image);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gamma Correction Demo</title>

    <style>
        img {
            margin: 0 auto;
            max-width: 100%;
        }
    </style>
</head>
<body>
    <h1>Gamma Correction Demo</h1>
    <img src="img/image-output.jpeg" alt="This is a brighter version of a camera resting on a sheepskin.">
</body>
</html>