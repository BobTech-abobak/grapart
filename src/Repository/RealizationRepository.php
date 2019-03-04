<?php
namespace App\Repository;

use App\Entity\Realization;

class RealizationRepository
{
    /**
     * @var array $data Data structure
     */
    protected $data = array(
        [
            'title' => 'Oklejanie samochodu SZEJK-BUD',
            'image' => 'realizacja_1.jpg',
            'categories' => [
                'oklejanie_witryn_pojazdow'
            ]
        ],
        [
            'title' => 'Mobilne usługi fryzjerskie Nesti - projekt + wykonanie',
            'image' => 'realizacja_2.jpg',
            'categories' => [
                'oklejanie_witryn_pojazdow', 'folia_ploterowa'
            ]
        ],
        [
            'title' => 'Kaseton firmy Grapart',
            'image' => 'realizacja_3.jpg',
            'categories' => [
                'kaseton_led'
            ]
        ],
        [
            'title' => 'Wykonanie tabliczki adresowej 3D - Hotel Redyk***',
            'image' => 'realizacja_4.jpg',
            'categories' => [
                'szyld'
            ]
        ],
        [
            'title' => 'Przykładowe realizacje koszulek',
            'image' => 'realizacja_5.jpg',
            'categories' => [
                'koszulki_z_nadrukiem'
            ]
        ],
        [
            'title' => 'Przykładowa realizacja koszulki',
            'image' => 'realizacja_6.jpg',
            'categories' => [
                'koszulki_z_nadrukiem'
            ]
        ],
        [
            'title' => 'Karnet na wyciąg WOJJAN',
            'image' => 'realizacja_7.jpg',
            'categories' => [
                'poligrafia'
            ]
        ],
        [
            'title' => 'Litery 3D na przykładzie firmy Grapart',
            'image' => 'realizacja_8.jpg',
            'categories' => [
                'litery_3d'
            ]
        ]
    );

    /**
     * @param string $url
     * @return array
     */
    public function findByUrl($url)
    {
        $realizations = array();
        foreach ($this->data as $realization) {
            if (in_array($url, $realization['categories'])) {
                $newRealization = new Realization();
                $newRealization->setImage($realization['image']);
                $newRealization->setTitle($realization['title']);
                array_push($realizations, $newRealization);
            }
        }
        return $realizations;
    }
}