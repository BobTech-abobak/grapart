<?php
namespace App\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;

class Menu
{
    protected $_menuStructure = array(
        array(
            'label' => 'Oferta',
            'url' => 'oferta',
            'file' => 'oferta.html.twig',
            'has_menu' => false,
            'submenu' => array(
                array (
                    'label' => 'Baner zwykły',
                    'url' => 'baner_zwykly',
                    'file' => 'baner_zwykly.html.twig'
                ),
                array (
                    'label' => 'Baner odblaskowy',
                    'url' => 'baner_odblaskowy',
                    'file' => 'baner_odblaskowy.html.twig'
                ),
                array (
                    'label' => 'Baner siatka mesh',
                    'url' => 'baner_siatka_mesh',
                    'file' => 'baner_siatka_mesh.html.twig'
                ),
                array (
                    'label' => 'Folia zwykła (monomeryczna)',
                    'url' => 'folia_zwykla',
                    'file' => 'folia_zwykla.html.twig'
                ),
                array (
                    'label' => 'Folia odblaskowa',
                    'url' => 'folia_odblaskowa',
                    'file' => 'folia_odblaskowa.html.twig'
                ),
                array (
                    'label' => 'Folia OWV (One Way Vision)',
                    'url' => 'folia_owv',
                    'file' => 'folia_owv.html.twig'
                ),
                array (
                    'label' => 'Folia samochodowa',
                    'url' => 'folia_samochodowa',
                    'file' => 'folia_samochodowa.html.twig'
                ),
                array (
                    'label' => 'Folia ploterowa',
                    'url' => 'folia_ploterowa',
                    'file' => 'folia_ploterowa.html.twig'
                ),
                array (
                    'label' => 'Flaga',
                    'url' => 'flaga',
                    'file' => 'flaga.html.twig'
                ),
                array (
                    'label' => 'Magnes',
                    'url' => 'magnes',
                    'file' => 'magnes.html.twig'
                ),
                array (
                    'label' => 'Rollup',
                    'url' => 'rollup',
                    'file' => 'rollup.html.twig'
                ),
                array (
                    'label' => 'Szyld',
                    'url' => 'szyld',
                    'file' => 'szyld.html.twig'
                ),
                array (
                    'label' => 'Kaseton LED',
                    'url' => 'kaseton_led',
                    'file' => 'kaseton_led.html.twig'
                ),
                array (
                    'label' => 'Litery 3D',
                    'url' => 'litery_3d',
                    'file' => 'litery_3d.html.twig'
                ),
                array (
                    'label' => 'Obróbka CNC, Cięcie laserem',
                    'url' => 'obrobka_cnc_ciecie_laserem',
                    'file' => 'obrobka_cnc_ciecie_laserem.html.twig'
                ),
                array (
                    'label' => 'Puchary, medale, dyplomy',
                    'url' => 'puchary_medale_dyplomy',
                    'file' => 'puchary_medale_dyplomy.html.twig'
                ),
                array (
                    'label' => 'Projekty graficzne',
                    'url' => 'projekty_graficzne',
                    'file' => 'projekty_graficzne.html.twig'
                ),
                array (
                    'label' => 'Koszulki z nadrukiem',
                    'url' => 'koszulki_z_nadrukiem',
                    'file' => 'koszulki_z_nadrukiem.html.twig'
                ),
                array (
                    'label' => 'Oklejanie witryn, pojazdów',
                    'url' => 'oklejanie_witryn_pojazdow',
                    'file' => 'oklejanie_witryn_pojazdow.html.twig'
                ),
                array (
                    'label' => 'Poligrafia',
                    'url' => 'poligrafia',
                    'file' => 'poligrafia.html.twig'
                )
            )
        ),
        array(
            'label' => 'Realizacje',
            'url' => 'realizacje',
            'file' => 'robota.html.twig',
            'has_menu' => false,
            'submenu' => array()
        ),
        array(
            'label' => 'Opinie',
            'url' => 'opinie',
            'file' => 'robota.html.twig',
            'has_menu' => false,
            'submenu' => array()
        ),
        array(
            'label' => 'Kontakt',
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