<?php

// First, let's create an image object that is 512px by 512px large.
$image = imagecreate(512, 512);

// Let's create a nice dark red to fill it with.
$crimson = imagecolorallocate($image, 153, 0, 0);

// When we created our canvas, it was completely empty. Here, we're filling it with the red we made, starting at positional coordinates (0, 0). This means we are starting at the origin (upper left-hand corner) and filling the whole canvas.
imagefill($image, 0, 0, $crimson);

// This tells the browser what MIME type we're dealing with. It says 'get ready for an image, not HTML'.
header("Content-type: image/png");

// This outputs our image in the form of a PNG to the browser.
imagepng($image);

// Now that we have our output, we need to destroy the image object in order to free up resources for the server.
imagedestroy($image);

?>