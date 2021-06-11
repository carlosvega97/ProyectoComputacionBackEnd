<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colegio extends Model
{
    use HasFactory;
    protected $table = 'colegios';
    
    protected $fillable = [
        'idColegio',
        'idMunicipio',
        'Localidad',
        'idProvincia',
        'Provincia',
        'Denominacion_generica',
        'Denominacion_especifica',
        'Naturaleza',
        'Domicilio',
        'C_Postal',
        'Telefono',
    ];


}
