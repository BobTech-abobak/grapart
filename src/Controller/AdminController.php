<?php
namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Realization;
use App\Form\RealizationFormType;
use App\Repository\RealizationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    public function index()
    {
        return $this->render('admin/index.html.twig', []);
    }

    public function projects(Request $request)
    {
        $realization = new Realization();
        $realizations = new RealizationRepository();
        $menu = new Menu();
        $categories = array();
        $edition = false;
        foreach ($menu->getMenu() as $menu) {
            if (array_key_exists('children', $menu)) {
                foreach ($menu['children'] as $child) {
                    if (array_key_exists('url', $child)) {
                        $categories[$child['url']] = $child['url'];
                    }
                }
            } else {
                if (array_key_exists('url', $menu)) {
                    $categories[$menu['url']] = $menu['url'];
                }
            }
        }

        $form = $this->createForm(RealizationFormType::class, $realization, array(
            'categories' => $categories
        ));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $object = $form->getData();
            $image = $object->getImage();
            if (intval($object->getId()>0)) {
                // EDITION
                $realizations->update($realization);
                return $this->redirectToRoute('admin_projects', array());
            } else {
                // ADD NEW
                $last = $realizations->findLast();
                if (false !== $last) {
                    $counter = $last->getId()+1;
                } else {
                    $counter = 1;
                }
                $realization->setId($counter);
                $newFilename = 'realizacja_'.$counter.'.'.$image->guessExtension();
                // Move the file to the directory where brochures are stored
                try {
                    $image->move(
                        $this->getParameter('kernel.project_dir') . DIRECTORY_SEPARATOR . 'public_html' . DIRECTORY_SEPARATOR . 'images',
                        $newFilename
                    );
                } catch (FileException $e) {
                    var_dump($e->getMessage());
                }
                $realization->setImage($newFilename);
                // Add new
                $realizations->add($realization);
                return $this->redirectToRoute('admin_projects', array());
            }
        }
        if (array_key_exists('action', $_POST)) {
            switch ($_POST['action']) {
                case 'edit':
                    $realization = $realizations->find($_POST['id']);
                    $form = $this->createForm(RealizationFormType::class, $realization, array(
                        'categories' => $categories,
                        'edit' => true
                    ));
                    $edition = $realization->getImage();
                    break;
                case 'delete':
                    $realization = $realizations->find($_POST['id']);
                    if ($realization !== false) {
                        $realizations->delete($realization);
                        return $this->redirectToRoute('admin_projects', array());
                    }
                    break;
            }
        }

        return $this->render('admin/realizations.html.twig', [
            'realizations' => $realizations->findAll(),
            'realization_form' => $form->createView(),
            'edition' => $edition
        ]);
    }
}