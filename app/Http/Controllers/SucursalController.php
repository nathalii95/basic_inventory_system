<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;

use sisInv\Sucursal;
use Illuminate\Support\Facades\Redirect;
use sisInv\Http\Requests\SucursalFormRequest;
use DB;use sisInv\User;

class SucursalController extends Controller
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
           $sucursales=DB::table('sucursal as s')
           ->join('empresa as e','s.id_empresa', '=','e.id_empresa') 
           ->select('s.id_sucursal','s.id_empresa','s.nombre','s.telefono',
           's.ciudad','s.direccion','s.email','s.encargado','s.estado','e.nombre_empresa')
           ->orderBy('s.id_sucursal','desc')->get();

    /*        ->where('p.nombre','LIKE','%'.$query.'%')
           ->orwhere('p.codigo','LIKE','%'.$query.'%')
           ->orderBy('p.id_producto','desc')
           ->paginate(7); */ //cantidad de registros paginación
           return view('acceso.sucursal.index',["sucursales"=>$sucursales,"searchText"=>$query]);
       }  
    }

    public function byProyect($id)
    { 
       return Sucursal::where('id_empresa',$id)->get();
    }


    public function create()
    {
    $empresas=DB::table('empresa')->where('estado','=','1')->get();  
     return view("acceso.sucursal.create",["empresas"=>$empresas]);
    }
    public function store(SucursalFormRequest $request)
    
    {
           $empresa=new Sucursal;
           $empresa->id_empresa=$request->get('id_empresa');
           $empresa->nombre=$request->get('nombre');
           $empresa->telefono=$request->get('telefono');
           $empresa->ciudad=$request->get('ciudad');
           $empresa->direccion=$request->get('direccion');
           $empresa->email=$request->get('email');
           $empresa->encargado=$request->get('encargado');
           $empresa->estado='1'; 
           $empresa->save();

          /*  return Redirect::to('acceso/sucursal'); */
           $id= $empresa->id_sucursal;
           return isset($id) ? Redirect::to('acceso/sucursal')->with('message', "Guardado Exitoso") : Redirect::to('acceso/sucursal')->with('messagerr', "Error al Guardar");
    }
    
    public function show($id)
    {
       return view("acceso.sucursal.show",["sucursal"=>Sucursal::findOrFail($id)]);
    }
    public function edit($id)
        {
            $sucursales=Sucursal::findOrFail($id);
            $empresas=DB::table('empresa')->where('estado','=','1')->get();

         return view("acceso.sucursal.edit",["empresas"=>$empresas,"sucursales"=>Sucursal::findOrFail($id)]);
        }
        
    public function update(SucursalFormRequest $request,$id)
 { 
    $sucursal=Sucursal::findOrFail($id);
    $sucursal->id_empresa=$request->get('id_empresa');
    $sucursal->nombre=$request->get('nombre');
    $sucursal->telefono=$request->get('telefono');
    $sucursal->ciudad=$request->get('ciudad');
    $sucursal->direccion=$request->get('direccion');
    $sucursal->email=$request->get('email');
    $sucursal->encargado=$request->get('encargado');

    $sucursal->update();
       /* return Redirect::to('acceso/sucursal'); */
     return isset($id) ? Redirect::to('acceso/sucursal')->with('message', "Actualización Exitosa") : Redirect::to('acceso/sucursal')->with('messagerr', "Error al Actualizar");

 }
 
 public function changStatuss(Request $request)
 {
    $sucursal = Sucursal::find($request->id);
    $sucursal->estado= $request->status;
    $sucursal->save();
 /* return response()->json(['succes'=>'Estado Cambiado con Éxito']); */
   
 }
 
}
