<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class examination extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $fillable = [
        'patient_Id'
    ];
}
