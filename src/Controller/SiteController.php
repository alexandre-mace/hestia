<?php

namespace App\Controller;

use App\Entity\Site;
use App\Form\SiteGeneralInformationType;
use App\Form\SiteInfrastructureType;
use App\Form\SiteMaterialsType;
use App\Form\SiteType;
use App\Form\SiteTypeType;
use App\Handler\SiteChooseTypeHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Handler\SiteAddHandler;
use App\Handler\SiteUpdateHandler;
use App\Handler\SiteDeleteHandler;

class SiteController extends Controller
{
    /**
     * @Route("/sites", name="site_list")
     */
    public function list()
    {
        return $this->render('site/site_list.html.twig', ['sites' => $this->getDoctrine()->getRepository(Site::class)->findAll()]);
    }

    /**
     * @Route("/site/show/{slug}", name="site_show")
     */
    public function show(Site $site)
    {
        return $this->render('site/site.html.twig', ['site' => $site]);
    }

    /**
     * @Route("/site/choose-type", name="site_choose_type")
     */
    public function chooseType(Request $request, SiteChooseTypeHandler $handler)
    {
        $form = $this->createForm(SiteTypeType::class)->handleRequest($request);
        if ($handler->handle($form)) {
            return $this->redirectToRoute('site_add_general_information');
        }
        return $this->render('site/choose_type.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/site/add-general-information", name="site_add_general_information")
     */
    public function addGeneralInformation(Request $request, SiteAddHandler $handler)
    {
        $form = $this->createForm(SiteGeneralInformationType::class)->handleRequest($request);
        $payload = $handler->handle($form);
        if ($payload['status']) {
            return $this->redirectToRoute('site_add_materials', ['slug' => $payload['slug']]);
        }
        return $this->render('site/add_general_information.html.twig', ['form' => $form->createView()]);
    }


    // NOT DONE
    /**
     * @Route("/site/{slug}/add-infrastructure", name="site_add_infrastructure")
     */
    public function addInfrastructure(SiteUpdateHandler $handler, Site $site)
    {
        return $this->render('site/add_infrastructure.html.twig', ['site' => $site]);
    }

    /**
     * @Route("/site/{slug}/add-materials", name="site_add_materials")
     */
    public function addMaterials(Request $request, SiteUpdateHandler $handler, Site $site)
    {
        $form = $this->createForm(SiteMaterialsType::class, $site)->handleRequest($request);
        if ($handler->handle($form)) {
            return $this->redirectToRoute('site_valorisation_center', ['slug' => $site->getSlug()]);
        }
        return $this->render('site/add_materials.html.twig', ['form' => $form->createView()]);
    }

    // NOT DONE
    /**
     * @Route("/site/{slug}/valorisation_center", name="site_valorisation_center")
     */
    public function valorisationCenter(EntityManagerInterface $manager, Request $request, SiteUpdateHandler $handler, Site $site)
    {
        return $this->render('site/valorisation_center.html.twig', ['site' => $site]);
    }

    public function update(Site $site, Request $request, SiteUpdateHandler $handler)
    {
        $form = $this->createForm(SiteType::class, $site)->handleRequest($request);
        if ($handler->handle($form)) {
            return $this->redirectToRoute('site_list');
        }
        return $this->render('site/site_update.html.twig', [
            'form' => $form->createView(),
            'site' => $site,
        ]);
    }

    /**
     * @Route("/site/{slug}/delete", name="site_delete")
     */
    public function delete(Site $site, SiteDeleteHandler $handler)
    {
        $handler->handle($site);
        return $this->redirectToRoute('site_list');
    }
}
