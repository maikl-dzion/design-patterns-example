<?php

interface SendMailInterface
{
    public function sendMail($message);  // --

}

// Исходные классы

class SimpleMailSender implements SendMailInterface
{
    protected $driver = 'mail';

    public function __construct() {
    }

    public function sendMail($message) {
        $message = "Письмо отправлено <br> Содержание письма : " . $message;
        return $this->getMessage($message);
    }

    protected function getMessage($message) {
        $message = $this->driver . ": {$message}";
        return $message;
    }
}

class SmtpMailSender implements SendMailInterface
{
    protected $driver = 'smtp';

    public function __construct() {
    }

    public function sendMail($message) {
        $message = "Письмо отправлено <br> Содержание письма : " . $message;
        return $this->getMessage($message);
    }

    protected function getMessage($message) {
        $message = $this->driver . " : {$message}";
        return $message;
    }
}

// Клиентский код который запускает сервисы
class StrategySendMessageServiceClientCode {

    protected $service;

    public function __construct(SendMailInterface $service) {
        $this->service = $service;
    }

    public function send($message) {
        return $this->service->sendMail($message);
    }
}


function strategyInit() {
    $show = new ShowMessage();

    $simpleMail = new SimpleMailSender();
    $mailSender = new StrategySendMessageServiceClientCode($simpleMail);
    $show->message('Отправляем письмо через mail()', 'h4');
    $show->message($mailSender->send('Добрый день,передаю документы по почте'));

    $smtpMail = new SmtpMailSender();
    $mailSender = new StrategySendMessageServiceClientCode($smtpMail);
    $show->message('Отправляем письмо через SMTP-протокол', 'h4');
    $show->message($mailSender->send('Привет,нужна помощь'));

    return $show->result();
}
