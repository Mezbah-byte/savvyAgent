<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\Basic\BasicModel;

class Product extends BaseController
{

    protected $userUnId;
    protected $isLoggedIn;

    public function __construct()
    {
        $session = session();
        $this->userUnId = $session->get('userUnId');
        $this->isLoggedIn = !empty($this->userUnId);

        if (!$this->checkLogin()) {
            redirect()->to(base_url());
        }
    }

    private function checkLogin()
    {
        if (!$this->isLoggedIn) {
            return false;
        }
        return true;
    }


    function globalData() {
        $basicModel = new BasicModel();

        $data = array();
        $data['agentData'] = $basicModel->agentDetails($this->userUnId);

        return $data;
    }




    public function index()
    {

        if (!$this->checkLogin()) {
            return redirect()->to(base_url());
        }

        $productModel = new ProductModel();
        $basicModel = new BasicModel();

        // Fetch all products
        $data['products'] = $productModel->getActiveProducts();
        $data['agentData'] = $basicModel->agentDetails($this->userUnId);

        // echo json_encode($data);

        return view('dashboard/product_list', $data);
    }


    
}
