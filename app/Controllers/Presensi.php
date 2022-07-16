<?php

namespace App\Controllers;

use App\Models\PresensiModel;
use \Hermawan\DataTables\DataTable;

class Presensi extends BaseController
{
    
    public function index()
    {
        return view('_auth/_login');
    }

    public function Presensi()
    {
        $PresensiModel = new PresensiModel();
        $data['dataabsen'] = $PresensiModel->getfirstAbsen()->getRow();
        $data['userdata'] = $PresensiModel->getuserdata()->getRow();
        $data['chartStatus'] = $PresensiModel->getChartStatus()->getResultArray();
        // $data['count'] = $PresensiModel->getCountuser();

        return view('_user/_index', $data);
    }

    public function kehadiran() {
        $PresensiModel = new PresensiModel();
        $data['status'] = $PresensiModel->getStatus()->getResultArray();
        $data['userdata'] = $PresensiModel->getuserdata()->getRow();
        $data['countbekerja'] = $PresensiModel->getCountBekerja();
        $data['countWFH'] = $PresensiModel->getCountWFH();
        $data['counttanpaket'] = $PresensiModel->getCountTanpaKet();
        $data['countcuti'] = $PresensiModel->getCountCuti();
        $data['countDL'] = $PresensiModel->getCountDL();

        return view('_user/_kehadiran', $data);
    }

    public function kehadiran_homebase() {
        $PresensiModel = new PresensiModel();
        return view('_pimpinan/_hmbkehadiran');

    }

    public function monitorKehadiran() {
        $PresensiModel = new PresensiModel();
        $data['chartStatus'] = $PresensiModel->getChartStatus()->getResultArray();
        return view('_user/_monitoring', $data);
    }


    public function BatchRow() 
    {
        $PresensiModel = new PresensiModel();

        $query = $PresensiModel->getpgwid();
         
        foreach ($query->getResultArray() as $row) {
            $cleanNumber = preg_replace( '/[^0-9]/', '', microtime(false));
            $pgw_id = $row['pgw_id'];
            $abs_hari = hari_indo(date('l'));
            $abs_status = '';
            $abs_terlambat = 'Tidak mengisi presensi datang';
            if(hari_indo(date('l')) == 'Sabtu' || hari_indo(date('l')) == 'Minggu') {
                $abs_status = 'Hari Libur';
                $abs_terlambat = 'Hari Libur';
            } else {
                $abs_status = 'Tanpa Keterangan';
                $abs_terlambat = 'Tidak mengisi presensi datang';
            }
            $absenArray = array
            (
                'abs_id' => base_convert($cleanNumber, 10, 36),
                'pgw_id' => $pgw_id,
                'act_id' => null,
                'abs_datang' => '',
                'abs_pulang' => '',
                'abs_tgl' => '',
                'abs_status' => $abs_status,  
                'abs_terlambat' => $abs_terlambat,       
                'abs_hari' => $abs_hari,          
                'abs_jamkerja' => '',          
            );  
            $PresensiModel->save($absenArray);
        }
    }

    public function UpdateAbsenDatang() 
    {
        $PresensiModel = new PresensiModel();

        $id = $this->request->getPost("absen_abs_id");
        $long = $this->request->getPost("absen_abs_long");
        $lat = $this->request->getPost("absen_abs_lat");

        $image = $this->request->getPost("absen_abs_img");
        $image = str_replace('data:image/jpeg;base64,', '', $image);

        $image = base64_decode($image, true);

        $cleanNumber = preg_replace( '/[^0-9]/', '', microtime(false));

        $filename = user()->getpgwId() . base_convert($cleanNumber, 10, 36) . '.jpg';
        file_put_contents(FCPATH . '/assets/presensi/images/' . $filename, $image);

        if(date('h:i') <= '08:00') {
            $abs_terlambat = 'Tepat Waktu';
        } else if(date('h:i') > '08:00' && hari_indo(date('l')) != 'Sabtu' || hari_indo(date('l')) != 'Minggu') {
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
            'abs_lat' => $lat,
            'abs_img' => '/assets/presensi/images/' . $filename
        ];

        $PresensiModel->update($id, $data);
        $output = array('status' => 'Absen Datang Berhasil', 'data' => $data);

        return $this->response->setJSON($output);
    }
    public function UpdateAbsenPulang() 
    {
        $PresensiModel = new PresensiModel();

        $id = $this->request->getPost("absen_abs_id");
        $data = [
            'abs_pulang' => $this->request->getPost("absen_abs_pulang"),
            'abs_status' => 'Bekerja',
            'abs_hari' => hari_indo(date('l'))
        ];

        $PresensiModel->update($id, $data);
        $output = array('status' => 'Absen Pulang Berhasil', 'data' => $data);

        return $this->response->setJSON($output);
    }

    public function ReadAbsen() {
        $PresensiModel = new PresensiModel();
        $data['allabsen'] = $PresensiModel->getAbsen();
        return $this->response->setJSON($data);
    }

    public function AjaxReadAbsen() {
        $db = db_connect();
        // $id = user()->getpgwId();
        $builder = $db->table('absensi')
                      ->select('absensi.pgw_id, abs_id, abs_tgl, abs_datang, abs_pulang, abs_hari, abs_status, abs_jamkerja, abs_ket, act_id, pegawai.nama')
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
                return '<button class="btn btn-outline-blue btn-md" id="btnabsdetail" data-id="'.$row->abs_id.'">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12.01" y2="8"></line><polyline points="11 12 12 12 12 16 13 16"></polyline></svg>Detail</button>';
               })
               ->toJson(true);
    }

    public function AbsDetails($id) {
 
        $this->PresensiModel = new PresensiModel();
 
        $data = $this->PresensiModel->get_abs_by_id($id);
 
        return $this->response->setJSON($data);
    }

    public function Readfirstabsen ()
    {
        $PresensiModel = new PresensiModel();
        $data['dataabsen'] = $PresensiModel->getfirstAbsen()->getResultArray();
        return $this->response->setJSON($data);
    }

    public function Ajaxchartstatus() {
        $PresensiModel = new PresensiModel();
        $data['chartstatus'] = $PresensiModel->getChartStatus()->getResult();
        return $this->response->setJSON($data);
    }
    public function Ajaxchartjamkerja() {
        $PresensiModel = new PresensiModel();
        $data['chartjamkerja'] = $PresensiModel->getChartJamKerja()->getResult();
        return $this->response->setJSON($data);
    }

    public function PresensiHomebase() {
        $db = db_connect();
        // $id = user()->getpgwId();
        $builder = $db->table('absensi')
                      ->select('absensi.pgw_id, abs_id, abs_tgl, abs_datang, abs_pulang, abs_hari, abs_status, abs_jamkerja, abs_ket, act_id, pegawai.nama')
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
                return '<button class="btn btn-outline-blue btn-md" id="btnabsdetail" data-id="'.$row->abs_id.'">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12.01" y2="8"></line><polyline points="11 12 12 12 12 16 13 16"></polyline></svg>Detail</button>';
               })
               ->toJson(true);
    }
}
