<?php

class Message
{
    protected $queue;

    public function addMessage(IMessageSender $sender)
    {
        echo "Invoker Add Queue" . get_class($sender) . " \n";

        $this->queue[] = $sender;
    }

    public function executeQueue()
    {
        echo "Invoker execute Queue\n";

        foreach ($this->queue as $sender) {
            $statusSendingMessage = false;
            while (!$statusSendingMessage) {
                $statusSendingMessage = $sender->sendMessage();
            }
        }
    }
}

interface IMessageSender
{
    public function sendMessage();
}

class SendEmail implements IMessageSender
{

    protected $title;
    protected $message;
    protected $emailAddress;

    /**
     * @param $title
     * @param $message
     * @param $emailAddress
     */
    public function __construct($title, $message, $emailAddress)
    {
        echo "call Object Send Mail \n";
        $this->title = $title;
        $this->message = $message;
        $this->emailAddress = $emailAddress;
    }


    public function sendMessage()
    {
        echo "Invoker: ...doing Send Message by Email $this->emailAddress \n";

        $status = rand(0, 1);
        return $status;
    }
}

class SendSms implements IMessageSender
{

    protected $title;
    protected $message;
    protected $number;

    /**
     * @param $title
     * @param $message
     * @param $number
     */
    public function __construct($title, $message, $number)
    {
        echo "call Object Send Sms \n";

        $this->title = $title;
        $this->message = $message;
        $this->number = $number;
    }


    public function sendMessage()
    {
        echo "Invoker: ...doing Send Message by Sms $this->number\n";
        $status = rand(0, 1);
        return $status;
    }
}


$messageQueue = new Message();

$messageQueue->addMessage(new SendEmail("subject", "Welcome", "apachish@gmail.com"));

$messageQueue->addMessage(new SendSms("subject", "Welcome", "0912*****27"));

$messageQueue->executeQueue();