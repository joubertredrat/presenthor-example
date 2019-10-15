<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Operation;
use App\Exception\Service\OperationService\OperationNotFoundException;
use App\Repository\OperationRepositoryInterface;

/**
 * Operation Service
 *
 * @package App\Service
 */
class OperationService
{
    /**
     * @var OperationRepositoryInterface
     */
    private $operationRepository;

    /**
     * OperationService constructor
     *
     * @param OperationRepositoryInterface $operationRepository
     */
    public function __construct(OperationRepositoryInterface $operationRepository)
    {
        $this->operationRepository = $operationRepository;
    }

    /**
     * @param int $id
     * @return Operation
     * @throws OperationNotFoundException
     */
    public function getOperation(int $id): Operation
    {
        $operation = $this
            ->operationRepository
            ->getOperation($id)
        ;

        if (!$operation instanceof Operation) {
            throw OperationNotFoundException::notFoundOnRepository($id);
        }

        return $operation;
    }

    /**
     * @return array
     */
    public function getOperationsList(): array
    {
        return $this
            ->operationRepository
            ->getOperationsList()
        ;
    }
}
