<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Operation;

/**
 * Operation Repository Interface
 * @package App\Repository
 */
interface OperationRepositoryInterface
{
    /**
     * @param int $id
     * @return Operation|null
     */
    public function getOperation(int $id): ?Operation;

    /**
     * @return Operation[]
     */
    public function getOperationsList(): array;
}
