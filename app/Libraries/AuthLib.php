<?php

namespace App\Libraries;

class AuthLib
{
    private $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function ssoCheck(): bool
    {
        $user_session = $this->session->get(SSO_SESSION);

        if (! empty($user_session) && isset($user_session["sso_id"])) {
            return true;
        }

        return false;
    }
}