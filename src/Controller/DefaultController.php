<?php
namespace App\Controller;

use App\Entity\Mail;
use App\Form\ContactFormType;
use App\Repository\CategoriesRepository;
use App\Repository\RealizationRepository;
use App\Repository\StaticSitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function index()
    {
        $categories = new CategoriesRepository();
        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail, ['action' => $this->generateUrl('send_mail')]);

        return $this->render('index.html.twig', [
            'menu' => $categories->getMenu(),
            'contact_form' => $form->createView()
        ]);
    }

    public function category($url)
    {
        $categories = new CategoriesRepository();
        $category = $categories->findByUrl($url);
        $realizations = new RealizationRepository();
        $staticSites = new StaticSitesRepository();
        $staticSite = $staticSites->find($category->getTemplate());

        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail, ['action' => $this->generateUrl('send_mail')]);

        return $this->render('oferta.html.twig', [
            'menu' => $categories->getMenu(),
            'category' => $category,
            'static_content' => $staticSite->getContent(),
            'realizations' => $realizations->findByUrl($url),
            'contact_form' => $form->createView()
        ]);
    }

    public function contact()
    {
        $categories = new CategoriesRepository();

        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail, ['action' => $this->generateUrl('send_mail')]);


        return $this->render('kontakt.html.twig', [
            'menu' => $categories->getMenu(),
            'contact_form' => $form->createView()
        ]);
    }

    public function mail(Request $request, \Swift_Mailer $mailer)
    {
        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail, ['action' => $this->generateUrl('send_mail')]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            var_dump($task);

            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('webmaster@grapart.pl')
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig'
                    ),
                    'text/html'
                )
            ;
            var_dump('wysyłam maila');
            var_dump($mailer->send($message, $failures));
            if (!$mailer->send($message, $failures))
            {
                echo "Failures:";
                print_r($failures);
            }
            die;
//            return $this->redirectToRoute('task_success');
        }
    }


    public function sitemap()
    {
        $categories = new CategoriesRepository();

        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail);


        return $this->render('mapa.html.twig', [
            'menu' => $categories->getMenu(),
            'contact_form' => $form->createView()
        ]);
    }
}