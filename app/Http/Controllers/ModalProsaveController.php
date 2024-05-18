<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisInv\Articulos;
use sisInv\Http\Requests\ArticuloFormRequest;
use DB;

class ModalProsaveController extends Controller
{
    

public function store(Request $request)
{
    try{
        DB::beginTransaction();

        $articulo=new Articulos;
        $articulo->id_categoria=$request->get('id_categoria');
        $articulo->codigo=$request->get('codigo');
        $articulo->codigo_externo=$request->get('codigoexterno');
        $articulo->nombre=$request->get('nombre');
        $articulo->marca=$request->get('marca');
        $articulo->color=$request->get('color');
        $articulo->modelo=$request->get('modelo');
        $articulo->descripcion=$request->get('descripcion');
        $articulo->stock=$request->get('stock');
        $articulo->descuento=$request->get('descuento');
       /*  $articulo->is_impuesto=$request->get('is_impuesto'); */
         $articulo->is_impuesto = $request->has('is_impuesto');
        $articulo->impuesto_valor=$request->get('impuesto_valor');
        $articulo->estado='Activo';  
        if(Input::hasFile('imagen')){
            $file=Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
            $articulo->imagen=$file->getClientOriginalName();
        } 
        
        $articulo->save();

        DB::commit();
    }
    catch(\Exception $e)
    {
        DB::rollback();
    }
    return Redirect::back();

/*     return redirect()->action('IngresoController@create')->withInput(); */

    /* return Redirect::back()->with('message','Operation Successful !'); */

  /*   return Redirect::to('compras/ingreso/create'); */
}


}


