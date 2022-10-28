<?php

namespace Tw\Devhelper\FileTypes;

use Tw\Devhelper\Domain\Model\Configuration;
use Tw\Devhelper\Types\AbstractType;

abstract class AbstractFileType {
    abstract protected function getFileName(Configuration $configuration, $languageId = 0);
    abstract public function write(AbstractType $typeObject, Configuration $configuration);

    protected function writeFile($content, $file){
        $handle = fopen($file, 'w+');
        fwrite($handle, $content . "\r\n");
        fclose($handle);
    }
}
