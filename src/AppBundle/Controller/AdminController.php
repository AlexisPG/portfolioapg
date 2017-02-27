<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{

    /**
     * @Route("/admin/homepage", name="admin.homepage")
     */
    public function adminAction(Request $request)
    {
        return $this->render('admin/main/index.html.twig');
    }

}