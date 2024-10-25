<?php

namespace App\Models\Auth;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'agent';
	protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password'];

    public function can_login($email, $password)
    {
        $query = $this->where('email', $email)
                      ->where('password', $password)
                      ->first();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }
}
