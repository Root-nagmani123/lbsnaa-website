<?php 
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_model extends Model
{
    public function getAllMenus()
    {
        $this->db->select('id, name, parent_id');
        $this->db->order_by('parent_id ASC, name ASC');
        $query = $this->db->get('menu_categories');
        return $query->result_array();
    }
}