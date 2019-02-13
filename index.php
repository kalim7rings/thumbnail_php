<?php

//https://code.tutsplus.com/articles/how-to-dynamically-create-thumbnails--net-1818
 
require 'config.php';
require 'functions.php';
 
if(isset($_FILES['fupload'])) {
     
    if(preg_match('/[.](jpg)|(jpeg)|(gif)|(png)$/', $_FILES['fupload']['name'])) {
         
        $filename = $_FILES['fupload']['name'];
        $source = $_FILES['fupload']['tmp_name']; 

        $fileinfo = @getimagesize($source);
        $width = $fileinfo[0];
        $height = $fileinfo[1];
    
        $allowed_image_extension = array(
            "png",
            "jpg",
            "jpeg"
        );
    

        if (($_FILES["fupload"]["size"] > 2000000)) {
            $response = array(
                "type" => "error",
                "message" => "Image size exceeds 2MB"
            );

            print_r($response);

            return;

        }    // Validate image file dimension
        else if ($width > "300" || $height > "200") {

            $response = array(
                    "type" => "error",
                    "message" => "Image dimension should be within 300X200"
                );
            print_r($response);
            return;
        }


        $target = $path_to_image_directory . $filename;
         
        move_uploaded_file($source, $target);
         
        createThumbnail($filename);     
    }
}



/*
$im = imagecreatetruecolor(100, 100);

// sets background to red
$red = imagecolorallocate($im, 255, 255, 255);
imagefill($im, 0, 0, $red);

header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
*/



/*$new   = imagecreatetruecolor(320, 320);
$color = imagecolorallocatealpha($new, 0, 0, 0, 127);
imagefill($new, 0, 0, $color);
imagesavealpha($new, TRUE); // it took me a good 10 minutes to figure this part out
imagepng($new);*/


?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
 
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="author" content="" />
    <title>Dynamic Thumbnails</title>
</head>
 
<body>
    <h1>Upload A File, Man!</h1>
    <form enctype="multipart/form-data" action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="file" name="fupload" />
        <input type="submit" value="Go!" />
    </form>
</body>
</html>