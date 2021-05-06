<?php
namespace App\Model\Behavior;

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

    public function simpleUpload(array $file, string $destino)
    {
        return $this->upload($file, $destino);
    }

    protected function upload(array $file, string $destino)
    {
        extract($file);

        if (move_uploaded_file($tmp_name, $destino . $name)) {
            return $name;
        } else {
            return false;
        }
    }

    public function slug(string $name): string
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
