<?php
Header("Content-Type: image/jpg");
$dir_path = "background/";
$count = count(glob($dir_path . "*"));
$num = rand(1,$count);
echo file_get_contents($dir_path.'bg-'.$num.'.jpg');
?>