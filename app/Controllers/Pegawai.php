<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use App\Models\PresensiModel;
use \Hermawan\DataTables\DataTable;

class Pegawai extends BaseController
{
    public function Infopegawai() {
        
        return view('_user/_profile');
    }
}

?>