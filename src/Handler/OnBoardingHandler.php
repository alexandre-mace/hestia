<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18/11/18
 * Time: 14:26
 */

namespace App\Handler;


use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OnBoardingHandler
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function handle() {
        $this->session->set('on-boarding', true);
        return true;
    }
}