<?php

require 'connection.php';
require_once 'vendor/mobiledetect/mobiledetectlib/Mobile_Detect.php';

$detect = new Mobile_Detect;

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gallery</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h1>Gallery by Ilnur</h1>
<a href="https://github.com/Ilnur786/PHP-script/tree/master"><h2>GitHub</h2></a>
<div class="gallery">
    <?
    if ($handle = opendir('gallery')) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                if ($detect->isMobile()) {
                    $size = 'mic';?>
                    <a href="generator.php?name=<?=$entry;?>&size=med"
                       data-fancybox="images-preview" data-caption="640x480"
                       data-thumbs='{"autoStart":true}'>
                        <img srcset="generator.php?name=<?=$entry;?>&size=mic 150w,
                                    generator.php?name=<?=$entry;?>&size=min 320w,
                                    generator.php?name=<?=$entry;?>&size=med 640w,
                                    generator.php?name=<?=$entry;?>&size=big 800w"
                             sizes="(max-width: 320px) 280px, (min-width: 321px) 281px, (min-width: 1200px) 1160px, (min-width: 1920px)"
                             src="gallery/<?=$entry;?>" alt="">
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
                        <img srcset="generator.php?name=<?=$entry;?>&size=mic 150w,
                                    generator.php?name=<?=$entry;?>&size=min 320w,
                                    generator.php?name=<?=$entry;?>&size=med 640w,
                                    generator.php?name=<?=$entry;?>&size=big 800w"
                             sizes="(max-width: 320px) 280px, (min-width: 321px) 281px, (min-width: 1200px) 1160px, (min-width: 1920px)"
                             src="gallery/<?=$entry;?>" alt="">
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
                        <img srcset="generator.php?name=<?=$entry;?>&size=mic 150w,
                                    generator.php?name=<?=$entry;?>&size=min 320w,
                                    generator.php?name=<?=$entry;?>&size=med 640w,
                                    generator.php?name=<?=$entry;?>&size=big 800w"
                             sizes="(max-width: 320px) 280px, (min-width: 321px) 281px, (min-width: 1200px) 1160px, (min-width: 1920px)"
                             src="gallery/<?=$entry;?>" alt="">
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
