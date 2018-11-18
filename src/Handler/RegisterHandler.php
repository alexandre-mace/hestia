<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18/11/18
 * Time: 10:31
 */

namespace App\Handler;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class RegisterHandler
{
    private $manager;
    private $flashBag;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flashBag)
    {
        $this->manager = $manager;
        $this->flashBag = $flashBag;
    }

    public function handle(FormInterface $form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($form->getData());
            $this->manager->flush();
            return true;
        }

        return false;
    }
}