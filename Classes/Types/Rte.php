<?php
namespace Tw\Devhelper\Types;

use Tw\Devhelper\Domain\Model\Configuration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Rte extends Text {
    public function getTcaFieldDefinition(Configuration $configuration)
    {
        $config = '\'type\' => \'text\',
                \'enableRichtext\' => 1,
                \'eval\' => \'trim\'';

        return $this->getTcaFieldDefinitionStructure($config, $configuration);
    }
}
