<?php

declare(strict_types=1);

namespace App\Exception\ValueObject\Operation\Status;

use InvalidArgumentException;

/**
 * InvalidStatusException
 *
 * @package App\Exception\ValueObject\Operation\Status
 */
class InvalidStatusException extends InvalidArgumentException
{
    /**
     * @param string $statusInformed
     * @param array $statusAvailable
     * @return static
     */
    public static function dispatchThrow(string $statusInformed, array $statusAvailable): self
    {
        return new self(
            sprintf(
                'Invalid status informed [ %s ] , available status [ %s ]',
                $statusInformed,
                implode(',  ', $statusAvailable)
            )
        );
    }
}
