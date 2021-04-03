<?php

interface NewCompInterface {
   public function createOrder();
}

class NewComputer implements NewCompInterface
{
    public $system;
    public $cpu;
    public $ram;
    public $_case;
    public $power;

    public $gpu   = false;
    public $hdd   = false;
    public $ssd   = false;
    public $sd    = false;
    public $keyboard = false;
    public $mouse = false;
    public $sound = false;
    public $price = 0;

    public function createOrder() {
         $order  = $this->is('system', 'Системная плата');
         $order .= $this->is('cpu', 'Процессор');
         $order .= $this->is('ram', 'Оперативная память');
         $order .= $this->is('_case', 'Корпус');
         $order .= $this->is('power', 'Блок питания');
         return $order;
    }

    protected function getMessage($value) {
        $message = "{$value}";
        return $message;
    }

    protected function is($name, $title) {
        $result = '';
        if(!empty($this->$name))
            $result = "<div>{$title}:{$this->$name}</div>";
        return $result;
    }

//    public function __construct(BurgerBuilder $builder)
//    {
//        $this->size = $builder->size;
//        $this->cheese = $builder->cheese;
//        $this->pepperoni = $builder->pepperoni;
//        $this->lettuce = $builder->lettuce;
//        $this->tomato = $builder->tomato;
//    }
}

interface NewCompBuilderInterface {
    public function create()      : void;
    public function get()         : NewCompInterface;
    public function cpu($data)    : NewCompBuilderInterface;
    public function system($data) : NewCompBuilderInterface;
    public function power($data)  : NewCompBuilderInterface;
    public function ram($data)    : NewCompBuilderInterface;
    public function _case($data)  : NewCompBuilderInterface;
    public function gpu($data)    : NewCompBuilderInterface;
    public function hdd($data)    : NewCompBuilderInterface;
    public function ssd($data)    : NewCompBuilderInterface;
}


class ComputerBuilder implements NewCompBuilderInterface {

    protected $computer;

    public function __construct() {
        $this->create();
    }

    public function create() : void {
       $this->computer = new NewComputer();
    }

    public function get() : NewCompInterface {
        $newComputer = $this->computer;
        $this->create();
        return $newComputer;
    }

    public function cpu($data = '') : NewCompBuilderInterface {
        $this->computer->cpu = $data;
        return $this;
    }

    public function system($data = '') : NewCompBuilderInterface {
        $this->computer->system = $data;
        return $this;
    }

    public function power($data = '') : NewCompBuilderInterface {
        $this->computer->power = $data;
        return $this;
    }

    public function ram($data = '') : NewCompBuilderInterface {
        $this->computer->ram = $data;
        return $this;
    }

    public function _case($data = '') : NewCompBuilderInterface {
        $this->computer->_case = $data;
        return $this;
    }

    public function gpu($data = '') : NewCompBuilderInterface {
        $this->computer->gpu = $data;
        return $this;
    }

    public function hdd($data = '') : NewCompBuilderInterface {
        $this->computer->hdd = $data;
        return $this;
    }

    public function ssd($data = '') : NewCompBuilderInterface {
        $this->computer->ssd = $data;
        return $this;
    }

}



//
//class Burger
//{
//    protected $size;
//    protected $cheese    = false;
//    protected $pepperoni = false;
//    protected $lettuce   = false;
//    protected $tomato    = false;
//
//    public function __construct(BurgerBuilder $builder)
//    {
//        $this->size = $builder->size;
//        $this->cheese = $builder->cheese;
//        $this->pepperoni = $builder->pepperoni;
//        $this->lettuce = $builder->lettuce;
//        $this->tomato = $builder->tomato;
//    }
//}
//
//
//class BurgerBuilder
//{
//    public $size;
//    public $cheese    = false;
//    public $pepperoni = false;
//    public $lettuce   = false;
//    public $tomato    = false;
//
//    public function __construct(int $size)
//    {
//        $this->size = $size;
//    }
//
//    public function addPepperoni()
//    {
//        $this->pepperoni = true;
//        return $this;
//    }
//
//    public function addLettuce()
//    {
//        $this->lettuce = true;
//        return $this;
//    }
//
//    public function addCheese()
//    {
//        $this->cheese = true;
//        return $this;
//    }
//
//    public function addTomato()
//    {
//        $this->tomato = true;
//        return $this;
//    }
//
//    public function build(): Burger
//    {
//        return new Burger($this);
//    }
//}


//$burger = (new BurgerBuilder(14))
//    ->addPepperoni()
//    ->addLettuce()
//    ->addTomato()
//    ->build();

