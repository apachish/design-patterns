<?php

class Validation{
    public function isValid($data)
    {
        echo "check data \n" ;
        return true;
    }
}

class User{
    public function create($data)
    {
        echo "create user \n" ;

        return $data;
    }
}

class Mail{

    private $email;
    private $subject;
    private $body;

    public function to($email)
    {
        echo "add send to $email \n";
        $this->email =  $email;
    }

    public function subject($subject)
    {
        echo "add subject email $subject \n";
        $this->subject = $subject;
    }

    public function send()
    {
        echo "send email ".$this->email." by subject  ".$this->subject."\n";
    }
}

class Auth{
    public function login($email,$password)
    {
        echo "check login user \n";
        return true;
    }
}

class AuthFacade{
    protected $validate;
    protected $user;
    protected $auth;
    protected $email;

    /**
     * @param $validate
     * @param $user
     * @param $auth
     * @param $email
     */
    public function __construct()
    {
        $this->validate = new Validation();
        $this->user = new User();
        $this->auth = new Auth();
        $this->email = new Mail();
    }

    public function SingUpUser($data)
    {
        if($this->validate->isValid($data)){
            $this->user->create($data);
            $this->auth->login($data["email"],$data["password"]);
            $this->email->to($data["email"]);
            $this->email->subject("welcome to site");
            $this->email->send();
        }
    }

    public function singInUser($email,$password)
    {
        return $this->auth->login($email,$password);
    }

}

$data = [
    "email"=>"apachish@gmail.com",
    "name"=>"shahriar",
    "password"=>"123456",
];
$authFacade = new AuthFacade();
$authFacade->SingUpUser($data);
$authFacade->singInUser($data["email"],$data["password"]);