<?php

namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;

abstract class AbstractType {
    abstract public function getSqlCode(Configuration $configuration);
    abstract public function getPropertyCode(Configuration $configuration);
    abstract public function getGetterAndSetterCode(Configuration $configuration);
    abstract public function getTcaShowitemCode(Configuration $configuration);
    abstract public function getTcaFieldDefinition(Configuration $configuration);

    public function getLocallangCode(Configuration $configuration, $languageId){
        $key = $configuration->getTableName() . '.' . $configuration->getField();

        $translation = $languageId ? LF . '                <target>' . $configuration->getLabels()[$languageId] . '</target>' : '';

        return '            <trans-unit id="' . $key . '" resname="' . $key . '">
                <source>' . $configuration->getLabels()[0] . '</source>' . $translation . '
            </trans-unit>';
    }

    public function getSqlMmCode(){

    }

    public function getTcaFieldDefinitionStructure($config, Configuration $configuration){
        return '        \'' . $configuration->getField() . '\' => [
            \'label\' => \'LLL:EXT:' . $configuration->getExtensionKey() .
            '/Resources/Private/Language/locallang_db.xlf:' . $configuration->getTableName() . '.' . $configuration->getField() . '\',
            \'config\' => [
                ' . $config . '
            ]      
        ],';
    }
}
