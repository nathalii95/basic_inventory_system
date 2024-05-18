<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use DB;

class IndicadorVentasController extends Controller
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
           ->join('detalle_venta as dtc', 'p.id_producto', '=', 'dtc.id_producto_cab')
           ->select('p.id_producto','p.nombre',DB::raw('CONCAT(p.codigo, " ", p.nombre) AS articulo'),'p.codigo',
           'p.stock','c.nombre as categoria','p.modelo','c.id_categoria','p.marca','p.descripcion','p.imagen','p.estado')
           ->get();

           $categoria = DB::table('categoria')->get();
           $items6 = DB::table('producto as p')->join('detalle_compra as dtc', 'p.id_producto', '=', 'dtc.id_producto')->select('p.id_producto','p.nombre',DB::raw('CONCAT(p.codigo, " ", p.nombre) AS articulo'))->distinct()->get();

           $items5 = DB::table('producto as p')->join('detalle_compra as dtc', 'p.id_producto', '=', 'dtc.id_producto')->select('p.codigo')->distinct()->get();
           $items = DB::table('producto')->select('modelo')->distinct()->get();
           $items2 = DB::table('producto')->select('marca')->distinct()->get();
           $items4 = DB::table('users')->get();
           $items3 = DB::table('ven_cliente')->get();
           
          return view('ventas.indicadores.index',["producto"=>$producto,"categoria"=>$categoria,"items"=>$items,"items2"=>$items2,"items3"=>$items3,"items4"=>$items4,"items5"=>$items5,"items6"=>$items6,"searchText"=>$query]);
      }
    }


    public function  load1Venta(Request $request)
    
{

   $producto =  $request->nombre;
   $mas = $request->masVendido;
   $menos =  $request->menosVendido;
   $desde = $request->desde;
   $hasta = $request->hasta;
   $mensual = $request->mensual;
   $anual = $request->anual;
   $codigo = $request->codigo;
   $categoria = $request->categoria;
   $marca = $request->marca;
   $modelo  = $request->modelo;
   $cliente  = $request->cliente;
   $vendedor  = $request->vendedor;
   $forma = $request->forma_pago;

            $sql = "SELECT  v.num_comprobante,  v.forma_pago , upper(MONTHNAME(vd.created_at)) AS Mes,   Year(vd.created_at) as anio, p.codigo, p.nombre, p.stock, p.modelo, 
            p.marca, c.nombre as categoria, vd.cantidad, sum(Round(vd.total,2)) as total_venta, Date(vd.created_at) as fecha, 
            vd.precio_venta, v.id_cliente, v.id_usuario , vd.cant_dev , vc.nombre as cliente ";
            $sql .= " FROM producto p, detalle_venta vd, categoria c, venta v , ven_cliente vc";
            $sql .= " WHERE  p.id_producto = vd.id_producto_cab ";
            $sql .= ($producto != "") ? " AND p.id_producto = '{$producto}' " : ""; 
            $sql .= ($mensual != "") ? " AND  upper(MONTHNAME(vd.created_at)) = '{$mensual}' " : "";
            $sql .= ($anual != "") ? " AND Year(vd.created_at) = '{$anual}' " : "";
            $sql .= ($codigo != "") ? " AND p.codigo = '{$codigo}' " : "";
            $sql .= ($categoria != "") ? " AND p.id_categoria = '{$categoria}' " : "";
            $sql .= ($modelo != "") ? " AND p.modelo = '{$modelo}' " : "";
            $sql .= ($marca != "") ? " AND p.marca = '{$marca}' " : "";
            $sql .= ($cliente != "") ? " AND v.id_cliente = '{$cliente}' " : "";
            $sql .= ($vendedor != "") ? " AND v.id_usuario = '{$vendedor}' " : "";
            $sql .= ($forma != "") ? " AND v.forma_pago = '{$forma}' " : "";
            $sql .= ($desde != null) && ($hasta != null) ? " AND DATE(vd.created_at) BETWEEN '{$desde}' and '{$hasta}'  " : ""; 
            $sql .= " AND p.id_categoria = c.id_categoria ";
            $sql .= " AND vd.id_venta_cab = v.id_venta ";
            $sql .= " AND v.id_cliente = vc.id_cliente  ";
            $sql .= " group by vd.id_dt_venta";
            $sql .= " order by vd.id_dt_venta ";
/*             $sql .= " group by p.id_producto ";
            $sql .= " order by sum(Round(vd.total,2)) "; */
            $sql .= ($menos != "") ? " asc limit {$menos}  " : ""; 
            $sql .= ($mas != "") ? " desc limit {$mas} " : ""; 

            DB::statement("SET lc_time_names = 'es_ES'");
            $response = DB::select($sql);
            return response()->json($response);
}

 

}
