<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;
use sisInv\Producto;
use sisInv\HistorialProducto;
use Illuminate\Support\Facades\Redirect;
use DB;


class HistorialProController extends Controller
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



           $ingresohist = DB::table('historial_producto as histpro')
           ->join('producto as p', 'histpro.id_producto', '=', 'p.id_producto')
           ->join('users as u', 'histpro.id_usuario', '=', 'u.id')
           ->select('histpro.id_historialpro','u.name','histpro.*','p.nombre','p.codigo', 'p.stock as stockp', 'p.descuento', 'p.impuesto_valor', 'p.marca', 'p.color')
           ->groupBy('histpro.id_historialpro')
           ->orderBy('histpro.id_historialpro', 'desc')
           ->get();

           return view('almacen.historialpro.index',["ingresohist"=>$ingresohist,"searchText"=>$query]);
       }
    }
}
