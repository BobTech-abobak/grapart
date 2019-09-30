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
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = new CategoriesRepository();
        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail, ['action' => $this->generateUrl('send_mail'), 'url' => $request->getUri()]);

        return $this->render('index.html.twig', [
            'menu' => $categories->getMenu(),
            'contact_form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param $url
     * @return Response
     */
    public function category(Request $request, $url)
    {
        $categories = new CategoriesRepository();
        $category = $categories->findByUrl($url);
        $realizations = new RealizationRepository();
        $staticSites = new StaticSitesRepository();
        $staticSite = $staticSites->find($category->getTemplate());

        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail, ['action' => $this->generateUrl('send_mail'), 'url' => $request->getUri()]);

        return $this->render('oferta.html.twig', [
            'menu' => $categories->getMenu(),
            'category' => $category,
            'static_content' => $staticSite->getContent(),
            'realizations' => $realizations->findByUrl($url),
            'contact_form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function contact(Request $request)
    {
        $categories = new CategoriesRepository();

        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail, ['action' => $this->generateUrl('send_mail'), 'url' => $request->getUri()]);


        return $this->render('kontakt.html.twig', [
            'menu' => $categories->getMenu(),
            'contact_form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function mail(Request $request, \Swift_Mailer $mailer)
    {
        $mail = new Mail();
        $form = $this->createForm(ContactFormType::class, $mail, ['action' => $this->generateUrl('send_mail'), 'url' => $request->headers->get('referer')]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Mail $task */
            $task = $form->getData();
            $title = 'Formularz kontaktowy grapart.pl - ' . $task->getDate()->format('Y-m-d H:i:s');
            $message = (new \Swift_Message($title))
                ->setFrom('webmaster@grapart.pl')
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',
                        ['mail' => $task]
                    ),
                    'text/html'
                )
            ;
            if (!$mailer->send($message, $failures))
            {
                $this->addFlash('danger', 'Wystąpił błąd podczas wysyłania maila.');
            } else {
                $this->addFlash('success', 'Wiadomość kontaktowa została wysłana. Skontaktujemy się z Państwem!');
            }
        }
        return $this->redirect($request->headers->get('referer'));
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