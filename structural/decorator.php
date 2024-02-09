<?php

interface Car{
    public function cost();
    public function description();
}

class Pride implements Car {

    public function cost()
    {
        return 4000000000;
    }

    public function description(): string
    {
        return "full option";
    }
}

abstract class CarFeature implements Car {
    protected $car;

    public function __construct(Car $car)
    {
        $this->car =$car;
    }

    abstract public function cost();
    abstract public function description();

}

class ElectricPheromone extends CarFeature{

    public function cost()
    {
        return $this->car->cost() + 5000000;
    }

    public function description()
    {
        return $this->car->description()." ,Electric pheromone";
    }
}

class SunRoof extends CarFeature{

    public function cost()
    {
        return $this->car->cost() + 10000000;
    }

    public function description()
    {
        return $this->car->description()." ,SunRoof";
    }
}

$pride = new Pride();
$pride = new ElectricPheromone($pride);
$pride = new SunRoof($pride);
echo $pride->cost()."\n";
echo $pride->description();