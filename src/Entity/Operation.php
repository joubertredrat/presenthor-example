<?php

declare(strict_types=1);

namespace App\Entity;

use App\ValueObject\Amount;
use App\ValueObject\Operation\Status;
use RedRat\Entity\DateTimeCreatedTrait;
use RedRat\Entity\DateTimeUpdatedTrait;
use RedRat\Presenthor\Item\DataItemInterface;

/**
 * Operation
 *
 * @package App\Entity
 */
class Operation implements DataItemInterface
{
    use DateTimeCreatedTrait;
    use DateTimeUpdatedTrait;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $resultHash;

    /**
     * @var Amount
     */
    private $amount;

    /**
     * @var Status
     */
    private $status;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getResultHash(): string
    {
        return $this->resultHash;
    }

    /**
     * @param string $resultHash
     * @return void
     */
    public function setResultHash(string $resultHash): void
    {
        $this->resultHash = $resultHash;
    }

    /**
     * @return Amount
     */
    public function getAmount(): Amount
    {
        return $this->amount;
    }

    /**
     * @param Amount $amount
     * @return void
     */
    public function setAmount(Amount $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @param Status $status
     * @return void
     */
    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }
}
