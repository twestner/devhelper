<?php

namespace Tw\Devhelper\FileTypes;

use Tw\Devhelper\Domain\Model\Configuration;

class Model extends AbstractFileType
{
    protected function getFileName($configuration, $languageId = 0)
    {
        return $configuration->getExtensionPath() . 'Classes/Domain/Model/' . ucfirst($configuration->getModel()) . '.php';
    }

    public function write($typeObject, $configuration)
    {
        $fileName = $this->getFileName($configuration);
        $filecontent = file_get_contents($fileName);

        $code = $typeObject->getPropertyCode($configuration);
        if($code){
            $filecontent = $this->detectPropertyPositionAndFill($configuration, $code, $filecontent);
        }

        $code = $typeObject->getGetterAndSetterCode($configuration);
        if($code){
            $filecontent = $this->detectGetterSetterPositionAndFill($configuration, $code, $filecontent);
        }

        $this->writeFile($filecontent, $fileName);
    }

    protected function detectPropertyPositionAndFill(Configuration $configuration, $code, $filecontent){
        if(preg_match_all('/public function (.*){./smU', $filecontent, $matches)){
            foreach($matches[0] as $match){
                $replacement = str_replace($match, $code . LF . LF . '    ' . $match, $match);
                $filecontent = str_replace($match, $replacement, $filecontent);
                return $filecontent;
            }
        }
        return $filecontent;
    }

    protected function detectGetterSetterPositionAndFill(Configuration $configuration, $code, $filecontent){
        $filecontentArray = explode(LF, trim($filecontent));

        $last = array_pop($filecontentArray);

        $filecontentArray[] = LF . $code;
        $filecontentArray[] = $last;

        return implode(LF, $filecontentArray);
    }
}
