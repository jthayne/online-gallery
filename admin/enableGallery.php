<?php
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
    header('Location:gallery.php');
    die();
}

$result = $mysqli->query("SELECT enabled FROM galleries WHERE id={$gid} LIMIT 1");
if ($result->num_rows == 0) {
    // Gallery does not exist
    header('Location:gallery.php');
}

$mysqli->query("UPDATE galleries SET enabled={$e} WHERE id={$gid}");
header('Location:gallery.php');
