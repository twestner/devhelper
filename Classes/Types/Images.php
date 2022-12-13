<?php
namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Images extends Files {
    public function getTcaFieldDefinition(Configuration $configuration)
    {
        $config = '\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(\'' . $configuration->getField() . '\', [
                    \'appearance\' => [
                        \'createNewRelationLinkTitle\' => \'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference\',
                    ],
                    \'maxitems\' => 999,
                ], $GLOBALS[\'TYPO3_CONF_VARS\'][\'GFX\'][\'imagefile_ext\'])';

        return $this->getTcaFieldDefinitionStructure($config, $configuration, false);
    }
}
