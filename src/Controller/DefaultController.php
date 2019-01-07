<?php
namespace App\Controller;

use App\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index()
    {
        $menu = new Menu();

        return $this->render('index.html.twig', [
            'menu' => $menu->getMenu(),
            'has_menu' => false
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
        return $this->render($category['file'], [
            'menu' => $menu->getMenu(),
            'category' => $category,
            'has_menu' => $category['has_menu'],
            'subcategory' => $category['submenu']
        ]);
    }

    public function subcategory($categoryUrl, $url)
    {
        $menu = new Menu();
        try {
            $category = $menu->getCategoryByUrl($categoryUrl);
            $subcategory = $menu->getSubcategoryByUrl($categoryUrl, $url);
        } catch (\Exception $exception) {
            return new Response("", 404);
        }
        return $this->render($category['url'] . DIRECTORY_SEPARATOR . $subcategory['file'], [
            'menu' => $menu->getMenu(),
            'category' => $category,
            'has_menu' => !empty($category['submenu']),
            'subcategory' => $category['submenu']
        ]);
    }
}