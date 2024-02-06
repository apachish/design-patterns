<?php
namespace adapter;

class Twitter
{
    public function checkUserToken()
    {
        return "twitter checkUserToken";
    }

    public function setStatusUpdate($token,$message)
    {
        return "twitter setStatusUpdate";
    }
}

class FaceBook implements IsStatusUpdate
{
    public function getUserToken()
    {
        return "facebook login";
    }

    public function postUpdate($token,$message)
    {
        return "facebook update post";
    }
}
interface IsStatusUpdate
{
    public function getUserToken();
    public function postUpdate($token,$message);
}

class TwitterAdapter implements IsStatusUpdate
{
    protected $twitter;

    public function __construct(Twitter $twitter)
    {
        $this->twitter = $twitter;
    }
    public function getUserToken(){
        return $this->twitter->checkUserToken();
    }
    public function postUpdate($token,$message){
        return $this->twitter->setStatusUpdate($token,$message);
    }
}


/**
 * The client code can work with any class that follows the Target interface.
 */
function clientCode(IsStatusUpdate $service)
{
    $token = $service->getUserToken();
    echo $service->postUpdate($token,"update Adapter");
}

echo "Client code is designed correctly and works with login Facebook:\n";
$service_provider = new FaceBook();
clientCode($service_provider);
echo "\n\n";


echo "The same client code can work with other classes via adapter:\n";
$twitterApi = new Twitter();
$service_provider = new TwitterAdapter($twitterApi);
clientCode($service_provider);


