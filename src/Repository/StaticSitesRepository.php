<?php
namespace App\Repository;


use App\Entity\Category;
use App\Entity\StaticSite;

class StaticSitesRepository
{
    /**
     * @return array
     */
    public function findAll()
    {
        $dir = dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'static_sites';
        $sites = array();
        foreach (scandir($dir) as $file) {
            if (!in_array($file, array('.', '..'))) {
                $site = new StaticSite();
                $site->setId($file)->setName($file)->setContent('');
                $sites[] = $site;
            }
        }
        return $sites;
    }

    /**
     * @return StaticSite|false
     */
    public function find($id)
    {
        foreach ($this->findAll() as $site) {
            /** @var StaticSite $site */
            if (strcmp($site->getId(), $id) == 0) {
                $site->setContent(
                    $this->_getContentForSite($site->getName())
                );
                return $site;
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public function findAllWithCategories()
    {
        $categories = new CategoriesRepository();
        $allSites = $this->findAll();
        foreach ($allSites as $site) {
            /** @var StaticSite $site */
            foreach ($categories->findByTemplate($site->getName()) as $category) {
                /** @var Category $category */
                $site->addCategory($category);
            }
        }
        return $allSites;
    }

    /**
     * @param $name
     * @return bool|string
     */
    protected function _getContentForSite($name)
    {
        $dir = dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'static_sites';
        return file_get_contents($dir . DIRECTORY_SEPARATOR . $name);
    }

    /**
     * @param StaticSite $updatedSite
     */
    public function update($updatedSite)
    {
        $dir = dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'static_sites';
        file_put_contents(
            $dir . DIRECTORY_SEPARATOR . $updatedSite->getId(),
            $updatedSite->getContent(),
            LOCK_EX
        );
    }
}