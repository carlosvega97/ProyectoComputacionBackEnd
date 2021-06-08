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
        'Denominación_genérica',
        'Denominación_específica',
        'Naturaleza',
        'Domicilio',
        'C_Postal',
        'Teléfono',
    ];


}
