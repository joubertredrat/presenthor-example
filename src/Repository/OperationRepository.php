<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Operation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Operation Repository
 *
 * @package App\Repository
 */
class OperationRepository extends ServiceEntityRepository implements OperationRepositoryInterface
{
    /**
     * OperationRepository constructor
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Operation::class);
    }

    /**
     * {@inheritDoc}
     */
    public function getOperation(int $id): ?Operation
    {
        /** @var Operation $operation */
        $operation = $this->find($id);

        return $operation;
    }

    /**
     * {@inheritDoc}
     */
    public function getOperationsList(): array
    {
        return $this->findAll();
    }
}
