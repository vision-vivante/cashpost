<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserSocialProfile extends Model
{
    protected $table = 'user_social_profiles';
    protected $fillable = ['user_id','facebook_url','twitter_url','google_url','linkedin_url','facebook_follower','twitter_follower','google_follower','linkedin_follower'];
}
