<?php 
namespace App\Models;
use CodeIgniter\Model;

class AbsenModel extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'abs_id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'array';
   

    protected $protectFields = true;
    protected $allowedFields = ['pgw_id','abs_datang','abs_pulang','abs_status','abs_hari','abs_jamkerja','abs_long','abs_lat','abs_ket','abs_terlambat'];


    public function getAbsen() 
    {
        return $this->db->table('absensi')
        ->join('pegawai', 'absensi.pgw_id = pegawai.pgw_id')
        ->where('absensi.pgw_id',user()->getpgwId())
        ->orderBy('abs_tgl','desc')
        ->limit(10)
        ->get()->getResultArray();
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
        ->where('absensi.pgw_id', user()->getpgwid())
        ->where('abs_id', $id)
        ->get();
         
        return $result->getRow();
      }

    public function getuserdata()
    {
        $result = $this->db->table('pegawai')
        ->join('users', 'pegawai.pgw_id = users.pgw_id')
        ->where('pegawai.pgw_id',user()->getpgwId())
        ->limit(1)
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
                ->where('pgw_id', user()->getpgwId())
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

}
?>