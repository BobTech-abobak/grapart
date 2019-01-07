<?php
namespace App\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;

class Menu
{
    protected $_menuStructure = array(
        'Oferta' => array(
            'url' => 'oferta',
            'file' => 'oferta.html.twig',
            'has_menu' => false,
            'submenu' => array(
                'Baner zwykły' => array (
                    'url' => 'baner_zwykly',
                    'file' => 'baner_zwykly.html.twig'
                ),
                'Baner odblaskowy' => array (
                    'url' => 'baner_odblaskowy',
                    'file' => 'baner_odblaskowy.html.twig'
                ),
                'Baner siatka mesh' => array (
                    'url' => 'baner_siatka_mesh',
                    'file' => 'baner_siatka_mesh.html.twig'
                )
            )
        ),
        'Realizacje' => array(
            'url' => 'realizacje',
            'file' => 'robota.html.twig',
            'has_menu' => false,
            'submenu' => array()
        ),
        'Opinie' => array(
            'url' => 'opinie',
            'file' => 'robota.html.twig',
            'has_menu' => false,
            'submenu' => array()
        ),
        'Kontakt' => array(
            'url' => 'kontakt',
            'file' => 'robota.html.twig',
            'has_menu' => false,
            'submenu' => array()
        )
    );

    public function getMenu()
    {
        return $this->_menuStructure;
    }

    public function getCategoryByUrl($url)
    {
        foreach ($this->_menuStructure as $category) {
            if ($category['url'] == $url)
                return $category;
        }
        throw new Exception('Category not found!');
    }


    public function getSubcategoryByUrl($categoryUrl, $url)
    {
        $category = $this->getCategoryByUrl($categoryUrl);
        foreach ($category['submenu'] as $subcategory) {
            if ($subcategory['url'] == $url)
                return $subcategory;
        }
        throw new Exception('Subcategory not found!');
    }
}