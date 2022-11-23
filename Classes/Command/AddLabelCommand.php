<?php

namespace Tw\Devhelper\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tw\Devhelper\Domain\Model\Configuration;
use Tw\Devhelper\FileTypes\Locallang;
use Tw\Devhelper\FileTypes\Model;
use Tw\Devhelper\FileTypes\Sql;
use Tw\Devhelper\FileTypes\Tca;
use Tw\Devhelper\Service\FileWriterService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/***************************************************************
 *  Copyright notice
 *  (c) 2022 <info@tina-westner.de>
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class AddLabelCommand extends Command
{
    /**
     * @var FileWriterService
     */
    protected $fileWriterService = null;

    public function __construct(string $name = null, FileWriterService $fileWriterService)
    {
        parent::__construct($name);
        $this->fileWriterService = $fileWriterService;
    }

    /**
     * Configure command
     */
    protected function configure()
    {
        $this->addArgument('extensionKey', InputArgument::REQUIRED, 'Extension Key of your extension');
        $this->addArgument('field', InputArgument::REQUIRED, 'Name of the field');
        $this->addArgument('labels', InputArgument::REQUIRED, 'Labels');
        $this->setDescription('adds a label to locallang-file');
    }

    /**
     * Removes the lock for the ke_search index process
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->fileWriterService->registerFileType(Locallang::class);

        /** @var Configuration $configuration */
        $configuration = GeneralUtility::makeInstance(Configuration::class, $input);
        $this->fileWriterService->writeAllFiles($configuration);

        return 0;
    }
}
