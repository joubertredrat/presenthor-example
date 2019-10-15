<?php

declare(strict_types=1);

namespace App\Fixtures;

use App\Entity\Operation;
use App\ValueObject\Amount;
use App\ValueObject\Operation\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use function count;
use function time;

/**
 * Operation Fixtures
 *
 * @package App\Fixtures
 */
class OperationFixtures extends Fixture
{
    /**
     * {@inheritDoc}
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 100; $i++) {
            $operation = new Operation();
            $operation->setResultHash(self::getRandomHash($i));
            $operation->setAmount(self::getRandomAmount());
            $operation->setStatus(self::getRandomStatus());

            if ($i % 7 == 0 || $i % 19 == 0) {
                $operation->forgeUpdatedAt();
            }

            $manager->persist($operation);
        }

        $manager->flush();
    }

    /**
     * @param int $pseudoSalt
     * @return string
     */
    public static function getRandomHash(int $pseudoSalt): string
    {
        return hash('sha256', (string) (time() + $pseudoSalt));
    }

    /**
     * @return Amount
     */
    public static function getRandomAmount(): Amount
    {
        $currenciesAvailable = Amount::getCurrenciesAvailable();
        $randomKey = mt_rand(0, count($currenciesAvailable) - 1);

        return new Amount(mt_rand(1, 999999), $currenciesAvailable[$randomKey]);
    }

    /**
     * @return Status
     */
    public static function getRandomStatus(): Status
    {
        $statusAvailable = Status::getStatusAvailable();
        $randomKey = mt_rand(0, count($statusAvailable) - 1);

        return new Status($statusAvailable[$randomKey]);
    }
}
