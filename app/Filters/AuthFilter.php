<?php

namespace App\Filters;

use App\Libraries\AuthLib;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = new AuthLib();
        if (! $auth->ssoCheck()) {
            return redirect()->to('/')->with('error', 'Session expired! Please login in order to access the page.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}