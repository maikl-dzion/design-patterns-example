<?php

interface TransportInterface
{
    public function load();     // погрузка
    public function delivery(); // доставка
    public function unload();   // выгрузка
}

// Исходные классы
// Дальнобойный траспорт (большегруз)
class TruckerTransport implements TransportInterface
{
    protected $name = 'TruckerTransport';

    public function __construct($transportName = '') {
        if($transportName)
          $this->name .= ' (' .$transportName . ')';
    }

    public function load() {
        $message = "Погрузка выполнена";
        return $this->getMessage($message);
    }

    public function delivery(){
        $message = "Товар доставлен на место";
        return $this->getMessage($message);
    }
    public function unload(){
        $message = "Выгрузка товара выполнена успешно";
        return $this->getMessage($message);
    }

    protected function getMessage($message) {
        $message = $this->name . ": {$message}";
        return $message;
    }
}


// Малогабаритный транспорт (газель, пикап)
class SmallTransport implements TransportInterface
{
    protected $name = 'SmallTransport';

    public function __construct($transportName = '') {
        if($transportName)
            $this->name .= ' (' .$transportName . ')';
    }

    public function load() {
        $message = "Погрузка выполнена";
        return $this->getMessage($message);
    }

    public function delivery(){
        $message = "Товар доставлен на место";
        return $this->getMessage($message);
    }
    public function unload(){
        $message = "Выгрузка товара выполнена успешно";
        return $this->getMessage($message);
    }

    protected function getMessage($message) {
        $message = $this->name . ": {$message}";
        return $message;
    }
}


// Абстрактный класс логистики
abstract class AbstractLogisticFactory {

    // Фабричный метод
    abstract function getTransport() : TransportInterface;

    public function deliveryCargo() {
        $transport = $this->getTransport();
        $load      = $transport->load();
        $delivery  = $transport->delivery();
        $unload    = $transport->unload();
        return [
            'load'     => $load,
            'delivery' => $delivery,
            'unload'   => $unload,
        ];
    }
}

// Фабрики реализующие абстрактный класс (внутри себя создают нужный класс транспорта)
class TruckerLogisticFactoryMethod extends AbstractLogisticFactory {
    public function getTransport() : TransportInterface {
        return new TruckerTransport('Камаз');
    }
}

class SmallTransportLogisticFactoryMethod extends AbstractLogisticFactory {
    public function getTransport() : TransportInterface {
        return new SmallTransport('Газель');
    }
}

// Клиентский код который запускает сервисы
class FactoryLogisticClientCode {
    protected $service;
    public function __construct(AbstractLogisticFactory $service) {
         $this->service = $service;
    }

    public function run() {
        return $this->service->deliveryCargo();
    }
}


function factoryMethodInit() {

    $show = new ShowMessage();

    $truckerTransport = new TruckerLogisticFactoryMethod();
    $clientLogistic   = new FactoryLogisticClientCode($truckerTransport);
    // $show->message('Создаем фабрику по постройке деревянного дома');
    $show->message(implode("<br>", $clientLogistic->run()));

    $smallTransport = new SmallTransportLogisticFactoryMethod();
    $clientLogistic = new FactoryLogisticClientCode($smallTransport);

    // $show->message('Создаем фабрику по постройке деревянного дома');
    $show->message(implode("<br>", $clientLogistic->run()));

    return $show->result();
}
