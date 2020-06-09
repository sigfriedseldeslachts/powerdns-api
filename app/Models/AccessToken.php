<?php


namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    use UuidTrait;

    public $incrementing = false;

    public $casts = [
        'zones' => 'array'
    ];
}
