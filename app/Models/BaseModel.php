<?php

namespace SchoolBoard\Models;

use SchoolBoard\Helper\DBConnectionHelper;

/**
 * Class BaseModel
 *
 * @package SchoolBoard\Models
 */
class BaseModel
{
    /**
     * @var DBConnectionHelper
     */
    protected $connection;

    /**
     * @var array
     */
    protected $config;

    /**
     * BaseModel constructor.
     */
    public function __construct()
    {
        $this->config = parse_ini_file(__DIR__ . '/../../config/config.ini');
        try {
            $this->connection = DBConnectionHelper::connection($this->config);
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}