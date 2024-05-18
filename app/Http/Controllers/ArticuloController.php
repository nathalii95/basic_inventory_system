<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisInv\Articulos;
use sisInv\Http\Requests\ArticuloFormRequest;
use DB;
class ArticuloController extends Controller
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
           $articulos=DB::table('products as p')
          /*  ->join('categoria as c','p.id_categoria', '=','c.id_categoria')  */
           ->select('p.*'/* ,'c.nombre as categoria', */)/* ->orderBy('p.id_producto','desc') */->get();

    /*        ->where('p.nombre','LIKE','%'.$query.'%')
           ->orwhere('p.codigo','LIKE','%'.$query.'%')
           ->orderBy('p.id_producto','desc')
           ->paginate(7); */ //cantidad de registros paginación
           return view('almacen.articulo.index',["articulos"=>$articulos,"searchText"=>$query]);
       }  
    }
    public function create()
    {
       $impuesto=DB::table('impuesto')->where('codigo','=','pro')->get();  
       $categorias=DB::table('categoria')->where('estado','=','1')->get();  
     return view("almacen.articulo.create",["categorias"=>$categorias,"impuesto"=>$impuesto]);
    }
    public function store (ArticuloFormRequest $request)
    {
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
           $id = $articulo->id_producto;
           /* return Redirect::to('almacen/articulo'); */
           return isset($id) ? Redirect::to('almacen/articulo')->with('message', "Guardado Exitoso") : Redirect::to('almacen/articulo')->with('messagerr', "Error al Guardar");
    }
    
    public function show($id)
    {
        
       return view("almacen.articulo.show",["articulo"=>Articulos::findOrFail($id)]);
    }
    public function edit($id)
        {
          
            $articulo=Articulos::findOrFail($id);
            $categorias=DB::table('categoria')->where('estado','=','1')->get();

          /*   $extra = DB::table('compra as c')
            ->join('detalle_compra as dtc','c.id_compra', '=','dtc.id_compra_cab')
         
            ->join('com_proveedor as pr','c.id_proveedor', '=','pr.id_proveedor') 
            
            ->select('dtc.precio_compra', 'pr.nombre as proveedor','c.fecha as fechaCompra')
            ->where('dtc.id_producto','=',$articulo->id_producto)
            ->orderBy('dtc.id_dt_compra','desc','limit 1')
            ->first(); */

            
            $extra = DB::table('producto as p')
            ->where('p.id_producto','=',$articulo->id_producto)
            ->orderBy('p.id_producto')
            ->first();

             
             $impuesto=DB::table('impuesto')->where('codigo','=','pro')->get();  

    /*         $fechaVenta = DB::table('detalle_venta as dtv')
            ->where('id_producto_cab','=',$articulo->id_producto)
            ->select('created_at as fecha_venta')
            ->orderBy('id_dt_venta','desc','limit 1')->first(); */
              
/*             if($extra !=NULL){
               return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias,"extra"=>$extra]);
            }else {
               return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
            } */
            return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias,"extra"=>$extra,"impuesto"=>$impuesto]);

        
        }
    public function update(ArticuloFormRequest $request,$id)
 {
       $articulo=Articulos::findOrFail($id);
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
       $articulo->update();
/*        return Redirect::to('almacen/articulo'); */
       return isset($id) ? Redirect::to('almacen/articulo')->with('message', "Actualización Exitosa") : Redirect::to('almacen/articulo')->with('messagerr', "Error al Actualizar");

 }
 
 public function changStatusa(Request $request)
 {
    $articulo = Articulos::find($request->id);
    $articulo->estado= $request->status;
    $articulo->save();
 /* return response()->json(['succes'=>'Estado Cambiado con Éxito']); */
   
 }

 public function changCodigovalart(Request $request)
 {
  $codigovalidate = DB::table('producto')
 ->select('codigo')
  ->where('codigo','=',$request->id)
  ->get();
  return response()->json($codigovalidate);
 }
 
 public function changCodigoextvalart(Request $request)
 {
  $codigovalidateext = DB::table('producto')
 ->select('codigo_externo')
  ->where('codigo_externo','=',$request->id)
  ->get();
  return response()->json($codigovalidateext);
 }

 public function saveNewProducto(Request $request)
 {
 
 
   /* return response()->json($request->all()); */


   $articulo=new Articulos;
   $articulo->id_categoria=$request->categoria;
   $articulo->codigo=$request->codigo;
   $articulo->codigo_externo=$request->codigoexterno;
   $articulo->nombre=$request->nombre;
   $articulo->marca=$request->marca;
   $articulo->color=$request->color;
   $articulo->modelo=$request->modelo;
   $articulo->descripcion=$request->descripcion;
   $articulo->stock=$request->stock;
   $articulo->descuento=$request->descuento;
   $articulo->is_impuesto = $request->has('is_impuesto');
   $articulo->impuesto_valor=$request->impuesto_valor;
   $articulo->estado='Activo';  

      if(Input::hasFile('imagen')){
         $file=Input::file('imagen');
         $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
         $articulo->imagen=$file->getClientOriginalName();
     }   

  $articulo->save();
  $query = "SELECT * FROM producto";
  $response = DB::select($query);
  return isset($articulo) ? response()->json($response) : response()->json(false);
 }
}
