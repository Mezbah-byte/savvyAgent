<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products'; // Table name
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = ['name', 'price', 'description'];

    public function getActiveProducts()
    {
        return $this->where('published', 1)->findAll();
    }
}
