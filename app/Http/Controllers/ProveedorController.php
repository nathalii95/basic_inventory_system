<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;
use sisInv\Proveedor;
use sisInv\Catalogo;
use Illuminate\Support\Facades\Redirect;
use sisInv\Http\Requests\ProveedorFormRequest;
use DB;

class ProveedorController extends Controller
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
           $proveedores=DB::table('com_proveedor')->where('nombre','LIKE','%'.$query.'%')
           ->orderBy('id_proveedor','desc')->get();
           /* ->paginate(7); */ //cantidad de registros
           return view('compras.proveedor.index',["proveedores"=>$proveedores,"searchText"=>$query]);
       }
    }
    public function create()
    {
      $catalogo=DB::table('sis_catalogo')->where('tipo','=','PAIS')->get();
      return view("compras.proveedor.create",["catalogo"=>$catalogo]);
    }
    public function store(ProveedorFormRequest $request)
    {
           $proveedor=new Proveedor;
           $proveedor->tipo_persona=$request->get('tipo_persona');
           $proveedor->tipo_documento=$request->get('tipo_documento');
           $proveedor->num_documento=$request->get('num_documento');
           $proveedor->nombre=$request->get('nombre');
           $proveedor->pais=$request->get('pais');
           $proveedor->provincia=$request->get('provincia');
           $proveedor->ciudad=$request->get('ciudad');
           $proveedor->direccion=$request->get('direccion');
           $proveedor->telefono=$request->get('telefono');
           $proveedor->email=$request->get('email');
           $proveedor->estado='1';
           $proveedor->save();
           /* return Redirect::to('compras/proveedor'); */
           $id = $proveedor->id_proveedor;
           return isset($id) ? Redirect::to('compras/proveedor')->with('message', "Guardado Exitoso") : Redirect::to('compras/proveedor')->with('messagerr', "Error al Guardar");
    }
    public function show($id)
    {
       return view("compras.proveedor.show",["proveedor"=>Proveedor::findOrFail($id)]);
    }
    public function edit($id)
        {
         $catalogo=DB::table('sis_catalogo')->where('tipo','=','PAIS')->get();
         return view("compras.proveedor.edit",["catalogo"=>$catalogo,"proveedor"=>Proveedor::findOrFail($id)]);
        }
    public function update(ProveedorFormRequest $request,$id)
 {
       $proveedor=Proveedor::findOrFail($id); //ME QUEDE AQUI
       $proveedor->tipo_persona=$request->get('tipo_persona');
       $proveedor->tipo_documento=$request->get('tipo_documento');
       $proveedor->num_documento=$request->get('num_documento');
       $proveedor->nombre=$request->get('nombre');
       $proveedor->pais=$request->get('pais');
     /*   $proveedor->provincia=$request->get('provincia'); */
       $proveedor->ciudad=$request->get('ciudad');
       $proveedor->direccion=$request->get('direccion');
       $proveedor->telefono=$request->get('telefono');
       $proveedor->email=$request->get('email');
       $proveedor->estado='1';
       $proveedor->update();
      /*  return Redirect::to('compras/proveedor'); */
       return isset($id) ? Redirect::to('compras/proveedor')->with('message', "Actualización Exitosa") : Redirect::to('compras/proveedor')->with('messagerr', "Error al Actualizar");

 }
 
 public function changStatusp(Request $request)
 {
    $categoria = Proveedor::find($request->id);
    $categoria->estado= $request->status;
    $categoria->update();
 /* return response()->json(['succes'=>'Estado Cambiado con Éxito']); */
   
 }

 public function changCedulaval(Request $request)
 {
  $cedulavalidate = DB::table('com_proveedor')
 ->select('num_documento')
  ->where('num_documento','=',$request->id)
  ->get();
  return response()->json($cedulavalidate);
 }

 public function byProyect($id)
 { 
    return Catalogo::where('grupo',$id)->get();
 }
 public function byProyectcity($id)
 { 
    return Catalogo::where('grupo',$id)->get();
 }

}
