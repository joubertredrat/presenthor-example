<?php

declare(strict_types=1);

namespace App\Exception\Service\OperationService;

use Exception;
use function sprintf;

/**
 * OperationNotFound Exception
 *
 * @package App\Exception\Service\OperationService
 */
class OperationNotFoundException extends Exception
{
    /**
     * @param int $id
     * @return static
     */
    public static function notFoundOnRepository(int $id): self
    {
        return new self(
            sprintf('Operation not found on repository: [ %d ]', $id)
        );
    }
}
