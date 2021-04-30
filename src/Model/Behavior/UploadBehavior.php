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

    public function simpleUpload(array $file, string $destino): bool
    {
        return $this->upload($file, $destino);
    }

    protected function upload(array $file, string $destino): bool
    {
        extract($file);

        if (move_uploaded_file($tmp_name, $destino . $name)) {
            return true;
        } else {
            return false;
        }
    }
}
