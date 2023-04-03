<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\M_Role_Menu;

class Role extends Model
{
    use SoftDeletes;
    protected $table = 'roles';
    protected $guarded = [];
    use HasFactory;

    public function menu()
    {
        return $this->hasMany(M_Role_Menu::class, 'id_role')->orderBy('urutan', 'asc');
    }
}
