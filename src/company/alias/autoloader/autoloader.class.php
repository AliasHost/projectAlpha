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
    /**
     * @var string $windowsString First three characters of the PHP_OS constant on a windows machine.
     */
    private $windowsString = 'WIN';
    /**
     * @var int $logLevel Autoloader log level.
     */
    private $logLevel = 0;

    /**
     * @var Autoloader $instance Singleton instance of Autoloader.
     */
    private static $instance = null;

    /**
     * Creates an instance of the Autolaoder Class
     */
    protected function __construct()
    {
        if($this->logLevel)
        {
            echo "Matching PHP_OS Constant\r\n";
        }
        if(strtoupper(substr(PHP_OS,0,3)) === $this->windowsString)
        {
            if($this->logLevel)
            {
                echo "On Windows Machine\r\n";
            }
            $this->windows = true;
            $parts = explode('\\',$this->path);
        }
        else
        {
            if($this->logLevel)
            {
                echo "On Linux Machine\r\n";
            }
            $parts = explode('/',$this->path);
        }
        if($this->logLevel)
        {
            echo "Finding Root Folder\r\n";
        }
        $c = count($parts);
        $basePath = array();
        for($i = 0; $i < $c; ++$i)
        {
            $basePath[] = $parts[$i];
            if(strtolower($parts[$i]) == $this->rootFolder)
            {
                break;
            }
        }
        if($this->windows)
        {
            $this->base = implode('\\',$basePath) . '\\';
        }
        else
        {
            $this->base = implode('/',$basePath) . '/';
        }
        if($this->logLevel)
        {
            echo "Root Folder: " . $this->base . "\r\n";
        }
    }

    /**
     * Finds and includes the class, interface, trait, or enum file
     *
     * @param string $className Fully-qualified-namespaced class name.
     * @return bool Whether a matching file was found.
     */
    public function loadClass(string $className)
    {
        if($this->logLevel)
        {
            echo "Trying to load " . $className . "\r\n";
        }
        $parts = explode('\\',$className);
        $c = count($parts);
        if($this->logLevel)
        {
            echo "Converting classname to camelcase\r\n";
        }
        $filename = strtolower(substr($parts[$c-1],0,1)) . substr($parts[$c-1],1);
        $filepath = '';
        if($this->windows)
        {
            $filepath = implode('\\',array_slice($parts,0,$c-1)) . '\\';
        }
        else {
            $filepath = implode('/',array_slice($parts,0,$c-1)) . '/';
        }
        $dir = $this->base . $filepath;
        if($this->logLevel)
        {
            echo "Searching through " . $dir . "\r\n";
        }
        foreach($this->types as $t)
        {
            $check = $dir . $filename . '.' . $t . '.php';
            if($this->logLevel)
            {
                echo 'Looking for '. $check . "\r\n";
            }
            if(file_exists($check))
            {
                if($this->logLevel)
                {
                    echo 'Including ' . $check . "\r\n";
                }
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
        if($this->logLevel)
        {
            echo "Registering instance of autoloader";
        }
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
        if($this->logLevel)
        {
            echo "Getting instance of autoloader";
        }
        if(static::$instance === null)
        {
            if($this->logLevel)
            {
                echo "Creating instance of autoloader";
            }
            static::$instance = new Autoloader();
        }
        return static::$instance;
    }
}


//$auto = Autoloader::getInstance();
//spl_autoload_register(array($auto,'load'));

?>
