<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class op_room extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $fillable = [
        'type',
        'surgeon_Id',
        'team_Id',
        'open_at',
        'close_at'
    ];
}
