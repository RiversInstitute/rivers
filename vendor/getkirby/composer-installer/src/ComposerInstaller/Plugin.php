<?php

namespace Kirby\ComposerInstaller;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * @package   Kirby Composer Installer
 * @author    Lukas Bestle <lukas@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier GmbH
 * @license   https://opensource.org/licenses/MIT
 */
class Plugin implements PluginInterface
{
    /**
     * Apply plugin modifications to Composer
     *
     * @param \Composer\Composer $composer
     * @param \Composer\IO\IOInterface $io
     * @return void
     */
    public function activate(Composer $composer, IOInterface $io): void
    {
        $installationManager = $composer->getInstallationManager();
        $installationManager->addInstaller(new CmsInstaller($io, $composer));
        $installationManager->addInstaller(new PluginInstaller($io, $composer));
    }

    /**
     * Remove any hooks from Composer
     *
     * @codeCoverageIgnore
     *
     * @param \Composer\Composer $composer
     * @param \Composer\IO\IOInterface $io
     * @return void
     */
    public function deactivate(Composer $composer, IOInterface $io): void
    {
        // nothing to do
    }

    /**
     * Prepare the plugin to be uninstalled
     *
     * @codeCoverageIgnore
     *
     * @param Composer $composer
     * @param IOInterface $io
     * @return void
     */
    public function uninstall(Composer $composer, IOInterface $io): void
    {
        // nothing to do
    }
}
