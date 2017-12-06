<?php

namespace App\Http\Controllers;

use App\biblioteca;
use App\libros;
use Auth;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BibliotecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //
        //dd(Auth::user());

        $libros = DB::table('biblioteca')
            ->join('libros','libros.titulo','=','biblioteca.libro')
            ->select('libros.titulo','libros.descripcion','libros.autor', 'libros.portada','libros.id')
            ->where('biblioteca.usuario','=', Auth::user()->id)
            ->get();

        $cantLibros = DB::table('biblioteca')
            ->select(DB::raw('count(*) as cantidad'))
            ->where('biblioteca.usuario','=', Auth::user()->id)
            ->get();

        return view('app/biblioteca',compact(['libros','cantLibros']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        
        //validando datos
        $this->validate($request, [
            'titulo' => 'required|string|filled|max:50',
            'autor' => 'required|string|filled|max:20',
            'descripcion' => 'required|string|filled|max:255',
            'year' => 'required|numeric|filled|min:4',  
        ]);
        //dd($request);

        //Agregar portada
        $portada = $request->portada;
        $filename = time() . '.' . $portada->getClientOriginalExtension();
        Image::make($portada)->resize(300, 300)->save( public_path('/uploads/portadas/' . $filename ) );

        //agregando todos los datos
        $libros = new libros;
        $libros->titulo = $request['titulo'];
        $libros->descripcion = $request['descripcion'];
        $libros->autor = $request['autor'];
        $libros->year = $request['year'];
        $libros->portada = $filename;
        $libros->save();

        $biblioteca = new biblioteca;
        $biblioteca->usuario = Auth::user()->id;
        $biblioteca->libro = request('titulo');
        $biblioteca->save();

        return redirect('/app/biblioteca')->with('libro actualizado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function show(biblioteca $biblioteca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function edit(biblioteca $biblioteca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, biblioteca $biblioteca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table("biblioteca")->where('libro',$id)->delete();
        DB::table("libros")->where('id',$id)->delete();
        return back()->withMessage('Role Deleted');
    }
}
