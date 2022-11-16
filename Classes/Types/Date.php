<?php
namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Date extends AbstractType {
    public function getSqlCode($configuration) {
        return $configuration->getField() . ' int(11) DEFAULT 0 NOT NULL,';
    }

    public function getPropertyCode(Configuration $configuration)
    {
        return '/**
     * @var \DateTime
     */
    protected $' . GeneralUtility::underscoredToLowerCamelCase($configuration->getField()) . ' = null;';
    }
    public function getGetterAndSetterCode(Configuration $configuration)
    {
        $ucField = GeneralUtility::underscoredToUpperCamelCase($configuration->getField());
        $field = lcfirst($ucField);

        return '    /**
     * @return \DateTime
     */
    public function get' . $ucField . '()
    {
        return $this->' . $field . ';
    }

    /**
     * @param \DateTime $' . $field . '
     */
    public function set' . $ucField . '(\DateTime $' . $field . ')
    {
        $this->' . $field . ' = $' . $field . ';
    }';
    }

    public function getTcaFieldDefinition(Configuration $configuration)
    {
        $config = '\'type\' => \'input\',
                \'size\' => 300,
                \'renderType\' => \'inputDateTime\',
                \'eval\' => \'datetime\'';

        return $this->getTcaFieldDefinitionStructure($config, $configuration);
    }
}
