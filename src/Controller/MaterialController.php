<?php

namespace App\Controller;

use App\Entity\Material;
use App\Form\MaterialType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Handler\MaterialAddHandler;
use App\Handler\MaterialUpdateHandler;
use App\Handler\MaterialDeleteHandler;
use App\Handler\ToggleMaterialHandler;

class MaterialController extends Controller
{
    /**
     * @Route("/materials", name="material_list")
     */
    public function list()
    {
        return $this->render('material/site_list.html.twig', ['materials' => $this->getDoctrine()->getRepository(Material::class)->findAll()]);
    }

    /**
     * @Route("/material/add", name="material_add")
     */
    public function add(Request $request, MaterialAddHandler $handler)
    {
        $form = $this->createForm(MaterialType::class)->handleRequest($request);
        if ($handler->handle($form)) {
            return $this->redirectToRoute('material_list');
        }
        return $this->render('material/site_add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/material/{slug}/update", name="material_update")
     */
    public function update(Material $material, Request $request, MaterialUpdateHandler $handler)
    {
        $form = $this->createForm(MaterialType::class, $material)->handleRequest($request);
        if ($handler->handle($form)) {
            return $this->redirectToRoute('material_list');
        }
        return $this->render('material/site_update.html.twig', [
            'form' => $form->createView(),
            'material' => $material,
        ]);
    }
}
