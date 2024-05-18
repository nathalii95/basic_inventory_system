<?php

namespace sisInv\Http\Controllers;
use Illuminate\Http\Request;
use sisInv\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisInv\Http\Requests\DevolucionCompraFormRequest;
use sisInv\DevolucionCompra;
use sisInv\User;
use sisInv\DevolucionDetalleCompra;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection; 
use sisInv\Ingreso;
use sisInv\DetalleIngreso; 
use sisInv\Articulos;
use sisInv\HistorialProducto;

class DevolucionComController extends Controller
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
           $ingresos=DB::table('com_devolucion_cab as c')
           ->join('com_proveedor as cp', 'c.id_proveedor', '=', 'cp.id_proveedor')
           ->select('c.id_devolucion', 'c.fecha_dev', 'cp.nombre', 'c.serie_comprobante','c.tipo_comprobante', 'c.numero_comprobante', 
           'c.impuesto_porcentaje','c.estado','c.total_dev')/* DB::raw('sum(dtc.cantidad*dtc.precio_compra) as total')) */
           /* ->where('c.numero_comprobante','LIKE','%'.$query.'%') */
           /* ->orderBy('c.id_devolucion', 'desc') */
           ->where('c.numero_comprobante','LIKE','%'.$query.'%')
           ->orderBy('c.id_devolucion', 'desc')->get();
