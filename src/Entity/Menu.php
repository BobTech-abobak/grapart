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
                ),
                'Folia zwykła (monomeryczna)' => array (
                    'url' => 'folia_zwykla',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Folia odblaskowa' => array (
                    'url' => 'folia_odblaskowa',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Folia OWV (One Way Vision)' => array (
                    'url' => 'folia_owv',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Folia samochodowa' => array (
                    'url' => 'folia_samochodowa',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Folia ploterowa' => array (
                    'url' => 'folia_ploterowa',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Flaga' => array (
                    'url' => 'flaga',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Magnes' => array (
                    'url' => 'magnes',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Rollup' => array (
                    'url' => 'rollup',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Szyld' => array (
                    'url' => 'szyld',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Kaseton LED' => array (
                    'url' => 'kaseton_led',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Litery 3D' => array (
                    'url' => 'litery_3d',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Obróbka CNC, Cięcie laserem' => array (
                    'url' => 'obrobka_cnc_ciecie_laserem',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Puchary, medale, dyplomy' => array (
                    'url' => 'puchary_medale_dyplomy',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Projekty graficzne' => array (
                    'url' => 'projekty_graficzne',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Koszulki z nadrukiem' => array (
                    'url' => 'koszulki_z_nadrukiem',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Oklejanie witryn, pojazdów' => array (
                    'url' => 'oklejanie_witryn_pojazdow',
                    'file' => 'folia_zwykla.html.twig'
                ),
                'Poligrafia' => array (
                    'url' => 'poligrafia',
                    'file' => 'folia_zwykla.html.twig'
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