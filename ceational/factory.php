<?php

interface Transport
{
    public function deliver($place);
}

class Truck implements Transport
{

    public function deliver($place)
    {
        return $place;
    }
}

class Ship implements Transport
{

    public function deliver($place)
    {
        return $place;
    }
}

abstract class Logistic
{
    abstract public function createTransport();

    public function planDelivery($place)
    {

        $transport = $this->createTransport();
        return  "Transported to:  " . $transport->deliver($place);
    }
}

class RoadLogistic extends Logistic
{


    public function createTransport(): Truck
    {
        echo "by Truck \n";
        return new Truck();
    }
}

class SeaLogistic extends Logistic
{

    public function createTransport(): Ship
    {
        echo "by Ship \n";
        return new Ship();
    }
}
echo "Client: Transfer by road or sea by:.\n";

$road = new RoadLogistic();
$sea = new SeaLogistic();

echo $road->planDelivery("tehran")."\n";
echo  $road->planDelivery("Isfahan")."\n";
echo  $road->planDelivery("Qom")."\n";


echo  $sea->planDelivery("china")."\n";
echo  $sea->planDelivery("usa")."\n";
echo  $sea->planDelivery("turkey")."\n";
