<?php

namespace App\Controllers;

use App\Models\AbsenModel;
use \Hermawan\DataTables\DataTable;

class Home extends BaseController
{
    
    public function index()
    {
        return view('_auth/_login');
    }

    public function home()
    {
        $AbsenModel = new AbsenModel();
        $data['dataabsen'] = $AbsenModel->getfirstAbsen()->getRow();
        $data['userdata'] = $AbsenModel->getuserdata()->getRow();
        $data['chartStatus'] = $AbsenModel->getChartStatus()->getResultArray();
        // $data['count'] = $AbsenModel->getCountuser();

        return view('_user/_index', $data);
    }

    public function kehadiran() {
        $AbsenModel = new AbsenModel();
        $data['status'] = $AbsenModel->getStatus()->getResultArray();
        $data['userdata'] = $AbsenModel->getuserdata()->getRow();
        $data['countbekerja'] = $AbsenModel->getCountBekerja();
        $data['countWFH'] = $AbsenModel->getCountWFH();
        $data['counttanpaket'] = $AbsenModel->getCountTanpaKet();
        $data['countcuti'] = $AbsenModel->getCountCuti();
        $data['countDL'] = $AbsenModel->getCountDL();

        return view('_user/_kehadiran', $data);
    }

    public function monitorKehadiran() {
        $AbsenModel = new AbsenModel();
        $data['chartStatus'] = $AbsenModel->getChartStatus()->getResultArray();
        return view('_user/_monitoring', $data);
    }


    public function BatchRow() 
    {
        $AbsenModel = new AbsenModel();

        $query = $AbsenModel->getpgwid();
        
        foreach ($query->getResultArray() as $row) {
            $abs_id = '';
            $pgw_id = $row['pgw_id'];
            $abs_datang = '';
            $abs_pulang = '';
            $abs_tgl = '';
            $abs_status = '';
            $abs_terlambat = 'Tidak mengisi presensi datang';
            $abs_hari = hari_indo(date('l'));
            if(hari_indo(date('l')) == 'Sabtu' || hari_indo(date('l')) == 'Minggu') {
                $abs_status = 'Hari Libur';
            } else {
                $abs_status = 'Tanpa Keterangan';
            }
            $absenArray = array
            (
                'abs_id' => $abs_id,
                'pgw_id' => $pgw_id,
                'abs_datang' => $abs_datang,
                'abs_pulang' => $abs_pulang,
                'abs_tgl' => $abs_tgl,
                'abs_status' => $abs_status,  
                'abs_terlambat' => $abs_terlambat,       
                'abs_hari' => $abs_hari,          
                'abs_jamkerja' => '',          
            );  
            $AbsenModel->save($absenArray);
        }
    }

    public function UpdateAbsenDatang() 
    {
        $AbsenModel = new AbsenModel();

        $id = $this->request->getPost("absen_abs_id");
        $long = $this->request->getPost("absen_abs_long");
        $lat = $this->request->getPost("absen_abs_lat");
        if(date('h:i') <= '08:00') {
            $abs_terlambat = 'Tepat Waktu';
        } else if(date('h:i') > '08:00') {
            $awal  = date_create('08:00:00');
            $akhir = date_create();
            $diff  = date_diff( $akhir, $awal );
            $jam   = $diff->h;
            $menit = $diff->i;
            $abs_terlambat = 'Terlambat ' .$jam. ' Jam ' .$menit. ' menit';
        } else {
            $abs_terlambat = 'Tidak Absen Datang';
        }
        $data = [
            'abs_datang' => $this->request->getPost("absen_abs_datang"),
            'abs_status' => 'Bekerja',
            'abs_terlambat' => $abs_terlambat,
            'abs_hari' => hari_indo(date('l')),
            'abs_long' => $long,
            'abs_lat' => $lat

        ];

        $AbsenModel->update($id, $data);
        $output = array('status' => 'Absen Datang Berhasil', 'data' => $data);

        return $this->response->setJSON($output);
    }
    public function UpdateAbsenPulang() 
    {
        $AbsenModel = new AbsenModel();

        $id = $this->request->getPost("absen_abs_id");
        $data = [
            'abs_pulang' => $this->request->getPost("absen_abs_pulang"),
            'abs_status' => 'Bekerja',
            'abs_hari' => hari_indo(date('l'))
        ];

        $AbsenModel->update($id, $data);
        $output = array('status' => 'Absen Pulang Berhasil', 'data' => $data);

        return $this->response->setJSON($output);
    }

    public function ReadAbsen() {
        $AbsenModel = new AbsenModel();
        $data['allabsen'] = $AbsenModel->getAbsen();
        return $this->response->setJSON($data);
    }

    public function AjaxReadAbsen() {
        $db = db_connect();
        // $id = user()->getpgwId();
        $builder = $db->table('absensi')
                      ->select('absensi.pgw_id, abs_id, abs_tgl, abs_datang, abs_pulang, abs_hari, abs_status, abs_jamkerja, abs_ket, pegawai.nama')
                      ->join('pegawai', 'absensi.pgw_id = pegawai.pgw_id')
                      ->where('absensi.pgw_id', user()->getpgwId());
                    //   ->orderBy('abs_tgl', 'desc');

        return DataTable::of($builder)
               ->addNumbering('no') //it will return data output with numbering on first column
               ->filter(function($builder, $request){
                 if ($request->status && !$request->datemin && !$request->datemax) {
                    $builder->where('abs_status', $request->status);
                 }
                 elseif ($request->datemin && $request->datemax &&!$request->status){
                    $builder->where("abs_tgl BETWEEN '$request->datemin' AND '$request->datemax'", NULL, FALSE);
                 }
                 elseif ($request->datemin && $request->datemax && $request->status){
                    $builder->where("abs_tgl BETWEEN '$request->datemin' AND '$request->datemax'");
                    $builder->where('abs_status', $request->status);
                 }
               })
               ->add('action', function($row){
                return '<button class="btn bg-blue-lt btn-sm" id="btnabsdetail" data-id="'.$row->abs_id.'">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12.01" y2="8"></line><polyline points="11 12 12 12 12 16 13 16"></polyline></svg>Detail</button>';
               })
               ->toJson(true);
    }

    public function AbsDetails($id) {
 
        $this->AbsenModel = new AbsenModel();
 
        $data = $this->AbsenModel->get_abs_by_id($id);
 
        return $this->response->setJSON($data);
    }

    public function Readfirstabsen ()
    {
        $AbsenModel = new AbsenModel();
        $data['dataabsen'] = $AbsenModel->getfirstAbsen()->getResultArray();
        return $this->response->setJSON($data);
    }

    public function Ajaxchartstatus() {
        $AbsenModel = new AbsenModel();
        $data['chartstatus'] = $AbsenModel->getChartStatus()->getResult();
        return $this->response->setJSON($data);
    }
}
