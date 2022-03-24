<?php

namespace SchoolBoard\Helper;

use PDO;

/**
 * Class DBConnectionHelper
 *
 * @package SchoolBoard\Helper
 */
class DBConnectionHelper extends PDO
{
    /**
     * DBConnectionHelper constructor.
     *
     * @param $driver
     * @param $host
     * @param $dbname
     * @param $user
     * @param $pass
     *
     * @throws \PDOException
     */
    public function __construct($driver, $host, $dbname, $user, $pass)
    {
        try {
            parent::__construct("$driver:host=$host;dbname=$dbname", $user, $pass);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // always disable emulated prepared statement when using the MySQL driver
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    /**
     * @param  array  $config
     *
     * @return DBConnectionHelper
     * @throws \PDOException
     */
    public static function connection($config): DBConnectionHelper
    {
        try {
            return new self(
                $config['driver'], $config['host'], $config['schema'], $config['user'], $config['password']
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage());
        }
    }
}