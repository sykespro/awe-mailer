<?php

// Define root path
defined('DS') ?: define('DS', DIRECTORY_SEPARATOR);
defined('ROOT') ?: define('ROOT', dirname(__DIR__) . DS);

// Load .env file
if (file_exists(ROOT . '.env')) {
    $dotenv = Dotenv\Dotenv::create(ROOT);
    $dotenv->load();
}

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // API Settings
        'name' => getenv('APP_NAME'),
        'version' => getenv('APP_VERSION'),

        // Mail Configurations
        'mailConfig' => [
            'provider' => getenv('MAIL_PROVIDER'),
            'sender_email' => getenv('SENDER_EMAIL'),
            'sender_name' => getenv('SENDER_NAME'),
            'sender_email_secert' => getenv('SENDER_EMAIL_SECERT'),
            'sender_email_server' => getenv('SENDER_EMAIL_SERVER'),
            'sender_email_port' => getenv('SENDER_EMAIL_PORT'),
            'testing_recipient' => getenv('TESTING_RECIPIENT'),
        ],

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
