<?php

require 'connection.php';

$browser = get_browser(null, true);

if ($browser['ismobiledevice'])   #надо isset?
{
    $sql1 = "SELECT width FROM sizes1 WHERE code= 'mic'";
    $width_array = mysqli_query($link, $sql1);
    $width = mysqli_fetch_row($width_array)[0];
    $sql2 = "SELECT height FROM sizes1 WHERE code= 'mic'";
    $height_array = mysqli_query($link, $sql2);
    $height = mysqli_fetch_row($height_array)[0];
}
else
{
    $sql1 = "SELECT width FROM sizes1 WHERE code= 'min'";
    $width_array = mysqli_query($link, $sql1);
    $width = mysqli_fetch_row($width_array)[0];
    $sql2 = "SELECT height FROM sizes1 WHERE code= 'min'";
    $height_array = mysqli_query($link, $sql2);
    $height = mysqli_fetch_row($height_array)[0];
}

print $width;
print $height;