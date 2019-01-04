<?php
namespace App\Controller;

use App\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function index()
    {
        $menu = new Menu();

        return $this->render('index.html.twig', [
            'menu' => $menu->getMenu(),
        ]);
    }
}