<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Exceptions\HTTPException;

class SingleSignOn extends BaseController
{
    private $session;
    private $service_id;
    private $secret_key;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->service_id = env('sso.hp.service_id', 0);
        $this->secret_key = env('sso.hp.secret_key', '');
    }

    public function testLogin()
    {
        $view = \Config\Services::renderer();
        return $view->renderString('<a href="' . env('sso.hp.login_url', '') . '?service_id=' . $this->service_id . '" target="_blank">Login</a>');
    }

    public function ssoSuccess()
    {
        if ($this->request->getMethod() == 'get') {
            try {
                $token = $this->request->getGet('token');

                $client = \Config\Services::curlrequest();

                $body = [
                    'token' => $token,
                    'secret_key' => $this->secret_key,
                    'service_id' => $this->service_id,
                ];

                $response = $client->request('POST',  env('sso.hp.validate_token_url', ''), [
                    'allow_redirects' => false,
                    'form_params' => $body,
                ]);

                $result = json_decode($response->getBody(), true);

                $ssoData = (array) $result;
                $userIdentifier = $ssoData['sso_id'];

                // Generate a unique session ID for this login
                $currentSessionId = session_id();

                // $this->session->regenerate(true);
                $this->session->set(SSO_SESSION, $ssoData);
                $this->session->set('sso_user_id', $userIdentifier);

                // Save active session ID in cache for this user
                cache()->save('active_session_' . $userIdentifier, $currentSessionId, 3600 * 8);

                return redirect()->to('/');
            } catch (HTTPException $e) {
                return redirect()->to('/')->with('error', $e->getMessage());
            }
        }
    }

    public function ssoLogout()
    {
        // Do something related to SSO logout. No details found in the documentation.
    }
}
