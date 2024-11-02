<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table            = 'transactions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'product_id',
        'quantity',
        'unit_price',
        'discount_applied',
        'transaction_date',
        'payment_method',
        'total_price',
        'shipping_address',
        'transaction_status',
        'notes',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'user_id' => 'required',
        'product_id' => 'required',
        'quantity' => 'required',
        'unit_price' => 'required',
        'discount_applied' => 'required',
        'transaction_date' => 'required',
        'payment_method' => 'required',
        'total_price' => 'required',
        'shipping_address' => 'required',
        'transaction_status' => 'required',
        'notes' => 'required',

    ];
    protected $validationMessages   = [

        'product_id' => [
            'required' => 'Tambahkan produk terlebih dahulu!',
        ],
        'quantity' => [
            'required' => 'Masukkan quantity',
        ],
        'unit_price' => [
            'required' => 'Unit price is required',
        ],
        'discount_applied' => [
            'required' => 'Discount applied is required',
        ],
        'transaction_date' => [
            'required' => 'Transaction date is required',
        ],
        'payment_method' => [
            'required' => 'Payment method is required',
        ],
        'total_price' => [
            'required' => 'Total price is required',
        ],
        'shipping_address' => [
            'required' => 'Shipping address is required',
        ],
        'transaction_status' => [
            'required' => 'Transaction status is required',
        ],
        'notes' => [
            'required' => 'Notes is required',
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
