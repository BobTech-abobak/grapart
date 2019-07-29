<?php
namespace App\Repository;

use App\Entity\Category;
use App\Entity\Realization;

class RealizationRepository
{
    /**
     * @return array
     */
    public function findAll()
    {
        $dir = dirname(__DIR__);
        $file = 'Files/realizations.csv';
        $csv = array_map('str_getcsv', file($dir . DIRECTORY_SEPARATOR . $file));
        $categories = new CategoriesRepository();
        $realizations = array();
        foreach ($csv as $realization) {
            $newRealization = new Realization();
            $newRealization->setId($realization[0]);
            $newRealization->setImage($realization[1]);
            $newRealization->setTitle($realization[2]);
            $newRealization->setOrder($realization[4]);
            foreach (explode(',', $realization[3]) as $category) {
                try {
                    $newRealization->addCategory(
                        $categories->find($category)
                    );
                } catch (\Exception $exception) {}
            }
            array_push($realizations, $newRealization);
        }
        return $realizations;
    }

    /**
     * @return Realization|false
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
     * @param string $url
     * @return array
     */
    public function findByUrl($url)
    {
        $realizations = array();
        foreach ($this->findAll() as $realization) {
            /** @var Realization $realization */
            foreach ($realization->getCategories() as $category) {
                /** @var Category $category */
                if ($url == $category->getUrl()) {
                    array_push($realizations, $realization);
                }
            }
        }
        return $this->_sortByOrder($realizations);
    }

    /**
     * @param array $realizations
     * @return array
     */
    protected function _sortByOrder($realizations)
    {
        for ($i=0 ; $i<count($realizations)-1 ; $i++) {
            for ($j=$i+1 ; $j<count($realizations) ; $j++) {
                if ($realizations[$i]->getOrder() > $realizations[$j]->getOrder()) {
                    $tmp = $realizations[$i];
                    $realizations[$i] = $realizations[$j];
                    $realizations[$j] = $tmp;
                }
            }
        }
        return $realizations;
    }

    /**
     * @param $id
     * @return bool|Realization
     */
    public function find($id)
    {
        foreach ($this->findAll() as $realization) {
            if ($realization->getId() == $id) {
                return $realization;
            }
        }
        return false;
    }

    /**
     * @param Realization $realization
     */
    public function add($realization)
    {
        $dir = dirname(__DIR__);
        $file = 'Files/realizations.csv';
        file_put_contents(
            $dir . DIRECTORY_SEPARATOR . $file,
            PHP_EOL . $realization->getAsCsvLine(),
            FILE_APPEND | LOCK_EX
        );
    }

    /**
     * @param Realization $deletedRealization
     */
    public function delete($deletedRealization)
    {
        $dir = dirname(__DIR__);
        $file = 'Files/realizations.csv';
        $newCsv = '';
        foreach ($this->findAll() as $realization) {
            if ($realization->getImage() !== $deletedRealization->getImage()) {
                $newCsv .= $realization->getAsCsvLine() . PHP_EOL;
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
     * @param Realization $updatedRealization
     */
    public function update($updatedRealization)
    {
        $dir = dirname(__DIR__);
        $file = 'Files/realizations.csv';
        $newCsv = '';
        foreach ($this->findAll() as $realization) {
            if ($realization->getId() !== $updatedRealization->getId()) {
                $newCsv .= $realization->getAsCsvLine() . PHP_EOL;
            } else {
                $updatedRealization->setImage(
                    $realization->getImage()
                );
                $newCsv .= $updatedRealization->getAsCsvLine() . PHP_EOL;
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