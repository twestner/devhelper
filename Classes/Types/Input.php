<?php

namespace Tw\Devhelper\Types;

class Input extends AbstractType {
    public function getSqlCode($configuration) {
        return LF . $configuration->getField() . ' varchar(255) DEFAULT "" NOT NULL,';
    }
}
