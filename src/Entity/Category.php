<?php
namespace App\Entity;

use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Category
{
    /** @var int $id */
    protected $id;

    /** @var string $name */
    protected $name;

    /** @var string $url */
    protected $url;

    /** @var string $template */
    protected $template;

    /** @var int $order */
    protected $order;

    /** @var string $parent */
    protected $parent;

    /** @var array $children */
    protected $children;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->children = array();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return intval($this->id);
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /** @return string */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }

    /** @return string */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setUrl($value)
    {
        $this->url = $value;
        return $this;
    }

    /** @return string */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setTemplate($value)
    {
        $this->template = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return int
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setParent($value)
    {
        $this->parent = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasParent()
    {
        return boolval(intval($this->parent)>0);
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Category $value
     * @return $this
     */
    public function addChildren($value)
    {
        array_push($this->children, $value);
        return $this;
    }

    /**
     * @param array $value
     * @return $this
     */
    public function setChildren($value)
    {
        $this->children = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return boolval(count($this->children)>0);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return (string)$this->getId();
    }

    /**
     * @return string
     */
    public function getAsCsvLine()
    {
        $csvLine = "\"".$this->getId()."\",";
        $csvLine .= "\"".$this->getName()."\",";
        $csvLine .= "\"".$this->getUrl()."\",";
        $csvLine .= "\"".$this->getTemplate()."\",";
        $csvLine .= "\"".$this->getOrder()."\",";
        $csvLine .= "\"".$this->getParent()."\"";
        return $csvLine;
    }
}