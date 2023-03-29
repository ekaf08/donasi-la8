<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\M_Role_Menu_sub;
use App\Models\M_Menu;

class M_Role_Menu extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'm_role_menu';
    protected $guarded = [];

    public function sub_menu()
    {
        return $this->hasMany(M_Role_Menu_sub::class, 'id_role_menu');
    }

    public function menu_detail()
    {
        return $this->belongsTo(M_Menu::class, 'id_menu');
    }
}
