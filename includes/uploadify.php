<?php
/*
Uploadify v2.1.4
Release Date: November 8, 2010

Copyright (c) 2010 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

include_once "/path/to/includes/includes.php";
include_once "/path/to/includes/simpleImage.php";

// DECLARE DEFAULT VALUES
$maxHeight = 350;
$maxThumbHeight = 75;

$maxWidth = 475;
$maxThumbWidth = 75;

if (!empty($_FILES)) {
    $gid = intval($_POST['gid']);
    
    $tempFile = $_FILES['Filedata']['tmp_name'];
    $newFile = $_FILES['Filedata']['name'];
    $targetPath = '/path/to/uploads/originals/';
    $targetFile =  str_replace('//','/',$targetPath) . $gid . "." . $newFile;
    $thumbnailPath = '/path/to/uploads/thumbnails/';
    $thumbnailFile =  str_replace('//','/',$thumbnailPath) . $gid . "." . $newFile;
    $resizedPath = '/path/to/uploads/resized/';
    $resizedFile =  str_replace('//','/',$resizedPath) . $gid . "." . $newFile;
    
    move_uploaded_file($tempFile,$targetFile);

    $image = new SimpleImage();
    $image->load($targetFile);
    $width = $image->getWidth();
    $height = $image->getHeight();

    // Create resized image
    if ($width > $height) {
        if ($width > $maxWidth) {
            $image->resizeToWidth($maxWidth);
        }
    } else {
        if ($height > $maxHeight) {
            $image->resizeToHeight($maxHeight);
        }
    }
    $image->save($resizedFile);
    
    // Create thumbnail
    if ($width > $height) {
        if ($width > $maxThumbWidth) {
            $image->resizeToWidth($maxThumbWidth);
        }
    } else {
        if ($height > $maxThumbHeight) {
            $image->resizeToHeight($maxThumbHeight);
        }
    }
    $image->save($thumbnailFile);

    // Add to database
    $newFile = $mysqli->real_escape_string($newFile);
    $mysqli->query("INSERT INTO images (filename, title, gallery, enabled) VALUES ('{$gid}.{$newFile}', '{$newFile}', {$gid}, 0)");

    echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
}
