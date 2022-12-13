<?php
namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class File extends AbstractType {
    public function getSqlCode($configuration) {
        return $configuration->getField() . ' int(11) DEFAULT 0 NOT NULL,';
    }

    public function getPropertyCode(Configuration $configuration)
    {
        return '/**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $' . GeneralUtility::underscoredToLowerCamelCase($configuration->getField()) . ' = null;';
    }
    public function getGetterAndSetterCode(Configuration $configuration)
    {
        $ucField = GeneralUtility::underscoredToUpperCamelCase($configuration->getField());
        $field = lcfirst($ucField);

        return '    /**
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function get' . $ucField . '()
    {
        return $this->' . $field . ';
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $' . $field . '
     */
    public function set' . $ucField . '($' . $field . ')
    {
        $this->' . $field . ' = $' . $field . ';
    }';
    }

    public function getTcaFieldDefinition(Configuration $configuration)
    {
        $config = '\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(\'' . $configuration->getField() . '\', [
                    \'appearance\' => [
                        \'createNewRelationLinkTitle\' => \'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference\',
                    ],
                    \'maxitems\' => 1,
                ], \'pdf,doc,docx,xls,xlsx,txt\'),';

        return $this->getTcaFieldDefinitionStructure($config, $configuration, false);
    }
}
