<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;
use sisInv\Categoria;
use Illuminate\Support\Facades\Redirect;
use sisInv\Http\Requests\CategoriaFormReques;
use DB;

class CategoriaController extends Controller
{
   public function _construct()
   {
      $this->middleware('auth'); 
   } 
   public function index(Request $request)
   {
      if($request)
      {
          $query=trim($request->get('searchText'));
          $categorias=DB::table('categoria')
          ->groupBy('id_categoria')
          ->orderBy('id_categoria', 'desc')->get();
          return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
      }
   }
   public function create()
   {
return view("almacen.categoria.create");
   }
   public function store(CategoriaFormReques $request)
   {
          $categoria=new Categoria;
          $categoria->nombre=$request->get('nombre');
          $categoria->descripcion=$request->get('descripcion');
          $categoria->estado='1';
          $categoria->save();
          /* return Redirect::to('almacen/categoria'); */

          $id = $categoria->id_categoria;
          return isset($id) ? Redirect::to('almacen/categoria')->with('message', "Guardado Exitoso") : Redirect::to('almacen/categoria')->with('messagerr', "Error al Guardar");
          
   }
   public function show($id)
   {
      return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
   }
   public function edit($id)
       {
        return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
       }
   public function update(CategoriaFormReques $request,$id)
{
      $categoria=Categoria::findOrFail($id);
      $categoria->nombre=$request->get('nombre');
      $categoria->descripcion=$request->get('descripcion');
      $categoria->update();
      /* return Redirect::to('almacen/categoria'); */
      return isset($id) ? Redirect::to('almacen/categoria')->with('message', "Actualización Exitosa") : Redirect::to('almacen/categoria')->with('messagerr', "Error al Actualizar");

}

public function changStatus(Request $request)
{
   $categoria = Categoria::find($request->id);
   $categoria->estado= $request->status;
   $categoria->save();
/* return response()->json(['succes'=>'Estado Cambiado con Éxito']); */
  
}

public function saveNewCategoria(Request $request)
{


  /* return response()->json($request->all()); */


  $categoria=new Categoria;
  $categoria->nombre=$request->categoria;
  $categoria->descripcion=$request->descripcion;
  $categoria->estado='1';
  $categoria->save();


 $query = "SELECT * FROM categoria";
 $response = DB::select($query);
 return isset($categoria) ? response()->json($response) : response()->json(false);
}

}
