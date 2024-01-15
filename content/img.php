<?php
function echoImagesWithOverlay($imageDirectory, $imageExtension = 'jpg', $title = 'Image title') {

    $images = glob($imageDirectory . '/*.' . $imageExtension);

    $i = 1;
    foreach ($images as $image) {
        echo '<li>';
        echo '<img class="image" src="' . $image . '" alt="image.' . $i . '">';
        echo '<div class="overlay"><span>' . $title . '</span></div>';
        echo '</li>';
        $i++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image gallary</title>
    <link rel="stylesheet" href="img.css">
</head>
<body>
    <h1>Responsive <span style="font-weight:lighter">image gallery</span></h1>
    <div class="image_container">
        <ul class="image_gallary">
            <?php echoImagesWithOverlay("img"); ?>
        </ul>
    </div>
</body>
</html>