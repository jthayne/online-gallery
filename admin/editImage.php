<?php
$imageID = isset($_GET['iid']) ? intval($_GET['iid']) : 0;

$addResult = "";
if (isset($_POST['filedescription']) || isset($_POST['filetitle'])) {
    $name = $mysqli->real_escape_string($_POST['filetitle']);
    $desc = $mysqli->real_escape_string($_POST['filedescription']);
    $enab = intval($_POST['enabled']);

    $getGalleryID = "SELECT gallery FROM images WHERE id='{$imageID}' LIMIT 1";
    $resultGalleryID = $mysqli->query($getGalleryID);
    $galleryInfo = $resultGalleryID->fetch_object();
    $gid = $galleryInfo->gallery;

    $updateImageInfo = "UPDATE images SET title='{$name}', description='{$desc}', enabled={$enab} WHERE id={$imageID}";
    $mysqli->query($updateImageInfo);

    header("Location:editGallery.php?gid={$gid}");
    die();
}

// Get image details
$getImageList = "SELECT filename, title, description, enabled FROM images WHERE id={$imageID} LIMIT 1";
$resultImageList = $mysqli->query($getImageList);

if ($resultImageList->num_rows == 1) {
    // Display image information
    $html .= "
        <div id='imageInfo'>
        <h2>Image Details</h2>
        <form id='imageDetailsForm' method='post' action='editImage.php?iid={$imageID}'>
        <table>";

    $row = $resultImageList->fetch_object();

    // Show image
    $html .= "<tr>
            <td colspan=2>
                <img src='showImage.php?i=".$imageID."&s=t'> <br>
                <a href='showImage.php?i=".$imageID."&s=f' target='new'>View Resized Image</a><br>
                <a href='showImage.php?i=".$imageID."&s=o' target='new'>View Original Image</a>
            </td>
        </tr>";

    // Show title
    $html .= "<tr><td>Title: </td><td><input type='text' name='filetitle' value='".$row->title."'></td></tr>";

    //Show description
    $html .= "<tr><td>Description: </td><td><textarea name='filedescription'>".$row->description."</textarea></td></tr>";

    //Show enabled radio options
    $ye = '';
    if($row->enabled == 1) {
        $ye = " checked";
    }
    $ne = '';
    if($row->enabled == 0) {
        $ne = " checked";
    }
    $html .= "<tr>
            <td>Enabled: </td>
            <td><input type='radio' value='1' name='enabled[]'{$ye}>Yes <input type='radio' value='0' name='enabled[]'{$ne}> No</td>
        </tr>";

    //Show form submission buttons
    $html .= "<tr><td><input type='button' value='Cancel Changes' id='cancelChanges'></td><td><input type='submit' value='Save Changes' id='saveChanges'></td></tr>";

    $html .= "
        </table>
        </form>
        </div>
        <hr class='dividingLine'>
        ";

    $html .= "
        <script type='text/javascript'>
            $('#cancelChanges').click(function(event) {
                event.preventDefault();
                history.go(-1);
            });
        </script>
        ";
}
