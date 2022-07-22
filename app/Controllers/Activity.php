<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use App\Models\PresensiModel;
use \Hermawan\DataTables\DataTable;

class Activity extends BaseController
{
    public function Recordkinerja() {
        $PresensiModel = new PresensiModel();
        $data['userdata'] = $PresensiModel->getuserdata()->getRow();
        return view('_user/_kinerja',$data);
    }

    public function Recordkinerjabidang() {
        $PresensiModel = new PresensiModel();
        $data['userdata'] = $PresensiModel->getuserdata()->getRow();
        return view('_pimpinan/_hmbkinerja',$data);
    }
    public function AddActivity() 
    {
        helper(['form', 'url']);
        $db = db_connect();
        $ActivityModel = new ActivityModel();
        $PresensiModel = new PresensiModel();
        $cleanNumber = preg_replace( '/[^0-9]/', '', microtime(false)); 
        $data = [
            'pgw_id' => user()->getpgwId(),
            'act_id' => base_convert($cleanNumber, 10, 36),
            'act_tgl' => $this->request->getPost("ativity_act_tgl"),
            'act_qty' => $this->request->getPost("ativity_act_qty"),
            'act_ket' => $this->request->getPost("ativity_act_ket"),
            'act_output' => $this->request->getPost("ativity_act_output"),
        ];

        $act_id = [
            'act_id' => base_convert($cleanNumber, 10, 36),
        ];
        
        $tgl =  $this->request->getPost("ativity_act_tgl");
        
        $ActivityModel->save($data);
        // $PresensiModel->update($id, $act_id);
        $builder = $db->table('absensi')
                      ->set('act_id',$act_id)
                      ->where('abs_tgl', $tgl)
                      ->where('pgw_id', user()->getpgwId())
                      ->update();

        $output = array('status' => 'Terkirim', 'data' => $data);

        return $this->response->setJSON($output);
    }
    
    public function EdtActivity() 
    {
        helper(['form', 'url']);
        $db = db_connect();
        $ActivityModel = new ActivityModel();
        $id =  $this->request->getPost("activity_act_id");
        $data = [
            'act_qty' => $this->request->getPost("activity_act_qty"),
            'act_ket' => $this->request->getPost("activity_act_ket"),
            'act_output' => $this->request->getPost("activity_act_output"),
        ];

        $ActivityModel->update($id, $data);

        $output = array('status' => 'Terkirim', 'data' => $data);

        return $this->response->setJSON($output);
    }

    public function AjaxReadKinerja() {
        $db = db_connect();
        // $id = user()->getpgwId();
        $builder = $db->table('activity')
                      ->select('activity.pgw_id, act_id, act_tgl, act_qty, act_ket, act_output, pegawai.nama')
                      ->join('pegawai', 'activity.pgw_id = pegawai.pgw_id')
                      ->where('activity.pgw_id', user()->getpgwId());
                    

        return DataTable::of($builder)
            ->addNumbering('no') //it will return data output with numbering on first column
               ->filter(function($builder, $request){
                 if ($request->datemin && $request->datemax){
                    $builder->where("act_tgl BETWEEN '$request->datemin' AND '$request->datemax'", NULL, FALSE);
                 }
               })
        ->add('action', function($row){            
        return '<div class="float-end">
        <button class="btn btn-outline-blue btn-md me-2" id="btnactdetail" data-id="'.$row->act_id.'">Detail</button>
        <button class="btn btn-outline-orange btn-md" id="btnactedit" data-id="'.$row->act_id.'">Edit</button>
            </div>';               
        })
        ->toJson(true);
    }
    public function AjaxReadKinerjaHomebase() {
        $PresensiModel = new PresensiModel();
        $userdata = $PresensiModel->getuserdata()->getRow(1);
        $db = db_connect();
        // $id = user()->getpgwId();
        $builder = $db->table('activity')
                      ->select('activity.pgw_id, act_id, act_tgl, act_qty, act_ket, act_output, pegawai.nama')
                      ->join('pegawai', 'activity.pgw_id = pegawai.pgw_id')
                      ->where('pegawai.hmb_id', $userdata->hmb_id);
                    

        return DataTable::of($builder)
            ->addNumbering('no') //it will return data output with numbering on first column
               ->filter(function($builder, $request){
                 if ($request->datemin && $request->datemax){
                    $builder->where("act_tgl BETWEEN '$request->datemin' AND '$request->datemax'", NULL, FALSE);
                 }
               })
        ->add('action', function($row){            
        return '<div class="float-end">
        <button class="btn btn-outline-blue btn-md me-2" id="btnactdetail" data-id="'.$row->act_id.'">Detail</button>
            </div>';               
        })
        ->toJson(true);
    }

    public function ActDetails($id) {
 
        $this->ActivityModel = new ActivityModel();
 
        $data = $this->ActivityModel->get_act_by_id($id);
 
        return $this->response->setJSON($data);
    }

    public function docheckDate()
    {
        $avlb_date = $this->request->getPost('available_act_tgl');
		
		$this->ActivityModel = new ActivityModel();
		
		$result=$this->ActivityModel->check_date($avlb_date);

		if($result)
		{
            $output = array('status' => 'Sudah mengisi laporan kegiatan');	
		}
		else
		{
            $output = array('status' => 'Available');	
		
		}

        return $this->response->setJSON($output);
        
    }

    public function Ajaxchartkinerja() {
        $ActivityModel = new ActivityModel();
        $data['chartkinerja'] = $ActivityModel->getChartKinerjaBulan()->getResult();
        return $this->response->setJSON($data);
    }
    public function Ajaxchartkinerjatiga() {
        $ActivityModel = new ActivityModel();
        $data['chartkinerja'] = $ActivityModel->getChartKinerjatigaBulan()->getResult();
        return $this->response->setJSON($data);
    }
}

?>