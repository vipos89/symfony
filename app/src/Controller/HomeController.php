<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function index()
    {
        return new Response(
            '<html><body>Lucky number: ' . 1 . '</body></html>'
        );
    }
}