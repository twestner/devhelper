<?php
namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Input extends AbstractType {
    public function getSqlCode($configuration) {
        return $configuration->getField() . ' varchar(255) DEFAULT \'\' NOT NULL,';
    }

    public function getPropertyCode(Configuration $configuration)
    {
        return '/**
     * @var string
     */
    protected $' . GeneralUtility::underscoredToLowerCamelCase($configuration->getField()) . ' = \'\';';
    }
    public function getGetterAndSetterCode(Configuration $configuration)
    {
        $field = GeneralUtility::underscoredToUpperCamelCase($configuration->getField());
        $ucField = ucfirst($field);

        return '    /**
     * @return string
     */
    public function get' . $ucField . '()
    {
        return $this->' . $field . ';
    }

    /**
     * @param string $' . $field . '
     */
    public function set' . $ucField . '($' . $field . ')
    {
        $this->' . $field . ' = $' . $field . ';
    }';
    }

    public function getTcaFieldDefinition(Configuration $configuration)
    {
        $config = '\'type\' => \'input\',
                \'size\' => 300,
                \'eval\' => \'trim\'';

        return $this->getTcaFieldDefinitionStructure($config, $configuration);
    }
}
