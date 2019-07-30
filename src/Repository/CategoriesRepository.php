<?php
namespace App\Repository;

use App\Entity\Category;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoriesRepository
{
    /**
     * @return array
     */
    public function findAll()
    {
        $dir = dirname(__DIR__);
        $file = 'Files/categories.csv';
        $csv = array_map('str_getcsv', file($dir . DIRECTORY_SEPARATOR . $file));
        $categories = array();
        foreach ($csv as $category) {
            $newCategory = new Category();
            $newCategory->setId($category[0]);
            $newCategory->setName($category[1]);
            $newCategory->setUrl($category[2]);
            $newCategory->setTemplate($category[3]);
            $newCategory->setOrder($category[4]);
            $newCategory->setParent($category[5]);
            $categories[$category[0]] = $newCategory;
        }
        return $categories;
    }

    /**
     * @param int $id
     * @return Category
     * @throws \Exception
     */
    public function find($id)
    {
        $allCategories = $this->findAll();
        if (!array_key_exists($id, $allCategories)) {
            throw new \Exception('Category not found!');
        }
        return $allCategories[$id];
    }

    /**
     * @return Category|false
     */
    public function findLast()
    {
        $all = $this->findAll();
        if (empty($all)) {
            return false;
        }
        return array_pop($all);
    }

    /**
     * @return array
     */
    public function getMenu()
    {
        $allCategories = $this->findAll();
        foreach ($allCategories as $key => $category) {
            /** @var Category $category */
            if ($category->hasParent()) {
                $parentCategory = $category->getParent();
                $allCategories[$parentCategory]->addChildren($category);
                unset($allCategories[$key]);
            }
        }
        $menu = array();
        foreach ($allCategories as $category) {
            /** @var Category $category */
            if ($category->hasChildren()) {
                $category->setChildren($this->_sortByOrder($category->getChildren()));
            }
            array_push($menu, $category);
        }
        return $this->_sortByOrder($menu);
    }

    /**
     * @param array $categories
     * @return array
     */
    protected function _sortByOrder($categories)
    {
        for ($i=0 ; $i<count($categories)-1 ; $i++) {
            for ($j=$i+1 ; $j<count($categories) ; $j++) {
                if ($categories[$i]->getOrder() > $categories[$j]->getOrder()) {
                    $tmp = $categories[$i];
                    $categories[$i] = $categories[$j];
                    $categories[$j] = $tmp;
                }
            }
        }
        return $categories;
    }

    /**
     * @param string $url
     * @throws NotFoundHttpException
     * @return Category
     */
    public function findByUrl($url)
    {
        foreach ($this->findAll() as $category) {
            /** @var Category $category */
            if (strcmp($url, $category->getUrl()) == 0 ) {
                return $category;
            }
        }
        throw new NotFoundHttpException('Category not found!');
    }

    /**
     * @param string $file
     * @return array
     */
    public function findByTemplate($file)
    {
        $categories = array();
        foreach ($this->findAll() as $category) {
            /** @var Category $category */
            if (strcmp($file, $category->getTemplate()) == 0 ) {
                $categories[] = $category;
            }
        }
        return $categories;
    }

    /**
     * @param Category $category
     */
    public function add($category)
    {
        $dir = dirname(__DIR__);
        $file = 'Files/categories.csv';
        file_put_contents(
            $dir . DIRECTORY_SEPARATOR . $file,
            PHP_EOL . $category->getAsCsvLine(),
            FILE_APPEND | LOCK_EX
        );
    }

    /**
     * @param Category $updatedCategory
     */
    public function update($updatedCategory)
    {
        $dir = dirname(__DIR__);
        $file = 'Files/categories.csv';
        $newCsv = '';
        foreach ($this->findAll() as $category) {
            if ($category->getId() !== $updatedCategory->getId()) {
                $newCsv .= $category->getAsCsvLine() . PHP_EOL;
            } else {
                $newCsv .= $updatedCategory->getAsCsvLine() . PHP_EOL;
            }
        }
        $newCsv = rtrim($newCsv, PHP_EOL);
        file_put_contents(
            $dir . DIRECTORY_SEPARATOR . $file,
            $newCsv,
            LOCK_EX
        );
    }

    /**
     * @param Category $deletedCategory
     */
    public function delete($deletedCategory)
    {
        $dir = dirname(__DIR__);
        $file = 'Files/categories.csv';
        $newCsv = '';
        foreach ($this->findAll() as $category) {
            /** @var Category $category */
            if ($category->getParent() == $deletedCategory->getId())
            {
                $category->setParent(null);
            }
            if ($category->getId() !== $deletedCategory->getId()) {
                $newCsv .= $category->getAsCsvLine() . PHP_EOL;
            }
        }
        $newCsv = rtrim($newCsv, PHP_EOL);
        file_put_contents(
            $dir . DIRECTORY_SEPARATOR . $file,
            $newCsv,
            LOCK_EX
        );
    }
}