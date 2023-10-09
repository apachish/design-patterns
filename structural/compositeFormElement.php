<?php

abstract class FormElement {

    protected $name;
    protected $title;
    protected $data;

    /**
     * @param $name
     * @param $title
     */
    public function __construct($name, $title)
    {
        $this->name = $name;
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    abstract public function render();

}


/**
 * Summary of leaf
 */
class Input extends FormElement {
    private $type;
    public function __construct($name, $title,$type)
    {
       parent::__construct($name,$title);
       $this->type = $type;
    }

    public function render()
    {
        return "<label for=\"{$this->name}\">{$this->title}</label>\n".
                "<input name=\"{$this->name}\" type=\"{$this->type}\" value=\"{$this->data}\">\n";
    }
}

abstract class FiledComposite extends FormElement{
    protected $fields;

    public function add(FormElement $field)
    {
        $name = $field->getName();
        $this->fields[$name] = $field;
    }

    /**
     * Summary of remove
     * @param FormElement $component
     * @return void
     */
    public function remove(FormElement $field)
    {
        $this->fields = array_filter($this->fields, function ($child) use ($field) {
            return $child == $field;
        });
    }

    public function setData($data)
    {
        foreach ($this->fields as $name => $field){
            if(isset($data[$name])){
                $field->setData($data[$name]);
            }
        }
    }

    public function getData()
    {
        $data = [];
        foreach ($this->fields as $name=>$field){
            $data[$name]= $field->getData();
        }

        return $data;
    }

    public function render()
    {
        $output = "";
         foreach ($this->fields as $name => $field){
             $output .= $field->render();
         }

         return $output;
    }
}

class Fieldset extends FiledComposite {
    public function render()
    {
        $output =  parent::render();

        return "<fieldset><legend>{$this->title}</legend>\n$output</fieldset>\n";
    }
}

class Form extends FiledComposite {
    protected $url;

    public function __construct($name,$title,$url)
    {
        parent::__construct($name,$title);
        $this->url = $url;
    }
    public function render()
    {
        $output =  parent::render();

        return "<form action=\"{$this->url}\">\n<h3>{$this->title}</h3>\n$output</form>\n";
    }
}

$form  = new Form('product','Add product','/product/add');

$form->add(new Input('name','Name','text'));

$form->add(new Input('description','Description','text'));

$picture = new Fieldset('photo',"Product photo");

$picture->add(new Input('caption','Caption','text'));

$picture->add(new Input('image','Image','file'));

$form->add($picture);

$data = [
    'name'=>"Apple MacBook Pro",
    'description'=>"laptop",
    'photo'=>[
        'caption'=>"Front Photo",
        'image'=>"product.png"
    ]
];
$form->setData($data);

echo $form->render();

?>
