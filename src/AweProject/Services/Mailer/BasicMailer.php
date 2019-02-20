<?php

namespace AweProject\Services\Mailer;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Slim\Collection;

class BasicMailer extends MailerBase
{
    const MAILER_NAME = 'Basic Mailer';

    protected $config;

    public function __construct(Collection $appConfig)
    {
        $this->config = $appConfig['mailConfig'];
    }

    public function send($subject, $body, $to, $cc = null)
    {
        var_dump(self::MAILER_NAME);

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = $this->config['sender_email_server'];
            $mail->SMTPAuth = true;
            $mail->Username = $this->config['sender_email'];
            $mail->Password = $this->config['sender_email_secert'];
            $mail->SMTPSecure = 'ssl';
            $mail->Port = $this->config['sender_email_port'];

            //Recipients
            $mail->setFrom($this->config['sender_email'], $this->config['sender_name']);

            // Loop to addresses
            if (gettype($to) == 'array') {
                foreach ($to as $email => $value) {
                    try { $mail->addAddress($value);} catch (Exception $e) {} // do nothing and go to next
                }
            } else {
                if ($to == "" || $this->config['testing_recipient'] != "") {
                    $to = $this->config['testing_recipient'];
                }

                $mail->addAddress($to);
            }

            // Loop cc addresses
            if ($cc != null) {
                if (gettype($cc) == 'array') {
                    foreach ($cc as $email => $value) {
                        try { $mail->addCC($value);} catch (Exception $e) {} // do nothing and go to next
                    }
                } else {
                    $mail->addCC($cc);
                }
            }

            $mail->addReplyTo('no-reply@domain.com', 'No Reply');

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // var_dump($mail);

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

}
