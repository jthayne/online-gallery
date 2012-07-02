<?php
include_once "./includes/includes.php";

header("Content-type: text/xml");

$xml = '<galleries>';

$getGalleryList = "SELECT 
        g.id, 
        g.name, 
        COUNT(i.id) as cnt 
    FROM galleries g 
        INNER JOIN images i ON i.gallery=g.id 
            AND i.enabled=1
    WHERE g.enabled=1 
    GROUP BY g.id 
    HAVING cnt > 0 
    ORDER BY g.name ASC";
$resultGalleryList = $mysqli->query($getGalleryList);

while ($row = $resultGalleryList->fetch_object()) {
    $xml .= "<gallery base='includes/' file='photos.php?g={$row->id}'>
        <sitename>{$row->name}</sitename>
        <photographer></photographer>
        <contactinfo></contactinfo>
        <email></email>
        <security><![CDATA[]]> </security>
    </gallery>";
}

$xml .= '</galleries>';

echo $xml;
