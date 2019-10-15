<?php

declare(strict_types=1);

namespace App\Exception\ValueObject\Amount;

use InvalidArgumentException;

/**
 * InvalidCurrency Exception
 *
 * @package App\Exception\ValueObject\Amount
 */
class InvalidCurrencyException extends InvalidArgumentException
{
    /**
     * @param string $currencyInformed
     * @param array $currenciesAvailable
     * @return static
     */
    public static function dispatchThrow(string $currencyInformed, array $currenciesAvailable): self
    {
        return new self(
            sprintf(
                'Invalid currency informed [ %s ] , available currencies [ %s ]',
                $currencyInformed,
                implode(',  ', $currenciesAvailable)
            )
        );
    }
}
