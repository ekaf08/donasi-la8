<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class M_Menu extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'm_menu';
    protected $guarded = [];
}
