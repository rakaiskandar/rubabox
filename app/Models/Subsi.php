<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsi extends Model
{
    use HasFactory;

    protected $table = 'subsis';

    protected $primaryKey = 'subsi_code';

    protected $fillable = ['subsi_code','section','description'];
}
