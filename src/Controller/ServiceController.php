<?php
namespace App\Controller;

use App\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends AbstractController
{
    public function index($type)
    {
        $menu = new Menu();
        try {
            $menuPosition = $menu->getPositionByUrl($type);
        } catch (\Exception $exception) {
            return new Response("", 404);
        }
        return $this->render($menuPosition['file'], [
            'menu' => $menu->getMenu(),
        ]);
    }
}