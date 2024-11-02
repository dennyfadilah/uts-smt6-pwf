<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TransactionController extends BaseController
{
    public function index()
    {
        $page = $this->request->getVar('page') ?? 1;
        $limit = $this->request->getVar('limit') ?? 10;
        $search = $this->request->getVar('search');
        $role = session()->get('user')['role'];

        $data['limit'] = $limit;

        if ($search) {
            $data['search'] = $search;

            $data['transactions'] = $this->transactionModel
                ->select('transactions.*, users.full_name, products.product_name, products.product_code')
                ->join('users', 'users.id = transactions.user_id', 'left')
                ->join('products', 'products.id = transactions.product_id', 'left')
                ->like('product_name', $search)
                ->orLike('transaction_date', $search);
        } else {
            $data['transactions'] = $this->transactionModel
                ->select('transactions.*, users.full_name, products.product_name, products.product_code')
                ->join('users', 'users.id = transactions.user_id', 'left')
                ->join('products', 'products.id = transactions.product_id', 'left');
        }

        if ($role === 'admin') {
            $data['transactions'] = $data['transactions']->paginate($limit, 'default', $page);
        } elseif ($role === 'user') {
            $userId = session()->get('user')['id'];
            $data['transactions'] = $data['transactions']
                ->where('transactions.user_id', $userId)
                ->paginate($limit, 'default', $page);
        } else {
            $data['transactions'] = [];
        }

        $data['pager'] = $this->transactionModel->pager;
        $data['page'] = $page;
        $data['total_pages'] = $data['pager'] ? $data['pager']->getPageCount() : 0;

        return view('pages/transactions/index', $data);
    }

    public function create()
    {
        $products = $this->productModel->findAll();
        $data['products'] = $products;

        if ($this->request->is('post')) {
            $product_id = $this->request->getPost('product_id');

            // Cek produk
            $product = $this->productModel->find($product_id);

            // Jika produk tidak ditemukan
            if (!$product) {
                return redirect()->back()->with('errors', 'Product not found');
            }

            // Cek stok 
            if ($product['stock'] < $this->request->getPost('quantity')) {
                return redirect()->back()->with('errors', 'Stock not enough');
            }

            $data = [
                'user_id' => session()->get('user')['id'],
                'product_id' => $product_id,
                'quantity' => $this->request->getPost('quantity'),
                'unit_price' => $this->request->getPost('unit_price'),
                'discount_applied' => $this->request->getPost('discount_applied'),
                'transaction_date' => date('Y-m-d H:i:s'),
                'payment_method' => $this->request->getPost('payment_method'),
                'total_price' => $this->request->getPost('total_price'),
                'shipping_address' => $this->request->getPost('shipping_address'),
                'transaction_status' => 'pending',
                'notes' => $this->request->getPost('notes'),
            ];

            if ($this->transactionModel->insert($data)) {
                $this->productModel->update($product_id, ['stock' => $product['stock'] - $this->request->getPost('quantity')]);
                return redirect()->to('/transactions')->with('success', 'Transaction created successfully');
            } else {
                return redirect()->back()->with('errors', $this->transactionModel->errors());
            }
        }
        return view('pages/transactions/create', $data);
    }

    public function detail($id)
    {

        $data['transaction'] = $this->transactionModel
            ->select('transactions.*, users.full_name, products.product_name, products.category')
            ->join('users', 'users.id = transactions.user_id', 'left')
            ->join('products', 'products.id = transactions.product_id', 'left')
            ->where('transactions.id', $id)
            ->first();

        $category = [
            'BW' => 'Body Wash',
            'FW' => 'Face Wash',
            'HS' => 'Hand Soap',
            'DG' => 'Deterjen',
            'SG' => 'Softener',
        ];

        $quantity = $data['transaction']['quantity'];
        $unit_price = $data['transaction']['unit_price'];
        $data['count_price'] = $quantity * $unit_price;

        $data['category'] = $category[$data['transaction']['category']];
        return view('pages/transactions/detail', $data);
    }

    public function edit($id)
    {
        $data['products'] = $this->productModel->findAll();

        $data['transaction'] = $this->transactionModel
            ->select('transactions.*, users.full_name, products.product_name, products.category')
            ->join('users', 'users.id = transactions.user_id', 'left')
            ->join('products', 'products.id = transactions.product_id', 'left')
            ->where('transactions.id', $id)
            ->first();

        $quantity = $data['transaction']['quantity'];
        $unit_price = $data['transaction']['unit_price'];
        $data['count_price'] = $quantity * $unit_price;

        if ($this->request->is('post')) {
            $product_id = $this->request->getPost('product_id');

            // Cek produk
            $product = $this->productModel->find($product_id);

            // Cek quantity
            $new_quantity = $this->request->getPost('quantity');
            $old_quantity = $data['transaction']['quantity'];

            // Jika produk tidak ditemukan
            if (!$product) {
                return redirect()->back()->with('errors', 'Product not found');
            }

            // Selisih quantity
            $quantity_difference = $new_quantity - $old_quantity;

            // Cek stok
            if ($quantity_difference > 0) {
                // Jika jumlah baru lebih besar, periksa apakah stok cukup
                if ($product['stock'] < $quantity_difference) {
                    return redirect()->back()->with('errors', 'Stock not enough');
                }
            }

            // Update stok
            $new_stock = $product['stock'] - $quantity_difference;

            $data = [
                'user_id' => $this->request->getPost('user_id'),
                'product_id' => $this->request->getPost('product_id'),
                'quantity' => $new_quantity,
                'unit_price' => $this->request->getPost('unit_price'),
                'discount_applied' => $this->request->getPost('discount_applied'),
                'transaction_date' => date('Y-m-d H:i:s'),
                'payment_method' => $this->request->getPost('payment_method'),
                'total_price' => $this->request->getPost('total_price'),
                'shipping_address' => $this->request->getPost('shipping_address'),
                'transaction_status' => $this->request->getPost('transaction_status'),
                'notes' => $this->request->getPost('notes'),
            ];
            if ($this->transactionModel->update($id, $data)) {
                $this->productModel->update($product_id, ['stock' => $product['stock'] - $new_stock]);
                return redirect()->to('/transactions')->with('success', 'Transaction updated successfully');
            } else {
                return redirect()->back()->with('errors', $this->transactionModel->errors());
            }
        }

        return view('pages/transactions/edit', $data);
    }

    public function delete($id)
    {
        if ($this->transactionModel->delete($id)) {
            return redirect()->to('/transactions')->with('success', 'Transaction deleted successfully');
        } else {
            return redirect()->back()->with('errors', $this->transactionModel->errors());
        }
    }
}
