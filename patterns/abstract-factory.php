<?php

interface HouseBuildInterface
{
    public function build();
}


// Типы домов
class WoodenHouse implements HouseBuildInterface
{
    protected $name ='Деревянный дом';
    public function build(){
        $message =  'Строим деревянный дом';
        return $this->getMessage($message);
    }

    protected function getMessage($message) {
        $message = $this->name . ": {$message}";
        return $message;
    }
}

class BrickHouse implements HouseBuildInterface
{
    protected $name ='Кирпичный дом';
    public function build(){
        $message =  'Строим кирпичный дом';
        return $this->getMessage($message);
    }

    protected function getMessage($message) {
        $message = $this->name . ": {$message}";
        return $message;
    }
}



interface BuilderExpertInterface
{
    public function getExpert();
}

// Типы строителей домов
class CarpenterExpert implements BuilderExpertInterface
{
    protected $name ='Плотник';
    public function getExpert(){
        $message =  'Могу построить деревянный дом';
        return $this->getMessage($message);
    }

    protected function getMessage($message) {
        $message = $this->name . ": {$message}";
        return $message;
    }
}

class BrickLayerExpert implements BuilderExpertInterface
{
    protected $name = 'Каменщик';
    public function getExpert(){
        $message =  'Могу построить кирпичный дом';
        return $this->getMessage($message);
    }

    protected function getMessage($message) {
        $message = $this->name . ": {$message}";
        return $message;
    }
}


// АБСТРАКТНАЯ ФАБРИКА которая создает Тип дома и тип нужного мастера по строительству дома
interface HouseBuildAbstractFactoryInterface
{
    public function buildHouse(): HouseBuildInterface;
    public function setExpert() : BuilderExpertInterface;
}


// Фабрика по строительству ДЕРЕВЯННОГО дома возвращает тип дома и нужного мастера
class WoodenHouseFactory implements HouseBuildAbstractFactoryInterface
{
    public function buildHouse(): HouseBuildInterface
    {
        return new WoodenHouse();
    }

    public function setExpert(): BuilderExpertInterface
    {
        return new CarpenterExpert();
    }
}

// Фабрика по строительству КИРПИЧНОГО дома возвращает тип дома и нужного мастера
class BrickHouseFactory implements HouseBuildAbstractFactoryInterface
{
    public function buildHouse(): HouseBuildInterface
    {
        return new BrickHouse();
    }

    public function setExpert(): BuilderExpertInterface
    {
        return new BrickLayerExpert();
    }
}


// Клиентский код который запускает сервисы
class AbstarctFactoryClientCode {

    protected $service;
    public function __construct(HouseBuildAbstractFactoryInterface $service) {
         $this->service = $service;
    }

    public function run() {
        $expert =  $this->service->setExpert();
        $house  =  $this->service->buildHouse();
        return $expert->getExpert() . "<br>" .$house->build();
    }
}
