<?php

namespace App\Controllers;
use App\Models\Basic\BasicModel;

class Home extends BaseController
{
    protected $userUnId;
    protected $isLoggedIn;

    public function __construct()
    {
        $session = session();
        $this->userUnId = $session->get('userUnId');
        $this->isLoggedIn = !empty($this->userUnId);
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
        return $this->home();
    }

    public function home()
    {
        if (!$this->checkLogin()) {
            return redirect()->to(base_url());
        }

        $data = $this->globalData();

        return view('dashboard/home', $data);

        // echo "Logged in: " . ($this->isLoggedIn ? 'Yes' : 'No') . "<br>";
        // echo "Logged in user un_id: " . $this->userUnId;
    }

    public function anotherMethod()
    {
        if (!$this->checkLogin()) {
            return redirect()->to(base_url());
        }

        echo "This is another method. User un_id: " . $this->userUnId;
    }
}
