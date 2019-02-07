<?php
namespace App\Controller;

use App\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SitemapController extends AbstractController
{
    const BASE_URL = "https://www.grapart.pl";

    public function xml()
    {
        $menu = new Menu();

        $response = new Response();
        $response->headers->set('Content-Type', 'xml');

        return $this->render('sitemap.xml.twig', [
            'menu' => $menu->getMenu(),
            'base_url' => self::BASE_URL
        ], $response);
    }
}