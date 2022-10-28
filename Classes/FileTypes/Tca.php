<?php

namespace Tw\Devhelper\FileTypes;

use Tw\Devhelper\Domain\Model\Configuration;

class Tca extends AbstractFileType
{
    protected function getFileName($configuration, $languageId = 0)
    {
        return $configuration->getExtensionPath() . 'Configuration/TCA/' . $configuration->getTableName() . '.php';
    }

    public function write($typeObject, $configuration)
    {
        $fileName = $this->getFileName($configuration);
        $filecontent = file_get_contents($fileName);

        $code = $typeObject->getTcaShowitemCode($configuration);
        if($code){
            $filecontent = $this->detectShowitemPositionAndFill($configuration, $code, $filecontent);
        }

        $code = $typeObject->getTcaFieldDefinition($configuration);
        if($code){
            $filecontent = $this->detectTcaDefinitionPositionAndFill($configuration, $code, $filecontent);
        }

        $this->writeFile($filecontent, $fileName);
    }

    protected function detectShowitemPositionAndFill(Configuration $configuration, $code, $filecontent){
        if(preg_match_all('/\'showitem\' => \'(.*)\'/smU', $filecontent, $matches)){
            foreach($matches[1] as $match){
                $replacement = $match . $code;
                $filecontent = str_replace($match, $replacement, $filecontent);
                return $filecontent;
            }
        }

        return $filecontent;
    }

    protected function detectTcaDefinitionPositionAndFill(Configuration $configuration, $code, $filecontent){
        $filecontentArray = explode(LF, trim($filecontent));

        $last = array_pop($filecontentArray);
        $beforeLast = array_pop($filecontentArray);

        $filecontentArray[] = $code;
        $filecontentArray[] = $beforeLast;
        $filecontentArray[] = $last;

        return implode(LF, $filecontentArray);
    }
}
