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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function StatusColor()
    {
        $color = '';
        switch ($this->status) {
            case 'publish':
                $color = 'success';
                break;
            case 'pending':
                $color = 'danger';
                break;
            case 'archived':
                $color = 'secondary';
                break;

            default:
                break;
        }
        return $color;
    }
}
