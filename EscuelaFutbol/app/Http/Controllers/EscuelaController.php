<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EscuelaController extends Controller
{
    protected static $Api = 'http://localhost/APIRest/API/APIRest.php';
    /**
     * Display a listing of the resource.
     */
    protected static $api = "http://localhost/APIRest/API/APIRest.php";
    public function index()
    {
        // URL de tu API REST
        $url = 'http://localhost/APIRest/API/APIRest.php';

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
