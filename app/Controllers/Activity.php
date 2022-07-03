<?php

namespace App\Controllers;

use App\Models\ActivityModel;
use App\Models\PresensiModel;
use \Hermawan\DataTables\DataTable;

class Activity extends BaseController
{
    public function AddActivity() 
    {
        $this->load->libaray('form_validation');
        $this->form_validation->set_rules($rules);
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

    public function Recordkinerja() {
        // $PresensiModel = new PresensiModel();

        return view('_user/_kinerja');
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
            //    ->filter(function($builder, $request){
            //      if ($request->status && !$request->datemin && !$request->datemax) {
            //         $builder->where('abs_status', $request->status);
            //      }
            //      elseif ($request->datemin && $request->datemax &&!$request->status){
            //         $builder->where("abs_tgl BETWEEN '$request->datemin' AND '$request->datemax'", NULL, FALSE);
            //      }
            //      elseif ($request->datemin && $request->datemax && $request->status){
            //         $builder->where("abs_tgl BETWEEN '$request->datemin' AND '$request->datemax'");
            //         $builder->where('abs_status', $request->status);
            //      }
            //    })
               ->add('action', function($row){
                return '<a href="#" id="btnactdetail" data-id="'.$row->act_id.'">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12.01" y2="8"></line><polyline points="11 12 12 12 12 16 13 16"></polyline></svg></a> <a href="#" id="btnactdetail" data-id="'.$row->act_id.'">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
   <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
   <path d="M16 5l3 3"></path>
</svg></a>';

               })
               ->toJson(true);
    }

    public function ActDetails($id) {
 
        $this->ActivityModel = new ActivityModel();
 
        $data = $this->ActivityModel->get_act_by_id($id);
 
        return $this->response->setJSON($data);
    }
}

?>