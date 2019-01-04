<?php
namespace App\Entity;

class Menu
{
    protected $_menuStructure = array(
        'Banery' => array (
            array(
                'label' => 'Baner PCV siatka mesh',
                'url' => '1.html'
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
}