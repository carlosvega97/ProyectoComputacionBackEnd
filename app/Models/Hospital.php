<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $table = 'hospitales';

    protected $fillable = [
        'CCN',
        'CODCNH',
        'Nombre_Centro',
        'Tipo_Via',
        'Nombre_Via',
        'Numero_Via',
        'Telefono_Principal',
        'Cód_Municipio',
        'Municipio',
        'Cód_Provincia',
        'Provincia',
        'Cód_CCAA',
        'CCAA',
        'Codigo_Postal',
        'CAMAS',
        'Cod_Clase_de_Centro',
        'Clase_de_Centro',
        'Cod_Dep_Funcional',
        'Dependencia_Funcional',
        'Forma_parte_Complejo',
        'CODIDCOM',
        'Nombre_del_Complejo',
        'ALTA',
        'Email'
    ];
}
