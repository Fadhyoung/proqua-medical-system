<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PatientModel;

class PatientController extends BaseController
{
    public function index()
    {
        return view('layouts/main', [
            'title' => 'Patient Management',
            'content' => 'patients/index',
        ]);
    }

    public function list()
    {
        $model = new PatientModel();
        $search = $this->request->getGet('search');

        if ($search) {
            $data = $model->select('patients.*, pcps.PCP_Name, pcps.PCP_Specialty')
                     ->join('pcps', 'pcps.PCP_ID = patients.PCP_ID')
                     ->like('Pat_Name', $search)
                     ->findAll();
        } else {
            $data = $model->select('patients.*, pcps.PCP_Name, pcps.PCP_Specialty')
                     ->join('pcps', 'pcps.PCP_ID = patients.PCP_ID')
                     ->findAll();
        }

        return $this->response->setJSON($data);
    }

    public function create()
    {
        $model = new PatientModel();
        $data = $this->request->getPost();

        if (!$model->save($data)) {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'errors' => $model->errors()
            ]);
        }

        return $this->response->setJSON(['status' => 'success']);
    }


    public function update($id)
    {
        $model = new PatientModel();
        $data = $this->request->getPost();
        $model->update($id, $data);
        return $this->response->setJSON(['status' => 'updated']);
    }

    public function delete($id)
    {
        $model = new PatientModel();
        $model->delete($id);
        return $this->response->setJSON(['status' => 'deleted']);
    }
}
