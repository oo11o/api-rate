<?php

namespace App\Services;

use App\Handlers\ResponseHandler;
use App\Models\EmailRepository;
use Respect\Validation\Validator as Validator;

class SubscriberService
{
    private $responseHandler;
    private $emailRepository;

    public function __construct(ResponseHandler $responseHandler, EmailRepository $emailRepository)
    {
        $this->responseHandler = $responseHandler;
        $this->emailRepository = $emailRepository;
    }

    public function addEmail(?string $email)
    {
        $emailValidator = Validator::email();
        if (empty($email)) {
            return  $this->responseHandler->jsonResponse(['message' => "Email is required"], 400);
        }
        if (!$emailValidator->validate($email)) {
            return  $this->responseHandler->jsonResponse(['message' => "Email is failed"], 400);
        }

        return $this->emailRepository->addEmail($email)
            ? $this->responseHandler->jsonResponse(['message' => 'E-mail added'], 200)
            : $this->responseHandler->jsonResponse(['message' => 'E-mail was already added earlier'], 409);
    }
};
