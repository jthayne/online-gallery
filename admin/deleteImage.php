<?php
$iid = isset($_GET['iid']) ? intval($_GET['iid']) : 0;
$gid = isset($_GET['gid']) ? intval($_GET['gid']) : 0;
$targetPath = '/path/to/uploads/originals/';
$thumbnailPath = '/path/to/uploads/thumbnails/';
$resizedPath = '/path/to/uploads/resized/';

$result = $mysqli->query("SELECT * FROM images WHERE id={$iid} AND gallery={$gid} LIMIT 1");
if ($result->num_rows == 0) {
    // Image does not exist
    header('Location:editGallery.php?gid='.$gid);
}

$row = $result->fetch_object();
$fn = $row->filename;

if (file_exists("{$targetPath}{$fn}")) unlink("{$targetPath}{$fn}");
if (file_exists("{$thumbnailPath}{$fn}")) unlink("{$thumbnailPath}{$fn}");
if (file_exists("{$resizedPath}{$fn}")) unlink("{$resizedPath}{$fn}");

$mysqli->query("DELETE FROM images WHERE id={$iid} AND gallery={$gid}");
header('Location:editGallery.php?gid='.$gid);
