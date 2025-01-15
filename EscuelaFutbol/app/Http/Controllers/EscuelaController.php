<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EscuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected static $api = "http://localhost:8087/APIRest/API/APIRest.php";
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

    public function categorias()
    {
        // Obtiene todas las categorías
        $categorias = Http::GET(static::$api . '?action=categorias');
        $categoriasArray = $categorias->json();

        $jugadorCategoria = Http::GET(static::$api . '?action=jugadores');
        $jugadorCategoriaArray = $jugadorCategoria->json();

        $jugadroSinCategoria = Http::GET(static::$api . '?action=jugadoresDisponibles');
        $jugadroSinCategoriaArray = $jugadroSinCategoria->json();

        return view('categorias', compact('categoriasArray', 'jugadorCategoriaArray', 'jugadroSinCategoriaArray'));
    }

    public function entrenadores()
    {
        // Obtiene todas las categorías
        $entrenador = Http::GET(static::$api . '?action=entrenador');
        $entrenadorArray = $entrenador->json();

        return view('entrenador', compact('entrendorArray'));
    }

    public function crearCategoria()
    {
        // Obtiene entrenadores y canchas para llenar los selects
        $entrenadores = Http::GET(static::$api . '?action=entrenadores');
        $entrenadoresArray = $entrenadores->json();

        $canchas = Http::GET(static::$api . '?action=canchas');
        $canchasArray = $canchas->json();

        return view('crearCategoria', compact('entrenadoresArray', 'canchasArray'));
    }

    public function asignarJugadorACategoria(Request $request)
    {
        $request->validate([
            'jugador' => 'required|exists:jugadores,id',
            'categoria' => 'required|exists:categorias,id',
        ]);
    
        $data = $request->only(['jugador', 'categoria']);
    
        // Intentar con asForm para enviar datos como un formulario
        $response = Http::asForm()->post(static::$api . '?action=jugadores', $data);
    
        if ($response->successful()) {
            return redirect('/Escuela/categorias')->with('success', 'Jugador asignado con éxito');
        } else {
            // Verificar la respuesta para obtener más detalles del error
            dd($response->body());
        }
    }
    
    

    public function guardarCategoria(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dia_entrenamiento' => 'required|array|min:1', 
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
            'id_cancha' => 'required|integer',
            'id_entrenador' => 'required|integer',
        ]);
 
        $data = $request->only([
            'nombre', 'dia_entrenamiento', 'hora_inicio', 'hora_fin', 'id_cancha', 'id_entrenador'
        ]);
    
        $response = Http::post(static::$api . '?action=categorias', $data);
  
        if ($response->successful()) {
            return redirect('/Escuela/categorias')->with('success', 'Categoría creada con éxito');
        } else {
            // Manejar el error de forma adecuada
            return back()->with('error', 'Error al crear la categoría');
        }
    }

    public function editarCategoria($id)
    {
        // Obtiene la categoría específica
        $categoria = Http::GET(static::$api . '?action=categorias&id=' . $id)->json();
    
        // Obtiene entrenadores y canchas para llenar los selects
        $entrenadores = Http::GET(static::$api . '?action=entrenadores');
        $entrenadoresArray = $entrenadores->json();
    
        $canchas = Http::GET(static::$api . '?action=canchas');
        $canchasArray = $canchas->json();
    
        return view('editarCategoria', compact('categoria', 'entrenadoresArray', 'canchasArray'));
    }    

    public function actualizarCategoria(Request $request, $id)
    {
       
        $request->validate([
            'nombre' => 'required|string|max:255',
            'dia_entrenamiento' => 'required|array',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
        ]);
    
        $data = $request->only(['nombre', 'dia_entrenamiento', 'hora_inicio', 'hora_fin']);
        $data['id'] = $id;
    
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->put(static::$api . '?action=categorias', $data);
    
        if ($response->successful()) {
            return redirect('/Escuela/categorias')->with('success', 'Categoría actualizada con éxito');
        } else {
            return back()->with('error', 'Error al actualizar la categoría');
        }
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

    public function eliminarCategoria($id)
    {
        Http::delete(static::$api . '?action=categorias&id=' . $id);

        return redirect('/Escuela/categorias');
    }
}
