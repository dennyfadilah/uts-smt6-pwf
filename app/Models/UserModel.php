<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'password_hash',
        'email',
        'full_name',
        'phone_number',
        'address',
        'birthdate',
        'gender',
        'profile_picture_url',
        'role',
        'status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'username' => 'required|is_unique[users.username]',
        'password_hash' => 'required',
        'email' => 'required|is_unique[users.email]|valid_email',
        'full_name' => 'required',
        'phone_number' => 'required',
        'address' => 'required',
        'birthdate' => 'required',
        'gender' => 'required',
        'profile_picture_url' => 'permit_empty|max_size[profile_picture_url,1024]|is_image[profile_picture_url]|mime_in[profile_picture_url,image/jpg,image/jpeg,image/gif,image/png]',
    ];
    protected $validationMessages   = [
        'username' => [
            'required' => 'Username harus diisi.',
            'is_unique' => 'Username sudah terdaftar.'
        ],
        'password_hash' => [
            'required' => 'Password harus diisi.',
        ],
        'email' => [
            'required' => 'Email harus diisi.',
            'is_unique' => 'Email sudah terdaftar.',
            'valid_email' => 'Email tidak valid.'
        ],
        'full_name' => [
            'required' => 'Nama lengkap harus diisi.',
        ],
        'phone_number' => [
            'required' => 'Nomor telepon harus diisi.',
        ],
        'address' => [
            'required' => 'Alamat harus diisi.',
        ],
        'birthdate' => [
            'required' => 'Tgl. lahir harus diisi.',
        ],
        'gender' => [
            'required' => 'Jenis kelamin harus diisi.',
        ],
        'profile_picture_url' => [
            'max_size' => 'Ukuran gambar terlalu besar.',
            'is_image' => 'Yang anda pilih bukan gambar.',
            'mime_in' => 'Yang anda pilih bukan gambar.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['hashPassword'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function hashPassword(array $data)
    {
        if (isset($data['data']['password_hash'])) {
            $data['data']['password_hash'] = password_hash($data['data']['password_hash'], PASSWORD_BCRYPT);
        }
        return $data;
    }
}
