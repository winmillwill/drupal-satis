<?php

namespace Drupal\Composer;

use Composer\Satis\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    /**
     * @return Composer
     */
    public function getComposer($required = true, $config = null)
    {
        if (null === $this->composer) {
            try {
                $this->composer = Factory::create($this->io, $config);
            } catch (\InvalidArgumentException $e) {
                $this->io->write($e->getMessage());
                exit(1);
            }
        }

        return $this->composer;
    }
}
