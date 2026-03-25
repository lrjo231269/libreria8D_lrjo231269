<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    //metodo para realizar busqueda con google books api
    public function home()
    {
        //realizar la consulta a la api de google books para obtener libros de historia
        $history = Http::get('https://www.googleapis.com/books/v1/volumes', [
            //incluir el parametro de busqueda y la clave de api desde el archivo de configuracion
            'q' => 'subject:history', // Ejemplo de búsqueda por tema
            'maxResults' => 12, // Número máximo de resultados
            'key' => config('services.google_books.api_key'),
        ])->json()['items'] ?? []; // Obtener solo los libros o un arreglo vacío si no hay resultados


         //realizar la consulta a la api de google books para obtener libros de fantasia
        $fantasy = Http::get('https://www.googleapis.com/books/v1/volumes', [
            //incluir el parametro de busqueda y la clave de api desde el archivo de configuracion
            'q' => 'subject:fantasy', // Ejemplo de búsqueda por tema
            'maxResults' => 12, // Número máximo de resultados
            'key' => config('services.google_books.api_key'),
        ])->json()['items'] ?? []; // Obtener solo los libros o un arreglo vacío si no hay resultados
        
        //regresar la vista home con los libros obtenidos de la api
        return view('libros.home', compact('history', 'fantasy'));

    }

}
