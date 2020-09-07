<?php
namespace App\Services;
use Intervention\Image\ImageManagerStatic as Image;

class ImageManager {
    private $folder;

    function __construct() {
        $this->folder = config("folder_image");
    }

    function uploadImage($image, $currentImage = null) {
        if(is_file($image['tmp_name']) && is_uploaded_file($image['tmp_name'])) {
            $this->deleteImage($currentImage);
            
            $filename = strtolower(random_str(10) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION));
            $img = Image::make($image['tmp_name']);
            
            $img->save($this->folder . $filename); 
            return  $filename;                     
        } else {
            $this->deleteImage($image);
        }

    }

    function checkImage($path) {
        if($path != null && is_file($this->folder . $path) && file_exists($this->folder . $path)) {
            return true;
        }
    }

    function deleteImage($image) {
        if($this->checkImage($image)) {
            unlink($this->folder . $image);
        }               
    }

    function getDimension($image) {
        $size = getimagesize($this->folder . $image);

        list($width, $height) = $size;
        return $width . "x" . $height;
    }

    function getImage($img) {
        if($this->checkImage($img)) {
            return '/'.$this->folder.$img;
        }
        return '/images/no-user.png';
    }
}