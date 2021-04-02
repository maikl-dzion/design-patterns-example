<?php


class NewComputer
{
    protected $system;
    protected $cpu;
    protected $ram;
    protected $case;
    protected $power;

    protected $gpu = false;
    protected $hdd = false;
    protected $ssd = false;
    protected $drive = false;

    public function __construct(BurgerBuilder $builder)
    {
//        $this->size = $builder->size;
//        $this->cheese = $builder->cheese;
//        $this->pepperoni = $builder->pepperoni;
//        $this->lettuce = $builder->lettuce;
//        $this->tomato = $builder->tomato;
    }
}


class Burger
{
    protected $size;
    protected $cheese    = false;
    protected $pepperoni = false;
    protected $lettuce   = false;
    protected $tomato    = false;

    public function __construct(BurgerBuilder $builder)
    {
        $this->size = $builder->size;
        $this->cheese = $builder->cheese;
        $this->pepperoni = $builder->pepperoni;
        $this->lettuce = $builder->lettuce;
        $this->tomato = $builder->tomato;
    }
}


class BurgerBuilder
{
    public $size;
    public $cheese    = false;
    public $pepperoni = false;
    public $lettuce   = false;
    public $tomato    = false;

    public function __construct(int $size)
    {
        $this->size = $size;
    }

    public function addPepperoni()
    {
        $this->pepperoni = true;
        return $this;
    }

    public function addLettuce()
    {
        $this->lettuce = true;
        return $this;
    }

    public function addCheese()
    {
        $this->cheese = true;
        return $this;
    }

    public function addTomato()
    {
        $this->tomato = true;
        return $this;
    }

    public function build(): Burger
    {
        return new Burger($this);
    }
}


//$burger = (new BurgerBuilder(14))
//    ->addPepperoni()
//    ->addLettuce()
//    ->addTomato()
//    ->build();

