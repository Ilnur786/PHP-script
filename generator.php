<?php

require 'connection.php';

//if ($host == 'localhost') {
//
//}

$name = $_GET['name'];
$size = $_GET['size'];
//$name = 'img.jpg';
//$size = 'min';
$sql1 = $pdo->prepare("SELECT width, height FROM sizes1 WHERE code = :size");
$sql1->execute(array(':size' => $size));
$row = $sql1->fetch();
$w = (int)$row['width'];
$h = (int)$row['height'];

//test
$test = fileBuildPath(__DIR__, 'cache_ext');
if (file_exists($test)) {
    echo $test;
    echo 'yes test';
}
else echo 'no test';
$test1 = fileBuildPath(__DIR__, 'gallery', $name);
if (file_exists($test1)) {
    echo $test;
    echo 'yes test1';
}
else echo 'no test1';
//

$cache_ext = fileBuildPath(__DIR__, 'cache_ext');
if (!file_exists($cache_ext)) {
    mkdir($cache_ext);
}

function fileBuildPath(...$segments): string {
    return join(DIRECTORY_SEPARATOR, $segments);
}

/**
 * @param $filepath
 * @return GdImage|resource
 * @throws Exception
 */
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
    if (!$im) {
        throw new Exception("Не удалось открыть изображение. Возможно, файл не является одним из типов: GIF, JPEG/JPG, PNG");
    }
    return $im;
}

/**
 * @param $name
 * @param $width_new
 * @param $height_new
 * @return string
 * @throws Exception
 */
function doImagePreview($name, $width_new, $height_new): string {
    $hash_dir_name = md5($name);
    $dir_path = fileBuildPath(__DIR__, 'cache_ext', $hash_dir_name);
    if (!file_exists($dir_path)) { #проверка на существование дериктории с изображениями разных размеров

        mkdir($dir_path);
    }
    $filename_preview = fileBuildPath(__DIR__, 'cache_ext', $hash_dir_name, $width_new . $height_new . '.jpg');
    $filename_original = fileBuildPath(__DIR__, 'gallery', $name);
    if (!file_exists($filename_original) or !is_readable($filename_original)) {
        throw new Exception("файл {$name} не существует или не доступен");
    }
    if (!in_array(mime_content_type($filename_original), ['image/gif', 'image/jpeg', 'image/png'])) {
        throw new Exception("файл {$name} не является одним из типов: GIF, JPEG/JPG, PNG");
    }
    $info = getimagesize($filename_original);
    if (!$info) {
        throw new Exception("файл {$name} не является изображением");
    }
    $width_original  = $info[0];
    $height_original = $info[1];
    try {
        $img = imageCreateFromAny($filename_original);
    } catch (Exception $e) {
        echo 'Выброшено исключение: ',  $e->getMessage(), "\r\n";
    }
    $tmp = imageCreateTrueColor($width_new, $height_new);
    imageCopyResampled($tmp, $img, 0, 0, 0, 0, $width_new, $height_new, $width_original, $height_original);
    imagejpeg($tmp, $filename_preview, 100);
    imagedestroy($tmp);
    return $filename_preview;
}

/**
 * @param $name
 * @param $width_new
 * @param $height_new
 * @return string
 */
function getImagePreview($name, $width_new, $height_new): string {
    $hash_dir_name = md5($name);
    $filename_preview = fileBuildPath(__DIR__, 'cache_ext', $hash_dir_name, $width_new . $height_new . '.jpg');
    if (!file_exists($filename_preview))   #проверка на существование изображения с необходимыми размерами
    {
        try {
            $filename_preview = doImagePreview($name, $width_new, $height_new);
        } catch (Exception $e) {
            echo 'Выброшено исключение: ',  $e->getMessage(), "\r\n";
        }
    }
    return $filename_preview;
}

$url = getImagePreview($name, $w, $h);

try {
    if (!file_exists($url)) {
        throw new Exception("не удалось сгенерировать изображение из {$name}");
    }
    header('Content-type: image/jpeg');
    readfile($url);
}

catch (Exception $e) {
    echo 'Выброшено исключение: ',  $e->getMessage(), "\r\n";
}
//header('Content-type: text/plane');
//echo $url;


