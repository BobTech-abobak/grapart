<?php
namespace App\Entity;

/**
 * Class Realization
 * @package App\Entity
 */
class Realization
{
    /** @var int $id */
    protected $id;

    /** @var string $title */
    protected $title;

    /** @var string $image */
    protected $image;

    /** @var array $categories */
    protected $categories;

    /** @var int $order */
    protected $order;

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

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;
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
     * @return string
     */
    public function getAsCsvLine()
    {
        $csvLine = "\"".$this->getId()."\",";
        $csvLine .= "\"".$this->getImage()."\",";
        $csvLine .= "\"".str_replace("\"", "", $this->getTitle())."\",";
        $csvLine .= "\"".implode(",", $this->getCategories())."\",";
        $csvLine .= "\"".$this->getOrder()."\"";
        return $csvLine;
    }
}