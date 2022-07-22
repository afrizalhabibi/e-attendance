<?php 
namespace App\Models;
use CodeIgniter\Model;
// use Michalsn\Uuid\UuidModel;

class ActivityModel extends Model
{
    
    protected $table = 'activity';
    protected $primaryKey = 'act_id';

    // protected $uuidFields = ['act_id'];
    protected $useAutoIncrement = false;
    // protected $insertID = 0;
    protected $returnType = 'array';
    // protected $useSoftDeletes = true;
    // protected $useTimestamps = true;

    protected $protectFields = true;
    protected $allowedFields = ['act_id','pgw_id','act_tgl','act_qty','act_ket','act_output'];

    public function get_act_by_id($id) {
        $result = $this->db->table('activity')
        ->where('act_id', $id)
        ->get();
         
        return $result->getRow();
      }

    public function check_date($avlb_date){
      $query = $this->db->table('activity')
               ->where('act_tgl',$avlb_date)
               ->where('pgw_id', user()->getpgwId());
             
               
      if($query->countAllResults()>0)
      {
        return 1;	
      }
      else
      {
        return 0;	
      }
    }

    public function getChartKinerjaBulan()
    {
        $result = $this->db->table('activity')
                ->select('act_qty, act_tgl')
                ->where('pgw_id', user()->getpgwId())
                // ->notLike('abs_jamkerja', '%-')
                ->like('act_tgl',date('Y-m'))
                ->orderBy('act_tgl', 'asc')
                ->groupBy('act_tgl')
                ->get();
        return $result;
    }
    public function getChartKinerjatigaBulan()
    {
        $result = $this->db->table('activity')
                ->select('act_qty, act_tgl')
                ->where('pgw_id', user()->getpgwId())
                ->where('act_tgl BETWEEN "' . date('Y-m-d', strtotime('-3 Months')) . '" AND "' .date('Y-m-d').'"')
                ->orderBy('act_tgl', 'asc')
                ->groupBy('act_tgl')
                ->get();
        return $result;
    }

}
?>