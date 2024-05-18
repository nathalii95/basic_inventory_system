<?php


namespace sisInv\Http\Controllers;
use Illuminate\Http\Request;
use sisInv\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisInv\Http\Requests\DevolucionVentaFormRequest;
use sisInv\DevolucionVenta;
use sisInv\User;
use sisInv\DevolucionDetalleVenta;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection; 
use sisInv\Venta;
use sisInv\DetalleVenta; 
use sisInv\Articulos;
use sisInv\HistorialProducto;
use Illuminate\Support\Facades\Mail;
use PDF;

class DevolucionVenController extends Controller
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
        $ingresos=DB::table('ven_devolucion_cab as c')
        ->join('ven_cliente as cp', 'c.id_cliente', '=', 'cp.id_cliente')
        ->select('c.id_devolucion', 'c.fecha_dev', 'cp.nombre', 'c.serie_comprobante','c.tipo_comprobante', 
        'c.numero_comprobante', 
        'c.impuesto_porcentaje','c.estado','c.total_dev')
        ->orderBy('c.id_devolucion', 'desc')
        ->get();
       /*  ->paginate(7); */
        return view('ventas.devolucion.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }
    }

    public function create(){

        $date = Carbon::now();
        $datein = $date->format('d-m-Y');
        $f_emsion = \Carbon\Carbon::parse($datein)->format('d-m-Y');
        $f_caducidad =\Carbon\Carbon::parse($datein)->addYears(4)->format('d-m-Y');
        $users=DB::table('users')->get();  
        $proveedores=DB::table('ven_cliente')->where('estado','=','1')->get();
        $articulos = DB::table('producto as p')
        ->select( DB::raw('CONCAT(p.codigo, " ", p.nombre) AS articulo'), 'p.id_producto', 'p.descuento' )
        ->where('p.estado','=','Activo')
        ->get();



        return view('ventas.ingreso.create',["proveedores"=>$proveedores,"articulos"=>$articulos,"users"=>$users,"f_emsion"=>$f_emsion,"f_caducidad"=>$f_caducidad]);
    }


    public function update(DevolucionVentaFormRequest $request,$id)
    {

          try{
            DB::beginTransaction();
            $ingreso=new DevolucionVenta;
            $ingreso->id_empresa= Auth::user()->id_empresa; 
            $ingreso->id_sucursal= Auth::user()->id_sucursal; 
            $ingreso->id_usuario=Auth::user()->id; 
            $ingreso->id_cargo=Auth::user()->id_cargo; 

            $ingreso->id_cliente=$request->get('id_cliente');
            $ingreso->id_venta_ant=$request->get('id_venta');
            $ingreso->ven_serie_ant=$request->get('serie_comprobante');
            $ingreso->ven_num_ant=$request->get('numero_comprobante');
            $ingreso->tipo_comprobante="NOTA DE CREDITO";
            $ingreso->serie_comprobante=$request->get('serie_comprobanten');
            $ingreso->numero_comprobante=$request->get('numero_comprobanten');
          /*   $ingreso->forma_pago=$request->get('forma_pagon'); */
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
            $ingreso->total_anterior=$request->get('totalVenta');
            $ingreso->retencion='0';
            $ingreso->retencion_porcentaje='0';
            /*$ingreso->retencion=$request->get('retencion');
            $ingreso->retencion_porcentaje=$request->get('retencion_porcentaje'); */
            $ingreso->motivo_dev=$request->get('observacionn');
            $ingreso->nota=$request->get('nota');
            $ingreso->cantidad_dev ='0';
            $ingreso->estado='1';

            /* echo $ingreso; */

            $ingreso->save();  

            $one = "Nota de Credito";
            $two = $request->get('serie_comprobanten');
            $three = $request->get('numero_comprobanten');
            $varNum ="$one-$two-$three.pdf";
 
            $is_impuesto = $request->has('is_selec');
            $checked_array = $request->get('is_selec'); 
            $id_dt_venta = $request->get('id_dt_venta');
            $id_producto = $request->get('id_producto');
            $cantidads = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');
            $descuento_porcentaje = $request->get('descuento_porcentaje');
            $descuento = $request->get('descuento');
            $iva_porcentaje = $request->get('iva_porcentaje');
            $iva = $request->get('iva');
            $cant_devuelta = $request->get('cant_devuelta');
            $total = $request->get('total');
            $n=0;

            $cliente = DB::table('ven_cliente')
            ->select('nombre')
            ->where('id_cliente','=',$ingreso->id_cliente)
            ->first();

        if(isset($checked_array)){
            foreach($request->id_dt_venta as $key => $value){
                if(in_array($request->id_dt_venta[$key],$checked_array)){
        
                    $product = new DevolucionDetalleVenta();
                    $product->id_dev_cab = $ingreso->id_devolucion; 
                    $product->id_dt_venta = $id_dt_venta[$key];
                    $product->id_producto = $id_producto[$key];
                    $product->cantidad_vendida = $cantidads[$key];
                    $product->precio_venta = $precio_venta[$key];  
                    $product->cant_devuelta = $cant_devuelta[$key];  
                    
                    $product->descuento_porcentaje = $descuento_porcentaje[$key];  
                    $valordescuento = $descuento_porcentaje[$key]/100;     
                    $valorTotaldevcant = $cant_devuelta[$key] * $precio_venta[$key];   
                    $valord = $valordescuento  * $valorTotaldevcant;   
                  
                    $valoriva = $iva_porcentaje[$key]/100; 
                    $valorTotaldevcantiva = $cant_devuelta[$key] * $precio_venta[$key];
                    $valorivad = $valoriva * $valorTotaldevcantiva;
                    $valordestotal = $valorTotaldevcant - $valord + $valorivad;
                    $product->descuento = $valord;
                    $product->iva_porcentaje = $iva_porcentaje[$key]; 
                    $product->iva = $valorivad;
                    $product->total = $valordestotal;
                    $cantidad = count($checked_array);
                    $suma = ($n += $product->total); 
                   /*  echo $product; */
                    $product->save(); 

                         if(isset($ingreso->id_devolucion)){
                         $ingresoup=DevolucionVenta::find($ingreso->id_devolucion);
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

                     $ingresoDev=DetalleVenta::find($product->id_dt_venta);
                     $ingresoDev->cant_dev= $ingresoDev->cant_dev + $cant_devuelta[$key];  
                     $ingresoDev->update();

                    //actualizar el stock con la devolucion (suma) 
                    $ingresopro=Articulos::find($product->id_producto);
                    $ingresopro->stock=  $ingresopro->stock + $product->cant_devuelta;  
                    $ingresopro->update(); 
                 
                    $stockveri = DB::table('producto')
                    ->select('stock')
                    ->where('id_producto','=', $product->id_producto)
                    ->first();

     
                     $histproduct = new HistorialProducto();
                     $histproduct->id_empresa  = $ingreso->id_empresa; 
                     $histproduct->persona  = $cliente->nombre;  
                     $histproduct->id_usuario  = $ingreso->id_usuario;
                     $histproduct->id_compra_cab  = $ingreso->id_devolucion;
                     $histproduct->id_dt_compra  = $product->id_dev_det; 
                     $histproduct->tipo_comprobante  = $ingreso->tipo_comprobante;
                     $histproduct->serie_comprobante  = $ingreso->serie_comprobante; 
                     $histproduct->numero_comprobante  = $ingreso->numero_comprobante;
                     $histproduct-> tipo_mov  = "Devolución Venta";
                     $histproduct-> detalle =  "Devolución de Mercadería, Nota de Crédito: N°-$ingreso->serie_comprobante-$ingreso->numero_comprobante";
                     $histproduct-> id_producto  = $product->id_producto; 
                     $histproduct-> stock  = $stockveri->stock;
                     $histproduct->cantidad  = $product->cant_devuelta;
                     $histproduct->precio  = $product->precio_venta;
                     $histproduct->costo_total  =  $product->total;
                     $date3 = $ingreso->fecha_dev;
                     $fecha6 = \Carbon\Carbon::parse($date3)->format('d-m-Y');
                     $histproduct->fecha  = $fecha6;
                     $histproduct->save();

                     

                    }
                }

                $ids = $product->id_dev_det;
                $id = $ingreso->id_devolucion;
                $id_cliente = $request->get('id_cliente');
        
                $venta = DB::table('ven_devolucion_cab as c')
                ->join('ven_cliente as cp', 'c.id_cliente', '=', 'cp.id_cliente')
                ->join('ven_devolucion_det as dtc', 'c.id_devolucion', '=', 'dtc.id_dev_cab')
                ->select('c.id_devolucion','c.id_cliente','c.fecha_dev','cp.nombre','c.cantidad_dev',
                'cp.pais','cp.provincia','cp.ciudad','cp.tipo_documento','cp.direccion','cp.num_documento as documento ','cp.telefono','cp.email','c.ven_serie_ant','c.ven_num_ant',
                'c.serie_comprobante', 'c.tipo_comprobante', 'c.numero_comprobante','c.impuesto','c.descuento','c.impuesto_porcentaje','c.fecha_caducidad',
                 'c.descuento_porcentaje','c.subtotal','c.total_dev','c.motivo_dev','c.nota','c.estado')
                 ->where ('c.id_devolucion','=',$id)
                 ->first();
         
         
                    $detalles= DB::table('ven_devolucion_det as dtc')
                    ->join('producto as p', 'dtc.id_producto', '=', 'p.id_producto')
                    ->select('p.codigo','p.nombre as articulo','dtc.id_producto','dtc.id_dev_det','dtc.cant_devuelta',
                    'dtc.descuento_porcentaje','dtc.descuento','dtc.iva','dtc.iva_porcentaje','dtc.precio_venta','dtc.cantidad_vendida','dtc.total')
                    ->where('dtc.id_dev_cab','=',$id)->get();
                
                    $cliente = DB::table('ven_cliente')
                    ->select("*")
                    ->where('id_cliente','=', $id_cliente)
                    ->get();
           
                    $data = $cliente[0]->email;
                    $nombre = $cliente[0]->nombre;
                
                    $pdf = PDF::loadView('ventas.devolucion.file',compact('venta','detalles'));
                
                    Mail::send('email.filedev', compact('cliente'), function ($mail) use ($pdf,$data,$varNum, $nombre) {
                        $mail->to($data);
                        $mail->attachData($pdf->output(), $varNum);
                    });

        }else{
            return redirect()->back()->with('messagedevp', "PRODUCTOS NO SELECCIONADO O AGOTADO PARA DEVOLUCIÓN");
        }

            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
        }

     return isset($id) && isset($ids) ? Redirect::to('ventas/devolucionven')->with('message', "Guardado exitoso y Factura enviada por correo electrónico $data del Cliente $nombre") : Redirect::to('ventas/devolucionven')->with('messagerr', "Error al Guardar");
    }

    //principal devolucion vista (seleccionar producto a devolver)
    public function show($id)
    {
        $date = Carbon::now();
        $datein = $date->format('d-m-Y');
        $f_emsion = \Carbon\Carbon::parse($datein)->format('d-m-Y');
        $f_caducidad =\Carbon\Carbon::parse($datein)->addYears(4)->format('d-m-Y');
       $ingreso = DB::table('venta as c')
       ->join('ven_cliente as cp', 'c.id_cliente', '=', 'cp.id_cliente')
       ->join('detalle_venta as dtc', 'c.id_venta', '=', 'dtc.id_venta_cab')
       ->join('users as u', 'c.id_usuario', '=', 'u.id')
       ->select('c.id_venta','c.id_cliente', 'c.fecha', 'u.name','cp.nombre','c.serie_comprobante', 'c.tipo_comprobante',
        'c.num_comprobante',
        'c.forma_pago','c.impuesto','c.descuento','c.fecha_caducidad',
        'c.descuento_porcentaje','c.subtotal','c.total_venta','c.impuesto_porcentaje',
        'c.estado',DB::raw('sum(dtc.cantidad*dtc.precio_venta) as total'))
        ->where ('c.id_venta','=',$id)
        ->first();

    $detalles= DB::table('detalle_venta as dtc')
    ->join('producto as p', 'dtc.id_producto_cab', '=', 'p.id_producto')
    ->select('p.nombre as articulo','dtc.id_producto_cab','dtc.id_dt_venta','dtc.cantidad','dtc.descuento_porcentaje','dtc.descuento','dtc.iva_porcentaje','dtc.iva','dtc.precio_venta','dtc.total','dtc.cant_dev')
    ->where('dtc.id_venta_cab','=',$id)->get();

    $ventaCount = DB::table('ven_devolucion_cab')->count();
    $var = $ventaCount + 1;
    $countVenta = str_pad($var ,9,"0", STR_PAD_LEFT);

       return view("ventas.devolucion.show",["countVenta"=>$countVenta,"ingreso"=>$ingreso,"detalles"=>$detalles,"f_emsion"=>$f_emsion,"f_caducidad"=>$f_caducidad
    ]);
    }


    public function showdtdev($id)
    {
        $date = Carbon::now();
        $datein = $date->format('d-m-Y');
        $f_emsion = \Carbon\Carbon::parse($datein)->format('d-m-Y');
        $f_caducidad =\Carbon\Carbon::parse($datein)->addYears(4)->format('d-m-Y');
       $ingreso = DB::table('ven_devolucion_cab as c')
       ->join('ven_cliente as cp', 'c.id_cliente', '=', 'cp.id_cliente')
       ->join('ven_devolucion_det as dtc', 'c.id_devolucion', '=', 'dtc.id_dev_cab')
       ->select('c.id_devolucion','c.id_cliente', 'c.fecha_dev','cp.nombre','c.serie_comprobante', 
       'c.tipo_comprobante', 'c.numero_comprobante',
       'c.impuesto','c.descuento','c.fecha_caducidad',
        'c.descuento_porcentaje','c.subtotal','c.total_dev','c.impuesto_porcentaje',
        'c.motivo_dev','c.nota','c.estado')
        ->where ('c.id_devolucion','=',$id)
        ->first();

    $detalles= DB::table('ven_devolucion_det as dtc')
    ->join('producto as p', 'dtc.id_producto', '=', 'p.id_producto')
    ->select('p.nombre as articulo','dtc.id_producto','dtc.id_dev_det','dtc.cant_devuelta',
    'dtc.descuento_porcentaje','dtc.descuento','dtc.precio_venta','dtc.iva_porcentaje','dtc.iva','dtc.cantidad_vendida','dtc.total')
    ->where('dtc.id_dev_cab','=',$id)->get();

       return view("ventas.devolucion.showdtdev",["ingreso"=>$ingreso,"detalles"=>$detalles,"f_emsion"=>$f_emsion,"f_caducidad"=>$f_caducidad
    ]);
    }

    public function showprintdv($id)
    {

        $date = Carbon::now();
        $datein = $date->format('d-m-Y');
        $f_emsion = \Carbon\Carbon::parse($datein)->format('d-m-Y');
        $f_caducidad =\Carbon\Carbon::parse($datein)->addYears(4)->format('d-m-Y');
       $ingreso = DB::table('ven_devolucion_cab as c')
       ->join('ven_cliente as cp', 'c.id_cliente', '=', 'cp.id_cliente')
       ->join('ven_devolucion_det as dtc', 'c.id_devolucion', '=', 'dtc.id_dev_cab')
       ->select('c.id_devolucion','c.id_cliente','c.fecha_dev','cp.nombre','c.cantidad_dev',
       'cp.pais','cp.provincia','cp.ciudad','cp.tipo_documento','cp.direccion',
       'cp.num_documento','cp.telefono','cp.email','c.ven_serie_ant','c.ven_num_ant',
       'c.serie_comprobante', 'c.tipo_comprobante', 'c.numero_comprobante',
        'c.impuesto','c.descuento','c.fecha_caducidad',
        'c.descuento_porcentaje','c.subtotal','c.total_dev','c.impuesto_porcentaje',
        'c.motivo_dev','c.nota','c.estado')
        ->where ('c.id_devolucion','=',$id)
        ->first();


    $detalles= DB::table('ven_devolucion_det as dtc')
    ->join('producto as p', 'dtc.id_producto', '=', 'p.id_producto')
    ->select('p.nombre as articulo','dtc.id_producto','dtc.id_dev_det','dtc.cant_devuelta',
    'dtc.descuento_porcentaje','dtc.descuento','dtc.iva','dtc.precio_venta','dtc.cantidad_vendida','dtc.total')
    ->where('dtc.id_dev_cab','=',$id)->get();
    

       return view("ventas.devolucion.showprintc",["ingreso"=>$ingreso,"detalles"=>$detalles,"f_emsion"=>$f_emsion,"f_caducidad"=>$f_caducidad
    ]);
    }
    

//Principal
public function changStatust(Request $request)
{
   $categoria = DevolucionVenta::find($request->id);
   $categoria->estado= $request->status;
   $categoria->update();
/* return response()->json(['succes'=>'Estado Cambiado con Éxito']); */  
}

}

