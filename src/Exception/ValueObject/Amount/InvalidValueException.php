<?php

declare(strict_types=1);

namespace App\Exception\ValueObject\Amount;

use InvalidArgumentException;

/**
 * InvalidValue Exception
 *
 * @package App\Exception\ValueObject\Amount
 */
class InvalidValueException extends InvalidArgumentException
{
    /**
     * @param int $amountInformed
     * @return static
     */
    public static function lessThanZero(int $amountInformed): self
    {
        return new self(
            sprintf('Amount informed less than zero: [ %d ]', $amountInformed)
        );
    }
}
