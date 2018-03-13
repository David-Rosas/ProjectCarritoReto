<?php

namespace Core;

/**
 * ProductRepository
 */
class ProductRepository implements RepositoryBase
{
    private $connection = null;

    public function __construct()
    {
        $connector = new Connection();
        $this->connection = $connector->getConnection();
    }


    public function register($entity): bool
    {
    }

    public function update($entity): bool
    {
    }

    public function findAll(): array
    {
    }

    public function findById(int $id)
    {
    }
}
