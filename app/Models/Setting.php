<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Setting extends Authenticatable
{

    protected $table = 'settings';

    protected $fillable = [
        'site_name',
        'phone',
        'address',
        'aboutus',
        'contact_email',
        'youtube',
        'fb',
        'insta',
        'copyright_year',
        'logo',
        'fevicon',
        'seo_title',
        'meta_keyword',
        'meta_description',
        'canonical',
        'googletagmanager',
        'password',
        'adminemail',
        'logo',
        'twitter'

    ];
    private $descendants = [];
}
