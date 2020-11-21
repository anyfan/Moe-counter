<?php
header('content-type:image/svg+xml;charset=utf-8');
include 'date.php';


// 接受参收
if (isset($_GET['name']) && !empty($_GET['name'])) {
    $name = $_GET['name'];
} else {
    $name = 'demo';
}
if (isset($_GET['theme']) && !empty($_GET['theme'])) {
    if ($_GET['theme'] != ('moebooru' && 'gelbooru' && 'rule34')) {
        $theme = 'moebooru';
    } else {
        $theme = $_GET['theme'];
    }
} else {
    $theme = 'moebooru';
}

if ($name != 'view') {
    $db = new db;
    $num = $db->find_name($name);
}else {
    $num = 1234567890;
}


// 不足7位补0
$num = str_pad($num, 7, "0", STR_PAD_LEFT);
$num = str_split("$num");

$img_x = 0;

echo "<?xml version='1.0' encoding='UTF-8'?>
<svg width='680' height='150' version='1.1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink'>
    <title>Moe Count</title>
    <g>";

for ($i = 0; $i < count($num); $i++) {
    $img_url = "assets/theme/" . $theme . "/" . $num[$i] . ".gif";
    $img_date = img_date($img_url);
    $img_w = $img_date['width'];
    $img_h = $img_date['height'];
    $img_d = $img_date['date'];
    $themeList_data = "<image x='$img_x' y='0' width='$img_w' height='$img_h' xlink:href='$img_d' />";
    $img_x += $img_date['width'];
    echo ($themeList_data);
}

echo '    </g>
</svg>';

function img_date($url)
{
    $info = getimagesize($url);
    $data = fread(fopen($url, 'r'), filesize($url));
    $base64_data = 'data:' . $info['mime'] . ';base64,' . chunk_split(base64_encode($data));
    $base64_data = str_replace("\r\n", "", $base64_data);
    return array("width" => $info[0], "height" => $info[1], "date" => $base64_data);
}

