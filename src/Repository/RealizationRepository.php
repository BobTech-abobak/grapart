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