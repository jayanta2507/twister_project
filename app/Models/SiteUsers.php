<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteUsers extends Model
{
    use HasFactory;

    protected $guard = 'site_users';
    protected $table = 'site_users';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'profile_photo_path',
        'email_verified_status'
    ];

    protected $hidden = [
        'password', 
    ];
}

?>
