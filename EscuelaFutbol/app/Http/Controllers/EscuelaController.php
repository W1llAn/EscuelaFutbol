<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EscuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected static $api = "http://localhost/APIRest/API/APIRest.php";
    public function index()
    {
        return view('Inicio');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Inscripciones');
    }

    //HORARIOS
    public function horarios()
    {
        #TRAE LAS CATEGORIAS CON SUS RESPECTIVOS HORARIOS
        $horarios = Http::GET(static::$api . '?action=horario');
        $horariosArray = $horarios->json();

        #TRAE LOS ENTRENADORES
        $entrenadores = Http::GET(static::$api . '?action=entrenadores');
        $entrenadoresArray = $entrenadores->json();

        #TRAE LAS CANCHAS
        $canchas = Http::GET(static::$api . '?action=canchas');
        $canchasArray = $canchas->json();

        return view('horarios', compact('horariosArray', 'entrenadoresArray', 'canchasArray'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->input('idCat');
        $diasEntrenamiento = implode(',', $request->input('diasEntrenamiento'));
        $horaInicio = $request->input('horaInicio');
        $horaFin = $request->input('horaFin');
        $idCancha = $request->input('idCancha');
        $idEntrenador = $request->input('idEntrenador');

        /*  echo "id= $id
              dias = $diasEntrenamiento 
              horaInicio = $horaInicio
              horaFin = $horaFin
              idCancha = $idCancha
              idEntrenador = $idEntrenador"; */
        $data = [
            'idCat' => $id,
            'diaEntrenamiento' => $diasEntrenamiento,
            'horaInicio' => $horaInicio,
            'horaFin' => $horaFin,
            'idCancha' => $idCancha,
            'idEntrenador' => $idEntrenador
        ];
        /* $data = `idCat=$id&
                 diaEntrenamiento=$diasEntrenamiento&
                 horaInicio=$horaInicio&
                 horaFin=$horaFin&
                 idCancha=$idCancha&
                 idEntrenador=$idEntrenador`; */

        $respuesta = Http::asForm()->put(static::$api . '?action=horario', $data);
        return redirect('/Escuela/horarios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $type)
    {

        if ($type === "horario") {
            $respuesta = Http::delete(static::$api . "?action=horario&id=$id");
            return redirect('/Escuela/horarios');
        }
    }
}
