<?php
$addResult = "";
if (isset($_POST['galleryname']) || isset($_POST['gallerydescription'])) {
    $name = $mysqli->real_escape_string($_POST['galleryname']);
    $desc = $mysqli->real_escape_string($_POST['gallerydescription']);

    $verifyUniqueName = "SELECT * FROM galleries WHERE name='$name'";
    $isNameUnique = $mysqli->query($verifyUniqueName);
    if ($isNameUnique->num_rows == 0) {
        //Name is unique.  Add to the db
        $addGalleryToDb = "INSERT INTO galleries (name, description, enabled) VALUES ('$name', '$description', 0)";
        $mysqli->query($addGalleryToDb);

        $addResult = "<div class='notification'>Gallery Added</div>";
    } else {
        //Name is not unique.  Display error.
        $addResult = "<div class='notification'>Name is not unique. Gallery was not added</div>";
    }
}

// Get gallery list
$getGalleryList = "SELECT g.id, g.name, g.description, g.enabled, count(i.id) as imageNumber FROM galleries g LEFT JOIN images i ON g.id=i.gallery GROUP BY g.id";
$resultGalleryList = $mysqli->query($getGalleryList);

if ($resultGalleryList->num_rows >= 1) {
    // Display list of galleries
    $html .= "
        <div id='galleryList'>
        <h2>Gallery List</h2>
        <table>
        <thead>
        <tr>
        <td>Gallery</td>
        <td># of Images</td>
        <td>&nbsp;</td>
        </tr>
        </thead>
        <tbody>";

    while($row = $resultGalleryList->fetch_object()) {
        $actionList = array();

        if ($row->enabled == 1) {
            $actionList[] = "<a href='enableGallery.php?gid=".$row->id."&s=2'><img src='/images/green_circle.gif'></a>";
        } else {
            $actionList[] = "<a href='enableGallery.php?gid=".$row->id."&s=3'><img src='/images/red_circle.gif'></a>";
        }

        $actionList[] = "<a href='editGallery.php?gid=".$row->id."'>edit</a>";

        $allActions = join("</td><td valign='middle'>", $actionList);

        $html .= "</tr><td>".$row->name."</td><td>".$row->imageNumber."</td><td valign='middle'>".$allActions."</td></tr>";
    }
    $html .= "
        </tbody>
        </table>
        </div>
        <hr class='dividingLine'>
        ";
}

// Show form to add new galleries
$html .= $addResult;
$html .= "
    <div id='createNewGalleryForm'>
    <h2>Create New Gallery</h2>
    <form action='gallery.php' method='post'>
    <table>
    <tr>
    <td>Name:</td>
    <td><input type='text' name='galleryname'></td>
    </tr>
    <tr>
    <td>Description:</td>
    <td><textarea name='gallerydescription'></textarea></td>
    </tr>
    <tr>
    <td>&nbsp;</td><td><input type='submit' value='Add Gallery'></td>
    </tr>
            </table>
        </form>
    </div>";

