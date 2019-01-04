<?php
namespace App\Entity;

use Symfony\Component\Config\Definition\Exception\Exception;

class Menu
{
    protected $_menuStructure = array(
        'Banery' => array (
            array(
                'label' => 'Baner PCV siatka mesh',
                'url' => 'testowa_oferta',
                'file' => 'oferta/testowa_oferta.html.twig'
            ),
            array(
                'label' => 'Baner PCV odblaskowy',
                'url' => '2.html'
            ),
            array(
                'label' => 'Baner PCV zwykły',
                'url' => '2.html'
            )
        ),
        'Folie' => array (
            array(
                'label' => 'Folia zwykła',
                'url' => '1.html'
            ),
            array(
                'label' => 'Folia OWV',
                'url' => '2.html'
            ),
            array(
                'label' => 'Folia odblaskowa',
                'url' => '2.html'
            ),
            array(
                'label' => 'Folia samochodowa',
                'url' => '2.html'
            ),
            array(
                'label' => 'Folia kasetonowa',
                'url' => '2.html'
            ),
            array(
                'label' => 'Folia kredowa',
                'url' => '2.html'
            ),
            array(
                'label' => 'Folia magnetyczna',
                'url' => '2.html'
            )
        )
    );

    public function getMenu()
    {
        return $this->_menuStructure;
    }

    public function getPositionByUrl($url)
    {
        foreach ($this->_menuStructure as $menuLabel) {
            foreach ($menuLabel as $menuItem) {
                if ($menuItem['url'] == $url)
                    return $menuItem;
            }
        }
        throw new Exception('Menu position not found!');
    }
}