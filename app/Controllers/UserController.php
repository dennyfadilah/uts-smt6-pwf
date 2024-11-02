<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        if (session()->get('user')['role'] != 'admin') {
            return redirect()->to('/')->with('errors', 'You are not allowed to access this page');
        }

        $page = $this->request->getVar('page') ?? 1;
        $limit = $this->request->getVar('limit') ?? 10;
        $search = $this->request->getVar('search');

        if ($search) {
            $data['search'] = $search;

            $data['users'] = $this->userModel
                ->like('full_name', $search)
                ->orLike('phone_number', $search)
                ->orLike('email', $search)
                ->orLike('role', $search)
                ->paginate($limit, 'default', $page);
        } else {
            $data['users'] = $this->userModel->paginate($limit, 'default', $page);
        }

        $data['limit'] = $limit;
        $data['pager'] = $this->userModel->pager;
        $data['page'] = $page;
        $data['total_pages'] = $data['pager']->getPageCount();

        return view("pages/users/index", $data);
    }

    public function detail($id)
    {

        $data['user'] = $this->userModel->find($id);
        return view("pages/users/detail", $data);
    }


    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);

        if ($this->request->is('post')) {
            $inputImage = $this->request->getFile('profile_picture_url');
            $currentImage = $data['user']['profile_picture_url'];
            $newName = null;

            // Input Profile Picture
            if ($inputImage && $inputImage->isValid()) {
                if ($currentImage && file_exists('uploads/profiles/' . $currentImage)) {
                    unlink('uploads/profiles/' . $currentImage);
                }

                $newName = $inputImage->getRandomName();
                $data['profile_picture_url'] = $newName;
            }

            // Input Username
            $inputUsername = $this->request->getPost('username');
            if ($data['user']['username'] != $inputUsername) {
                $data['username'] = $inputUsername;
            }

            // Input Email
            $inputEmail = $this->request->getPost('email');
            if ($data['user']['email'] !== $inputEmail) {
                $data['email'] = $inputEmail;
            }

            // Input Password
            $inputPassword = $this->request->getPost('password_hash');
            if (!empty($inputPassword)) {
                $data['password_hash'] = $inputPassword;
            }

            $data['full_name'] = $this->request->getPost('full_name');
            $data['phone_number'] = $this->request->getPost('phone_number');
            $data['address'] = $this->request->getPost('address');
            $data['birthdate'] = $this->request->getPost('birthdate');
            $data['gender'] = $this->request->getPost('gender');
            $data['role'] = $this->request->getPost('role');
            $data['status'] = $this->request->getPost('status');


            if ($this->userModel->update($id, $data)) {
                if ($newName) {
                    $inputImage->move('uploads/profiles', $newName);
                    $user = session()->get('user');
                    $user['profile_picture_url'] = $newName;
                    session()->set('user', $user);
                }
                return redirect()->to('users/detail/' . $id)->with('success', 'User updated successfully');
            } else {
                return redirect()->back()->with('errors', $this->userModel->errors());
            }
        }
        return view('pages/users/edit', $data);
    }

    public function delete($id)
    {
        if (session()->get('user')['role'] != 'admin') {
            return redirect()->to('/')->with('errors', 'You are not allowed to access this page');
        }

        $currentImage = $this->userModel->find($id)['profile_picture_url'] ?? null;
        if ($currentImage && file_exists('uploads/profiles/' . $currentImage)) {
            unlink('uploads/profiles/' . $currentImage);
        }

        if ($this->userModel->delete($id)) {
            return redirect()->to('/users')->with('success', 'User deleted successfully');
        } else {
            return redirect()->back()->with('errors', $this->userModel->errors());
        }
    }

    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        if ($this->request->is('post')) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password_hash');
            $user = $this->userModel->where('email', $email)->first();
            if ($user) {
                if (password_verify($password, $user['password_hash'])) {
                    session()->set(['user' => $user, 'isLoggedIn' => true]);
                    return redirect()->to('/');
                }
            }
            return redirect()->back()->with('errors', ['Email atau password salah']);
        }
        return view('pages/auth/login');
    }

    public function register()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/');
        }

        if ($this->request->is('post')) {
            $inputImage = $this->request->getFile('profile_picture_url');
            $newName = null;

            // Input Profile Picture
            if ($inputImage && $inputImage->isValid()) {
                $newName = $inputImage->getRandomName();
                $data['profile_picture_url'] = $newName;
            }

            $data['username'] = $this->request->getPost('username');
            $data['full_name'] = $this->request->getPost('full_name');
            $data['email'] = $this->request->getPost('email');
            $data['password_hash'] = $this->request->getPost('password_hash');
            $data['phone_number'] = $this->request->getPost('phone_number');
            $data['address'] = $this->request->getPost('address');
            $data['birthdate'] = $this->request->getPost('birthdate');
            $data['gender'] = $this->request->getPost('gender');

            if ($this->userModel->insert($data)) {
                if ($newName) {
                    $inputImage->move('uploads/profiles', $newName);
                }
                return redirect()->to('/login')->with('success', 'User created successfully');
            } else {
                return redirect()->back()->with('errors', $this->userModel->errors());
            }
        }
        return view('pages/auth/register');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
