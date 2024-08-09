<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HireInvitation extends Model
{
    use SoftDeletes;
    protected $fillable = ['project_id','sent_by_user_id','sent_to_user_id','price','message','status'];
    public function project()
    {
        return $this->belongsTo(Project::class)->withTrashed();
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'sent_by_user_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'sent_to_user_id');
    }
}
