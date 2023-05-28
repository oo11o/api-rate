<?php

namespace App\Services;

use Psr\Http\Message\ResponseInterface as Response;
use App\Handlers\ResponseHandler;
use App\Models\EmailRepository;
use App\Services\Api\Api;
use App\Services\Sender\EmailSender;

class SenderService
{
    private $responseHandler;
    private $emailSender;
    private $emailRepository;
    private $apiRate;

    public function __construct(
        ResponseHandler $responseHandler,
        EmailSender $emailSender,
        EmailRepository $emailRepository,
        Api $apiRate
    ) {
        $this->responseHandler = $responseHandler;
        $this->emailSender = $emailSender;
        $this->emailRepository = $emailRepository;
        $this->apiRate = $apiRate;
    }

    public function sendEmailToSubscribers()
    {
        $subscribers = $this->emailRepository->getAllEmail();
        $rate = $this->apiRate->getRate();
        foreach ($subscribers as $email) {
            $this->emailSender->send($email, 'New bitcoin exchange rate', $rate);
        }
        return $this->responseHandler->jsonResponse(
            [
                'message'=>'E-mails sent',
                'rate' => $rate,
                'countSubscriber' => count($subscribers)
            ]
        );
    }
}
