<?php

namespace AweProject\Services\Mailer;

use Slim\Collection;

class MailgunMailer extends MailerBase
{
    const MAILER_NAME = 'Mailgun Mailer';

    public function __construct(Collection $appConfig)
    {
        var_dump($appConfig);
    }

    public function send($subject, $body, $to, $cc = null)
    {
        var_dump(self::MAILER_NAME);
    }

}
