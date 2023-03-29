<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\M_Menu_Sub;

class M_Role_Menu_sub extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'm_role_menu_sub';
    protected $guarded = [];

    public function sub_menu_detail()
    {
        return $this->belongsTo(M_Menu_Sub::class, 'id_sub_menu');
    }
}
