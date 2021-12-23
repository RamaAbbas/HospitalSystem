<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operation extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $fillable = [
        'dateTime',
        'op_room_Id',
        'anesthesiologist_Id'
    ];
}
