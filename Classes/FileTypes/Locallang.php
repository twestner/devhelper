<?php

namespace Tw\Devhelper\FileTypes;

class Locallang extends AbstractFileType
{
    protected function getFileName($configuration, $languageId = 0)
    {
        $languageKey = $this->getLanguageKey($languageId);
        return $configuration->getExtensionPath() . 'Resources/Private/Language/' . $languageKey . 'locallang_db.xlf';
    }

    protected function getLanguageKey($languageId){
        // TODO
        $languageKey = '';
        return $languageKey ? $languageKey . '.' : '';
    }

    public function write($typeObject, $configuration)
    {

    }
}
