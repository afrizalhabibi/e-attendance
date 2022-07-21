<?php 
namespace App\Models;
use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'abs_id';
    protected $useAutoIncrement = false;
    // protected $insertID = 0;
    protected $returnType = 'array';
   

    protected $protectFields = true;
    protected $allowedFields = ['abs_id','act_id','pgw_id','abs_datang','abs_pulang','abs_status','abs_hari','abs_jamkerja','abs_long','abs_lat','abs_ket','abs_terlambat','abs_img'];


    public function getPresensiReport() 
    {
        return $this->db->table('absensi')
        ->join('pegawai', 'absensi.pgw_id = pegawai.pgw_id')
        ->join('homebase', 'pegawai.hmb_id = homebase.hmb_id')
        ->like('abs_tgl', date('Y-m'))
        ->groupBy('nama','asc')
        ->orderBy('abs_tgl','asc')
        ->get();
    }
    public function getPegawaiforreport() 
    {
        return $this->db->table('pegawai')
        ->join('homebase', 'pegawai.hmb_id = homebase.hmb_id')
        ->orderBy('nama','asc')
        ->distinct()
        ->get();
    }

    public function getfirstAbsen()
    {
        $result = $this->db->table('absensi')
        ->join('pegawai', 'absensi.pgw_id = pegawai.pgw_id')
        ->where('absensi.pgw_id',user()->getpgwId())
        ->where('absensi.abs_tgl', date('Y-m-d'))
        ->orderBy('abs_tgl','desc')
        ->limit(1)
        ->get();

        return $result;
    }

    public function get_abs_by_id($id) {
        $result = $this->db->table('absensi')
        ->join('pegawai', 'absensi.pgw_id = pegawai.pgw_id')
        ->where('abs_id', $id)
        ->get();
         
        return $result->getRow();
    }

    public function getuserdata()
    {
        $result = $this->db->table('pegawai')
        ->select('pegawai.hmb_id, homebase.hmb_name, pegawai.nama, pegawai.jabatan, pegawai.pgw_id')
        ->join('users', 'pegawai.pgw_id = users.pgw_id')
        ->join('homebase', 'pegawai.hmb_id = homebase.hmb_id')
        ->where('pegawai.pgw_id', user()->getpgwId())
        ->get();

        return $result;
    }

    public function getpgwid()
    {
        $result = $this->db->table('pegawai')->get();

        return $result;
    }

    public function getCountuser()
    {
        $builder = $this->db->table('pegawai');
        return $builder;
    }

    public function getStatus()
    {
        $result = $this->db->table('absensi')
                ->select('abs_status')
                ->distinct()
                ->get();
        return $result;
    }
    public function getHomebase()
    {
        $result = $this->db->table('homebase')
                ->distinct()
                ->get();
        return $result;
    }

    public function getCountBekerja()
    {
        $result = $this->db->table('absensi')
                ->select('abs_status')
                ->where('pgw_id', user()->getpgwId())
                ->like('abs_status', 'Bekerja')
                ->like('abs_tgl',date('Y-m'))
                ->countAllResults();
        return $result;
    }
    public function getCountWFH()
    {
        $result = $this->db->table('absensi')
                ->select('abs_status')
                ->where('pgw_id', user()->getpgwId())
                ->like('abs_status', 'WFH')
                ->like('abs_tgl',date('Y-m'))
                ->countAllResults();
        return $result;
    }
    public function getCountTanpaKet()
    {
        $result = $this->db->table('absensi')
                ->select('abs_status')
                ->where('pgw_id', user()->getpgwId())
                ->where('abs_status', 'Tanpa Keterangan')
                ->like('abs_tgl',date('Y-m'))
                ->countAllResults();
        return $result;
    }
    public function getCountCuti()
    {
        $result = $this->db->table('absensi')
                ->select('abs_status')
                ->where('pgw_id', user()->getpgwId())
                ->like('abs_status','Cuti')
                ->like('abs_tgl',date('Y-m'))
                ->countAllResults();
        return $result;
    }
    public function getCountDL()
    {
        $result = $this->db->table('absensi')
                ->select('abs_status')
                ->where('pgw_id', user()->getpgwId())
                ->where('abs_status','Dinas Luar')
                ->like('abs_tgl',date('Y-m'))
                ->countAllResults();
        return $result;
    }

    public function getChartStatus()
    {
        $result = $this->db->table('absensi')
                ->select('abs_status')
                ->select("count(*) AS total")
                ->where('pgw_id', user()->getpgwId())
                ->like('abs_tgl',date('Y-m'))
                ->groupBy('abs_status')
                ->get();
        return $result;
    }
    public function getChartStatusTahun()
    {
        $result = $this->db->table('absensi')
                ->select('abs_status')
                ->select("count(*) AS total")
                ->where('pgw_id', user()->getpgwId())
                ->like('abs_tgl',date('Y'))
                ->groupBy('abs_status')
                ->get();
        return $result;
    }

    public function getChartJamKerjaBulan()
    {
        $result = $this->db->table('absensi')
                ->select('abs_datang,abs_jamkerja, abs_tgl')
                ->where('pgw_id', user()->getpgwId())
                // ->where('abs_datang !=', '00:00:00')
                ->where('abs_status !=', 'Hari Libur')
                ->where('abs_status', 'Bekerja')
                // ->notLike('abs_jamkerja', '%-')
                ->like('abs_tgl',date('Y-m'))
                ->orderBy('abs_tgl', 'asc')
                ->groupBy('abs_jamkerja')
                ->get();
        return $result;
    }

}
?>