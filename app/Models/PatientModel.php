<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table = 'patients';
    protected $primaryKey = 'Pat_ID';

    protected $allowedFields = ['Pat_Name', 'Pat_Gender', 'Pat_Address', 'Pat_DOB', 'PCP'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'Pat_Name' => 'required|min_length[3]',
        'Pat_Gender' => 'required|in_list[Male,Female,Other]',
        'Pat_Address' => 'required|min_length[5]',
        'Pat_DOB' => 'required|valid_date',
        'PCP' => 'required|min_length[3]'
    ];

    protected $validationMessages = [
        'Pat_Name' => [
            'required' => 'Patient name is required.',
            'min_length' => 'Name must be at least 3 characters.'
        ],
        'Pat_Gender' => [
            'required' => 'Gender is required.',
            'in_list' => 'Gender must be Male, Female, or Other.'
        ],
        'Pat_Address' => [
            'required' => 'Address is required.',
            'min_length' => 'Address must be at least 5 characters.'
        ],
        'Pat_DOB' => [
            'required' => 'Date of birth is required.',
            'valid_date' => 'Date of birth must be a valid date.'
        ],
        'PCP' => [
            'required' => 'Primary care provider is required.',
            'min_length' => 'PCP must be at least 3 characters.'
        ]
    ];
}
