<?php
$iid = isset($_GET['iid']) ? intval($_GET['iid']) : 0;
$gid = isset($_GET['gid']) ? intval($_GET['gid']) : 0;
$action = isset($_GET['s']) ? intval($_GET['s']) : 0;

switch ($action) {
case 2:
    $e = 0;
    break;
case 3:
    $e = 1;
    break;
default:
    header('Location:editGallery.php?gid='.$gid);
    die();
}

$result = $mysqli->query("SELECT enabled FROM images WHERE id={$iid} LIMIT 1");
if ($result->num_rows == 0) {
    // Gallery does not exist
    header('Location:editGallery.php?gid='.$gid);
}

$mysqli->query("UPDATE images SET enabled={$e} WHERE id={$iid}");
header('Location:editGallery.php?gid='.$gid);
