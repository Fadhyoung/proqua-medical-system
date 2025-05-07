<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PatientModel;

class Patient extends BaseController
{
    public function index()
    {
        return view('patients/index');
    }

    public function list()
    {
        $model = new PatientModel();
        $search = $this->request->getGet('search');

        if ($search) {
            $data = $model->like('Pat_Name', $search)->findAll();
        } else {
            $data = $model->findAll();
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
        $data = $this->request->getRawInput();
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
