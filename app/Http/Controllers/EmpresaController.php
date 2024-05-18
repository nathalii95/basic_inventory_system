<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;
use sisInv\Empresa;
use Illuminate\Support\Facades\Redirect;
use sisInv\Http\Requests\EmpresaFormRequest;
use DB;

class EmpresaController extends Controller
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
           $empresas=DB::table('empresa')
          /*  ->where ('estado','=','1'); */
           ->orderBy('id_empresa','desc')->get();
           /* ->paginate(4); */ //cantidad de registro
           return view('acceso.empresa.index',["empresas"=>$empresas,"searchText"=>$query]);
       }
    }
    public function create()
    {
 return view("acceso.empresa.create");
    }
    public function store(EmpresaFormRequest $request)
    {
           $empresa=new Empresa;
           $empresa->nombre_empresa	=$request->get('nombre_empresa');
           $empresa->ruc=$request->get('ruc');
           $empresa->r_legal=$request->get('r_legal');
           $empresa->direccion=$request->get('direccion');
           $empresa->telefono=$request->get('telefono');
           $empresa->email=$request->get('email');
           $empresa->contacto=$request->get('contacto');
           $empresa->estado='1';
           $empresa->save();
/*            return Redirect::to('acceso/empresa'); */
           $id = $empresa->id_empresa;
           return isset($id) ? Redirect::to('acceso/empresa')->with('message', "Guardado Exitoso") : Redirect::to('acceso/empresa')->with('messagerr', "Error al Guardar");
    }
    public function show($id)
    {
       return view("acceso.empresa.create.show",["empresa"=>Empresa::findOrFail($id)]);
    }
    public function edit($id)
        {
         return view("acceso.empresa.edit",["empresa"=>Empresa::findOrFail($id)]);
        }
    public function update(EmpresaFormRequest $request,$id)
 {
       $empresa=Empresa::findOrFail($id);
       $empresa->nombre_empresa	=$request->get('nombre_empresa');
       $empresa->ruc=$request->get('ruc');
       $empresa->r_legal=$request->get('r_legal');
       $empresa->direccion=$request->get('direccion');
       $empresa->telefono=$request->get('telefono');
       $empresa->email=$request->get('email');
       $empresa->contacto=$request->get('contacto');
       $empresa->estado='1';
       $empresa->update();
       return isset($id) ? Redirect::to('acceso/empresa')->with('message', "Actualización Exitosa") : Redirect::to('acceso/empresa')->with('messagerr', "Error al Actualizar");
 }
 
/*  public function destroy($id)
 {
     $empresa=Categoria::findOrFail($id);
     $empresa->estado='0';
     $empresa->update();
     return Redirect::to('acceso/empresa');
 } */

 public function changStatuse(Request $request)
{
   $empresa = Empresa::find($request->id);
   $empresa->estado= $request->status;
   $empresa->update();
/* return response()->json(['succes'=>'Estado Cambiado con Éxito']); */
  
}
 
}
