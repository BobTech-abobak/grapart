<?php
namespace App\Controller;

use App\Entity\Mail;
use App\Entity\Menu;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    const DIRECTORY_NAME = "static_sites";

    public function index()
    {
        $menu = new Menu();

        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail, ['action' => $this->generateUrl('send_mail')]);

        return $this->render('index.html.twig', [
            'menu' => $menu->getMenu(),
            'contact_form' => $form->createView()
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

        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail, ['action' => $this->generateUrl('send_mail')]);


        return $this->render(self::DIRECTORY_NAME . DIRECTORY_SEPARATOR . $category['file'], [
            'menu' => $menu->getMenu(),
            'category' => $category,
            'contact_form' => $form->createView()
        ]);
    }

    public function contact()
    {
        $menu = new Menu();

        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail, ['action' => $this->generateUrl('send_mail')]);


        return $this->render('kontakt.html.twig', [
            'menu' => $menu->getMenu(),
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
        $menu = new Menu();

        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail);


        return $this->render('mapa.html.twig', [
            'menu' => $menu->getMenu(),
            'contact_form' => $form->createView()
        ]);
    }
}