<?php

namespace Tw\Devhelper\FileTypes;

use Tw\Devhelper\Domain\Model\Configuration;

class Sql extends AbstractFileType
{
    protected function getFileName($configuration, $languageId = 0)
    {
        return $configuration->getExtensionPath() . 'ext_tables.sql';
    }

    public function write($typeObject, $configuration)
    {
        $fileName = $this->getFileName($configuration);
        $filecontent = file_get_contents($fileName);

        $code = $typeObject->getSqlCode($configuration);
        if($code){
            $filecontent = $this->detectPositionAndFill($configuration, $code, $filecontent);
        }

        $code = $typeObject->getSqlMmCode($configuration);
        if($code){
            $filecontent = $this->detectPositionForMmAndFill($configuration, $code, $filecontent);
        }

        $this->writeFile($filecontent, $fileName);
    }

    protected function detectPositionAndFill(Configuration $configuration, $code, $filecontent){
        $tablename = $configuration->getTableName();

        if(preg_match_all('/CREATE TABLE ' . $tablename . '(.*);./smU', $filecontent, $matches)){
            foreach($matches[0] as $match){
                if(strpos($match, 'PRIMARY KEY')){
                    $replacement = str_replace('PRIMARY KEY', $code . LF . LF . '    PRIMARY KEY', $match);
                } else {
                    $replacement = str_replace(');', '    ' . $code . LF . ');', $match);
                }
                $filecontent = str_replace($match, $replacement, $filecontent);
            }
        }

        return $filecontent;
    }

    protected function detectPositionForMmAndFill(Configuration $configuration, $code, $filecontent){
        return $filecontent . LF . LF . $code;
    }
}
