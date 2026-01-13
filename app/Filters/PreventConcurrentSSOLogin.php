<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PreventConcurrentSSOLogin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // if (!$session->has('sso_user_id')) {
        //     return redirect()->to('/');
        // }

        $userId = $session->get('sso_user_id');
        $currentSessionId = session_id();
        $cachedSessionId = cache('active_session_' . $userId);

        if ($cachedSessionId && $cachedSessionId !== $currentSessionId) {
            // Someone else logged in with the same account
            $session->destroy();
            return redirect()->to('/')->with('error', 'You have been logged out because your account was used elsewhere.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing needed here
    }
}
