<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/11/18
 * Time: 12:13
 */

namespace App\Handler;


use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SiteChooseTypeHandler
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function handle($form) {
        if ($form->isSubmitted() && $form->isValid()) {
            $this->session->set('site_type', $form->getData('data'));
            return true;
        }
        return false;

    }
}