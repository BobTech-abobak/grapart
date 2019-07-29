<?php
namespace App\Controller;

use App\Entity\Category;
use App\Entity\Realization;
use App\Form\CategoryFormType;
use App\Form\RealizationFormType;
use App\Repository\CategoriesRepository;
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


    public function categories(Request $request)
    {
        $category = new Category();
        $categories = new CategoriesRepository();
        $categoriesSelect = array();
        $edition = false;
        foreach ($categories->findAll() as $categorySelect) {
            /** @var Category $categorySelect */
            if (!$categorySelect->hasParent()) {
                $categoriesSelect[$categorySelect->getName()] = $categorySelect->getId();
            }
        }
        $templates = array();
        $files = scandir($this->getParameter('kernel.project_dir') . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'static_sites');
        foreach ($files as $file) {
            if (!in_array($file, array('.', '..'))) {
                $templates[$file] = $file;
            }
        }
        $form = $this->createForm(CategoryFormType::class, $category, array(
            'templates' => $templates,
            'categories' => $categoriesSelect
        ));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $object = $form->getData();
            if (intval($object->getId()>0)) {
                // EDITION
                $categories->update($category);
                return $this->redirectToRoute('admin_categories', array());
            } else {
                // ADD NEW
                $last = $categories->findLast();
                if (false !== $last) {
                    $counter = $last->getId()+1;
                } else {
                    $counter = 1;
                }
                $category->setId($counter);
                // Add new
                $categories->add($category);
                return $this->redirectToRoute('admin_categories', array());
            }
        }
        if (array_key_exists('action', $_POST)) {
            switch ($_POST['action']) {
                case 'edit':
                    $category = $categories->find($_POST['id']);
                    $form = $this->createForm(CategoryFormType::class, $category, array(
                        'templates' => $templates,
                        'categories' => $categoriesSelect
                    ));
                    $edition = true;
                    break;
                case 'delete':
                    try {
                        $category = $categories->find($_POST['id']);
                        $categories->delete($category);
                    } catch (\Exception $exception) {}
                    return $this->redirectToRoute('admin_categories', array());
                    break;
            }
        }

        return $this->render('admin/categories.html.twig', [
            'categories' => $categories->findAll(),
            'category_form' => $form->createView(),
            'edition' => $edition
        ]);
    }

    public function projects(Request $request)
    {
        $realization = new Realization();
        $realizations = new RealizationRepository();
        $categories = new CategoriesRepository();
        $categoriesSelect = array();
        $edition = false;
        foreach ($categories->findAll() as $category) {
            /** @var Category $category */
            $categoriesSelect[$category->getName()] = $category->getId();
        }

        $form = $this->createForm(RealizationFormType::class, $realization, array(
            'categories' => $categoriesSelect
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
                        'categories' => $categoriesSelect,
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