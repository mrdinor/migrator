<?php
namespace Migrator\Factory\Config;

use RuntimeException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class YAMLConfigProvider
 * @package Migrator\Factory\Config
 */
class YAMLConfigProvider extends BaseFileConfigProvider
{
    /**
     * @param string $db_name
     *
     * @return array
     */
    public function getConfig($db_name)
    {
        $this->validateFilePath();

        try {
            $config = Yaml::parse(file_get_contents($this->file));
        } catch (ParseException $e) {
            throw new RuntimeException("Unable to parse the YAML string: " . $e->getMessage());
        }

        if (isset($config[$db_name]) && is_array($config[$db_name])) {
            return $config[$db_name];
        }

        throw new RuntimeException("No configuration found for database '{$db_name}'");
    }
}
