<?php
namespace App\Entity;

class StaticSite
{
    /** @var string $id */
    protected $id;

    /** @var string $name */
    protected $name;

    /** @var string $content */
    protected $content;

    /** @var array $categories */
    protected $categories;

    public function __construct()
    {
        $this->categories = array();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setContent($value)
    {
        $this->content = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param array $categoriesArray
     * @return $this
     */
    public function setCategories($categoriesArray)
    {
        $this->categories = $categoriesArray;
        return $this;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function addCategory($category)
    {
        array_push($this->categories, $category);
        return $this;
    }
}