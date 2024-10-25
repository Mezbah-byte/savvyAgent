<?php

namespace App\Models\Basic;

use CodeIgniter\Model;

class BasicModel extends Model
{
    protected $table = 'agent';
	protected $primaryKey = 'id';
    protected $allowedFields = ['un_id'];

    public function agentDetails($unId)
    {
        $query = $this->where('un_id', $unId)
                      ->first();
        if ($query) {
            return $query;
        } else {
            return false;
        }
    }
}
