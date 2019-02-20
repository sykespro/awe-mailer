<?php

use AweProject\Controllers\Mail\MailController;
use Slim\Http\Request;
use Slim\Http\Response;

// Api Routes
$app->group('/api',
    function () {

        // Mail Routes
        $this->get('/mail', MailController::class . ':index')->setName('mail.index');

    });

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    var_dump($this->mailer);

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
