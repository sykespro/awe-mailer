<?php

namespace AweProject\Controllers\Mail;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class MailController
{

    protected $mailer;

    public function __construct(ContainerInterface $container)
    {
        $this->mailer = $container->get('mailer');
    }

    public function index(Request $request, Response $response, array $args)
    {
        $response->getBody()->write("Hello, Mailer");

        $this->mailer->send('Testing Email', 'This appears to be working', '');

        return $response;
    }

}
