<?php

namespace App\Controllers;

use App\Models\PlannerModel;
use CodeIgniter\CLI\Console;

class Planner extends BaseController
{
    protected $plannerModel;

    public function __construct()
    {
        $this->plannerModel = new PlannerModel();
    }

    public function getPlannerData()
    {
        $month = $this->request->getPost('month');
        $level = $this->request->getPost('level');
       
        $data = $this->plannerModel->getData($month, $level); // method from planner model...

        return $this->response->setJSON($data);
    }

    public function savePlannerData()
    {
        $id = $this->request->getPost('id');
        $data = [
            'date' => $this->request->getPost('date'),
            'content' => $this->request->getPost('content'),
            'level' => $this->request->getPost('level'),
            'month' => $this->request->getPost('month'),
            'createdate' => date('Y-m-d')
        ];

        if ($id) {
            $this->plannerModel->update($id, $data);
        } else {
            $this->plannerModel->insert($data);
        }

        return $this->response->setJSON(['status' => true, 'message' => 'Planner data saved successfully!']);
    }
    public function deletePlanner($id)
    {
        $deleted = $this->plannerModel->delete($id);
        echo json_encode(['status' => true, 'message' => $deleted]);
    }
    public function editPlanner($id)
    {
        $data = $this->plannerModel->find($id);
        echo json_encode($data);
    }
}
