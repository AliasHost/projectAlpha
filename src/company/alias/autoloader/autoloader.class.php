<?php
namespace company\alias\autoloader;
use company\alias\autoloader\Autoloader;

/**
 * Autoloader class
 *
 * The Autoloader class searches under the projects 'src' folder for the file
 * in the folders matching the Fully-Quallified-Namespaced prefix for the class
 * attempting to be autoloaded. It then loads the first file matching the
 * Classname as it appears in camelCase suffixed with 'class.php',
 * 'interface.php', 'trait.php', or 'enum.php' that order.
 */
class Autoloader
{
    /**
     * @var string $path Current file path.
     */
    private $path = __DIR__;
    /**
     * @var string $base Project path.
     */
    private $base = '';
    /**
     * @var bool $windows Whether php is running on a windows machine.
     */
    private $windows = false;
    /**
     * @var array $types Autoload type suffixes.
     */
    private $types = array('class','interface','trait','enum');
    /**
     * @var string $rootFolder Root source folder.
     */
    private $rootFolder = 'src';
    private $vendorFolder = 'vendor';
    /**
     * @var string $windowsString First three characters of the PHP_OS constant on a windows machine.
     */
    private $windowsString = 'WIN';
    /**
     * @var int $logLevel Autoloader log level.
     */
    private static $logLevel = 0;

    /**
     * @var Autoloader $instance Singleton instance of Autoloader.
     */
    private static $instance = null;

    /**
     * Creates an instance of the Autolaoder Class
     */
    protected function __construct()
    {
        static::log('Matching PHP_OS Constant');
        if(strtoupper(substr(PHP_OS,0,3)) === $this->windowsString)
        {
            static::log('On Windows Machine');
            $this->windows = true;
        }
        else
        {
            static::log('On Linux Machine');
        }
        $parts = explode($this->getSeperator(),$this->path);
        static::log('Finding Root Folder');
        $c = count($parts);
        $basePath = array();
        for($i = 0; $i < $c; ++$i)
        {
            if(strtolower($parts[$i]) == $this->rootFolder)
            {
                break;
            }
            $basePath[] = $parts[$i];
        }
        $this->base = implode($this->getSeperator(),$basePath) . $this->getSeperator();
        static::log('Root Folder: ' . $this->base);
    }

    /**
     * Finds and includes the class, interface, trait, or enum file
     *
     * @param string $className Fully-qualified-namespaced class name.
     * @return bool Whether a matching file was found.
     */
    public function loadClass(string $className)
    {
        static::log('Trying to load ' . $className);
        $parts = explode('\\',$className);
        $c = count($parts);
        static::log('Converting classname to camelcase');
        $filename = strtolower(substr($parts[$c-1],0,1)) . substr($parts[$c-1],1);
        $filepath = '';
        $filepath = implode($this->getSeperator(),array_slice($parts,0,$c-1)) . $this->getSeperator();
        $dir = $this->base . $this->rootFolder . $this->getSeperator() . $filepath;
        static::log('Searching through ' . $dir);
        foreach($this->types as $t)
        {
            $check = $dir . $filename . '.' . $t . '.php';
            static::log('Looking for '. $check);
            if(file_exists($check))
            {
                static::log('Including ' . $check);
                include_once($check);
                return true;
            }
        }
        return false;
    }

    /**
     * Registers an instance of the Autoloader as the spl autolaoder
     */
    public static function registerInstance()
    {
        static::log('Registering instance of autoloader');
        $instance = Autoloader::getInstance();
        spl_autoload_register(array($instance,'loadClass'));
    }

    /**
     * Returns an instance of Autolaoder
     *
     * @return Autoloader An instance of Autoloader
     */
    public static function getInstance() : Autoloader
    {
        static::log('Getting instance of autoloader');
        if(static::$instance === null)
        {
            static::log('Creating instance of autoloader');
            static::$instance = new Autoloader();
        }
        return static::$instance;
    }

    private static function log(string $msg) : bool
    {
        if(static::$logLevel)
        {
            echo $msg . "\r\n";
            return true;
        }
        return false;
    }

    private function getSeperator() : string
    {
        if($this->windows)
        {
            return '\\';
        }
        else return '/';
    }
}

?>
