<?php

require 'connection.php';

$browser = get_browser(null, true);

if ($browser['ismobiledevice'])   #условие должно быть для Desktop
{
    $size = "mic";
//    $sql1 = $pdo->query("SELECT width FROM sizes1 WHERE code = 'mic'");
//    $row = $sql1->fetch();
//    $w = (int)$row['width'];
//    $sql2 = $pdo->query("SELECT height FROM sizes1 WHERE code = 'mic'");
//    $row = $sql2->fetch();
//    $h = (int)$row['height'];
}
else
{
    $size = "min";
//    $sql1 = $pdo->query("SELECT width FROM sizes1 WHERE code = 'min'");
//    $row = $sql1->fetch();
//    $width = (int)$row['width'];
//    $sql2 = $pdo->query("SELECT height FROM sizes1 WHERE code = 'min'");
//    $row = $sql2->fetch();
//    $height = (int)$row['height'];
}

//print $width;
//print $height;

//if ($handle = opendir('gallery')) {
//    while (false !== ($entry = readdir($handle))) {
//        if ($entry != "." && $entry != "..") {
//            $path_parts = pathinfo($entry);
//            echo $path_parts["filename"], "\n";
//        }
//    }
//    closedir($handle);
//}
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
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
<!--    <div class="button">-</div>-->
<!--    <div class="gallery">-->
<!--        <div class="big">-->
<!--            <img src="gallery/start.jpg" alt="Start">-->
<!--        </div>-->
<!--        <div class="small">-->
<!--            <a href="gallery/1.jpg"><img src="gallery/1_mini.jpg" alt=""></a>-->
<!--            <a href="gallery/2.jpg"><img src="generator.php?name=2&size=mic" alt=""></a>-->
<!--            <a href="gallery/3.jpg"><img src="gallery/3_mini.jpg" alt=""></a>-->
<!--            <a href="gallery/4.jpg"><img src="gallery/4_mini.jpg" alt=""></a>-->
<!--        </div>-->
<!--    </div>-->
<div class="gallery">
    <?
    if ($handle = opendir('gallery')) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $img_name = pathinfo($entry)["filename"];?>
                <img src="generator.php?name=<?print $entry;?>&size=<?print $size;?>" alt="">
            <?}
        }
        closedir($handle);
    }
    ?>
</div>
</body>
