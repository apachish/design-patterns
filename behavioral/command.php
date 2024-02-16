<?php

abstract class CarWashCommand
{
    protected $car;

    public function __construct(CarInterface $car)
    {
        $this->car = $car;
    }

    abstract public function execute();
}

class CarSimpleWashCommand extends CarWashCommand
{
    protected $car;

    public function execute()
    {
        echo "washing  car  now \n";
    }
}

class CarDryCommand extends CarWashCommand
{


    public function execute()
    {
        echo "drying  car  now \n";
    }
}

class CarWaxCommand extends CarWashCommand
{


    public function execute()
    {
        echo "waxing  car  now \n";

    }
}

interface CarInterface
{

}

class PeugeotCar implements CarInterface
{
    public function __construct()
    {
        echo "driving Peugeot \n";
    }
}


class CarWash
{
    protected $customer_list;

    public function newCustomer($task_list)
    {
        echo "receive in car wash \n";
        $this->customer_list[] = $task_list;
    }

    public function wash()
    {
        echo "start to wash car \n";
        foreach ($this->customer_list as $i=>$customer) {
            echo ($i+1)." : ".($i?"new Customer \n":"start Work \n");
            foreach ($customer as $command) {
                echo "going  :".get_class($command)."\n";
                $command->execute();
            }
        }
    }
}

$car = new PeugeotCar();
$carWash = new CarWash();
$carWash->newCustomer([
    new CarSimpleWashCommand($car),
    new CarDryCommand($car)]
);

$carWash->newCustomer(
    [new CarSimpleWashCommand($car),
    new CarDryCommand($car),
    new CarWaxCommand($car)]
);

$carWash->wash();