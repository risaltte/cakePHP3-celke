<?php
namespace App\Model\Behavior;

use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\ORM\Behavior;
use Cake\ORM\Table;

/**
 * DeleteFile behavior
 */
class DeleteFileBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function deleteDirectory(string $pathDir): bool
    {
        $directory = new Folder($pathDir);

        return $directory->delete();
    }

    public function deleteFile(string $pathDir, $fileNameOld, $fileNameNew)
    {
        if ($fileNameOld !== null && $fileNameOld !== $fileNameNew) {
            $file = new File($pathDir . $fileNameOld);
            $file->delete();
        }
    }
}
