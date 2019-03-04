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
            'title' => 'Kaseton frezowany dibond',
            'image' => 'realizacja_3.jpg',
            'categories' => [
                'kaseton_led'
            ]
        ],
        [
            'title' => 'Tabliczka 3D dibond frezowany',
            'image' => 'realizacja_4.jpg',
            'categories' => [
                'szyld'
            ]
        ],
        [
            'title' => 'Nadruk metodą termotransferu',
            'image' => 'realizacja_5.jpg',
            'categories' => [
                'koszulki_z_nadrukiem'
            ]
        ],
        [
            'title' => 'Nadruk metodą termotransferu',
            'image' => 'realizacja_6.jpg',
            'categories' => [
                'koszulki_z_nadrukiem'
            ]
        ],
        [
            'title' => 'Karnety Wojjan',
            'image' => 'realizacja_7.jpg',
            'categories' => [
                'poligrafia'
            ]
        ],
        [
            'title' => 'Logo ze styroduru',
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