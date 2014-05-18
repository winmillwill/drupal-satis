<?php
/**
 * @{inheritdoc}
 */

namespace Drupal\Composer;

use Composer\Config;
use Composer\Factory as ComposerFactory;
use Composer\IO\IOInterface;
use Composer\EventDispatcher\EventDispatcher;

class Factory extends ComposerFactory
{
    protected function createRepositoryManager(
        IOInterface $io,
        Config $config,
        EventDispatcher $eventDispatcher = null
    )
    {
        $rm = parent::createRepositoryManager($io, $config, $eventDispatcher);
        $rm->setRepositoryClass('git', 'Drupal\ParseComposer\Repository');
        return $rm;
    }
}
