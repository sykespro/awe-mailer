<?php

namespace AweProject\Services\Mailer;

use Interop\Container\ContainerInterface;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MailServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['mailer'] = function (ContainerInterface $c) {
            $settings = $c->get('settings')['mailConfig'];

            switch ($settings['provider']) {
                case 'PHP':
                    return new BasicMailer($c->get('settings'));
                    break;
                case 'Mailgun':
                    return new MailgunMailer($c->get('settings'));
                    break;
                default:
                    # code...
                    break;
            }

            return null;
        };
    }
}
