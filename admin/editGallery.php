<?php
$gid = isset($_GET['gid']) ? intval($_GET['gid']) : -1;

// Get image list
$getImageList = "SELECT id, filename, title, description, enabled FROM images WHERE gallery={$gid} ORDER BY filename";
$resultImageList = $mysqli->query($getImageList);

$html .= "<div id='imageList'>
    <h2>Image List</h2>";

if ($resultImageList->num_rows >= 1) {
    // Display list of galleries
    $html .= "
        <table>
        <thead>
        <tr>
        <td>&nbsp;</td>
        <td>Image</td>
        <td>&nbsp;</td>
        </tr>
        </thead>
        <tbody>";

    while($row = $resultImageList->fetch_object()) {
        $actionList = array();

        if ($row->enabled == 1) {
            $actionList[] = "<a href='enableImage.php?gid=".$gid."&iid=".$row->id."&s=2'><img src='/images/green_circle.gif'></a>";
        } else {
            $actionList[] = "<a href='enableImage.php?gid=".$gid."&iid=".$row->id."&s=3'><img src='/images/red_circle.gif'></a>";
        }

        $actionList[] = "<a href='editImage.php?iid=".$row->id."'><img src='/images/edit-icon.gif'></a>";
        $actionList[] = "<a href='deleteImage.php?iid=".$row->id."&gid=".$gid."' class='deleteImageLink'><img src='/images/delete.png'></a>";

        $allActions = join('&nbsp;', $actionList);

        $html .= "<tr valign=middle>
            <td><img src='showImage.php?i=".$row->id."&s=t'></td>
            <td>".$row->title."</td>
            <td>".$allActions."</td>
            </tr>";
    }
    $html .= "
        </tbody>
        </table>
        ";
} else {
    $html .= "No images in the gallery";
}

$html .= "</div><hr class='dividingLine'>";

// Show form to add new galleries
$html .= $addResult;
$html .= "
    <div id='uploadImagesForm'>
    <h2>Upload Images to Gallery</h2>
    <div id='numFilesUploaded'></div>
    <input id='file_upload' name='file_upload' type='file' />
    </div>";

$html .= "<script type='text/javascript'>
    $('.deleteImageLink').click(function() {
        if (confirm('Do you want to delete the image from the server?')) {
            return true;
        } else {
            return false;
        }
    });
</script>";
