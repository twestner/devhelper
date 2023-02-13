<?php
namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;

class Slug extends AbstractType {
    public function getSqlCode($configuration) {
        return $configuration->getField() . ' varchar(255) DEFAULT \'\' NOT NULL,';
    }

    public function getPropertyCode(Configuration $configuration)
    {
        return '';
    }
    public function getGetterAndSetterCode(Configuration $configuration)
    {
        return '';
    }

    public function getTcaFieldDefinition(Configuration $configuration)
    {
        $config = '\'type\' => \'slug\',
                \'size\' => 50,
                \'generatorOptions\' => [
                    \'fields\' => [\'title\'], // TODO: adjust this field to the one you want to use
                    \'fieldSeparator\' => \'-\',
                    \'replacements\' => [
                        \'/\' => \'\',
                    ],
                ],
                \'fallbackCharacter\' => \'-\',
                \'eval\' => \'uniqueInPid\',';

        return $this->getTcaFieldDefinitionStructure($config, $configuration);
    }
}
