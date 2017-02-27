<?php

namespace AppBundle\Controller;

use AppBundle\Form\projectType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Projets;

class ProjectController extends Controller
{

    /**
     * @Route("/admin/projet", name="admin.project")
     */
    public function projectAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $projets = $em->getRepository('AppBundle:Projets')->findAll();

        return $this->render('admin/project/index.html.twig', [
            'projets' => $projets,
        ]);
    }

    /**
     * @Route("/admin/projet/{id}", name="admin.project.show", requirements={"id" = "\d+"})
     */
    public function projectShowAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $projet = $em->getRepository('AppBundle:Projets')->find($id);


        return $this->render('admin/project/show.html.twig', [
            'projet' => $projet,
        ]);
    }


    /**
     * @Route("/admin/projet/add", name="admin.project.add")
     */
    public function addProjectAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $projet = new Projets();

        $projet->setNom('My Blog');
        $projet->setCategorie('Site démo');
        $projet->setDescription('Blog interactif avec commentaire en HTML5 / CSS3');
        $projet->setImage('myblog.png');
        $projet->setContent('hello');
        $projet->setLogoSm('hello.png');

        $em->persist($projet);
        $em->flush();


        return $this->render('admin/project/add.html.twig');
    }


    /**
     * @Route("/admin/projet/edit/{id}", name="admin.project.edit", requirements={"id" = "\d+"})
     */

    public function editProjectAction($id, Request $request)
    {
        // Récupération des projets par $id
        $em = $this->getDoctrine()->getManager();
        $projet = $em->getRepository('AppBundle:Projets')->find($id);

        // Création du formulaire d'édition
        $form = $this->createForm(projectType::class, $projet);

        // Liaison reqête ($_POST) au formulaire d'édition
        $form = $form->handleRequest($request);

        // Je valide mon formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            // La ligne ci-dessous n'est pas obligatoire car doctrine est au courant de l'existance de $product

            $form = $form->getData();

            $em->flush();

            return $this->redirectToRoute('admin.project');
        }

        return $this->render('admin/project/edit.html.twig', [
            'form' => $form->createView(),
            'projet' => $projet,
        ]);
    }
}
