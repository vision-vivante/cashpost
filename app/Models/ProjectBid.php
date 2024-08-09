<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectBid extends Model
{
    use SoftDeletes;
    protected $fillable = ['project_id','bid_by_user_id','amount','message','status'];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'bid_by_user_id');
    }
}
