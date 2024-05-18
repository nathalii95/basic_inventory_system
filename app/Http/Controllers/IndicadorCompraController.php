<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;


class IndicadorCompraController extends Controller
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
           ->join('detalle_compra as dtc', 'p.id_producto', '=', 'dtc.id_producto')

           ->select('p.id_producto','p.nombre',DB::raw('CONCAT(p.codigo, " ", p.nombre) AS articulo'),'p.codigo',
           'p.stock','c.nombre as categoria','p.modelo','c.id_categoria','p.marca','p.descripcion','p.imagen','p.estado')
           ->get();

           $categoria = DB::table('categoria')->get();
           $items6 = DB::table('producto as p')->join('detalle_compra as dtc', 'p.id_producto', '=', 'dtc.id_producto')->select('p.id_producto','p.nombre',DB::raw('CONCAT(p.codigo, " ", p.nombre) AS articulo'))->distinct()->get();
           $items5 = DB::table('producto as p')->join('detalle_compra as dtc', 'p.id_producto', '=', 'dtc.id_producto')->select('p.codigo')->distinct()->get();
           $items = DB::table('producto')->select('modelo')->distinct()->get();
           $items2 = DB::table('producto')->select('marca')->distinct()->get();
           $items4 = DB::table('users')->get();
           $items3 = DB::table('com_proveedor')->get();
           
          return view('compras.indicadores.index',["producto"=>$producto,"categoria"=>$categoria,"items"=>$items,"items2"=>$items2,"items3"=>$items3,"items4"=>$items4,"items5"=>$items5,"items6"=>$items6,"searchText"=>$query]);
      }
    }


    public function  loadCompra(Request $request)
    
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
   $proveedor  = $request->proveedor;
   $usuario  = $request->usuario;
   $forma  = $request->forma_pago;
   

            $sql = "SELECT c.numero_comprobante, c.forma_pago, dc.id_dt_compra, c.id_proveedor , cp.nombre as proveedor , c.id_usuario,
           u.name as cliente, upper(MONTHNAME(dc.created_at)) AS Mes,Year(dc.created_at) as anio, p.codigo, p.nombre, p.modelo, p.marca, ca.nombre as categoria, 
           dc.cantidad, dc.precio_unitario , dc.precio_compra, dc.precio_venta,  Date(dc.created_at) as fecha, dc.cant_dev  ";
            $sql .= " FROM producto p, detalle_compra dc, categoria ca, compra c, users u, com_proveedor cp ";
            $sql .= " WHERE  p.id_producto = dc.id_producto ";
            $sql .= ($producto != "") ? " AND p.id_producto = '{$producto}' " : ""; 
            $sql .= ($mensual != "") ? " AND  upper(MONTHNAME(dc.created_at)) = '{$mensual}' " : "";
            $sql .= ($anual != "") ? " AND Year(dc.created_at) = '{$anual}' " : "";
            $sql .= ($codigo != "") ? " AND p.codigo = '{$codigo}' " : "";
            $sql .= ($categoria != "") ? " AND p.id_categoria = '{$categoria}' " : "";
            $sql .= ($modelo != "") ? " AND p.modelo = '{$modelo}' " : "";
            $sql .= ($marca != "") ? " AND p.marca = '{$marca}' " : "";
            $sql .= ($proveedor != "") ? " AND c.id_proveedor = '{$proveedor}' " : "";
            $sql .= ($usuario != "") ? " AND c.id_usuario = '{$usuario}' " : "";
            $sql .= ($forma != "") ? " AND c.forma_pago = '{$forma}' " : "";
          
            $sql .= ($desde != null) && ($hasta != null) ? " AND DATE(dc.created_at) BETWEEN '{$desde}' and '{$hasta}'  " : ""; 
            $sql .= " AND p.id_categoria = ca.id_categoria ";
            $sql .= " AND dc.id_compra_cab = c.id_compra ";
            $sql .= " AND c.id_proveedor = cp.id_proveedor  ";
            $sql .= " group by dc.id_dt_compra ";
            $sql .= " order by dc.id_dt_compra ";
         /*    $sql .= " group by p.id_producto ";
            $sql .= " order by sum(Round(vd.total,2)) "; */
            $sql .= ($menos != "") ? " asc limit {$menos}  " : ""; 
            $sql .= ($mas != "") ? " desc limit {$mas} " :  ""; 

            DB::statement("SET lc_time_names = 'es_ES'");
            $response = DB::select($sql);
            return response()->json($response);
}

}
