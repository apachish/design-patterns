<?php

namespace behavioral;


interface Gateway{

    public function setInfo($info);

    public function pay();
}

class MasterCard implements Gateway
{
    protected $info;


    public function setInfo($info)
    {
        $this->info = $info;
    }

    public function pay()
    {
        return $this->info;
    }
}

class VisaCard implements Gateway
{
    protected $info;


    public function setInfo($info)
    {
        $this->info = $info;
    }

    public function pay()
    {
        return $this->info;
    }
}


class Payment
{
    protected $gateway;

    public function setGateway(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function addInfo($info)
    {
        $this->gateway->setInfo($info);
    }

    public function pay()
    {
        return $this->gateway->pay();
    }
}

$payment = new Payment();

$payment->setGateway(new VisaCard());

$payment->addInfo(["name" => "shahriar", "price" => 1000]);

$pay = $payment->pay();

$payment->setGateway(new MasterCard());

$payment->addInfo(["name" => "ali", "price" => 1200]);

$pay2 = $payment->pay();

echo implode(" ",$pay);

echo "<hr>";

echo implode("",$pay2);