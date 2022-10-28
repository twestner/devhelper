<?php

namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;

abstract class AbstractType {
    abstract public function getSqlCode(Configuration $configuration);
    abstract public function getPropertyCode(Configuration $configuration);
    abstract public function getGetterAndSetterCode(Configuration $configuration);
    abstract public function getTcaShowitemCode(Configuration $configuration);
    abstract public function getTcaFieldDefinition(Configuration $configuration);

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
