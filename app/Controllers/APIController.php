<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class APIController extends BaseController
{
    public function getProductsByCategory($category)
    {
        $products = $this->productModel->where('category', $category)->findAll();
        return $this->response->setJSON($products);
    }

    public function getUnitPrice($product_id)
    {
        $product = $this->productModel->find($product_id);
        return $this->response->setJSON($product['unit_price']);
    }
}
