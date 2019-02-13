<?php

function createThumbnail($filename) {
     
    require 'config.php';
     
    if(preg_match('/[.](jpg)|(jpeg)$/', $filename)) {
        $im = imagecreatefromjpeg($path_to_image_directory . $filename);
    } else if (preg_match('/[.](gif)$/', $filename)) {
        $im = imagecreatefromgif($path_to_image_directory . $filename);
    } else if (preg_match('/[.](png)$/', $filename)) {
        $im = imagecreatefrompng($path_to_image_directory . $filename);
    }



   // $image = imagecreatefrompng($filePath);
    $bg = imagecreatetruecolor(imagesx($im), imagesy($im));
    imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
    imagealphablending($bg, TRUE);
    imagecopy($bg, $im, 0, 0, 0, 0, imagesx($im), imagesy($im));
    imagedestroy($im);
    $quality = 50; // 0 = worst / smaller file, 100 = better / bigger file 
    imagejpeg($bg, $path_to_image_directory . $filename . ".jpg", $quality);
    imagedestroy($bg);


     
    /*$ox = imagesx($im);
    $oy = imagesy($im);
     
    $nx = $final_width_of_image;
    $ny = floor($oy * ($final_width_of_image / $ox));
     
    $nm = imagecreatetruecolor($nx, $ny);


    // set background to white
    $white = imagecolorallocate($nm, 255, 255, 255);
    imagefill($nm, 0, 0, $white);

     
    imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
     
    if(!file_exists($path_to_thumbs_directory)) {
      if(!mkdir($path_to_thumbs_directory)) {
           die("There was a problem. Please try again!");
      } 
       }
 
    imagejpeg($nm, $path_to_thumbs_directory . $filename);

    //imagejpeg($image_resource, $image_path, 100); // quality: [0-100]

    $tn = '<img src="' . $path_to_thumbs_directory . $filename . '" alt="image" />';
    $tn .= '<br />Congratulations. Your file has been successfully uploaded, and a      thumbnail has been created.';
    echo $tn;*/
}

?>