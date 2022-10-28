<?php

namespace Tw\Devhelper\FileTypes;

class Tca extends AbstractFileType
{
    protected function getFileName($configuration, $languageId = 0)
    {
        return $configuration->getExtensionPath() . 'Configuration/TCA/' . $configuration->getTableName() . '.php';
    }

    public function write($typeObject, $configuration)
    {

    }
}
