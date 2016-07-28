<?php

namespace gitproject\composer;


use Composer\Composer;
use Composer\Installer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new GitProject($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}
?>