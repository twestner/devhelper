<?php

namespace Tw\Devhelper\Service;

use Tw\Devhelper\Domain\Model\Configuration;
use Tw\Devhelper\FileTypes\AbstractFileType;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FileWriterService
{
    /**
     * @var array
     */
    protected $registeredFileTypes = [];

    /**
     * @param Configuration $configuration
     */
    public function writeAllFiles($configuration){
        $type = $this->getTypeObject($configuration->getType());

        foreach($this->registeredFileTypes as $class){
            /** @var AbstractFileType $object */
            $fileType = GeneralUtility::makeInstance($class);
            $fileType->write($type, $configuration);
        }
    }

    protected function getTypeObject($typeString){
        // write only label e.g.
        if(!$typeString){
            $typeString = 'NoType';
        }

        $typeString = ucfirst($typeString);

        if(!class_exists('Tw\\Devhelper\\Types\\' . $typeString)){
            throw new \Exception('type class does not exist');
        }

        return GeneralUtility::makeInstance('Tw\\Devhelper\\Types\\' . $typeString);
    }

    public function registerFileType($classname){
        $this->registeredFileTypes[] = $classname;
    }
}
