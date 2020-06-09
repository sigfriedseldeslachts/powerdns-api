<?php


namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{
    use UuidTrait;

    public $incrementing = false;

    protected $fillable = ['secret', 'zones'];

    public $casts = [
        'zones' => 'array'
    ];
}
