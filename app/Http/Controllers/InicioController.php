<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;


use sisInv\Articulos;
use sisInv\cliente;
use sisInv\proveedor;
use sisInv\productos;
use sisInv\ingreso;
use sisInv\venta;
use sisInv\User;
use sisInv\empresa;
use sisInv\Sucursal;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use DB;

class InicioController extends Controller
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

       //por usuario
       $user = Auth::user()->id; 
       $comprausr = DB::table('compra')->where('id_usuario','=',$user)->count();
       $ventausr = DB::table('venta')->where('id_usuario','=',$user)->count();

       $devComprausr=DB::table('com_devolucion_cab')->where('id_usuario','=',$user)->count();
       $devVentausr=DB::table('ven_devolucion_cab')->where('id_usuario','=',$user)->count();

       // general 
       $compra = DB::table('compra')->count();
       $venta = DB::table('venta')->count();

       $productos=DB::table('producto')->count();
       $proveedor=DB::table('com_proveedor')->count();
       $cliente=DB::table('ven_cliente')->count();


       $usuarios=DB::table('users')->count();
       $sucursal=DB::table('sucursal')->count();
       $empresa=DB::table('empresa')->count();

       $devCompra=DB::table('com_devolucion_cab')->count();
       $devVenta=DB::table('ven_devolucion_cab')->count();

       $bajostock = Articulos::selectRaw('id_producto, codigo, nombre , stock')
       ->whereRaw(DB::raw('stock <= 5'))->get();
       $evio_nota =  count($bajostock);


       return view('inicio.index',["evio_nota"=>$evio_nota,"productos"=>$productos,"proveedor"=>$proveedor,"cliente"=>$cliente,"comprausr"=>$comprausr,"ventausr"=>$ventausr,"bajostock"=>$bajostock,
       "devComprausr"=>$devComprausr,
       "devVentausr"=>$devVentausr,
       "usuarios"=>$usuarios,
       "compra"=>$compra,
       "venta"=>$venta,
       "sucursal"=>$sucursal,
       "empresa"=>$empresa,
       "devCompra"=>$devCompra,
       "devVenta"=>$devVenta,
       "searchText"=>$query]);
       }
    }
    
}

