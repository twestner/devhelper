<?php
namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class NoType extends AbstractType {
    public function getSqlCode(Configuration $configuration)
    {
        return '';
    }

    public function getPropertyCode(Configuration $configuration)
    {
        return '';
    }

    public function getGetterAndSetterCode(Configuration $configuration)
    {
        return '';
    }

    public function getTcaFieldDefinition(Configuration $configuration)
    {
        return '';
    }
}
