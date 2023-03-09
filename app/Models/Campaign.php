<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'campaigns';

    public function category_campaign()
    {
        return $this->belongsToMany(Category::class, 'category_campaign');
    }
}
