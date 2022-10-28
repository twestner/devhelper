<?php

namespace Tw\Devhelper\FileTypes;

class Model extends AbstractFileType
{
    protected function getFileName($configuration, $languageId = 0)
    {
        return $this->getExtensionPath() . 'Domain/Model/' . ucfirst($configuration->getModel()) . '.php';
    }

    public function write($typeObject, $configuration)
    {

    }
}
