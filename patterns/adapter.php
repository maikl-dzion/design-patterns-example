<?php

interface SocialServiceInterface {
    public function auth($login, $password);
    public function send($message);
}

// Существующие сервисы

class TwitterService implements SocialServiceInterface {

    protected $token;
    protected $login;

    public function auth($login, $password) {
        if($login && $password) {
            $this->login = $login;
            $this->token = '123';
            return true;
        }
        return false;
    }

    public function send($message) {
        if($message && $this->token) {
            return "Пользователь '{$this->login}' отправил сообщение:'{$message}'  в TwitterService";
        }
        return false;
    }
}

class FacebookService implements SocialServiceInterface {

    protected $token;
    protected $login;

    public function auth($login, $password) {
        if($login && $password) {
            $this->login = $login;
            $this->token = 'rtyett';
            return true;
        }
        return false;
    }

    public function send($message) {
        if($message && $this->token) {
            return "Пользователь '{$this->login}' отправил сообщение:'{$message}' в FacebookService";
        }
        return false;
    }
}
///////////////////////////////////////////



// Новый класс у которого несовместимый интерфейс
// (будем адаптировать этот класс)
class InstagrammService {

    protected $authInfo = [];
    protected $email;
    protected $password;

    public function __construct() {
    }

    public function userAuthorization($email, $password) {
        if($email && $password) {
            $info = ['uid', 'user_id'];
            $this->authInfo = $info;
        }
        return false;
    }

    public function sendMessage($message) {
        if($message && !empty($this->authInfo)) {
            $info  = $this->authInfo;
            $token = $info['uid'] . $info['user_id'];
            return 'Ваше сообщение успешно отправлено';
        }
        return false;
    }
}

// Адаптер который адаптирует класс InstagrammService

class AdapterInstagrammService implements SocialServiceInterface {

    protected $token;
    protected $login;
    protected $service;

    public function __construct(InstagrammService $service) {
        $this->service = $service;
    }

    public function auth($login, $password) {
        $this->login = $login;
        return $this->service->userAuthorization($login, $password);
    }

    public function send($message) {
        $alert = $this->service->sendMessage($message);
        $response = "Пользователь '{$this->login}' отправил сообщение:'{$message}' в InstagrammService";
        return $response . ' (' . $alert . ')';
    }
}


// Клиентский код который запускает сервисы (TwitterService, FacebookService)
// и теперь может работать с InstagrammService через AdapterInstagrammService

class SocialServiceClientClass {

    protected $socialService;

    public function __construct(SocialServiceInterface $service) {
        $this->socialService = $service;
    }

    public function newMessageSender($login, $password, $message) {
        $this->socialService->auth($login, $password);
        return $this->socialService->send($message);
    }

}


function adapterInit() {

    // Существующие сервисы
    $twitter  = new TwitterService();
    $facebook = new FacebookService();

    // Сервис который адаптируем
    $instagramm = new InstagrammService();
    $adapterInstagramm = new AdapterInstagrammService($instagramm);

    // Создаем senders
    $twitterSender    = new SocialServiceClientClass($twitter);
    $facebookSender   = new SocialServiceClientClass($facebook);
    $instagrammSender = new SocialServiceClientClass($adapterInstagramm);

    // Отправляем сообщения в сервисы
    $show = new ShowMessage('Отправляем сообщения в сервисы', 'h3');

    $result = $twitterSender->newMessageSender('maikl-dzion'     , '1234'     , 'Привет сообщество!Как жизнь?');
    $show->message($result);
    $result = $facebookSender->newMessageSender('fillip-maker'   , 'urty65756', 'Всем желаю доброго утра!!!');
    $show->message($result);
    $show->message('InstagrammService имеет нестандартный интерфейс');
    $result = $instagrammSender->newMessageSender('swide@mail.ru', 'gfhdggd'  , 'Продаю платяной шкаф (антиквариат)');
    $show->message($result);
    $html = $show->result();

    return $html;
}

