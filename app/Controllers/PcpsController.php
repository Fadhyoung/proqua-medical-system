<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PcpModel;

class PcpsController extends BaseController
{
    public function list()
    {
        $model = new PcpModel();
        $data = $model->findAll();
        return $this->response->setJSON($data);
    }
}