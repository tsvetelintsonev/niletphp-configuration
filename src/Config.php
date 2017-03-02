<?php
/**
 * NiletPHP - Simple and lightweight web MVC framework
 * (c) Tsvetelin Tsonev <github.tsonev@yahoo.com>
 * For copyright and license information of this source code, please view the LICENSE file.
 */

namespace Nilet\Components\Configuration;

use Nilet\Components\FileSystem\File;
use Nilet\Components\FileSystem\DirectoryInterface;

/**
 * @author Tsvetelin Tsonev <github.tsonev@yahoo.com>
 */
class Config {

    /**
     * @var DirectoryInterface
     */
    private $configDir = null;

    /**
     * @var array
     */
    private $config = [];

    /**
     * Set configuration dir
     *
     * @param \Nilet\Components\FileSystem\DirectoryInterface $directory
     */
    public function setConfigDir(DirectoryInterface $directory) {
        $this->configDir = $directory;
        $this->config = [];
    }

    /**
     * Retrieve configuration dir
     *
     * @return \Nilet\Components\FileSystem\DirectoryInterface
     */
    public function getConfigDir() : DirectoryInterface {
        return $this->configDir;
    }

    /**
     * Include config file
     * @param string $fileName
     * @throws \Exception
     */
    private function includeConfigFile(string $fileName) {
        $file = new File($this->configDir->getPath().DIRECTORY_SEPARATOR.$fileName.".php");
        if($file->isReadable()) {
            $this->config[$fileName] = include_once $file->getRealPath();
        } else {
            throw new \Exception("File is not readable.");
        }
    }

    /**
     * Retrieves a config array from a given config file
     * @param $name
     *
     * @return array Configuration array
     */
    public function get(string $fileName) : array {
        if(!isset($this->config[$fileName])) {
            $this->includeConfigFile($fileName);
        }
        return $this->config[$fileName];
    }
}
