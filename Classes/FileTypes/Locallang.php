<?php

namespace Tw\Devhelper\FileTypes;

use Tw\Devhelper\Domain\Model\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Locallang extends AbstractFileType
{
    protected function getFileName($configuration, $languageId = 0)
    {
        $languageKey = $this->getLanguageKey($languageId);
        return $configuration->getExtensionPath() . 'Resources/Private/Language/' . $languageKey . 'locallang_db.xlf';
    }

    protected function getLanguageKey($languageId){
        $given = GeneralUtility::trimExplode(',', $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['devhelper']['languageKeys'], 0);
        $languageKey = $given[$languageId];
        return $languageKey == 'default' ? '' : $languageKey . '.';
    }

    public function write($typeObject, $configuration)
    {
        foreach($configuration->getLabels() as $key => $label){
            $fileName = $this->getFileName($configuration, $key);

            if(!file_exists($fileName)){
                continue;
            }

            $filecontent = file_get_contents($fileName);

            $code = $typeObject->getLocallangCode($configuration, $key);

            if($code){
                $filecontent = $this->detectLocallangPositionAndFill($configuration, $code, $filecontent);
            }

            $this->writeFile($filecontent, $fileName);
        }
    }

    protected function detectLocallangPositionAndFill(Configuration $configuration, $code, $filecontent){
        $filecontentArray = explode(LF, trim($filecontent));

        $last = array_pop($filecontentArray);
        $last2 = array_pop($filecontentArray);
        $last3 = array_pop($filecontentArray);

        $filecontentArray[] = $code;
        $filecontentArray[] = $last3;
        $filecontentArray[] = $last2;
        $filecontentArray[] = $last;

        return implode(LF, $filecontentArray);
    }
}
