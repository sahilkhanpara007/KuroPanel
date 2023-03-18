<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if ($session->userid and $session->time_login) {
            $userModel = new UserModel();
            $user = $userModel->getUser($session->userid);
            if ($user) {
                if ($user->level != 1) {
                    return redirect()->to('dashboard')->with('msgWarning', "Access Denied!");
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
