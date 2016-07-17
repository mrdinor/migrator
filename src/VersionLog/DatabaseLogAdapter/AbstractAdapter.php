<?php
namespace Migrator\VersionLog\DatabaseLogAdapter;

use InvalidArgumentException;
use PDO;

abstract class AbstractAdapter
{
    /**
     * @var string
     */
    protected $table;

    /**
     * @param string $table Version log table name
     */
    public function __construct(string $table = '__version_log')
    {
        if (!preg_match('/^[\._0-9a-z]+$/', $table)) {
            throw new InvalidArgumentException('Invalid table name');
        }
        $this->table = $table;
    }

    /**
     * Initialize table
     * @param PDO $pdo
     * @return void
     */
    abstract public function init(PDO $pdo);

    /**
     * Get current version
     * @param PDO $pdo
     * @return int
     */
    abstract public function getCurrentVersion(PDO $pdo);

    /**
     * Set version to the new value
     * @param PDO $pdo
     * @param int $new_version
     * @return void
     */
    abstract public function updateVersion(PDO $pdo, int $new_version);
}