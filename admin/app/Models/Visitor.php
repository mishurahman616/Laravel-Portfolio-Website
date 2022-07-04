<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    /* Telling Laravel that the table name is visitors. */
    public $table='visitors';
    /* Telling Laravel that the primary key of the visitors table is id. */
    public $primaryKey='id';
    /* Telling Laravel that the primary key is Auto incrementing. */
    public $incrementing='true';
    /* Telling Laravel that the primary key is an integer. */
    public $keyType='int';
    /* Telling Laravel that the table does not have timestamps. */
    public $timestamps='false';
}
