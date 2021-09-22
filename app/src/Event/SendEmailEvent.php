<?php


namespace App\Event;


use Symfony\Contracts\EventDispatcher\Event;

class SendEmailEvent extends Event
{
    public const NAME = 'send_email';

    public function __construct()
    {
    }


}