<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    public function index()
    {
        $role = session()->get('user')['role'];

        if ($role == 'admin') {
            $data['transaksiPerbulan'] = $this->transactionModel->select('count(id) as total')->where('MONTH(transaction_date)', date('m'))->first();

            $data['totalTransaksi'] = $this->transactionModel->select('count(id) as total')->first();

            $data['transaksiSelesai'] = $this->transactionModel->select('count(id) as total')->where('transaction_status', 'completed')->first();
        } else {
            $data['transaksiPerbulan'] = $this->transactionModel->select('count(id) as total')->where('MONTH(transaction_date)', date('m'))->where('user_id', session()->get('user')['id'])->first();

            $data['totalTransaksi'] = $this->transactionModel->select('count(id) as total')->where('user_id', session()->get('user')['id'])->first();

            $data['transaksiSelesai'] = $this->transactionModel->select('count(id) as total')->where('transaction_status', 'completed')->where('user_id', session()->get('user')['id'])->first();
        }
        return view('pages/home', $data);
    }
}
