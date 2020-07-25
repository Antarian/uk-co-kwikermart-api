<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractController extends BaseController
{

    public static function getSubscribedServices()
    {
        return array_merge(parent::getSubscribedServices(), [
            'validator' => '?'.ValidatorInterface::class,
        ]);
    }

    /**
     * @param mixed $input
     * @return JsonResponse|null
     */
    protected function validateInput($input): ?JsonResponse
    {
        $errors = $this->get('validator')->validate($input);

        if (count($errors) > 0) {
            $errorsOutput = [];

            /** @var ConstraintViolationInterface $error */
            foreach ($errors as $error) {
                $errorsOutput[] = [
                    'message' => $error->getMessage(),
                    'path' => $error->getPropertyPath(),
                    'invalidValue' => $error->getInvalidValue(),
                ];
            }

            return new JsonResponse($errorsOutput, 403);
        }

        return null;
    }
}
