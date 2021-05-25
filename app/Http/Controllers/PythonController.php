<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class PythonController extends Controller
{
    /**
     * Solicita la ejecucion de un script en python.
     *
     * @return \Illuminate\Http\Response
     */
    public function processData()
    {
        // tener en cuenta la ruta del interprete de python
        $python = 'C:\Users\sebas\AppData\Local\Programs\Python\Python37\python.exe';
        // estrategia 1 shell_exec php
        $cmd = $python." ".base_path('app\Python\src\Saluda.py');//lo concatenamos con el script de python
        //dd($cmd);
        $ans = shell_exec($cmd);
        //dd($cmd, $ans);
        return response()->json($ans, JsonResponse::HTTP_OK);
    }

    /**
     * Solicita la ejecucion de un script en python con symfony.
     *
     * @return \Illuminate\Http\Response
     */
    public function processDataSymfony()
    {
        // tener en cuenta la ruta del interprete de python
        $python = 'C:\Users\sebas\AppData\Local\Programs\Python\Python37\python.exe';
        
        // estrategia 2 process
        $process = new Process(
            [
                $python,
                base_path('app\Python\src\Saluda.py')
            ]
        );

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
            //return response()->json(["ERROR: " => "error en la ejecucion del script de python."], JsonResponse::HTTP_BAD_REQUEST);
        }

        return response()->json($process->getOutput(), JsonResponse::HTTP_OK);
    }
}
