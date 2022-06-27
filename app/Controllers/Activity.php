<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use App\Models\PresensiModel;
use \Hermawan\DataTables\DataTable;

class Activity extends BaseController
{
    public function AddActivity() 
    {
        $ActivityModel = new ActivityModel();
        $PresensiModel = new PresensiModel();
        $data = [
            'pgw_id' => user()->getpgwId(),
            // 'act_id' => '',
            'act_tgl' => $this->request->getPost("ativity_act_tgl"),
            'act_qty' => $this->request->getPost("ativity_act_qty"),
            'act_ket' => $this->request->getPost("ativity_act_ket"),
            'act_output' => $this->request->getPost("ativity_act_output"),
        ];

        // $act_id = [
        //     'act_id'
        // ];
        

        $ActivityModel->save($data);
        // $PresensiModel->save($act_id);
        $output = array('status' => 'Terkirim', 'data' => $data);

        return $this->response->setJSON($output);
    }
}

?>