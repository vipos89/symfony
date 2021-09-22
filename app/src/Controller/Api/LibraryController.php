<?php


namespace App\Controller\Api;


use App\Message\EmailMessage;
use App\Util\LibraryServiceInterface;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class LibraryController extends AbstractController
{
    private LibraryServiceInterface $libraryService;

    public function __construct(LibraryServiceInterface $libraryService)
    {
        $this->libraryService = $libraryService;
    }

    public function index(SerializerInterface $serializer, MessageBusInterface $bus): JsonResponse
    {

        $data = $serializer->serialize($this->libraryService->getUsersWithBooks(), JsonEncoder::FORMAT);
        $this->dispatchMessage(new EmailMessage($data));

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}