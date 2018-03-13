<?php

namespace Core;

use PDO;

/**
 * DataSource
 */
class DataSource
{
    private $connection;

    public function __construct()
    {
        $connector = new Connection();
        $this->connection = $connector->getConnection();
    }

    public function executeQueryListResult(string $query, $options = array())
    {
        $queryResult = $this->connection->prepare($query);
        $queryResult->execute($options);
        $resultSet = $queryResult->fetchAll(\PDO::FETCH_ASSOC);

        return $resultSet;
    }

    public function executeQuerySingleResult(string $query, $options = array())
    {
        $resultSet = $this->executeQueryListResult($query, $options)[0];

        return $resultSet;
    }
}
