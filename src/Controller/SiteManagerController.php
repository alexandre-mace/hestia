<?php

namespace App\Controller;

use App\Form\SiteManagerType;
use App\Handler\RegisterHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Site;

class SiteManagerController extends Controller
{
    /**
     * @Route("/sitemanager/dashboard", name="sitemanager_dashboard")
     */
    public function dashboard(EntityManagerInterface $manager)
    {
        $siteManager = $this->getUser();
        $sites = $manager->getRepository(Site::class)->findAllLimited($siteManager->getId());
        $labeledSites = $manager->getRepository(Site::class)->getLabeledSite($siteManager->getId());
        return $this->render('sitemanager/dashboard.html.twig', [
            'sites' => $sites,
            'siteManager' => $siteManager,
            'labeledSites' => $labeledSites
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, RegisterHandler $handler)
    {
        $form = $this->createForm(SiteManagerType::class)->handleRequest($request);
        if ($handler->handle($form)) {
            return $this->redirectToRoute('login');
        }
        return $this->render('registration/register.html.twig', ['form' => $form->createView()]);
    }
}
