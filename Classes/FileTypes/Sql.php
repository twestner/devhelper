<?php

namespace Tw\Devhelper\FileTypes;

class Sql extends AbstractFileType
{
    protected function getFileName($configuration, $languageId = 0)
    {
        return $this->getExtensionPath() . 'ext_tables.sql';
    }

    public function write($typeObject, $configuration)
    {
        $fileName = $this->getFileName($configuration);

        $code = $typeObject->getSqlCode($configuration);

        var_dump($code);
    }
}
