<?php
namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Text extends Input {
    public function getSqlCode($configuration) {
        return $configuration->getField() . ' text,';
    }

    public function getTcaFieldDefinition(Configuration $configuration)
    {
        $config = '\'type\' => \'text\',
                \'eval\' => \'trim\',
                \'cols\' => \'300\',
                \'rows\' => \'5\'';

        return $this->getTcaFieldDefinitionStructure($config, $configuration);
    }
}
