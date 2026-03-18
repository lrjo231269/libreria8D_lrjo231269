<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Usar el modelo
use App\Models\Libro;

class LibroController extends Controller
{
    /**
     * Mostrar elementos de la base de datos
     */
    public function index()
    {
        // Obtener información de la base de datos
        $libros = Libro::all();

        return view('libros.index', compact('libros'));
    }
    /**
     * Función insertar
     */
    public function create()
    {
        return view('libros.create');
    }
    
    /**
     * Guardar información en la base de datos
     */
    public function store(Request $request)
    {
        // Usa el modelo para mandar la información a la BD
        Libro::create([
            // <NombreFormulario => $request-><NombreBD>
            'nombre' => $request->nombre,
            'autor' => $request->autor,
            'editorial' => $request->editorial,
            'precio' => $request->precio
        ]);

        // Redireccionar al usuario al formulario
        return redirect()->route('libros.create');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Editar registro
     */
    public function edit(Libro $libro)
    {
        // Regresar datos del libro
        return view('libros.edit', compact('libro'));
    }

    /**
     * Actualizar registro
     */
    public function update(Request $request, Libro $libro)
    {
        // Crear la validación para el formulario
        $request->validate([
            'nombre' => 'required',
            'autor' => 'required',
            'editorial' => 'required',
            'precio' => 'required'
        ]);
        // Indicar actualización de todos los campos
        $libro->update($request->all());

        // Redirigir al usuario al index y enviarle un mensaje
        return redirect()->route('libros.index')
        ->with('success', 'Actualizaión exitosa');
    }

    /**
     * Eliminar 
     */
    public function destroy(Libro $libro)
    {
        // Función para eliminar registro.
        $libro -> delete();

        return redirect()->route('libros.index')
        ->with('success', 'Libro eliminado');
    }
}
