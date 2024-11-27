<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    private $userModel = null;
    private $homePage  = "";

    public function __construct()
    {
        $this->userModel = model(UserModel::class);
        $this->homePage  = base_url().'user';
    }

    //Login
    public function login()
    {
        $post = $this->request->getPost();
        if ($post) {
            $rules = [
                'email'  => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email',
                ],
                'password'  => [
                    'label'  => 'Password',
                    'rules'  => 'required|max_length[45]|min_length[2]',
                ]
            ];

            if ($this->validateData($post, $rules)) {
                $user = $this->userModel->checkLogin($post);
                if ($user) {
                    if (password_verify($post["password"], $user->password)) {
                        $sessionData = [
                            "isLoggedIn" => true,
                            "userId"     => $user->ID,
                            "userName"   => $user->name,
                            "userEmail"  => $user->email,
                            "userRoleId"   => $user->role_id,
                            "userRoleName"   => $user->role_name,
                        ];
                        $this->session->set($sessionData);
                        $r = $this->userModel->login($this->session->userId);
                        if($r)
                        {
                            return $this->response->setJSON(['status' => true, 'redirect' => $this->homePage]);
                        }
                    }
                }
                return $this->response->setJSON(['status' => false, 'message' => 'Invalid username or password! Please try again.']);
            } else {
                return $this->response->setJSON(['status' => false, 'errors' => $this->validator->getErrors()]);
            }
        }
        return view('login');
    }

    public function logout()
    {
        //Destroy the session
        $this->session->destroy();
        //Update user login details
        //$this->updateUserLoginInfo("logout");
        $this->userModel->logout($this->session->userId);
        return redirect()->to('/');
    }

    //Forget Password
    public function forget()
    {
        return view('forget');
    }
}
