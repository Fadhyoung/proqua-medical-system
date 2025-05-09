<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table = 'patients';
    protected $primaryKey = 'Pat_ID';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'Pat_Name',
        'Pat_Gender',
        'Pat_Address',
        'Pat_DOB',
        'PCP_ID',
        'Pat_Phone',
        'Pat_Email',
    ];

    protected $validationRules = [
        'Pat_Name' => 'required|min_length[3]|max_length[100]',
        'Pat_Gender' => 'required|in_list[Male,Female]',
        'Pat_Address' => 'required|min_length[5]',
        'Pat_DOB' => 'required|valid_date',
        'PCP_ID' => 'required|is_natural_no_zero',
        'Pat_Phone' => 'permit_empty|max_length[20]',
        'Pat_Email' => 'permit_empty|valid_email|max_length[100]',
    ];

    protected $validationMessages = [
        'Pat_Name' => [
            'required' => 'Patient name is required.',
            'min_length' => 'Name must be at least 3 characters.',
            'max_length' => 'Name cannot exceed 100 characters.'
        ],
        'Pat_Gender' => [
            'required' => 'Gender is required.',
            'in_list' => 'Please select a valid gender.'
        ],
        'Pat_Address' => [
            'required' => 'Address is required.',
            'min_length' => 'Address must be at least 5 characters.'
        ],
        'Pat_DOB' => [
            'required' => 'Date of birth is required.',
            'valid_date' => 'Please enter a valid date of birth.'
        ],
        'PCP_ID' => [
            'required' => 'Primary care physician is required.',
            'is_natural_no_zero' => 'Please select a valid physician.'
        ],
        'Pat_Email' => [
            'valid_email' => 'Please enter a valid email address.',
            'max_length' => 'Email cannot exceed 100 characters.'
        ]
    ];

    public function getPatientsWithPCP(string $search = null, bool $pagination= false, int $itemsPerPage = 10, int $page = 1)
    {
        $builder = $this->select('patients.*, pcps.PCP_Name, pcps.PCP_Specialty')
            ->join('pcps', 'pcps.PCP_ID = patients.PCP_ID');

        if ($search) {
            $builder->like('Pat_Name', $search);
        }

        if ($pagination) {
            return [
                'patients' => $builder->paginate($itemsPerPage, 'default', $page),
                'pager' => $this->pager
            ];
        }

        return $builder->findAll();
    }

    public function createPatient(array $data)
    {
        try {
            if ($this->save($data)) {
                return $this->insertID();
            }
            return false;
        } catch (\Exception $e) {
            log_message('error', 'Patient creation failed: ' . $e->getMessage());
            return false;
        }
    }
}
