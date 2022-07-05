<?php

namespace App\Models;

use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $table='services';
    public $primaryKey='id';
    public $keyType='int';
    public $autoIncrementing='true';
    public $timestamps='true';
}
