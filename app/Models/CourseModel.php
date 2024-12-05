<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'course'; // Table name
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = ['name', 'price', 'description'];

    public function getActiveCourse()
    {
        return $this->where('status', 1)->findAll();
    }

    public function getOrderListByType($type)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user_courses');
        //$this->where('status',1);
        return $builder->get()->getResultArray();
    }


    public function getCourseDetails($unId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('course');
        $this->where('un_id',$unId);
        return $builder->get()->getRowArray();
    }


    public function getAgentGatewayDetails($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('agent_payment_gateway');
        $this->where('un_id',$id);
        return $builder->get()->getRowArray();
    }
}
