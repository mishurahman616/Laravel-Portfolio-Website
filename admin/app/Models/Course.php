<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public $table='courses';
    public $primaryKey='id';
    public $keyType='int';
    public $autoIncrementing='true';
    public $timestamps='true';
}
