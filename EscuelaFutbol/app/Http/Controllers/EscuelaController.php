<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EscuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // URL de tu API REST
        $url = 'http://localhost:8080/MisProyectos/EscuelaFutbol-feature-home/APIRest/API/APIRest.php';

        // Realizar la solicitud GET para el primer gráfico
        $actionPrimerGrafico = 'obtenerPrimerGrafico';
        $responsePrimerGrafico = Http::get($url . '?action=' . $actionPrimerGrafico);

        // Realizar la solicitud GET para el segundo gráfico
        $actionSegundoGrafico = 'obtenerSegundoGrafico';
        $responseSegundoGrafico = Http::get($url . '?action=' . $actionSegundoGrafico);

        // Comprobar si la solicitud para ambos gráficos fue exitosa
        if ($responsePrimerGrafico->successful() && $responseSegundoGrafico->successful()) {
            // Decodificar las respuestas JSON
            $dataPrimerGrafico = $responsePrimerGrafico->json();
            $dataSegundoGrafico = $responseSegundoGrafico->json();

            // Pasar los datos a la vista
            return view('Inicio', [
                'primerGrafico' => $dataPrimerGrafico,
                'segundoGrafico' => $dataSegundoGrafico
            ]);
        } else {
            // Si hubo un error con alguna de las solicitudes
            return response()->json(['error' => 'Error al obtener los datos'], 500);
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Inscripciones');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
