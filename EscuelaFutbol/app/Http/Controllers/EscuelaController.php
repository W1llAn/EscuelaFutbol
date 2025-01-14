<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EscuelaController extends Controller
{
    protected static $Api = 'http://localhost:8087/ApiEscuela/API/APIRest.php';
    public function index()
    {

        return view('Inicio');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}
    public function InscripcionesYpagos()
    {
        $Estudiantes = Http::GET(static::$Api . "?action=obtener");
        $EstudiantesArray = $Estudiantes->json();
        return view('Estudiantes', compact('EstudiantesArray'));
    }
    public function Inscripciones()
    {

        return view('InscripcionesYpagos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function guardarInscripcion(Request $request)
    {
        $respuesta = Http::asForm()->post(static::$Api . "?action=inscripcion", [
            'nombres' => $request->input('nombres'),
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
            'fechaNaci' => $request->input('fechaNaci')
        ]);

        return redirect('/Escuela/InscripcionesYpagos');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function buscar(string $nombre, string $type)
    {
        if ($type === 'buscar') {
            $Estudiantes = Http::GET(static::$Api . "?action=obtenerNombre&nombre=" . $nombre);
            $EstudiantesArray = $Estudiantes->json();

            if ($EstudiantesArray) {
                return view('Estudiantes', compact('EstudiantesArray'));
            } else {
                return redirect('/Escuela/InscripcionesYpagos')->with('error', 'Estudiante no encontrado.');
            }
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    public function editaEstudiante(string $id)
    {
        $Estudiantes =  Http::GET(static::$Api . "?action=obtener")->json();
        $Estudiante = collect($Estudiantes)->firstWhere('id', $id);
        return view('EditarEstudiante', with(['Estudiante' => $Estudiante]));
    }

    public function pagos(string $id)
    {
        $Estudiantes =  Http::GET(static::$Api . "?action=obtener")->json();
        $Estudiante = collect($Estudiantes)->firstWhere('id', $id);
        return view('Pagos', with(['Estudiante' => $Estudiante]));
    }

    public function updateEstudiante(Request $request, string $id, string $actualizarEstudiante)
    {
        if ($actualizarEstudiante === 'actualizarEstudiante') {
            $nombre = $request->input('nombres');
            $direccion = $request->input('direccion');
            $telefono = $request->input('telefono');
            $fechaNaci = $request->input('fechaNaci');

            $data = [
                'nombres' => $nombre,
                'direccion' => $direccion,
                'telefono' => $telefono,
                'fechaNaci' => $fechaNaci,
                'id' => $id
            ];
            $response = Http::asForm()->put(static::$Api . "?action=editarEstudiante", $data);

            return redirect('/Escuela/InscripcionesYpagos');
        }
    }

    public function updatePagos(Request $request, string $id)
    {
       
            $cantidad = $request->input('cantidad');
            $fechaPago = $request->input('fechaPago');


            $data = [
                'cantidad' => $cantidad,
                'fechaPago' => $fechaPago,
                'id' => $id
            ];
            $response = Http::asForm()->put(static::$Api . "?action=editarEstudiantePago", $data);

            return redirect('/Escuela/InscripcionesYpagos');
        
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
    public function eliminarInscripcion(String $id, String $type)
    {
        if ($type === 'eliminar') {
            try {
                // Hacer la solicitud DELETE a la API para eliminar la inscripción
                $response = Http::delete(static::$Api . "?action=eliminarInscripcionId&id=" . $id);

                // Verificar si la respuesta fue exitosa
                $data = $response->json(); // Convertir la respuesta JSON en un array

                if (isset($data['message'])) {
                    // Si la eliminación fue exitosa, redirigir con un mensaje de éxito
                    return redirect('/Escuela/InscripcionesYpagos')->with('success', $data['message']);
                } elseif (isset($data['error'])) {
                    // Si ocurrió un error (como clave foránea), mostrar el mensaje de error
                    return redirect('/Escuela/InscripcionesYpagos')->with('error', $data['error']);
                } else {
                    // Si no se recibió un mensaje adecuado
                    return redirect('/Escuela/InscripcionesYpagos')->with('error', 'Ocurrió un error inesperado.');
                }
            } catch (\Exception $e) {
                // Si ocurre un error durante la solicitud, capturarlo y mostrar un mensaje de error
                return redirect('/Escuela/InscripcionesYpagos')->with('error', 'Ocurrió un error al eliminar la inscripción: ' . $e->getMessage());
            }
        }
    }
}
