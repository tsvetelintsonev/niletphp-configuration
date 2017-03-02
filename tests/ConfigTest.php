<?php

namespace Nilet\Components\Configuration;

use Nilet\Components\FileSystem\Directory;
use Nilet\Components\FileSystem\FileSystem;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase  {

    /**
     * @var Config
     */
    protected $config;

    private static $tempDir;

    const DS = DIRECTORY_SEPARATOR;

    public static function setUpBeforeClass() {
        self::$tempDir = __DIR__.self::DS.'tmp';
        mkdir(self::$tempDir);
        file_put_contents(self::$tempDir."/foo.php", "<?php return [\"bar\" => true];");
    }

    protected function setUp() {
        $this->config = new Config;
    }

    public function testSetAndGetConfigFolder() {

        $configDir = new Directory(self::$tempDir);
        $this->config->setConfigDir($configDir);

        $this->assertSame($configDir, $this->config->getConfigDir());
    }

    public function testGetConfigArray() {
        $configDir = new Directory(self::$tempDir);
        $this->config->setConfigDir($configDir);

        $this->assertTrue(count($this->config->get("foo")) == 1);
        $this->assertTrue($this->config->get("foo")["bar"]);
    }

    /**
     * @expectedException Exception
     */
    public function testGetThrowsExceptionIfFileIsNotReadable() {
        $configDir = new Directory(self::$tempDir);
        $this->config->setConfigDir($configDir);
        file_put_contents(self::$tempDir."/baz.php", "");
        chmod(self::$tempDir."/baz.php", 0200);
        $this->config->get("baz");
    }

    public static function tearDownAfterClass() {
        (new FileSystem())->deleteDirectory(new Directory(self::$tempDir));
    }
}
