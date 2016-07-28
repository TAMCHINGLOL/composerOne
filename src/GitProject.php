<?php

namespace gitproject\composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;

class GitProject extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    //这个方法需要返回一个资源包将要安装的位置。相对于 composer.json 文件的位置。
    public function getInstallPath(PackageInterface $package)
    {
        if ('tamchinglol/gitproject' !== $package->getPrettyName()) {
            throw new \InvalidArgumentException('Unable to install this library!');
        }


        if ($this->composer->getPackage()) {
            $extra = $this->composer->getPackage()->getExtra();
            if (!empty($extra['think-path'])) {
                return $extra['think-path'];
            }
        }

        return 'corephp';
    }

    //这里你可以定义在安装时需要执行的动作。
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        parent::install($repo, $package);
        //remove tests dir
        $this->filesystem->removeDirectory($this->getInstallPath($package) . DIRECTORY_SEPARATOR . 'tests');
    }

    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        parent::update($repo, $initial, $target);
        //remove tests dir
        $this->filesystem->removeDirectory($this->getInstallPath($target) . DIRECTORY_SEPARATOR . 'tests');
    }

    /**
     * {@inheritDoc}
     */
    //在这里测试你发布的这个安装程序名称是否通过 安装类型 匹配
    public function supports($packageType)
    {
        return 'tamchinglol-gitproject' === $packageType;
    }
}
?>