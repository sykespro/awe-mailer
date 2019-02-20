<?php

namespace AweProject\Services\Mailer;

abstract class MailerBase
{
    abstract protected function send($subject, $body, $to, $cc = null);
}
