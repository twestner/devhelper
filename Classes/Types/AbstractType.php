<?php

namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;

abstract class AbstractType {
    abstract public function getSqlCode(Configuration $configuration);

    public function getSqlMmCode(){

    }
}
