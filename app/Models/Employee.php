<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $primaryKey = 'nip';

    protected $foreignKey = 'subsi_code';

    protected $fillable = ['nip','subsi_code','name','section'];

}
