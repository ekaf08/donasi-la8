<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'settings';
    protected $guarded = [];

    public function bank_setting()
    {
        return $this->belongsToMany(Bank::class, 'bank_setting', 'setting_id')->withPivot('account', 'name', 'is_main')->withTimestamps();
    }
}
