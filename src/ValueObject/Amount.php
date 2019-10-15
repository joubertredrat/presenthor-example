<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Exception\ValueObject\Amount\InvalidCurrencyException;
use App\Exception\ValueObject\Amount\InvalidValueException;
use function in_array;

/**
 * Amount
 *
 * @package App\ValueObject
 */
class Amount
{
    /**
     * Minimum value
     */
    const VALUE_MINIMUM = 0;

    /**
     * Currencies
     */
    const CURRENCY_BRL = 'BRL';
    const CURRENCY_USD = 'USD';

    /**
     * @var int
     */
    private $value;

    /**
     * @var string
     */
    private $currency;

    /**
     * Amount constructor
     *
     * @param int $value
     * @param string $currency
     */
    public function __construct(int $value, string $currency)
    {
        if (self::VALUE_MINIMUM > $value) {
            throw InvalidValueException::lessThanZero($value);
        }

        if (!self::isValidCurrency($currency)) {
            throw InvalidCurrencyException::dispatchThrow($currency, self::getCurrenciesAvailable());
        }

        $this->value = $value;
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return bool
     */
    public function isCurrencyBRL(): bool
    {
        return self::CURRENCY_BRL === $this->getCurrency();
    }

    /**
     * @return bool
     */
    public function isCurrencyUSD(): bool
    {
        return self::CURRENCY_USD === $this->getCurrency();
    }

    /**
     * @return array
     */
    public static function getCurrenciesAvailable(): array
    {
        return [
            self::CURRENCY_BRL,
            self::CURRENCY_USD,
        ];
    }

    /**
     * @param string $currency
     * @return bool
     */
    public static function isValidCurrency(string $currency): bool
    {
        return in_array($currency, self::getCurrenciesAvailable());
    }
}
