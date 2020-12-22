<?php

require 'connection.php';

$name = $_GET['name'];
$size = $_GET['size'];
//$name = 'Безымянный.png';
//$size = 'min';
$sql1 = $pdo->prepare("SELECT width, height FROM sizes1 WHERE code = :size");
$sql1->execute(array(':size' => $size));
$row = $sql1->fetch();
$w = (int)$row['width'];
$h = (int)$row['height'];

function fileBuildPath(...$segments): string
{
    return join(DIRECTORY_SEPARATOR, $segments);
}

function imageCreateFromAny($filepath) {
    $type = exif_imagetype($filepath);

    switch ($type) {
        case IMAGETYPE_GIF :
            $im = imageCreateFromGif($filepath);
            break;
        case IMAGETYPE_JPEG :
            $im = imageCreateFromJpeg($filepath);
            break;
        case IMAGETYPE_PNG :
            $im = imageCreateFromPng($filepath);
            break;
    }

    if (!$im) {                 #какую то проверку добавить
        return false;
    }
    return $im;
}

function doImagePreview($name, $width_new, $height_new): string
{
    $hash_dir_name = md5($name);
    $dir_path = fileBuildPath('cache_ext', $hash_dir_name);
    if (!file_exists($dir_path))   #проверка на существование дериктории с изображениями разных размеров
    {
        mkdir($dir_path);
    }
    $filename_preview = fileBuildPath(__DIR__, 'cache_ext', $hash_dir_name, $width_new . $height_new . '.jpg');
    $filename_original = fileBuildPath('gallery', $name);
    $info = getimagesize($filename_original);
    $width_original  = $info[0];
    $height_original = $info[1];
    $img = imageCreateFromAny($filename_original);
    $tmp = imageCreateTrueColor($width_new, $height_new);
    imageCopyResampled($tmp, $img, 0, 0, 0, 0, $width_new, $height_new, $width_original, $height_original);
    imagejpeg($tmp, $filename_preview, 100);
    imagedestroy($tmp);
    return $filename_preview;
}
function getImagePreview($name, $width_new, $height_new): string
{
    $hash_dir_name = md5($name);
    $filename_preview = fileBuildPath(__DIR__, 'cache_ext', $hash_dir_name, $width_new . $height_new . '.jpg');
    if (!file_exists($filename_preview))   #проверка на существование изображения с необходимыми размерами
    {
        $filename_preview = doImagePreview($name, $width_new, $height_new);
    }
    return $filename_preview;
}

$url = getImagePreview($name, $w, $h);
header('Content-type: image/jpeg');
readfile($url);
//header('Content-type: text/plane');
//echo $url;


