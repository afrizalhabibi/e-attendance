<?php

namespace App\Controllers;

use App\Models\PresensiModel;
use \Hermawan\DataTables\DataTable;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Presensi extends BaseController
{
    
    public function index()
    {
        $data['title'] = 'Login';
        d($data);
        return view('_auth/_login', $data);
    }

    public function DoPresensi()
    {
        $PresensiModel = new PresensiModel();
        $data['title'] = 'Halaman Presensi';
        $data['dataabsen'] = $PresensiModel->getfirstAbsen()->getRow();
        $data['userdata'] = $PresensiModel->getuserdata()->getRow();
        $data['chartStatus'] = $PresensiModel->getChartStatus()->getResultArray();
        // $data['count'] = $PresensiModel->getCountuser();

        return view('_user/_index', $data);
    }

    public function presensi_pegawai() {
        $PresensiModel = new PresensiModel();
        $data['title'] = 'Presensi Pegawai';
        $data['status'] = $PresensiModel->getStatus()->getResultArray();
        $data['userdata'] = $PresensiModel->getuserdata()->getRow();
        $data['countbekerja'] = $PresensiModel->getCountBekerja();
        $data['countWFH'] = $PresensiModel->getCountWFH();
        $data['counttanpaket'] = $PresensiModel->getCountTanpaKet();
        $data['countcuti'] = $PresensiModel->getCountCuti();
        $data['countDL'] = $PresensiModel->getCountDL();

        return view('_user/_kehadiran', $data);
    }

    public function presensi_homebase() {
        $PresensiModel = new PresensiModel();
        $data['title'] = 'Per Homebase';
        $data['status'] = $PresensiModel->getStatus()->getResultArray();
        $data['userdata'] = $PresensiModel->getuserdata()->getRow(1);
        return view('_pimpinan/_hmbkehadiran', $data);

    }
    public function presensi_all() {
        $PresensiModel = new PresensiModel();
        $data['title'] = 'Semua Pegawai';
        $data['status'] = $PresensiModel->getStatus()->getResultArray();
        $data['homebase'] = $PresensiModel->getHomebase()->getResultArray();
        $data['userdata'] = $PresensiModel->getuserdata()->getRow(1);
        return view('_admin/_admkehadiran', $data);

    }

    public function monitorKehadiran() {
        $PresensiModel = new PresensiModel();
        $data['userdata'] = $PresensiModel->getuserdata()->getRow();
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

    public function EdtPresensi() 
    {
        helper(['form', 'url']);
        $db = db_connect();
        $PresensiModel = new PresensiModel();
        $id =  $this->request->getPost("presensi_abs_id");
        $data = [
            'abs_datang' => $this->request->getPost("presensi_abs_datang"),
            'abs_pulang' => $this->request->getPost("presensi_abs_pulang"),
            'abs_status' => $this->request->getPost("presensi_abs_status"),
            'abs_ket'    => $this->request->getPost("presensi_abs_ket"),
        ];

        $PresensiModel->update($id, $data);

        $output = array('status' => 'Terkirim', 'data' => $data);

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
                Detail</button>';
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
    public function AjaxchartstatusPertahun() {
        $PresensiModel = new PresensiModel();
        $data['chartstatus'] = $PresensiModel->getChartStatusTahun()->getResult();
        return $this->response->setJSON($data);
    }
    public function Ajaxchartjamkerja() {
        $PresensiModel = new PresensiModel();
        $data['chartjamkerja'] = $PresensiModel->getChartJamKerjaBulan()->getResult();
        return $this->response->setJSON($data);
    }
    public function AjaxchartLaporan() {
        $PresensiModel = new PresensiModel();
        $data['chartlaporan'] = $PresensiModel->getChartLaporan()->getResult();
        return $this->response->setJSON($data);
    }

    public function PresensiHomebase() {
        $PresensiModel = new PresensiModel();
        $userdata = $PresensiModel->getuserdata()->getRow(1);
        $db = db_connect();
        
        $builder = $db->table('absensi')
                      ->select('absensi.pgw_id, abs_id, abs_tgl, abs_datang, abs_pulang, abs_hari, abs_status, abs_jamkerja, abs_ket, act_id, pegawai.nama, pegawai.status_peg')
                      ->join('pegawai', 'absensi.pgw_id = pegawai.pgw_id')
                      ->where('pegawai.hmb_id', $userdata->hmb_id);

        return DataTable::of($builder)
               ->addNumbering('no')
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
                return '<button class="btn btn-outline-blue btn-md" id="btnabsdetail" data-id="'.$row->abs_id.'">Detail</button>';
               })
               ->toJson(true);
    }
    public function PresensiPegawaiAll() {
        $PresensiModel = new PresensiModel();
        $userdata = $PresensiModel->getuserdata()->getRow(1);
        $db = db_connect();
        
        $builder = $db->table('absensi')
                      ->select('absensi.pgw_id, abs_id, abs_tgl, abs_datang, abs_pulang, abs_hari, abs_status, abs_jamkerja, abs_ket, act_id, pegawai.nama, pegawai.hmb_id, homebase.hmb_name, pegawai.jabatan, pegawai.status_peg')
                      ->join('pegawai', 'absensi.pgw_id = pegawai.pgw_id')
                      ->join('homebase', 'pegawai.hmb_id = homebase.hmb_id');
                      //->where('pegawai.hmb_id', $userdata->hmb_id);

        return DataTable::of($builder)
               ->addNumbering('no')
               ->filter(function($builder, $request){
                 if ($request->status && !$request->datemin && !$request->datemax && !$request->homebase) {
                    $builder->where('abs_status', $request->status);
                 }
                 elseif ($request->homebase && !$request->status && !$request->datemin && !$request->datemax){
                    $builder->where('homebase.hmb_id', $request->homebase);
                 }
                 elseif ($request->datemin && $request->datemax &&!$request->status && !$request->homebase){
                    $builder->where("abs_tgl BETWEEN '$request->datemin' AND '$request->datemax'", NULL, FALSE);
                 }
                 elseif($request->datemin && $request->datemax &&!$request->status && $request->homebase) {
                    $builder->where("abs_tgl BETWEEN '$request->datemin' AND '$request->datemax'");
                    $builder->where('homebase.hmb_id', $request->homebase);
                 }
                 elseif($request->datemin && $request->datemax &&$request->status && !$request->homebase) {
                    $builder->where("abs_tgl BETWEEN '$request->datemin' AND '$request->datemax'");
                    $builder->where('abs_status', $request->status);
                 }
                 elseif(!$request->datemin && !$request->datemax &&$request->status && $request->homebase) {
                    $builder->where('homebase.hmb_id', $request->homebase);
                    $builder->where('abs_status', $request->status);
                 }
                 elseif ($request->datemin && $request->datemax && $request->status && $request->homebase){
                    $builder->where("abs_tgl BETWEEN '$request->datemin' AND '$request->datemax'");
                    $builder->where('abs_status', $request->status);
                    $builder->where('homebase.hmb_id', $request->homebase);
                 }
               })
               ->add('action', function($row){
                return '<div class="float-end"><button class="btn btn-outline-blue btn-md me-2" id="btnabsdetail" data-id="'.$row->abs_id.'">Detail</button>
                <button class="btn btn-outline-orange btn-md" id="btnabsedit" data-id="'.$row->abs_id.'">Edit</button></div>';
               })
               ->toJson(true);
    }

    public function monthlyReport()
    {
        $PresensiModel = new PresensiModel();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'NIP/NIK');
        $sheet->setCellValue('C1', 'Status Kepegawaian');
        $sheet->setCellValue('D1', 'Nama');
        $sheet->setCellValue('E1', 'Bulan');
        // $sheet->setCellValue('E2', 'Tanggal');

        $pgwreport = $PresensiModel->getPegawaiforreport()->getResult();
        $prsreport = $PresensiModel->getPresensiReport()->getResult();
        // d($prsreport);
        $no = 1;
        $x = 2;
        foreach($pgwreport as $row)
        {
            $sheet->setCellValue('A'.$x, $no++);
            $sheet->setCellValue('B'.$x, $row->pgw_id);
            $sheet->setCellValue('C'.$x, $row->status_peg);
            $sheet->setCellValue('D'.$x, $row->nama);
            $sheet->setCellValue('E'.$x, $row->abs_tgl);
            $x++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporanpresensibulanan';

        ob_clean();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='. $filename .'.xlsx'); 
        header('Cache-Control: max-age=0');

        // $writer = IOFactory::createWriter($spreadsheet, 'CSV');
        $writer->save('php://output');
        die();

    }

    
}
