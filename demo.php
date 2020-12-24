<?php

require 'connection.php';
require_once 'vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php';

$detect = new Mobile_Detect;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <title>Gallery</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
</head>
<body>
    <?
    if ($handle = opendir('gallery')) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                if ($detect->isMobile()) {
                    $size = 'mic';?>
                <a href="generator.php?name=<?=$entry;?>&size=med"
                   data-fancybox="images-preview" data-caption="640x480"
                   data-thumbs='{"autoStart":true}'>
                    <img src="generator.php?name=<?=$entry;?>&size=<?=$size;?>"  alt=""/>
                </a>
                <div style="display: none">
                    <a href="generator.php?name=<?=$entry;?>&size=min" data-fancybox="images-preview" data-caption="320x240"
                       data-thumb="generator.php?name=<?=$entry;?>&size=<?=$size;?>"></a>
                    <a href="generator.php?name=<?=$entry;?>&size=mic" data-fancybox="images-preview" data-caption="150x150"
                       data-thumb="generator.php?name=<?=$entry;?>&size=<?=$size;?>"></a>
                </div>
                <?}
                else if ($detect->isTablet()) {
                    $size = 'mic';?>
                <a href="generator.php?name=<?=$entry;?>&size=big"
                   data-fancybox="images-preview" data-caption="800x600"
                   data-thumbs='{"autoStart":true}'>
                    <img src="generator.php?name=<?=$entry;?>&size=<?=$size;?>"  alt=""/>
                </a>
                <div style="display: none">
                    <a href="generator.php?name=<?=$entry;?>&size=med" data-fancybox="images-preview" data-caption="640x480"
                       data-thumb="generator.php?name=<?=$entry;?>&size=<?=$size;?>"></a>
                    <a href="generator.php?name=<?=$entry;?>&size=min" data-fancybox="images-preview" data-caption="320x240"
                       data-thumb="generator.php?name=<?=$entry;?>&size=<?=$size;?>"></a>
                    <a href="generator.php?name=<?=$entry;?>&size=mic" data-fancybox="images-preview" data-caption="150x150"
                       data-thumb="generator.php?name=<?=$entry;?>&size=<?=$size;?>"></a>
                </div>
                <?}
                else {
                    $size = 'min';?>
                    <a href="generator.php?name=<?=$entry;?>&size=big"
                       data-fancybox="images-preview" data-caption="800x600"
                       data-thumbs='{"autoStart":true}'>
                        <img src="generator.php?name=<?=$entry;?>&size=<?=$size;?>"  alt=""/>
                    </a>
                    <div style="display: none">
                        <a href="generator.php?name=<?=$entry;?>&size=med" data-fancybox="images-preview" data-caption="640x480"
                           data-thumb="generator.php?name=<?=$entry;?>&size=<?=$size;?>"></a>
                        <a href="generator.php?name=<?=$entry;?>&size=min" data-fancybox="images-preview" data-caption="320x240"
                           data-thumb="generator.php?name=<?=$entry;?>&size=<?=$size;?>"></a>
                    </div>
                <?}
                    }
                }
                closedir($handle);
            }
    ?>
</body>
