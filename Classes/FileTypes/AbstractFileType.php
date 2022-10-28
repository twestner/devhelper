<?php

namespace Tw\Devhelper\FileTypes;

use Tw\Devhelper\Domain\Model\Configuration;
use Tw\Devhelper\Types\AbstractType;
use TYPO3\CMS\Core\Utility\GeneralUtility;

abstract class AbstractFileType {
    abstract protected function getFileName(Configuration $configuration, $languageId = 0);
    abstract public function write(AbstractType $typeObject, Configuration $configuration);

    protected function getExtensionPath(){
        return GeneralUtility::getFileAbsFileName('packages/con_products/');
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
}
