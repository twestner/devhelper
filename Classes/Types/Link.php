<?php
namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Link extends Input {
    public function getTcaFieldDefinition(Configuration $configuration)
    {
        $config = '\'type\' => \'input\',
                \'size\' => 300,
                \'renderType\' => \'inputLink\',
                \'eval\' => \'trim\'';

        return $this->getTcaFieldDefinitionStructure($config, $configuration);
    }
}
