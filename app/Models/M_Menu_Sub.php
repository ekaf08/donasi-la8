<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class M_Menu_Sub extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'm_menu_sub';
    protected $guarded = [];
}
