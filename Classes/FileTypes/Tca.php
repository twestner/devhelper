<?php

namespace Tw\Devhelper\FileTypes;

class Tca extends AbstractFileType
{
    protected function getFileName($configuration, $languageId = 0)
    {
        return $this->getExtensionPath($configuration) . 'Configuration/TCA/' . $this->getTableName($configuration) . '.php';
    }

    public function write($typeObject, $configuration)
    {

    }
}
