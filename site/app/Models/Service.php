<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
   /* Defining the table name, primary key, incrementing, key type, and timestamps. */
   public $table='services';
   public $primaryKey='id';
   public $incrementing='true';
   public $keyType='int';
   public $timestamps='true';
}
