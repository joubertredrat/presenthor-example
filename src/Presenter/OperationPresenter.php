<?php

declare(strict_types=1);

namespace App\Presenter;

use App\Entity\Operation;
use App\ValueObject\Amount;
use RedRat\Presenthor\Item\DataItemInterface;
use RedRat\Presenthor\Item\ItemInjectableInterface;
use function json_encode;
use function number_format;

/**
 * Operation Presenter
 *
 * @package App\Presenter
 */
class OperationPresenter implements ItemInjectableInterface
{
    /**
     * @var Operation
     */
    private $operation;

    /**
     * {@inheritDoc}
     */
    public function __construct(DataItemInterface $dataItem)
    {
        $this->setDataItem($dataItem);
    }

    /**
     * {@inheritDoc}
     */
    public function getDataItem(): DataItemInterface
    {
        return $this->operation;
    }

    /**
     * {@inheritDoc}
     */
    public function setDataItem(DataItemInterface $dataItem): void
    {
        $this->operation = $dataItem;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        /** @var Operation $operation */
        $operation = $this->getDataItem();

        return [
            'id' => $operation->getId(),
            'resultHashFromGateway' => [
                'algo' => 'sha256',
                'data' => $operation->getResultHash(),
            ],
            'amount' => self::getAmountFragment($operation->getAmount()),
            'status' => $operation->getStatus()->getName(),
            'statusApproved' => $operation->getStatus()->isApproved(),
            'createdAt' => [
                'canonical' => $operation->getCreatedAtString(),
                'pt-br' => $operation->getCreatedAtString('d/m/Y H:i:s'),
            ],
            'updatedAt' => [
                'canonical' => $operation->getUpdatedAtString(),
                'pt-br' => $operation->getUpdatedAtString('d/m/Y H:i:s'),
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * @param Amount $amount
     * @return array
     */
    public static function getAmountFragment(Amount $amount): array
    {
        return [
            'value' => [
                'centsScale' => $amount->getValue(),
                'decimal' => number_format(($amount->getValue() / 100), 2, '.', ''),
            ],
            'currency' => $amount->getCurrency(),
        ];
    }
}
