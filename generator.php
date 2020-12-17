<?php

require 'connection.php';

$name = $_GET['name'];
$size = $_GET['size'];
$sql1 = "SELECT width FROM sizes1 WHERE code= '{$size}'";
$width_array = mysqli_query($link, $sql1);
$w = (int)mysqli_fetch_row($width_array)[0];
$sql2 = "SELECT height FROM sizes1 WHERE code= '{$size}'";
$height_array = mysqli_query($link, $sql2);
$h = (int)mysqli_fetch_row($height_array)[0];

function fileBuildPath(...$segments): string
{
    return join(DIRECTORY_SEPARATOR, $segments);
}

function doImagePreview($name, $width_new, $height_new): string
{
    $hash_dir_name = md5($name);
    $dir_path = fileBuildPath('cache', $hash_dir_name);
    if (!file_exists($dir_path))
    {
        mkdir($dir_path);
    }
    $filename_preview = fileBuildPath(__DIR__, 'cache', $hash_dir_name, $width_new . $height_new . '.jpg');
    $filename_original = fileBuildPath('gallery', $name . 'jpg');
    $info = getimagesize($filename_original);
    $width_original  = $info[0];
    $height_original = $info[1];
    $img = imagecreatefromjpeg($filename_original);
    $tmp = imageCreateTrueColor($width_new, $height_new);
    imageCopyResampled($tmp, $img, 0, 0, 0, 0, $width_new, $height_new, $width_original, $height_original);
    imagejpeg($tmp, $filename_preview, 100);
    imagedestroy($tmp);
    return $filename_preview;
}
function getImagePreview($name, $width_new, $height_new): string
{
    $hash_dir_name = md5($name);
    $filename_preview = fileBuildPath(__DIR__, 'cache', $hash_dir_name, $width_new . $height_new . '.jpg');
    if (!file_exists($filename_preview))
    {
        $filename_preview = doImagePreview($name, $width_new, $height_new);
    }
    return $filename_preview;
}

print getImagePreview($name, $w, $h);

?>

