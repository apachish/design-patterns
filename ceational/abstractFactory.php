<?php

interface TransportA
{
    public function deliver($place);
}

interface TransportB
{
    public function deliver($place);
    public function insurance();
}

class TruckA implements TransportA
{

    public function deliver($place)
    {
        return "The result of the Transfer  Truck A ".$place;
    }
}

class ShipA implements TransportA
{

    public function deliver($place)
    {
        return "The result of the Transfer  Ship A  ".$place;
    }
}

class TruckB implements TransportB
{

    public function deliver($place)
    {
        return "The result of the Transfer  Truck B ".$place;
    }

    public function insurance()
    {
        return "The insurance of the Transfer  Truck  B ";
    }
}

class ShipB implements TransportB
{

    public function deliver($place): string
    {
        return "The result of the Transfer  Ship  B ".$place;
    }
    public function insurance(): string
    {
        return "The insurance of the Transfer  Ship  B ";
    }
}

interface  ATransportFactory
{
     public function createRoadTransport();
     public function createSeaTransport();

}

class TransportFactoryA implements ATransportFactory
{

    public function createRoadTransport(): TruckA
    {
        return new TruckA();
    }

    public function createSeaTransport(): ShipB
    {
        return new ShipB();
    }
}

class TransportFactoryB implements ATransportFactory
{

    public function createRoadTransport(): TruckB
    {
        return new TruckB();
    }

    public function createSeaTransport(): ShipA
    {
        return new ShipA();
    }
}
echo "Client: Transfer by road or sea by:.\n";

$transportA = new TransportFactoryA();
$transportB = new TransportFactoryB();

$truck1 =  $transportA->createRoadTransport();
echo $truck1->deliver("tehran")."\n";
$truck2 =   $transportB->createRoadTransport();
echo $truck2->deliver("Isfahan")."\n";
echo $truck2->insurance()."\n";




$ship1 =  $transportA->createRoadTransport();
echo $ship1->deliver("china")."\n";
$ship2 =  $transportB->createRoadTransport();
echo $ship2->deliver("usa")."\n";
echo $ship2->insurance()."\n";


