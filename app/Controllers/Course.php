<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\Basic\BasicModel;

class Course extends BaseController
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




    function courseList()
    {

        if (!$this->checkLogin()) {
            return redirect()->to(base_url());
        }

        $productModel = new CourseModel();
        $basicModel = new BasicModel();

        // Fetch all products
        $data['courses'] = $productModel->getActiveCourse();
        $data['agentData'] = $basicModel->agentDetails($this->userUnId);

        // echo json_encode($data);

        return view('dashboard/course_list', $data);
    }


    function orderList($type) {
        if (!$this->checkLogin()) {
            return redirect()->to(base_url());
        }

        $productModel = new CourseModel();
        $basicModel = new BasicModel();

        $courseRowData = $productModel->getOrderListByType(1);

        $finalArray = array();

        foreach($courseRowData as $course){
            // echo json_encode($course['user_un_id']);
            $singleArray = array();
            $userData = $basicModel->getUserDetails($course['user_un_id']);
            $courseDetails = $productModel->getCourseDetails($course['course_id']);
            $getAgentGatewayDetails = $productModel->getAgentGatewayDetails($course['gateway_id']);

            // echo json_encode($userData);

            $singleArray['name']=$userData['first_name'];
            $singleArray['username']=$userData['username'];
            $singleArray['email']=$userData['email'];
            $singleArray['phoneNumber']=$userData['phone_number'];
            $singleArray['userImg']=$userData['img'] == ""?'https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg':$userData['img'];

            $singleArray['courseName']=$courseDetails['title'];
            $singleArray['paymentMethod']=$getAgentGatewayDetails['name'];
            $singleArray['paymentMethodIcon']=$getAgentGatewayDetails['image'];
            $singleArray['trx']=$course['trx'];
            $singleArray['ss']='https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg';

            array_push($finalArray, $singleArray);
        }

        $data['datas'] = $finalArray;
        $data['agentData'] = $basicModel->agentDetails($this->userUnId);

        // echo json_encode($data);

        return view('dashboard/order_list', $data);
    }


    
}
