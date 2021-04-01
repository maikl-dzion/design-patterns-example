<?php


interface CommandServiceInterface {
    public function execute();
    public function cancel();
}


// Целевой класс
class AirDefenseSystemControl {

    public $commandList = [];
    public $targetList  = [];
    public $targetNum;

    public function __construct() {
    }

    // Отслеживание целей
    public function targetTracking() {
        $this->commandList['tracking'] = 'tracking';
        $rand = rand(3, 15);
        for($i = 0; $i < $rand; $i++) {
            $num = $i + 1;
            $this->targetList[$num] = $num;
        }
        $count = count($this->targetList);
        $message = "Команда: производим отслеживание целей  <br> Найдено {$count} воздушные цели ";
        return $message;
    }

    // Наведение на цель
    public function targetQuidance() {
        $rand = rand(3, 15);
        $this->targetNum = $this->targetList[1];
        if(!empty($this->targetList[$rand])) {
            $this->targetNum = $this->targetList[$rand];
        }
        $this->commandList['quidance'] = 'quidance';
        $message = "Команда: наведение на цель {$this->targetNum} выполнено <br> Цель находиться в радиусе поражения <br> Ждем команда на уничтожение цели";
        return $message;
    }

    // Уничтожить цель
    public function destroyTarget() {
        $this->commandList['destroy'] = 'destroy';
        $message = "Команда: уничтожить цель {$this->targetNum} <br> Цель {$this->targetNum} уничтожена ";
        return $message;
    }

    // Отменить команду
    public function cancelCommand($command) {
        $message = 'Неправильная команда';
        if(!empty($this->commandList[$command])){
            $this->commandList[$command] = false;
            $this->targetList  = [];
            $this->targetNum   = 0;
            $message = "Команда : $command отменена";
        }
        return $message;
    }
}


// Команда для отслеживания цели
class TargetTrackingCommand implements CommandServiceInterface
{
    private $system;

    public function __construct(AirDefenseSystemControl $system)
    {
        $this->system = $system;
    }

    public function execute() {
        return $this->system->targetTracking();
    }

    public function cancel() {
        return $this->system->cancelCommand('tracking');
    }
}


// Команда для наведения на цель
class TargetQuidanceCommand implements CommandServiceInterface
{
    private $system;

    public function __construct(AirDefenseSystemControl $system)
    {
        $this->system = $system;
    }

    public function execute() {
        return $this->system->targetQuidance();
    }

    public function cancel() {
        return $this->system->cancelCommand('quidance');
    }
}


// Команда для уничтожения цели
class DestroyTargetgCommand implements CommandServiceInterface
{
    private $system;

    public function __construct(AirDefenseSystemControl $system)
    {
        $this->system = $system;
    }

    public function execute() {
        return $this->system->destroyTarget();
    }

    public function cancel() {
        return $this->system->cancelCommand('destroy');
    }
}



// Клиентский код который запускает сервисы
class CommandServiceClientCode {

    protected $service;

    public function __construct(CommandServiceInterface $service) {
        $this->service = $service;
    }

    public function start() {
        return $this->service->execute();
    }

    public function undo() {
        return $this->service->cancel();
    }

}

