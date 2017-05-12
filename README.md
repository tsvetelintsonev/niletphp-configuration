Makes working with php config arrays painless. 

### Requirements
`PHP >= 7.0`

### Install

Composer

```javascript
{
    "require": {
        "niletphp/configuration": ">=v1.0"
    }
}
```

### Examples

```php
$config = new Nilet\Components\Configuration\Config();
```

Set the config folder

```php
$configDir = new Nilet\Components\FileSystem\Directory("path/to/config/files");
$config->setConfigDir($configDir);
```

Get the config folder

```php
$configDir = $config->getConfigDir();
```

Retrieves a config array from a given config file

```php
/** 
* Lets assume that there is a config file called foo.php inside the config directory
* with the following array 
* [
*   "bar" => true,
*   "baz" => false
* ]
*/
$foo = $config->get("foo");
$foo["bar"];
$foo["baz"];
```
