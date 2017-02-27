<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\contactType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // Renvoi les projets depuis la BDD
        $em = $this->getDoctrine()->getManager();
        $projets = $em->getRepository('AppBundle:Projets')->findAll();


        // Gestion du formulaire de contact
        $form = $this->createForm(contactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            // Récupération de toutes les données
            $data = $form->getData();

            $message = \Swift_Message::newInstance()
                ->setSubject('Vous avez reçu un message de ' . $data['email'])
                ->setFrom($data['email'])
                ->setTo('contact@monsupersite.com')
                ->setCharset('utf-8')

                // Version HTML
                ->setBody(
                    $this->renderView('public/email/contact.html.twig',
                        [
                            'data' => $data
                        ]), 'text/html')

                // Version texte
                ->addPart(
                    $this->renderView('public/email/contact.txt.twig',
                        [
                            'data' => $data
                        ]),
                    'text/plain'
                )
            ;
            $this->get("mailer")->send($message);

            //Redirection : Préciser le nom de la route dans la méthode 'redirectToRoute
            return $this->redirectToRoute('homepage');

        }

        return $this->render('public/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            "projets" => $projets,
            'form' => $form->createView()
        ]);
    }

}
