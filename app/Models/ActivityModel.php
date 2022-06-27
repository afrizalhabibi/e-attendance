<?php 
namespace App\Models;
// use CodeIgniter\Model;
use Michalsn\Uuid\UuidModel;

class ActivityModel extends UuidModel
{
    
    protected $table = 'activity';
    protected $primaryKey = 'act_id';

    protected $uuidFields = ['act_id'];
    // protected $useAutoIncrement = true;
    // protected $insertID = 0;
    protected $returnType = 'array';
    // protected $useSoftDeletes = true;
    // protected $useTimestamps = true;

    protected $protectFields = true;
    protected $allowedFields = ['act_id','pgw_id','act_tgl','act_qty','act_ket','act_output'];

}
?>