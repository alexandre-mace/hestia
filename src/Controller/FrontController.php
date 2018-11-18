<?php

namespace App\Controller;

use App\Handler\HomePageHandler;
use App\Handler\OnBoardingHandler;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Site;

class FrontController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function home(EntityManagerInterface $manager, HomePageHandler $handler)
    {
        if ($handler->handle()) {
            $bestSites = $manager->getRepository(Site::class)->findBestSites();
            return $this->render('homepage.html.twig', [
                'bestSites' => $bestSites
            ]);
        }
        return $this->redirectToRoute('on-boarding');

    }

    /**
     * @Route("/on-boarding", name="on-boarding")
     */
    public function onBoarding(EntityManagerInterface $manager, OnBoardingHandler $handler)
    {
        $handler->handle();
        return $this->render('on-boarding.html.twig');
    }
}
