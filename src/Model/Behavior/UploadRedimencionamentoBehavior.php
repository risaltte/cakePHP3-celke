<?php
namespace App\Model\Behavior;

use Cake\Filesystem\Folder;
use Cake\ORM\Behavior;
use Cake\ORM\Table;
use GdImage;

/**
 * UploadRedimencionamento behavior
 */
class UploadRedimencionamentoBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function uploadResizeImage(array $file, string $destiny, int $width, int $hight)
    {
        $this->createDirectoryResizeImage($destiny);

        $this->validateImageExtension($file, $destiny, $width, $hight);

        return true;
    }

    public function validateImageExtension(array $file, string $destiny, int $width, int $hight)
    {
        extract($file);

        switch ($type) {
            case 'image/jpeg';
            case 'image/pjpeg';
                // create image
                $image = imagecreatefromjpeg($tmp_name);

                // resize image
                $imageResized = $this->resizeImg($image, $width, $hight);

                // upload the resized image
                imagejpeg($imageResized, $destiny . $name);
                break;
            case 'image/png';
            case 'image/x-png';
                // create image
                $image = imagecreatefrompng($tmp_name);

                // resize image
                $imageResized = $this->resizeImg($image, $width, $hight);

                // upload the resized image
                imagepng($imageResized, $destiny . $name);
                break;
        }

    }

    // Resize Image
    protected function resizeImg($image, int $width, int $hight)
    {
        // take the original width and height of the image
        $widthOri = imagesx($image);
        $hightOri = imagesy($image);

        // create a template with the size of the image after resizing
        $imageResized = imagecreatetruecolor($width, $hight);

        // resize image
        imagecopyresampled($imageResized, $image, 0, 0, 0, 0, $width, $hight, $widthOri, $hightOri);

        return $imageResized;
    }

    protected function createDirectoryResizeImage(string $pathDir): void
    {
        //if the directory does not exist, create it
        $directory = new Folder($pathDir);

        if (is_null($directory->path)) {
            $directory->create($pathDir);
        }
    }

    protected function upload(array $file, string $destiny)
    {
        extract($file);

        if (move_uploaded_file($tmp_name, $destiny . $name)) {
            return $name;
        } else {
            return false;
        }
    }

    public function slugUploadResizeImage(string $name): string
    {
        $formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';

        $name = strtr(utf8_decode($name), utf8_decode($formato['a']), $formato['b']);

        $name = str_replace(' ', '-', $name);
        $name = str_replace(['-----', '----', '---', '--'], '-', $name);

        $name = mb_strtolower($name);

        return $name;
    }

}
