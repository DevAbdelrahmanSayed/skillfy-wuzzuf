<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing_user extends Model
{
    use HasFactory;
    protected $fillable = [
        'listing_id',
        'user_id',
        'accepted',
        'reject'
    ];
}
