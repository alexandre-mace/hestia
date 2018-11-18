<?php

namespace App\Handler;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class SiteAddHandler
{
    private $manager;
    private $flashBag;
    private $session;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flashBag, SessionInterface $session)
    {
        $this->manager = $manager;
        $this->flashBag = $flashBag;
        $this->session = $session;
    }

    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData()->setType($this->session->get('site_type')['choice']);
            $this->manager->persist($form->getData());
            $this->manager->flush();
            return [
                'slug' => $form->getData()->getSlug(),
                'status' => true
            ];
        }

        return [
            'status' => false
        ];
    }
}