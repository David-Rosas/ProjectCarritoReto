<?php

namespace Core;

/**
 * Queries
 */
interface RepositoryBase
{
    public function register($entity): bool;
    public function update($entity): bool;
    public function findAll(): array;
    public function findById(int $id);
}
