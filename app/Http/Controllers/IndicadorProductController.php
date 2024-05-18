<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;
use sisInv\Http\Requests;
use sisInv\Articulos;
use Illuminate\Support\Facades\Redirect;
use DB;


class IndicadorProductController extends Controller
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
          $producto=DB::table('producto as p')
           ->join('categoria as c','p.id_categoria', '=','c.id_categoria') 
           ->select('p.id_producto','p.nombre',DB::raw('CONCAT(p.codigo, " ", p.nombre) AS articulo'),'p.codigo',
           'p.stock','c.nombre as categoria','p.modelo','c.id_categoria','p.marca','p.descripcion','p.estado')
           ->get();

           $categoria = DB::table('categoria')->get();
           $items = DB::table('producto')->select('modelo')->distinct()->get();
           $items2 = DB::table('producto')->select('marca')->distinct()->get();
           
           
          return view('almacen.indicadores.index',["producto"=>$producto,"categoria"=>$categoria, "items"=>$items,"items2"=>$items2,"searchText"=>$query]);
      }
    }


    public function  load1Product(Request $request)
    
{

   $producto =  $request->nombre;
   $desde = $request->desde;
   $hasta = $request->hasta;
   $mensual = $request->mensual;
   $anual = $request->anual;
   $codigo = $request->codigo;
   $categoria = $request->categoria;
   $marca = $request->marca;
   $modelo  = $request->modelo;
   $iva  = $request->iva;

      /* if($mas != ""){
       
         
         $sql = "SELECT  upper(MONTHNAME(vd.created_at)) AS Mes,  Year(vd.created_at) as anio, p.codigo, p.nombre, p.stock, p.modelo, p.marca, c.nombre as categoria, sum(Round(vd.cantidad)) as cantidad, sum(Round(vd.total,2)) as total_venta, Date(vd.created_at) as fecha";
         $sql .= " from producto p, detalle_venta vd, categoria c ";
         $sql .= " where p.id_producto = vd.id_producto_cab ";
      
         $sql .= ($producto != "") ? " AND p.id_producto = '{$producto}' " : "";
         $sql .= ($mensual != "") ? " AND  upper(MONTHNAME(vd.created_at)) = '{$mensual}' " : "";
         $sql .= ($anual != "") ? " AND Year(vd.created_at) = '{$anual}' " : "";
         $sql .= ($codigo != "") ? " AND p.codigo = '{$codigo}' " : "";
         $sql .= ($categoria != "") ? " AND c.nombre = '{$categoria}' " : "";
         $sql .= ($modelo != "") ? " AND p.modelo = '{$modelo}' " : "";
         $sql .= ($marca != "") ? " p.marca = '{$marca}' " : "";
         $sql .= ($desde != null) && ($hasta != null) ? " AND DATE(vd.created_at) BETWEEN '{$desde}' and '{$hasta}'  " : "";  
         $sql .= " AND p.id_categoria = c.id_categoria  ";
         $sql .= " group by p.id_producto ";
         $sql .= " order by sum(Round(vd.total,2)) ";  
         $sql .= " desc limit {$mas}";  

         DB::statement("SET lc_time_names = 'es_ES'");
         $response = DB::select($sql);
         
         return response()->json($response);

         } else if($menos != ""){
            $sql = "SELECT  upper(MONTHNAME(vd.created_at)) AS Mes,   Year(vd.created_at) as anio, p.codigo, p.nombre, p.stock, p.modelo, p.marca, c.nombre as categoria, sum(Round(vd.cantidad)) as cantidad, sum(Round(vd.total,2)) as total_venta, Date(vd.created_at) as fecha";
            $sql .= " from producto p, detalle_venta vd, categoria c ";
            $sql .= " where p.id_producto = vd.id_producto_cab ";
         
            $sql .= ($producto != "") ? " AND p.id_producto = '{$producto}' " : "";
            $sql .= ($mensual != "") ? " AND  upper(MONTHNAME(vd.created_at)) = '{$mensual}' " : "";
            $sql .= ($anual != "") ? " AND Year(vd.created_at) = '{$anual}' " : "";
            $sql .= ($codigo != "") ? " AND p.codigo = '{$codigo}' " : "";
            $sql .= ($categoria != "") ? " AND c.nombre = '{$categoria}' " : "";
            $sql .= ($modelo != "") ? " AND p.modelo = '{$modelo}' " : "";
            $sql .= ($marca != "") ? " p.marca = '{$marca}' " : "";
            $sql .= ($desde != "" && $hasta != "") ? " AND Date(vd.created_at) between '{$desde}' and '{$hasta}' " : "";      
            $sql .= " AND p.id_categoria = c.id_categoria";
            $sql .= " group by p.id_producto  ";
            $sql .= " order by sum(Round(vd.total,2)) ";  
            $sql .= " asc limit {$menos}";  
         
            DB::statement("SET lc_time_names = 'es_ES'");
            $response = DB::select($sql);
            return response()->json($response);
      
         }else{ */
            $sql = "SELECT p.id_producto, upper(MONTHNAME(p.created_at)) AS Mes,   Year(p.created_at) as anio, 
            p.codigo, p.nombre, p.stock, p.modelo, p.marca, c.nombre as categoria,  Date(p.created_at) as fecha, is_impuesto, impuesto_valor, descuento ";
            $sql .= " FROM producto p, categoria c ";
            $sql .= " WHERE  p.id_categoria = c.id_categoria  ";
            $sql .= ($producto != "") ? " AND p.id_producto = '{$producto}' " : ""; 
            $sql .= ($mensual != "") ? " AND  upper(MONTHNAME(p.created_at)) = '{$mensual}' " : "";
            $sql .= ($anual != "") ? " AND Year(p.created_at) = '{$anual}' " : "";
            $sql .= ($codigo != "") ? " AND p.codigo = '{$codigo}' " : "";
            $sql .= ($categoria != "") ? " AND p.id_categoria = '{$categoria}' " : "";
            $sql .= ($modelo != "") ? " AND p.modelo = '{$modelo}' " : "";
            $sql .= ($marca != "") ? " AND p.marca = '{$marca}' " : "";
            $sql .= ($iva != "") ? " AND p.is_impuesto = '{$iva}' " : "";
            $sql .= ($desde != null) && ($hasta != null) ? " AND DATE(p.created_at) BETWEEN '{$desde}' and '{$hasta}'  " : ""; 
            $sql .= " order by p.created_at asc ";

            DB::statement("SET lc_time_names = 'es_ES'");
            $response = DB::select($sql);
            return response()->json($response);
         /* } */
}

 

}
