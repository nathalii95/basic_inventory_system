<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;
use sisInv\Cliente;
use Illuminate\Support\Facades\Redirect;
use sisInv\Http\Requests\ClienteFormRequest;
use DB;

class ClienteController extends Controller
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
           $clientes=DB::table('ven_cliente')
           ->orderBy('id_cliente','desc')->get(); //cantidad de registros
           return view('ventas.cliente.index',["clientes"=>$clientes,"searchText"=>$query]);
       }
    }
    public function create()
    {
    $catalogo=DB::table('sis_catalogo')->where('tipo','=','PAIS')->get();
    $impuesto=DB::table('impuesto')->where('codigo','=','cli')->get();  
    return view("ventas.cliente.create",["impuesto"=>$impuesto,"catalogo"=>$catalogo]);
    }
    public function store(ClienteFormRequest $request)
    {
           $cliente=new Cliente;
           $cliente->tipo_documento=$request->get('tipo_documento');
           $cliente->num_documento=$request->get('num_documento');
           $cliente->nombre=$request->get('nombre');
           $cliente->pais=$request->get('pais');
           $cliente->provincia=$request->get('provincia');
           $cliente->ciudad=$request->get('ciudad');
           $cliente->direccion=$request->get('direccion');
           $cliente->telefono=$request->get('telefono');
           $cliente->email=$request->get('email');
           $cliente->is_retencion = $request->has('is_retencion');
           $cliente->retencion_valor=$request->get('retencion_valor');
           $cliente->estado='1';
           $cliente->save();
          /*  return Redirect::to('ventas/cliente'); */
           $id = $cliente->id_cliente;
           return isset($id) ? Redirect::to('ventas/cliente')->with('message', "Guardado Exitoso") : Redirect::to('ventas/cliente')->with('messagerr', "Error al Guardar");
    }
    public function show($id)
    {
       return view("ventas.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
    }
    public function edit($id)
        {
         $catalogo=DB::table('sis_catalogo')->where('tipo','=','PAIS')->get();
         $impuesto=DB::table('impuesto')->where('codigo','=','cli')->get();  

         return view("ventas.cliente.edit",["cliente"=>Cliente::findOrFail($id),"impuesto"=>$impuesto,"catalogo"=>$catalogo]);
        }
    public function update(ClienteFormRequest $request,$id)
 {
       $cliente=Cliente::findOrFail($id); 
       $cliente->tipo_documento=$request->get('tipo_documento');
       $cliente->num_documento=$request->get('num_documento');
       $cliente->nombre=$request->get('nombre');
       $cliente->pais=$request->get('pais');
       $cliente->provincia=$request->get('provincia');
       $cliente->ciudad=$request->get('ciudad');
       $cliente->direccion=$request->get('direccion');
       $cliente->telefono=$request->get('telefono');
       $cliente->email=$request->get('email');
       $cliente->is_retencion = $request->has('is_retencion');
       $cliente->retencion_valor=$request->get('retencion_valor');
       $cliente->estado='1';
       $cliente->update();
       /* return Redirect::to('ventas/cliente'); */
       return isset($id) ? Redirect::to('ventas/cliente')->with('message', "Actualización Exitosa") : Redirect::to('ventas/cliente')->with('messagerr', "Error al Actualizar");
 }
 
 public function changStatusc(Request $request)
 {
    $cliente = Cliente::find($request->id);
    $cliente->estado= $request->status;
    $cliente->update();
 /* return response()->json(['succes'=>'Estado Cambiado con Éxito']); */
   
 }

 public function changCedulavalcli(Request $request)
 {
  $cedulavalidate = DB::table('ven_cliente')
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
