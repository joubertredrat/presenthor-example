<?php

declare(strict_types=1);

namespace App\ValueObject\Operation;

use App\Exception\ValueObject\Operation\Status\InvalidStatusException;
use function in_array;

/**
 * Status
 *
 * @package App\ValueObject\Operation
 */
class Status
{
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REFUSED = 'refused';

    /**
     * @var string
     */
    private $name;

    /**
     * Status constructor
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        if (!self::isValidStatus($name)) {
            throw InvalidStatusException::dispatchThrow($name, self::getStatusAvailable());
        }

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isPending(): bool
    {
        return self::STATUS_PENDING === $this->getName();
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return self::STATUS_APPROVED === $this->getName();
    }

    /**
     * @return bool
     */
    public function isRefused(): bool
    {
        return self::STATUS_REFUSED === $this->getName();
    }

    /**
     * @return array
     */
    public static function getStatusAvailable(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_APPROVED,
            self::STATUS_REFUSED,
        ];
    }

    /**
     * @param string $status
     * @return bool
     */
    public static function isValidStatus(string $status): bool
    {
        return in_array($status, self::getStatusAvailable());
    }
}
