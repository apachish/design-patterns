<?php

    class Service implements IObserver
    {


        protected $name;

        protected $priority;


        public function __construct($name, $priority)
        {
            $this->name = $name;
            $this->priority = $priority;
        }

        public function update(IObservable $observable)
        {
            print_r("{$this->name} : {$observable->getEvent()} \n");
        }
    }

    class Publisher implements IObservable
    {

        protected $event;

        protected $observers = [];

        /**
         * @return mixed
         */
        public function getEvent()
        {
            return $this->event;
        }

        /**
         * @param mixed $event
         */
        public function setEvent($event)
        {
            $this->event = $event;
            $this->notify();
        }


        public function register(IObserver $observer)
        {
            $observer_key = spl_object_hash($observer);
            $this->observers[$observer_key] = $observer;
        }

        public function unRegister(IObserver $observer)
        {
            $observer_key = spl_object_hash($observer);
            unset($this->observers[$observer_key]);
        }

        public function notify()
        {
            echo "call notify \n";
            foreach ($this->observers as $observer) {
                echo "send notify \n";
                $observer->update($this);
            }
        }

        /**
         * @return array
         */
        public function getObservers(): array
        {
            return $this->observers;
        }
    }

    interface IObservable
    {
        public function register(IObserver $observer);

        public function unRegister(IObserver $observer);

        public function notify();
    }

    interface IObserver
    {
        public function update(IObservable $observable);

    }

    $notify = new Publisher();
    $email = new Service('MailObserver', 30);
    $clock = new Service('ClockObserver', 60);
    $desktop = new Service('DesktopObserver', 50);
    $icons = new Service('IconsObserver', 20);
    $notify->register($email);
    $notify->register($clock);
    $notify->register($desktop);
    $notify->register($icons);

    $notify->setEvent("do something ... ");
    $notify->unRegister($email);
    $notify->setEvent("something  else ... ");