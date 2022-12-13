<?php

namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;

abstract class AbstractType {
    abstract public function getSqlCode(Configuration $configuration);
    abstract public function getPropertyCode(Configuration $configuration);
    abstract public function getGetterAndSetterCode(Configuration $configuration);
    abstract public function getTcaFieldDefinition(Configuration $configuration);

    public function getTcaShowitemCode(Configuration $configuration)
    {
        return ', ' . $configuration->getField();
    }

    public function getLocallangCode(Configuration $configuration, $languageId){
        $table = $configuration->getTableName() ? $configuration->getTableName() . '.' : '';
        $key = $table . $configuration->getField();

        $translation = $languageId ? LF . '                <target>' . $configuration->getLabels()[$languageId] . '</target>' : '';

        return '            <trans-unit id="' . $key . '" resname="' . $key . '">
                <source>' . $configuration->getLabels()[0] . '</source>' . $translation . '
            </trans-unit>';
    }

    public function getSqlMmCode(){

    }

    public function getTcaFieldDefinitionStructure($config, Configuration $configuration, $isArray = true){
        if($isArray){
            $configCode = '\'config\' => [
                ' . $config . '
            ]';
        } else {
            $configCode = '\'config\' => ' . $config;
        }

        return '        \'' . $configuration->getField() . '\' => [
            \'label\' => \'LLL:EXT:' . $configuration->getExtensionKey() .
            '/Resources/Private/Language/locallang_db.xlf:' . $configuration->getTableName() . '.' . $configuration->getField() . '\',
            ' . $configCode . '      
        ],';
    }
}