/*            ->groupby('c.id_devolucion', 'c.fecha_dev', 'cp.nombre', 'c.tipo_comprobante', 'c.numero_comprobante', 
           'c.impuesto_porcentaje','c.estado') */
          /*  ->paginate(7); */
           return view('compras.devolucion.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }
    }

    public function create(){

        $date = Carbon::now();
        $datein = $date->format('d-m-Y');
        $f_emsion = \Carbon\Carbon::parse($datein)->format('d-m-Y');
        $f_caducidad =\Carbon\Carbon::parse($datein)->addYears(4)->format('d-m-Y');
        $users=DB::table('users')->get();  
        $proveedores=DB::table('com_proveedor')->where('estado','=','1')->get();
        $articulos = DB::table('producto as p')
        ->select( DB::raw('CONCAT(p.codigo, " ", p.nombre) AS articulo'), 'p.id_producto', 'p.descuento' )
        ->where('p.estado','=','Activo')
        ->get();




        return view('compras.ingreso.create',["proveedores"=>$proveedores,"articulos"=>$articulos,"users"=>$users,"f_emsion"=>$f_emsion,"f_caducidad"=>$f_caducidad]);
    }

    //guardar ----> devolucion

    public function update(DevolucionCompraFormRequest $request,$id)
    {

          try{
            DB::beginTransaction();
            $ingreso=new DevolucionCompra;
            $ingreso->id_empresa= Auth::user()->id_empresa; 
            $ingreso->id_sucursal= Auth::user()->id_sucursal; 
            $ingreso->id_usuario=Auth::user()->id; 
            $ingreso->id_cargo=Auth::user()->id_cargo; 

            $ingreso->id_proveedor=$request->get('id_proveedor');
            $ingreso->id_compra_ant=$request->get('id_compra');
            $ingreso->comp_serie_ant=$request->get('serie_comprobante');
            $ingreso->comp_num_ant=$request->get('numero_comprobante');
            $ingreso->tipo_comprobante=$request->get('tipo_comprobante');


            $ingreso->serie_comprobante=$request->get('serie_comprobanten');
            $ingreso->numero_comprobante=$request->get('numero_comprobanten');
           /*  $ingreso->forma_pago=$request->get('forma_pagon'); */
          
           $fecha1 = $request->get('fechan');
           $fecha2 = \Carbon\Carbon::parse($fecha1)->format('d-m-Y');
           $ingreso->fecha_dev=$fecha2;

            $fecha3 = $request->get('fecha_caducidadn');
            $fecha4 = \Carbon\Carbon::parse($fecha3)->format('d-m-Y');
            $ingreso->fecha_caducidad=$fecha4; 
           
            $ingreso->subtotal='0';
            $ingreso->descuento='0';
            $ingreso->descuento_porcentaje=$request->get('descuento_general');
            $ingreso->impuesto ='0'; 
            $ingreso->impuesto_porcentaje=$request->get('iva_general');
            $ingreso->total_dev = '0';
            $ingreso->total_anterior=$request->get('totalCompra');
            $ingreso->retencion='0';
            $ingreso->retencion_porcentaje='0';
            /*$ingreso->retencion=$request->get('retencion');
            $ingreso->retencion_porcentaje=$request->get('retencion_porcentaje'); */
            $ingreso->motivo_dev=$request->get('observacionn');
            $ingreso->nota=$request->get('nota');
            $ingreso->cantidad_dev ='0';
            $ingreso->estado='1';

        
            $ingreso->save();
 

            $checked_array = $request->get('is_selec'); 
       
            $id_dt_compra = $request->get('id_dt_compra');
            $id_producto = $request->get('id_producto');
            $cantidads = $request->get('cantidad');
            $precio_unitario = $request->get('precio_unitario');
            $descuento_porcentaje = $request->get('descuento_porcentaje');
            $descuento = $request->get('descuento');
            $iva_porcentaje = $request->get('iva_porcentaje');
            $iva = $request->get('iva');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');
            $cant_devuelta = $request->get('cant_devuelta');
            $total = $request->get('total');
            $n=0;



            $proveedor = DB::table('com_proveedor')
            ->select('nombre')
            ->where('id_proveedor','=',$ingreso->id_proveedor)
            ->first();

        if(isset($checked_array)){
            
           foreach($request->id_dt_compra as $key => $value){
               if(in_array($request->id_dt_compra[$key],$checked_array)){
                   $product = new DevolucionDetalleCompra();
                   $product->id_dev_cab = $ingreso->id_devolucion; 
                   $product->id_dt_compra = $id_dt_compra[$key];
                   $product->id_producto = $id_producto[$key];
                   $product->cantidad_vendida = $cantidads[$key];
                   $product->precio_unitario = $precio_unitario[$key];  
                   $product->cant_devuelta = $cant_devuelta[$key];  
                
                   $product->descuento_porcentaje = $descuento_porcentaje[$key];  
                   $product->iva_porcentaje = $iva_porcentaje[$key];  
               
                   
                   $valordescuento = $descuento_porcentaje[$key]/100; 
                   $valorTotaldevcant = $cant_devuelta[$key] * $precio_unitario[$key];
                   $valord = $valordescuento  * $valorTotaldevcant;
                
                  
                   $valorivapas = $iva_porcentaje[$key]/100; 
                   $valoriva = $valorivapas  * $valorTotaldevcant;
                   $valordestotal = $valorTotaldevcant + $valoriva - $valord;

                  
                   $product->descuento = $valord;
                   $product->iva = $valoriva;
             
                   $product->precio_compra = $precio_compra[$key]; 
                   $product->precio_venta = $precio_venta[$key];
                   $product->total = $valordestotal;
                   $cantidad = count($checked_array);
                   $suma = ($n +=  $product->total); 
                
                   $product->save();

                   

                 
                        if(isset($ingreso->id_devolucion)){
                        $ingresoup=DevolucionCompra::find($ingreso->id_devolucion);
                        $ingresoup->subtotal= $suma;
                        $datadesc = $request->get('descuento_general');
                        $datavalordesctotal = $suma * $datadesc;                    
                        $ingresoup->descuento = $datavalordesctotal;
                        $dataiva = $request->get('iva_general')/100;
                        $datavalorivatotal = $suma * $dataiva;
                        $ingresoup->impuesto = $datavalorivatotal;
                        $resTotal = $suma - $datavalordesctotal + $datavalorivatotal;
                        $ingresoup->total_dev = $suma - $datavalordesctotal + $datavalorivatotal;
                        $ingresoup->cantidad_dev = $cantidad;
                        
                        $ingresoup->update();
                    } 

                     $ingresoDev=DetalleIngreso::find($product->id_dt_compra);
                    $ingresoDev->cant_dev= $ingresoDev->cant_dev + $cant_devuelta[$key];    
                    $ingresoDev->update();


                   //actualizar el stock con la devolucion (resta) 
                   $ingresopro=Articulos::find($product->id_producto);
                   $ingresopro->stock=  $ingresopro->stock - $product->cant_devuelta;
                   $ingresopro->update(); 

                  
                   $stockveri = DB::table('producto')
                   ->select('stock')
                   ->where('id_producto','=', $product->id_producto)
                   ->first();
                   
    
                    $histproduct = new HistorialProducto();
                    $histproduct->id_empresa  = $ingreso->id_empresa; 
                    $histproduct->persona  = $proveedor->nombre;  
                    $histproduct->id_usuario  = $ingreso->id_usuario;
                    $histproduct->id_compra_cab  = $ingreso->id_devolucion;
                    $histproduct->id_dt_compra  = $product->id_dev_det;
                    $histproduct->tipo_comprobante  = $ingreso->tipo_comprobante;
                    $histproduct->serie_comprobante  = $ingreso->serie_comprobante; 
                    $histproduct->numero_comprobante  = $ingreso->numero_comprobante;
                    $histproduct-> tipo_mov  = "Devolución Compra";
                    $histproduct-> detalle =  "Devolución de Mercadería,  $ingreso->tipo_comprobante: N°-$ingreso->serie_comprobante-$ingreso->numero_comprobante";
                    $histproduct-> id_producto  = $product->id_producto; 
                    $histproduct-> stock  = $stockveri->stock;
                    $histproduct->cantidad  = $product->cant_devuelta;
                    $histproduct->precio  = $product->precio_unitario;
                    $histproduct->costo_total  =  $product->total;
                    $date3 = $ingreso->fecha_dev;
                    $fecha6 = \Carbon\Carbon::parse($date3)->format('d-m-Y');
                    $histproduct->fecha  = $fecha6;
                    $histproduct->save();
                   /* echo $histproduct; */

               }
           }  
                $id = $ingreso->id_devolucion;
                $ids = $product->id_dev_det;

        }else{
         return redirect()->back()->with('message', "PRODUCTOS NO SELECCIONADO O AGOTADO PARA DEVOLUCIÓN");
        }

            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
        }
        return isset($id) && isset($ids) ? Redirect::to('compras/devolucioncom')->with('message', "Guardado Exitoso") : Redirect::to('compras/devolucioncom')->with('messagerr', "Error al Guardar");
      
    }

    //principal devolucion vista
    public function show($id)
    {
        $date = Carbon::now();
        $datein = $date->format('d-m-Y');
        $f_emsion = \Carbon\Carbon::parse($datein)->format('d-m-Y');
        $f_caducidad =\Carbon\Carbon::parse($datein)->addYears(1)->format('d-m-Y');
       $ingreso = DB::table('compra as c')
       ->join('com_proveedor as cp', 'c.id_proveedor', '=', 'cp.id_proveedor')
       ->join('detalle_compra as dtc', 'c.id_compra', '=', 'dtc.id_compra_cab')
       ->join('users as u', 'c.id_usuario', '=', 'u.id')
       ->select('c.id_compra','c.id_proveedor', 'c.fecha', 'u.name','cp.nombre','c.serie_comprobante', 'c.tipo_comprobante',
        'c.numero_comprobante','c.impuesto','c.descuento','c.fecha_caducidad','c.forma_pago',
        'c.descuento_porcentaje','c.subtotal','c.totalCompra','c.impuesto_porcentaje',
        'c.observacion','c.estado',DB::raw('sum(dtc.cantidad*dtc.precio_compra) as total'))
        ->where ('c.id_compra','=',$id)
        ->first();

    $detalles= DB::table('detalle_compra as dtc')
    ->join('producto as p', 'dtc.id_producto', '=', 'p.id_producto')
    ->select('p.nombre as articulo','dtc.id_producto','dtc.id_dt_compra','dtc.cantidad','dtc.precio_unitario','dtc.descuento_porcentaje','dtc.descuento','dtc.iva_porcentaje','dtc.iva','dtc.precio_compra','dtc.precio_venta','dtc.cant_dev')
    ->where('dtc.id_compra_cab','=',$id)->get();

    $compraCount = DB::table('com_devolucion_cab')->where('tipo_comprobante','=','FACTURA')->count();
    $var = $compraCount + 1;
    $countCompra = str_pad($var ,9,"0", STR_PAD_LEFT);
    $compraCountnv = DB::table('com_devolucion_cab')->where('tipo_comprobante','=','NOTA DE VENTA')->count();
    $varnv = $compraCountnv + 1;

    $countCompranv = str_pad($varnv ,9,"0", STR_PAD_LEFT);


       return view("compras.devolucion.show",["countCompranv"=>$countCompranv,"countCompra"=>$countCompra,"ingreso"=>$ingreso,"detalles"=>$detalles,"f_emsion"=>$f_emsion,"f_caducidad"=>$f_caducidad, "datein"=>$datein
    ]);
    }


    public function showdtdev($id)
    {
        $date = Carbon::now();
        $datein = $date->format('d-m-Y');
        $f_emsion = \Carbon\Carbon::parse($datein)->format('d-m-Y');
        $f_caducidad =\Carbon\Carbon::parse($datein)->addYears(4)->format('d-m-Y');
       $ingreso = DB::table('com_devolucion_cab as c')
       ->join('com_proveedor as cp', 'c.id_proveedor', '=', 'cp.id_proveedor')
       ->join('com_devolucion_det as dtc', 'c.id_devolucion', '=', 'dtc.id_dev_cab')
       ->select('c.id_devolucion','c.id_proveedor', 'c.fecha_dev','cp.nombre','c.serie_comprobante', 'c.tipo_comprobante', 'c.numero_comprobante',
        'c.impuesto','c.descuento','c.fecha_caducidad',
        'c.descuento_porcentaje','c.subtotal','c.total_dev','c.impuesto_porcentaje','c.total_anterior',
        'c.motivo_dev','c.nota','c.estado')
        ->where ('c.id_devolucion','=',$id)
        ->first();

    $detalles= DB::table('com_devolucion_det as dtc')
    ->join('producto as p', 'dtc.id_producto', '=', 'p.id_producto')
    ->select('p.nombre as articulo','dtc.id_producto','dtc.id_dev_det','dtc.cant_devuelta','dtc.precio_unitario',
    'dtc.descuento_porcentaje','dtc.descuento','dtc.precio_compra','dtc.precio_venta','dtc.iva_porcentaje','dtc.iva')
    ->where('dtc.id_dev_cab','=',$id)->get();

       return view("compras.devolucion.showdtdev",["ingreso"=>$ingreso,"detalles"=>$detalles,"f_emsion"=>$f_emsion,"f_caducidad"=>$f_caducidad
    ]);
    }

    public function showprintc($id)
    {

        $date = Carbon::now();
        $datein = $date->format('d-m-Y');
        $f_emsion = \Carbon\Carbon::parse($datein)->format('d-m-Y');
        $f_caducidad =\Carbon\Carbon::parse($datein)->addYears(4)->format('d-m-Y');
        $datoid = Auth::user()->id_empresa; 
        /* 
    $datas  = DB::table('empresa')->where('id_empresa','=',$datoid)->get(); */
       $ingreso = DB::table('com_devolucion_cab as c')
       ->join('com_proveedor as cp', 'c.id_proveedor', '=', 'cp.id_proveedor')
       ->join('empresa as e', 'c.id_empresa', '=', 'e.id_empresa')
       ->join('com_devolucion_det as dtc', 'c.id_devolucion', '=', 'dtc.id_dev_cab')
       ->select('c.id_devolucion','c.id_proveedor','c.fecha_dev','cp.nombre','c.cantidad_dev',
       'cp.pais','cp.provincia','cp.ciudad','cp.tipo_documento','cp.direccion',
       'cp.num_documento','cp.telefono','cp.email','c.comp_serie_ant','c.comp_num_ant',
       'c.serie_comprobante', 'c.tipo_comprobante', 'c.numero_comprobante',
        'c.impuesto','c.descuento','c.fecha_caducidad',
        'c.descuento_porcentaje','c.subtotal','c.total_dev','c.impuesto_porcentaje','c.total_anterior',
        'c.motivo_dev','c.nota','c.estado','e.nombre_empresa','e.ruc as rucempresa','e.r_legal','e.direccion as empdirec','e.telefono as emptele','e.email as empemail','e.id_empresa')
        ->where ('c.id_devolucion','=',$id)
        ->first();

     
    $detalles= DB::table('com_devolucion_det as dtc')
    ->join('producto as p', 'dtc.id_producto', '=', 'p.id_producto')
    ->select('p.nombre as articulo','dtc.id_producto','dtc.id_dev_det','dtc.cant_devuelta','dtc.precio_unitario',
    'dtc.descuento_porcentaje','dtc.descuento','dtc.precio_compra','dtc.precio_venta','dtc.total','dtc.iva_porcentaje','dtc.iva')
    ->where('dtc.id_dev_cab','=',$id)->get();

       return view("compras.devolucion.showprintc",["ingreso"=>$ingreso,"detalles"=>$detalles,"f_emsion"=>$f_emsion,"f_caducidad"=>$f_caducidad
    ]); 
    }
    


//Principal
 public function changStatusw(Request $request)
{
   $categoria = DevolucionCompra::find($request->id);
   $categoria->estado= $request->status;
   $categoria->update();
/* return response()->json(['succes'=>'Estado Cambiado con Éxito']); */  
}

}
