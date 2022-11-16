<?php
namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Integer extends AbstractType {
    public function getSqlCode($configuration) {
        return $configuration->getField() . ' int(11) DEFAULT 0 NOT NULL,';
    }

    public function getPropertyCode(Configuration $configuration)
    {
        return '/**
     * @var integer
     */
    protected $' . GeneralUtility::underscoredToLowerCamelCase($configuration->getField()) . ' = \'\';';
    }
    public function getGetterAndSetterCode(Configuration $configuration)
    {
        $field = GeneralUtility::underscoredToUpperCamelCase($configuration->getField());
        $ucField = ucfirst($field);

        return '    /**
     * @return integer
     */
    public function get' . $ucField . '()
    {
        return $this->' . $field . ';
    }

    /**
     * @param integer $' . $field . '
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
                \'eval\' => \'trim,int\'';

        return $this->getTcaFieldDefinitionStructure($config, $configuration);
    }
}
