<?php
namespace App\Controller;

use App\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    const DIRECTORY_NAME = "static_sites";

    public function index()
    {
        $menu = new Menu();

        return $this->render('index.html.twig', [
            'menu' => $menu->getMenu()
        ]);
    }

    public function category($url)
    {
        $menu = new Menu();
        try {
            $category = $menu->getCategoryByUrl($url);
        } catch (\Exception $exception) {
            return new Response("", 404);
        }

        return $this->render(self::DIRECTORY_NAME . DIRECTORY_SEPARATOR . $category['file'], [
            'menu' => $menu->getMenu(),
            'category' => $category
        ]);
    }

    public function contact()
    {
        $menu = new Menu();

        return $this->render('kontakt.html.twig', [
            'menu' => $menu->getMenu()
        ]);
    }


    public function sitemap()
    {
        $menu = new Menu();

        return $this->render('mapa.html.twig', [
            'menu' => $menu->getMenu()
        ]);
    }
}