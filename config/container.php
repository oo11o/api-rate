<?php
    use DI\ContainerBuilder;
    use GuzzleHttp\Client;

    // API
    use App\Services\Api\CoinGeckoApi;
    use App\Services\RateService;
    use App\Services\Api\Api;

    // EmailStorage
    use App\Services\SubscriberService;
    use App\Models\EmailRepository;
    use App\Models\Email as EmailStorage;

    // EmailSender
    use App\Services\SenderService;
    use App\Services\Sender\EmailSender;

    // Handler
    use App\Handlers\ResponseHandler;
    use Psr\Http\Message\ResponseFactoryInterface;
    use Slim\Psr7\Factory\ResponseFactory;

    $containerBuilder = new ContainerBuilder();
    $container = $containerBuilder->build();

    // API
    $container->set(RateServic::class, function (\Psr\Container\ContainerInterface $container) {
        $ApiService = $container->get(Api::class);
        $ResponseHandler = $container->get(ResponseHandler::class);
        return new RateService(ResponseHandler, $ApiService);
    });
    // Chose Api for rate
    $container->set(Api::class, function (\Psr\Container\ContainerInterface $container) {
        $ApiRate = $container->get(CoinGeckoApi::class);
        return new Api($ApiRate);
    });
    $container->set(CoinGeckoApi::class, function (\Psr\Container\ContainerInterface $container) {
        $httpClient = $container->get(Client::class);
        return new CoinGeckoApi($httpClient);
    });

    // SUBSCRIBER
    $container->set(SubscriberService::class, function (\Psr\Container\ContainerInterface $container) {
        $EmailRepository = $container->get(EmailRepository::class);
        $ResponseHandler = $container->get(ResponseHandler::class);
        return new SubscriberService($ResponseHandler, $EmailRepository);
    });
    // Chose Email Model (file)
    $container->set(EmailRepository::class, function (\Psr\Container\ContainerInterface $container) {
        $EmailStorage = $container->get(EmailStorage::class);
        return new EmailRepository($EmailStorage);
    });

    // SENDER EMAIL
    $container->set(SenderService::class, function (\Psr\Container\ContainerInterface $container) {
        $EmailRepository = $container->get(EmailRepository::class);
        $EmailSender = $container->get(EmailSender::class);
        $Api = $container->get(Api::class);
        $ResponseHandler = $container->get(ResponseHandler::class);
        return new SenderService($ResponseHandler, $EmailSender, $EmailRepository, $Api);
    });

    // RESPONSE HANDLER
    $container->set(ResponseHandler::class, function (\Psr\Container\ContainerInterface $container) {
        $responseFactory = $container->get(ResponseFactoryInterface::class);
        return new ResponseHandler($responseFactory);
    });
    $container->set(ResponseFactoryInterface::class, function () {
        return new ResponseFactory();
    });

return $container;