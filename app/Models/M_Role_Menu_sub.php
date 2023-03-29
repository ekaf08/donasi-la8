<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class M_Role_Menu_sub extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'm_role_menu_sub';
    protected $guarded = [];
}
