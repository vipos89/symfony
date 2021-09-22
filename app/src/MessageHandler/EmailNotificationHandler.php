<?php


namespace App\MessageHandler;


use App\Message\EmailMessage;
use Swift_Mailer;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class EmailNotificationHandler implements MessageHandlerInterface
{
    public function __invoke(EmailMessage $message, Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $message->getContent()
            );

        $mailer->send($message);
    }
}
