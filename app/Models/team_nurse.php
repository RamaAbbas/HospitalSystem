<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team_nurse extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    protected $fillable = [
        'nurse_Id',
        'team_Id'
    ];
}
