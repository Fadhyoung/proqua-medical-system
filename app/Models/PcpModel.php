<?php

namespace App\Models;

use CodeIgniter\Model;

class PcpModel extends Model
{
    protected $table = 'pcps';
    protected $primaryKey = 'PCP_ID';
    protected $allowedFields = ['PCP_Name', 'PCP_Specialty', 'PCP_Phone', 'PCP_Email', 'PCP_Address'];
    protected $useTimestamps = true;
}