<?php
namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Checkbox extends AbstractType {
    public function getSqlCode($configuration) {
        return $configuration->getField() . ' tinyint(3) DEFAULT 0 NOT NULL,';
    }

    public function getPropertyCode(Configuration $configuration)
    {
        return '/**
     * @var boolean
     */
    protected $' . GeneralUtility::underscoredToLowerCamelCase($configuration->getField()) . ' = false;';
    }
    public function getGetterAndSetterCode(Configuration $configuration)
    {
        $field = $configuration->getField();
        $ucField = ucfirst($field);

        return '    /**
     * @return boolean
     */
    public function get' . $ucField . '()
    {
        return $this->' . $field . ';
    }

    /**
     * @param boolean $' . $field . '
     */
    public function set' . $ucField . '($' . $field . ')
    {
        $this->' . $field . ' = $' . $field . ';
    }';
    }

    public function getTcaFieldDefinition(Configuration $configuration)
    {
        $config = '\'type\' => \'check\'';

        return $this->getTcaFieldDefinitionStructure($config, $configuration);
    }
}
