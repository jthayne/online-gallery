<?php
$extraCSS = "#centercontent { width: 98%; height: 420px;}</style>
    <link rel='stylesheet' type='text/css' media='screen' href='/styles/screen.css' /><style type='text/css'>";


$html .= "<noscript><h1>This page requires JavaScript. Please enable JavaScript in your browser and reload this page.</h1></noscript>";

$html .= "<script type='text/javascript' src='/includes/gallery.js'></script>";
$html .= "<div id='wrap'>
    <div id='previews'>
        <div id='galleries' spry:region='dsGalleries'>
            <label for='gallerySelect'>Choose a Gallery:</label>
            <select spry:repeatchildren='dsGalleries' spry:choose='choose' id='gallerySelect' onchange='dsGalleries.setCurrentRowNumber(this.selectedIndex);'>
                <option spry:when='{ds_RowNumber} == {ds_CurrentRowNumber}' selected='selected'>{sitename}</option>
                <option spry:default='default'>{sitename}</option>
            </select>
        </div>
    </div>
    <div id='previews2'>
        <div id='thumbnails' spry:region='dsPhotos dsGalleries dsGallery'>
            <div spry:repeat='dsPhotos' onclick='HandleThumbnailClick(\"{ds_RowID}\");' onmouseover='GrowThumbnail(this.getElementsByTagName(\"img\")[0], \"{@thumbwidth}\", \"{@thumbheight}\");' onmouseout='ShrinkThumbnail(this.getElementsByTagName(\"img\")[0]);'>
                <img id='tn{ds_RowID}' alt='thumbnail for {@thumbpath}' src='{dsGalleries::@base}{dsGallery::thumbnail/@base}{@thumbpath}' width='24' height='24' style='left: 0px; right: 0px;' />
            </div>
            <p class='ClearAll'></p>
        </div>
    </div>
    <div id='picture'>
        <div id='mainImageOutline' style='width: 0px; height: 0px;'><img id='mainImage' alt='main image' /></div>
    </div>
    <p class='clear'></p>
</div>";
