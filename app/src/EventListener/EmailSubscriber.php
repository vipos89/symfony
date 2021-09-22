<?php


namespace App\EventListener;


use App\Event\SendEmailEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EmailSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
       return  [
           SendEmailEvent::NAME => [
               ''
           ]
       ];
    }
}