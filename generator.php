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
print gettype($h);
print $h;
print $name;
print $size;
//    print __DIR__.'/gallery/.' . $name . '.jpg';
//    $image = new Thumbs(__DIR__.'\gallery\.' . $name . '.jpg');
//    $image->resize($width, $height);
//    $image->save(__DIR__.'\cache\
$filename = __DIR__ ."\gallery\\{$name}.jpg";
print $filename;

$info   = getimagesize($filename);
var_dump($info);
$width  = $info[0];
$height = $info[1];
$img = imagecreatefromjpeg($filename);
$tmp = imageCreateTrueColor($w, $h);

imageCopyResampled($tmp, $img, 0, 0, 0, 0, $w, $h, $width, $height);

$hash_dir_name = md5($name);
$filename = __DIR__."/cache/{$hash_dir_name}/{$w}{$h}.jpg";

if (!file_exists($filename))
{
    imagejpeg($tmp, $filename, 100);

}

?>

