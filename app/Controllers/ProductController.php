<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    public function index()
    {
        $page = $this->request->getVar('page') ?? 1;
        $limit = $this->request->getVar('limit') ?? 10;
        $search = $this->request->getVar('search');
        $data['limit'] = $limit;

        if ($search) {
            $data['search'] = $search;

            $data['products'] = $this->productModel
                ->like('product_name', $search)
                ->orLike('product_code', $search)
                ->orLike('category', $search)
                ->orLike('supplier_name', $search)
                ->paginate($limit, 'default', $page);
        } else {
            $data['products'] = $this->productModel->paginate($limit, 'default', $page);
        }

        $data['pager'] = $this->productModel->pager;
        $data['page'] = $page;
        $data['total_pages'] = $data['pager']->getPageCount();

        return view('pages/products/index', $data);
    }

    public function detail($id)
    {
        $data['product'] = $this->productModel->find($id);

        $category = [
            'BW' => 'Body Wash',
            'FW' => 'Face Wash',
            'HS' => 'Hand Soap',
            'DG' => 'Deterjen',
            'SG' => 'Softener',
        ];

        $data['category'] = $category[$data['product']['category']];
        return view('pages/products/detail', $data);
    }

    public function create()
    {

        if (session()->get('user')['role'] != 'admin') {
            return redirect()->to('/products')->with('errors', 'You are not allowed to access this page');
        }

        if ($this->request->is('post')) {
            $imageFile = $this->request->getFile('image_url');

            // cek validasi input file
            if (!$imageFile->isValid()) {
                return redirect()->back()->with('errors', $imageFile->getError());
            }

            $imageName = $imageFile->getRandomName();

            $category = $this->request->getPost('category');
            do {
                $code = $category . '-' . random_int(10000, 99999);
                $cekCode = $this->productModel->where('product_code', $code)->first();
            } while ($cekCode);

            $data = [
                'product_code' => $code,
                'product_name' => $this->request->getPost('product_name'),
                'category' => $category,
                'supplier_name' => $this->request->getPost('supplier_name'),
                'stock' => $this->request->getPost('stock'),
                'unit_price' => $this->request->getPost('unit_price'),
                'discount_percentage' => $this->request->getPost('discount_percentage'),
                'description' => $this->request->getPost('description'),
                'image_url' => $imageName,
            ];

            if ($this->productModel->insert($data)) {
                $imageFile->move('uploads/products/', $imageName);
                return redirect()->to('/products')->with('success', 'Product created successfully');
            } else {
                return redirect()->back()->with('errors', $this->productModel->errors());
            }
        }
        return view('pages/products/create');
    }

    public function edit($id)
    {
        if (session()->get('user')['role'] != 'admin') {
            return redirect()->to('/products')->with('errors', 'You are not allowed to access this page');
        }

        $data['product'] = $this->productModel->find($id);

        if ($this->request->is('post')) {
            $imageFile = $this->request->getFile('image_url');
            $currentImage = $data['product']['image_url'];
            $newName = null;

            // Input Image
            if ($imageFile && $imageFile->isValid()) {
                if ($currentImage && file_exists('uploads/products/' . $currentImage)) {
                    unlink('uploads/products/' . $currentImage);
                }

                $newName = $imageFile->getRandomName();
                $data['image_url'] = $newName;
            }

            $data['product_name'] = $this->request->getPost('product_name');
            $data['category']  = $this->request->getPost('category');
            $data['supplier_name'] = $this->request->getPost('supplier_name');
            $data['stock'] = $this->request->getPost('stock');
            $data['unit_price'] = $this->request->getPost('unit_price');
            $data['discount_percentage'] = $this->request->getPost('discount_percentage');
            $data['description'] = $this->request->getPost('description');

            if ($this->productModel->update($id, $data)) {
                if ($newName) {
                    $imageFile->move('uploads/products/', $newName);
                }
                return redirect()->to('/products/detail/' . $id)->with('success', 'Product created successfully');
            } else {
                return redirect()->back()->with('errors', $this->productModel->errors());
            }
        }
        return view('pages/products/edit', $data);
    }

    public function delete($id)
    {
        if (session()->get('user')['role'] != 'admin') {
            return redirect()->to('/products')->with('errors', 'You are not allowed to access this page');
        }

        $product = $this->productModel->find($id);
        $currentImage = $product['image_url'];

        if ($currentImage && file_exists('uploads/products/' . $currentImage)) {
            unlink('uploads/products/' . $currentImage);
        }

        if ($this->productModel->delete($id)) {
            return redirect()->to('/products')->with('success', 'Product deleted successfully');
        } else {
            return redirect()->back()->with('errors', $this->productModel->errors());
        }
    }
}