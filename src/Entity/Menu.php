<?php
namespace App\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;

class Menu
{
    protected $_menuStructure = array(
        array(
            'label' => 'Banery',
            'children' => array(
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
                )
            )
        ),
        array(
            'label' => 'Naklejki',
            'children' => array(
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
                )
            )
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
            'label' => 'Rollup, potykacz',
            'url' => 'rollup_potykacz',
            'file' => 'rollup_potykacz.html.twig'
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
    );

    public function getMenu()
    {
        return $this->_menuStructure;
    }

    public function getCategoryByUrl($url, $mainCategory = null)
    {
        if ($mainCategory == null) {
            $mainCategory = $this->_menuStructure;
        }
        foreach ($mainCategory as $category) {
            if (array_key_exists('url', $category) && $category['url'] == $url) {
                return $category;
            } elseif (array_key_exists('children', $category) && is_array($category['children'])) {
                if (($result = $this->getCategoryByUrl($url, $category['children'])) !== null) {
                    return $result;
                }
            }
        }
        if ($mainCategory == null) {
            throw new Exception('Category not found!');
        }
    }
}