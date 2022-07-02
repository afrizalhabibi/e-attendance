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
        ->where('pgw_id', user()->getpgwid())
        ->where('act_id', $id)
        ->get();
         
        return $result->getRow();
      }

}
?>