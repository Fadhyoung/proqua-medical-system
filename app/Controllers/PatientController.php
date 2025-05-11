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
        $page = $this->request->getGet('page', FILTER_VALIDATE_INT) ?? 1;
    
        $result = $model->getPatientsWithPCP($search, true, 15, $page);

        return $this->response->setJSON([
            'data' => $result['patients'],
            'pager' => [
                'currentPage' => $result['pager']->getCurrentPage(),
                'totalPages' => $result['pager']->getPageCount(),
                'totalItems' => $result['pager']->getTotal()
            ]
        ]);
    }

    public function create()
    {
        $model = new PatientModel();
        $data = $this->request->getJSON(true);

        log_message('alert', 'the request for create patient is ' . print_r($data, true));

        if (!$model->createPatient($data)) {
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
        $data = $this->request->getJSON();
        log_message('alert', 'the data request is' . print_r($data, true));
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
