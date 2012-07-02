<?php
include_once "/path/to/includes/simpleImage.php";

// DECLARE DEFAULT VALUES
$maxHeight = 350;
$thumbHeight = 48;
$maxWidth = 475;
$thumbWidth = 48;
$targetPath = '/path/to/uploads/originals/';
$thumbnailPath = '/path/to/uploads/thumbnails/';
$resizedPath = '/path/to/uploads/resized/';
if (isset($_GET['i'])) {
    $imageID = intval($_GET['i']);
} else {
    $imageID = 0;
}

$getImageFileName = $mysqli->query("SELECT filename FROM images WHERE id={$imageID} LIMIT 1");
$resultImageFileName = $getImageFileName->fetch_object();

switch ($_GET['s']) {
case 't':
    $imageName = $thumbnailPath.$resultImageFileName->filename;
    break;
case 'f':
    $imageName = $resizedPath.$resultImageFileName->filename;
    break;
case 'o':
    $imageName = $targetPath.$resultImageFileName->filename;
    break;
default:
    $imageName = '';
    break;
}
echo $image;
header('Content-Type: image/jpeg');
$image = new SimpleImage();
$image->load($imageName);
$image->output();
die();
