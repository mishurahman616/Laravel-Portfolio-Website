<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public $table='contact';
    public $primaryKey='id';
    public $keyType='int';
    public $autoIncrementing='true';
    public $timestamps='true';
}