<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 18/11/18
 * Time: 14:23
 */

namespace App\Handler;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomePageHandler
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function handle() {
        if ($this->session->has('on-boarding')) {
            return true;
        }
        return false;
    }
}