<?php

namespace Tw\Devhelper\FileTypes;

use Tw\Devhelper\Domain\Model\Configuration;
use Tw\Devhelper\Types\AbstractType;

abstract class AbstractFileType {
    abstract protected function getFileName(Configuration $configuration, $languageId = 0);
    abstract public function write(AbstractType $typeObject, Configuration $configuration);

    protected function getExtensionPath(Configuration $configuration){
        $basePath = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['devhelper'] ?: 'packages/';
        return $basePath . $configuration->getExtensionKey() . '/';
    }

    /**
     * @param Configuration $configuration
     * @return string
     */
    protected function getTableName($configuration){
        $flatExtensionKey = str_replace('_', '', $configuration->getExtensionKey());
        $flatExtensionKey = strtolower($flatExtensionKey);
        return 'tx_' . $flatExtensionKey . '_domain_model_' . strtolower($configuration->getModel());
    }

    protected function writeFile($content, $file){
        $handle = fopen($file, 'w+');
        fwrite($handle, $content . "\r\n");
        fclose($handle);
    }
}
