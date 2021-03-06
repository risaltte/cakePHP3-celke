<?php
namespace App\Model\Behavior;

use Cake\Filesystem\Folder;
use Cake\ORM\Behavior;
use Cake\ORM\Table;

/**
 * Upload behavior
 */
class UploadBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function singleUpload(array $file, string $destiny)
    {
        $this->createDirectory($destiny);

        return $this->upload($file, $destiny);
    }

    public function createDirectory(string $pathDir): void
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

    public function slugSingleUpload(string $name): string
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
