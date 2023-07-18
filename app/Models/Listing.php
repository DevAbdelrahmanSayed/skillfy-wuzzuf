<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{

    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'description',
        'roles',
        'job_type',
        'slug',
        'feature_photo',
        'address',
        'salary',
        'application_close_date'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class,'listing_users','listing_id','user_id')
        ->withPivot('accepted','reject')
         ->withTimestamps();
    }
    public function user_posts()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }


}
