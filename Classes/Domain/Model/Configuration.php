<?php

namespace Tw\Devhelper\Domain\Model;

use Symfony\Component\Console\Input\InputInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Configuration {
    /**
     * @var string
     */
    protected $extensionKey = '';

    /**
     * @var string
     */
    protected $model = '';

    /**
     * @var string
     */
    protected $field = '';

    /**
     * @var string
     */
    protected $type = '';

    /**
     * @var array
     */
    protected $labels = [];

    /**
     * @var bool
     */
    protected $isFe = false;

    public function __construct(InputInterface $input){
        $this->extensionKey = $input->getArgument('extensionKey');
        $this->model = $input->hasArgument('model') ? $input->getArgument('model') : '';
        $this->field = $input->hasArgument('field') ? $input->getArgument('field') : '';
        $this->type = $input->hasArgument('type') ? $input->getArgument('type') : '';
        $this->labels = GeneralUtility::trimExplode('|', $input->getArgument('labels'));
        $this->isFe = $input->hasArgument('fe') ? (bool)$input->getArgument('fe') : false;
    }

    /**
     * @return string
     */
    public function getExtensionKey(): string
    {
        return $this->extensionKey;
    }

    /**
     * @param string $extensionKey
     */
    public function setExtensionKey(string $extensionKey): void
    {
        $this->extensionKey = $extensionKey;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @param string $field
     */
    public function setField(string $field): void
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * @param array $labels
     */
    public function setLabels(array $labels): void
    {
        $this->labels = $labels;
    }

    public function getExtensionPath(){
        $basePath = $GLOBALS['TYPO3_CONF_VARS']['EXTENSIONS']['devhelper']['baseExtensionPath'] ?: 'packages/';
        return $basePath . $this->getExtensionKey() . '/';
    }

    /**
     * @return string
     */
    public function getTableName(){
        if(!$this->getModel()){
            return '';
        }

        $flatExtensionKey = str_replace('_', '', $this->getExtensionKey());
        $flatExtensionKey = strtolower($flatExtensionKey);
        return 'tx_' . $flatExtensionKey . '_domain_model_' . strtolower($this->getModel());
    }

    /**
     * @return bool
     */
    public function isFe(): bool
    {
        return $this->isFe;
    }

    /**
     * @param bool $isFe
     */
    public function setIsFe(bool $isFe): void
    {
        $this->isFe = $isFe;
    }
}
