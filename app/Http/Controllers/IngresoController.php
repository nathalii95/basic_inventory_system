<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use sisInv\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisInv\Http\Requests\IngresoFormRequest;
use sisInv\Ingreso;
use sisInv\User;
use sisInv\DetalleIngreso;
use sisInv\HistorialProducto;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection; 
 
class IngresoController extends Controller
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
           $ingresos=DB::table('compra as c')
           ->join('com_proveedor as cp', 'c.id_proveedor', '=', 'cp.id_proveedor')
           ->select('c.id_compra', 'c.fecha', 'cp.nombre', 'c.serie_comprobante','c.tipo_comprobante', 'c.numero_comprobante', 
           'c.forma_pago','c.impuesto_porcentaje','c.estado','c.totalCompra')
           ->groupBy('c.id_compra')
           ->orderBy('c.id_compra', 'desc')
/*            ->where('c.numero_comprobante','LIKE','%'.$query.'%')
           ->orderBy('c.id_compra', 'desc') */->get();
          /*  ->paginate(7); */
           return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }
    }

    //Incluir informacion en vista Index
    public function create(){
        $date = Carbon::now();
        $datein = $date->format('d-m-Y');
        $f_emsion = \Carbon\Carbon::parse($datein)->format('d-m-Y');
        $f_caducidad =\Carbon\Carbon::parse($datein)->addYears(1)->format('d-m-Y');
        $users=DB::table('users')->get();  
        $proveedores=DB::table('com_proveedor')->where('estado','=','1')->get();
        $articulos = DB::table('producto as p')
        ->select( DB::raw('CONCAT(p.codigo, " ", p.nombre) AS articulo'), 'p.id_producto', 'p.descuento','p.impuesto_valor','p.stock' )
        ->where('p.estado','=','Activo')
        ->get();

        $impuesto=DB::table('impuesto')->where('codigo','=','pro')->get();  
        $categorias=DB::table('categoria')->where('estado','=','1')->get();  
        $compraCountf = DB::table('compra')->where('tipo_comprobante','=','FACTURA')->count();
        $var = $compraCountf + 1;
        $countCompra = str_pad($var ,9,"0", STR_PAD_LEFT);


        $compraCountnv = DB::table('compra')->where('tipo_comprobante','=','NOTA DE VENTA')->count();
        $varnv = $compraCountnv + 1;
        $countCompranv = str_pad($varnv ,9,"0", STR_PAD_LEFT);


        return view('compras.ingreso.create',["categorias"=>$categorias,"impuesto"=>$impuesto,"proveedores"=>$proveedores,"articulos"=>$articulos,"users"=>$users,"f_emsion"=>$f_emsion,"f_caducidad"=>$f_caducidad,"countCompra"=>$countCompra,"countCompranv"=>$countCompranv]);
    }

    //almacena los objetos para guardar de la tabla de BD
    public function store(IngresoFormRequest $request)
    {
        try{
            DB::beginTransaction();
            $ingreso=new Ingreso;
            $ingreso->id_proveedor=$request->get('id_proveedor');
            $ingreso->id_usuario= Auth::user()->id; 
            $ingreso->id_empresa= Auth::user()->id_empresa; 
            $ingreso->tipo_comprobante=$request->get('tipo_comprobante');
            $ingreso->serie_comprobante=$request->get('serie_comprobante');
            $ingreso->numero_comprobante=$request->get('numero_comprobante');
            $ingreso->forma_pago=$request->get('forma_pago');
          
            $date0 = $request->fecha;
            $fecha0 = \Carbon\Carbon::parse($date0)->format('d-m-Y');
            $ingreso->fecha=$fecha0;
           

            $date2 = $request->fecha_caducidad;
            $fecha2 = \Carbon\Carbon::parse($date2)->format('d-m-Y');
            $ingreso->fecha_caducidad=$fecha2;
            
            
            $ingreso->subtotal=$request->get('subtotal');
            $ingreso->descuento=$request->get('descuentop');
            $ingreso->descuento_porcentaje=$request->get('descuento_porcentajep');
            $ingreso->impuesto = $request->get('impuesto');
            $ingreso->impuesto_porcentaje=$request->get('impuesto_porcentaje');
            $ingreso->totalCompra=$request->get('totalCompra');
            $ingreso->retencion='0';
            $ingreso->retencion_porcentaje='0';
            /*$ingreso->retencion=$request->get('retencion');
            $ingreso->retencion_porcentaje=$request->get('retencion_porcentaje'); */
            $ingreso->observacion=$request->get('observacion');
/*             $ingreso->documento= 'pasData'; */
            if(Input::hasFile('imagen')){
                $file=Input::file('imagen');
                $file->move(public_path().'/imagenes/documentos/',$file->getClientOriginalName());
                $ingreso->documento=$file->getClientOriginalName();
            }     
            $ingreso->estado='1';

            $ingreso->save();
           /*  echo $ingreso; */
            
            $id_producto = $request->get('id_producto');
            $cantidad = $request->get('cantidad');
            $precio_unitario = $request->get('precio_unitario');
            $descuento_porcentaje = $request->get('descuento_porcentaje');
            $descuento = $request->get('descuento');
            $iva_porcentajepro = $request->get('iva_porcentajepro');
            $ivapro = $request->get('ivapro');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;


            $proveedor = DB::table('com_proveedor')
            ->select('nombre')
            ->where('id_proveedor','=',$ingreso->id_proveedor)
            ->first();

            while($cont < count($id_producto)){
                $detalle = new DetalleIngreso();
                $detalle->id_compra_cab= $ingreso->id_compra;
                $detalle->id_producto= $id_producto[$cont];
                $detalle->cantidad= $cantidad[$cont];
                $detalle->precio_unitario= $precio_unitario[$cont];
                $detalle->descuento_porcentaje= $descuento_porcentaje[$cont];
                $detalle->descuento= $descuento[$cont];  
                $detalle->iva_porcentaje =  ($iva_porcentajepro[$cont] == "" || $iva_porcentajepro[$cont] == null) ? "0" : $iva_porcentajepro[$cont];
                $detalle->iva= $ivapro[$cont];   
                $detalle->precio_compra= $precio_compra[$cont];
                $detalle->precio_venta= $precio_venta[$cont];
                $detalle->cant_dev ='0';
                $detalle->save();
                /* echo ($detalle); */
                $cont=$cont+1;

                $stockveri = DB::table('producto')
                ->select('stock')
                ->where('id_producto','=', $detalle->id_producto )
                ->first();
            
               

                $histproduct = new HistorialProducto();
                $histproduct->id_empresa  = $ingreso->id_empresa; 
                $histproduct->persona  = $proveedor->nombre;  
                $histproduct->id_usuario  = $ingreso->id_usuario;
                $histproduct->id_compra_cab  = $ingreso->id_compra;
                $histproduct->id_dt_compra  = $detalle->id_dt_compra;
                $histproduct->tipo_comprobante  = $ingreso->tipo_comprobante;
                $histproduct->serie_comprobante  = $ingreso->serie_comprobante; 
                $histproduct->numero_comprobante  = $ingreso->numero_comprobante;
                $histproduct-> tipo_mov  = "Compra";
                $histproduct-> detalle =  "Ingreso de Mercaderia, $ingreso->tipo_comprobante: N°-$ingreso->serie_comprobante-$ingreso->numero_comprobante";
                $histproduct-> id_producto  = $detalle->id_producto; 
                $histproduct-> stock  = $stockveri->stock;
                $histproduct->cantidad  = $detalle->cantidad;
                $histproduct->precio  = $detalle->precio_unitario;
                $histproduct->costo_total  =  $detalle->precio_compra;
                $date3 = $ingreso->fecha;
                $fecha3 = \Carbon\Carbon::parse($date3)->format('d-m-Y');
                $histproduct->fecha  = $fecha3;
                $histproduct->save();


            }
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
        }
         
        $id = $ingreso->id_compra;
        $ids =  $detalle->id_dt_compra;

        return isset($id) && isset($ids) ? Redirect::to('compras/ingreso')->with('message', "Guardado Exitoso") : Redirect::to('compras/ingreso')->with('messagerr', "Error al Guardar");

    }

    public function show($id)
    {
       $ingreso = DB::table('compra as c')
       ->join('com_proveedor as cp', 'c.id_proveedor', '=', 'cp.id_proveedor')
       ->join('detalle_compra as dtc', 'c.id_compra', '=', 'dtc.id_compra_cab')
       ->join('users as u', 'c.id_usuario', '=', 'u.id')
       ->select('c.id_compra', 'c.fecha', 'u.name','cp.nombre','c.serie_comprobante', 'c.tipo_comprobante', 'c.numero_comprobante',
        'c.forma_pago','c.impuesto','c.descuento','c.fecha_caducidad',
        'c.descuento_porcentaje','c.subtotal','c.totalCompra','c.impuesto_porcentaje',
        'c.observacion','c.estado',DB::raw('sum(dtc.cantidad*dtc.precio_compra) as total'))
        ->where ('c.id_compra','=',$id)
        ->first();

    $detalles= DB::table('detalle_compra as dtc')
    ->join('producto as p', 'dtc.id_producto', '=', 'p.id_producto')
    ->select('p.nombre as articulo','dtc.id_producto','dtc.id_dt_compra','dtc.cantidad','dtc.precio_unitario','dtc.descuento_porcentaje','dtc.descuento','dtc.iva_porcentaje','dtc.iva','dtc.precio_compra','dtc.precio_venta')
    ->where('dtc.id_compra_cab','=',$id)->get();

       return view("compras.ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);
    }

    public function showprinti($id)
    {
       
       $ingreso = DB::table('compra as c')
       ->join('com_proveedor as cp', 'c.id_proveedor', '=', 'cp.id_proveedor')
       ->join('detalle_compra as dtc', 'c.id_compra', '=', 'dtc.id_compra_cab')
       ->select('c.id_compra','c.id_proveedor', 'c.fecha','cp.nombre','cp.nombre','cp.pais','cp.provincia','cp.ciudad','cp.tipo_documento','cp.direccion','cp.num_documento','cp.telefono','cp.email','c.serie_comprobante', 'c.tipo_comprobante', 'c.numero_comprobante',
        'c.forma_pago','c.impuesto','c.descuento','c.fecha_caducidad',
        'c.descuento_porcentaje','c.subtotal','c.totalCompra','c.impuesto_porcentaje',
        'c.observacion','c.estado')
        ->where ('c.id_compra','=',$id)
        ->first();

    $detalles= DB::table('detalle_compra as dtc')
    ->join('producto as p', 'dtc.id_producto', '=', 'p.id_producto')
    ->select('p.nombre as articulo','dtc.id_producto','dtc.id_dt_compra','dtc.cantidad','dtc.precio_unitario','dtc.iva_porcentaje','dtc.iva',
    'dtc.descuento_porcentaje','dtc.descuento','dtc.precio_compra','dtc.precio_venta')
    ->where('dtc.id_compra_cab','=',$id)->get();

       return view("compras.ingreso.showprint",["ingreso"=>$ingreso,"detalles"=>$detalles
    ]);
    }

 public function changStatusi(Request $request)
{
   $categoria = Ingreso::find($request->id);
   $categoria->estado= $request->status;
   $categoria->update();
/* return response()->json(['succes'=>'Estado Cambiado con Éxito']); */
  
}



}
