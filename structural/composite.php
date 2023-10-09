<?php

abstract class Component
{
    /**
     * Summary of parent
     * @var
     */
    protected $parent;

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     * @return self
     */
    public function setParent($parent): self
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Summary of operation
     * @return void
     */
    abstract public function operation();
}


/**
 * Summary of leaf
 */
class leaf extends Component
{

    /**
     * Summary of operation
     * @return string
     */
    public function operation()
    {
        return "Leaf";
    }
}


class Composite extends Component
{

    protected $children = [];

    /**
     * Summary of add
     * @param Component $component
     * @return void
     */
    public function add(Component $component)
    {
        $this->children[] = $component;
        $component->setParent($this);
    }


    /**
     * Summary of remove
     * @param Component $component
     * @return void
     */
    public function remove(Component $component)
    {
        $this->children = array_filter($this->children, function ($child) use ($component) {
            return $child == $component;
        });
    }


    /**
     * Summary of operation
     * @return string
     */
    public function operation()
    {
        $results = [];
        foreach ($this->children as $child) {
            $results[] = $child->operation();
        }

        return "Branch(" . implode("+", $results) . ")";
    }
}


$tree = new Composite();

$branch1 = new Composite();

$branch1->add(new leaf());

$branch1->add(new leaf());

$branch2 = new Composite();

$branch2->add(new leaf());

$branch2->add(new leaf());

$tree->add($branch1);

$tree->add($branch2);

echo 'result :' . $tree->operation();
?>
