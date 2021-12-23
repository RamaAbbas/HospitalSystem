<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team_doctor extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $fillable = [
        'doctor_Id',
        'team_Id'
    ];
}
