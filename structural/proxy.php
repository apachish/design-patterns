<?php


abstract class ReadFileAbstract
{
    protected $fileName;
    protected $contents;

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getContents()
    {
        return $this->contents;
    }
}

class ReadFile extends ReadFileAbstract {

    const DOCUMENTS_PATH = __DIR__;

    public function __construct($fileName)
    {
        $this->setFileName($fileName);
        $this->contents = file_get_contents(self::DOCUMENTS_PATH . "/" . $this->getFileName());
        echo "contents file  : ". $this->contents."\n";
    }
}

class ReadFileProxy extends ReadFileAbstract
{
    private $file;

    public function __construct($fileName)
    {
        $this->setFileName($fileName);
    }

    public function lazyLoad()
    {
        if($this->file === null) {
            $this->file = new ReadFile($this->getFileName());
        }
        return $this->file;
    }
}

echo "Executing client Read File With Out Proxy:\n";

$fileOne = new ReadFile('fileOne.txt');

echo "Executing client Read File with a proxy:\n";

$fileTwo = new ReadFileProxy('fileTwo.txt');

echo "Load File\n";
$fileOne = $fileTwo->lazyLoad();
echo "\n";
echo "Get Content File\n";
echo $fileOne->getContents();
echo "\n";

echo "Again Load File\n";
echo "Load File\n";
$fileOne = $fileTwo->lazyLoad();
echo "\n";

echo "Get Content File\n";
echo $fileOne->getContents();

