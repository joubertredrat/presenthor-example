<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Operation;
use App\Exception\Service\OperationService\OperationNotFoundException;
use App\Presenter\OperationPresenter;
use App\Service\OperationService;
use RedRat\Presenthor\Bag\ItemBagFactory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

/**
 * Operation Controller
 *
 * @package App\Controller
 */
class OperationController extends Controller
{
    /**
     * @param int $id
     * @return JsonResponse
     */
    public function actionGet(int $id): JsonResponse
    {
        try {
            $operationService = $this->get(OperationService::class);
            $operation = $operationService->getOperation($id);
            $operationPresenter = new OperationPresenter($operation);

            return new JsonResponse($operationPresenter->toArray());
        } catch (OperationNotFoundException $e) {
            return new JsonResponse(['message' => $e->getMessage()], 404);
        } catch (Throwable $e) {
            return new JsonResponse(['message' => "Oh no, anything wrong isn't right"], 500);
        }
    }

    /**
     * @return JsonResponse
     */
    public function actionList(): JsonResponse
    {
        try {
            $operationService = $this->get(OperationService::class);
            $operationList = $operationService->getOperationsList();
            $operationPresenterList = [];

            /** @var Operation $operation */
            foreach ($operationList as $operation) {
                $operationPresenterList[] = new OperationPresenter($operation);
            }

            $operationPresenterBag = ItemBagFactory::createUnique($operationPresenterList);

            return new JsonResponse($operationPresenterBag->toArray());
        } catch (Throwable $e) {
            return new JsonResponse(['message' => "Oh no, anything wrong isn't right"], 500);
        }
    }
}
