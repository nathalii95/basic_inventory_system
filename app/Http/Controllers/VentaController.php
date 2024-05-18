<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use PDF;
use App;
/* use Mail; */
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisInv\Http\Requests\VentaFormRequest;
use sisInv\Venta;
use sisInv\User;
use sisInv\DetalleVenta;
use sisInv\HistorialProducto;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;  

class VentaController extends Controller
{
    public function _construct()
    {
       $this->middleware('auth'); 
    } 
    public function index(Request $request)
    {
       if($request)
       {
        $cargo =  Auth::user()->id_cargo; 
        $ven =  Auth::user()->id; 

          if($cargo=='1'){
            $query=trim($request->get('searchText'));
            $ventas=DB::table('venta as v')
            ->join('ven_cliente as c', 'c.id_cliente', '=', 'v.id_cliente')
            ->join('users as u', 'u.id', '=', 'v.id_usuario')
            ->select('v.id_venta', 'v.fecha', 'c.nombre', 'v.serie_comprobante','v.tipo_comprobante',
             'v.num_comprobante', 'v.subtotal','v.impuesto','v.total_venta','v.subtotal','v.descuento','v.descuento_porcentaje',
             'v.impuesto','u.name',
            'v.forma_pago','v.impuesto_porcentaje','v.estado')
            ->where('v.num_comprobante','LIKE','%'.$query.'%')
            ->orderBy('v.id_venta', 'desc')->get();
           /*  ->paginate(7); */
           return view('ventas.ventas.index',["ventas"=>$ventas,"searchText"=>$query]);
          }else { 


            $query=trim($request->get('searchText'));
           $ventas=DB::table('venta as v')
           ->join('ven_cliente as c', 'c.id_cliente', '=', 'v.id_cliente')
           ->join('users as u', 'u.id', '=', 'v.id_usuario')
           ->select('v.id_venta', 'v.fecha', 'c.nombre', 'v.serie_comprobante','v.tipo_comprobante',
            'v.num_comprobante', 'v.subtotal','v.impuesto','v.total_venta','v.subtotal','v.descuento','v.descuento_porcentaje',
            'v.impuesto','u.name','v.forma_pago','v.impuesto_porcentaje','v.estado')
           ->where('v.id_usuario','=',$ven)
           ->orderBy('v.id_venta', 'desc')
           ->groupBy('v.id_venta', 'v.fecha', 'c.nombre', 'v.tipo_comprobante',
           'v.num_comprobante', 
           'v.forma_pago','v.impuesto_porcentaje','v.estado')->get();
           return view('ventas.ventas.index',["ventas"=>$ventas,"searchText"=>$query]);
          }


           
        }
    }

    //enviar valores para dato o arrays a los inputs.
    public function create(){
        $date = Carbon::now();
        $datein = $date->format('d-m-Y');
        $f_emsion = \Carbon\Carbon::parse($datein)->format('d-m-Y');
        $f_caducidad =\Carbon\Carbon::parse($datein)->addYears(1)->format('d-m-Y');
        $users=DB::table('users')->get();
        $clientes=DB::table('ven_cliente')->where('estado','=','1')->get();
        $articulos = DB::table('producto as p')->join('detalle_compra as dtc',
        'p.id_producto',"=",'dtc.id_producto')
        ->select(DB::raw('CONCAT(p.codigo, " ", p.nombre) AS articulo'),
         'p.id_producto','p.stock', 'dtc.precio_venta', DB::raw('avg(dtc.precio_venta) as
          precio_promedio'), 'p.precio_v','p.descuento','p.impuesto_valor')
        ->where('p.estado','=','Activo')
        ->where('p.stock','>','0')
        ->groupBy('articulo','p.id_producto','p.stock','p.descuento')
        ->orderBy('dtc.created_at', 'desc')
        ->get();

        $ventaCount = DB::table('venta')->where('tipo_comprobante','=','FACTURA')->count();
        $var = $ventaCount + 1;
        $countVenta = str_pad($var ,9,"0", STR_PAD_LEFT);


        $compraCountnv = DB::table('venta')->where('tipo_comprobante','=','NOTA DE VENTA')->count();
        $varnv = $compraCountnv + 1;
        $countCompranv = str_pad($varnv ,9,"0", STR_PAD_LEFT);

        $impuesto=DB::table('impuesto')->where('codigo','=','pro')->get();  
        $categorias=DB::table('categoria')->where('estado','=','1')->get();  

        return view('ventas.ventas.create',
        ["clientes"=>$clientes,"articulos"=>$articulos,
        "users"=>$users,"f_emsion"=>$f_emsion,"f_caducidad"=>$f_caducidad,
       "countVenta"=>$countVenta,"countCompranv"=>$countCompranv/* "impuesto"=>$impuesto,"categorias"=>$categorias */]);
    }

    //almacena los objetos en la tabla
    public function store(VentaFormRequest $request)
    {
        try{
            DB::beginTransaction();
            $venta=new Venta;

            $venta->id_cliente=$request->get('id_cliente');
            $venta->id_usuario=Auth::user()->id; 
            $venta->id_empresa= Auth::user()->id_empresa; 
            $venta->tipo_comprobante=$request->get('tipo_comprobante');
            $venta->serie_comprobante=$request->get('serie_comprobante');
            $venta->num_comprobante=$request->get('num_comprobante');
            $venta->forma_pago=$request->get('forma_pago');
            $fecha1 = $request->get('fecha');
            $fecha2 = \Carbon\Carbon::parse($fecha1)->format('d-m-Y');
            $venta->fecha=$fecha2;

            $fecha3 = $request->get('fecha_caducidad');
            $fecha4 = \Carbon\Carbon::parse($fecha3)->format('d-m-Y');
            $venta->fecha_emision= \Carbon\Carbon::now()->format('d-m-Y');
            $venta->fecha_caducidad=$fecha4;
            $venta->subtotal=$request->get('subtotal');
            $venta->descuento=$request->get('descuentop');
            $venta->descuento_porcentaje=$request->get('descuento_porcentajep');
            $venta->impuesto_porcentaje=$request->get('impuesto_porcentaje');
            $venta->impuesto = $request->get('impuesto');
            $venta->total_venta=$request->get('total_venta');
            $venta->retencion='0';
            $venta->retencion_porcentaje='0';
            $venta->estado='1';
            /* echo $venta; */
            $venta->save();

            $one = $request->get('tipo_comprobante');
            $two = $request->get('serie_comprobante');
            $three = $request->get('num_comprobante');
            $varNum ="$one-$two-$three.pdf";

            $id_producto_cab = $request->get('id_producto_cab');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');
            $descuento_porcentaje = $request->get('descuento_porcentaje');
            $descuento = $request->get('descuento');
            $iva_porcentajepro = $request->get('iva_porcentajepro');
            $ivapro = $request->get('ivapro');
            $total = $request->get('total');
            $cont = 0;
            
            $proveedor = DB::table('ven_cliente')
            ->select('nombre', 'email')
            ->where('id_cliente','=',$venta->id_cliente)
            ->first();
            
            while($cont < count($id_producto_cab)){
                $detalle = new DetalleVenta();
                $detalle->id_venta_cab= $venta->id_venta;
                $detalle->id_producto_cab= $id_producto_cab[$cont];
                $detalle->cantidad= $cantidad[$cont];
                $detalle->precio_venta= $precio_venta[$cont];
                $detalle->descuento_porcentaje= $descuento_porcentaje[$cont];
                $detalle->descuento= $descuento[$cont];
                $detalle->iva_porcentaje=  ($iva_porcentajepro[$cont] == "" || $iva_porcentajepro[$cont] == null) ? 0 : $iva_porcentajepro[$cont];
                $detalle->iva= $ivapro[$cont];   
                $detalle->total= $total[$cont];
                $detalle->cant_dev ='0';
                $detalle->save();     
                $cont=$cont+1;


                $stockveri = DB::table('producto')
                ->select('stock')
                ->where('id_producto','=',$detalle->id_producto_cab)
                ->first();
            
                $histproduct = new HistorialProducto();
                $histproduct->id_empresa  = $venta->id_empresa; 
                $histproduct->persona  = $proveedor->nombre;  
                $histproduct->id_usuario  = $venta->id_usuario;
                $histproduct->id_compra_cab  = $venta->id_venta;
                $histproduct->id_dt_compra  = $detalle-> id_dt_venta;
                $histproduct->tipo_comprobante  = $venta->tipo_comprobante;
                $histproduct->serie_comprobante  = $venta->serie_comprobante; 
                $histproduct->numero_comprobante  = $venta->num_comprobante;
                $histproduct-> tipo_mov  = "Venta";
                $histproduct-> detalle =  "Venta Mercaderia, Factura: N°-$venta->serie_comprobante-$venta->num_comprobante";
                $histproduct-> id_producto  = $detalle->id_producto_cab; 
                $histproduct-> stock  = $stockveri->stock;
                $histproduct->cantidad  = $detalle->cantidad;
                $histproduct->precio  = $detalle->precio_venta;
                $histproduct->costo_total  =  $detalle->total;

                $fecha5 = $venta->fecha;
                $fecha6 = \Carbon\Carbon::parse($fecha5)->format('d-m-Y');
                $histproduct->fecha  = $fecha6;
                $histproduct->save();
                  /* var_dump($detalle); */
               
            }
            DB::commit();
        
        }
       catch(\Exception $e)
        {
            DB::rollback();
        }
        /*   $this->showpdfv($venta->id_venta,$request->get('id_cliente'), $varNum); */
        /* return Redirect::to('ventas/ventas'); */
        $ids = $detalle->id_dt_venta;
        $id = $venta->id_venta;
        $id_cliente = $request->get('id_cliente');

        $venta = DB::table('venta as v')
        ->join('ven_cliente as c', 'v.id_cliente', '=', 'c.id_cliente')
        ->join('detalle_venta as dtv', 'v.id_venta', '=', 'dtv.id_venta_cab')
        ->select('v.id_venta', 'v.fecha', 'v.fecha_caducidad','c.nombre', 
        'c.pais','c.provincia','c.ciudad','c.tipo_documento','c.direccion',
        'c.num_documento','c.telefono','c.email',
        'v.tipo_comprobante','v.serie_comprobante', 'v.num_comprobante',
        'v.forma_pago','v.impuesto','v.subtotal','v.total_venta',
        'v.impuesto_porcentaje','v.descuento_porcentaje','v.descuento',
        'v.estado', 'v.total_venta')
       ->where ('v.id_venta','=',$id)
       ->first();
   
       $detalles= DB::table('detalle_venta as dtv')
       ->join('producto as p', 'dtv.id_producto_cab', '=', 'p.id_producto')
       ->select('p.codigo','p.nombre as articulo','dtv.id_producto_cab','dtv.cantidad','dtv.precio_venta','dtv.descuento','dtv.iva')
       ->where('dtv.id_venta_cab','=',$id)->get();
 
      $cliente = DB::table('ven_cliente')
      ->select("*")
      ->where('id_cliente','=', $id_cliente)
      ->get();
   
      $data = $cliente[0]->email;
      $nombre = $cliente[0]->nombre;
 
      $pdf = PDF::loadView('ventas.ventas.file',compact('venta','detalles'));
 
       Mail::send('email.file', compact('cliente'), function ($mail) use ($pdf,$data,$varNum, $nombre) {
         $mail->to($data);
         $mail->attachData($pdf->output(), $varNum);
     });
     /* return $pdf->download("factura.php"); */
     /* return Redirect::to('ventas/ventas')->with('message', "Factura enviada por correo electrónico $data del Cliente $nombre "); */

     return isset($id) && isset($ids) ? Redirect::to('ventas/ventas')->with('message', "Factura enviada por correo electrónico $data del Cliente $nombre ") : Redirect::to('ventas/ventas')->with('messagerr', "Error al Guardar");
    }

    //vista Detalle Boton Venta
    public function show($id)
    {
       $venta = DB::table('venta as v')
       ->join('ven_cliente as c', 'v.id_cliente', '=', 'c.id_cliente')
       ->join('detalle_venta as dtv', 'v.id_venta', '=', 'dtv.id_venta_cab')
       ->join('users as u', 'v.id_usuario', '=', 'u.id')
       ->select('v.id_venta', 'v.fecha', 'v.fecha_caducidad','u.name','c.nombre', 
       'v.tipo_comprobante','v.serie_comprobante', 'v.num_comprobante',
        'v.forma_pago','v.impuesto','v.subtotal','v.total_venta',
        'v.impuesto_porcentaje','v.descuento_porcentaje','v.descuento',
        'v.estado', 'v.total_venta')
    ->where ('v.id_venta','=',$id)
    ->first();

    $detalles= DB::table('detalle_venta as dtv')
    ->join('producto as p', 'dtv.id_producto_cab', '=', 'p.id_producto')
    ->select('p.nombre as articulo','dtv.id_producto_cab','dtv.cantidad','dtv.precio_venta','dtv.descuento')
    ->where('dtv.id_venta_cab','=',$id)->get();

       return view("ventas.ventas.show",["venta"=>$venta,"detalles"=>$detalles]);
    }

    
    public function showpdfv($id, $id_cliente, $varNum)
    {
         $venta = DB::table('venta as v')
         ->join('ven_cliente as c', 'v.id_cliente', '=', 'c.id_cliente')
         ->join('detalle_venta as dtv', 'v.id_venta', '=', 'dtv.id_venta_cab')
         ->select('v.id_venta', 'v.fecha', 'v.fecha_caducidad','c.nombre', 
         'c.pais','c.provincia','c.ciudad','c.tipo_documento','c.direccion',
         'c.num_documento','c.telefono','c.email',
         'v.tipo_comprobante','v.serie_comprobante', 'v.num_comprobante',
         'v.forma_pago','v.impuesto','v.subtotal','v.total_venta',
         'v.impuesto_porcentaje','v.descuento_porcentaje','v.descuento',
         'v.estado', 'v.total_venta')
        ->where ('v.id_venta','=',$id)
        ->first();
    
        $detalles= DB::table('detalle_venta as dtv')
        ->join('producto as p', 'dtv.id_producto_cab', '=', 'p.id_producto')
        ->select('p.codigo','p.nombre as articulo','dtv.id_producto_cab','dtv.cantidad','dtv.precio_venta','dtv.descuento','dtv.descuento_porcentaje','dtv.iva','dtv.iva_porcentaje')
        ->where('dtv.id_venta_cab','=',$id)->get();
  
       $cliente = DB::table('ven_cliente')
       ->select("*")
       ->where('id_cliente','=', $id_cliente)
       ->get();
    
       $data = $cliente[0]->email;
  
       $pdf = PDF::loadView('ventas.ventas.file',compact('venta','detalles'));
  
  /*      Mail::send('email.file', compact('cliente'),function ($message) use ($data, $pdf) {
          $message->to($data, $data)->attachData($pdf->output(), "factura.pdf");
      }); */
  
        Mail::send('email.file', compact('cliente'), function ($mail) use ($pdf,$data,$varNum) {
          $mail->to($data);
          $mail->attachData($pdf->output(), $varNum);
      });
      /* return $pdf->download("factura.php"); */
       /* return $pdf->download('factura.php')->redirect()->back()->with('message', "Factura enviada al correo electrónico"); */
       /* return Redirect::to('ventas/ventas')->with('message', "Factura enviada al correo electrónico", $envia); */
       /* return Redirect::to('ventas/ventas'); */
    }
  

    public function showprintv($id)
    {
       
        $venta = DB::table('venta as v')
        ->join('ven_cliente as c', 'v.id_cliente', '=', 'c.id_cliente')
        ->join('detalle_venta as dtv', 'v.id_venta', '=', 'dtv.id_venta_cab')
        ->select('v.id_venta', 'v.fecha', 'v.fecha_caducidad','c.nombre', 
        'c.pais','c.provincia','c.ciudad','c.tipo_documento','c.direccion',
       'c.num_documento','c.telefono','c.email',
        'v.tipo_comprobante','v.serie_comprobante', 'v.num_comprobante',
         'v.forma_pago','v.impuesto','v.subtotal','v.total_venta',
         'v.impuesto_porcentaje','v.descuento_porcentaje','v.descuento',
         'v.estado', 'v.total_venta')
     ->where ('v.id_venta','=',$id)
     ->first();

     $detalles= DB::table('detalle_venta as dtv')
     ->join('producto as p', 'dtv.id_producto_cab', '=', 'p.id_producto')
     ->select('p.nombre as articulo','dtv.id_producto_cab','dtv.cantidad','dtv.precio_venta','dtv.descuento','dtv.descuento_porcentaje','dtv.iva','dtv.iva_porcentaje')
     ->where('dtv.id_venta_cab','=',$id)->get();
    
        return view("ventas.ventas.showprint",["venta"=>$venta,"detalles"=>$detalles]);
    }
  
    public function changStatusv(Request $request)
    {
       $venta = Venta::find($request->id);
       $venta->estado= $request->status;
       $venta->update();
    /* return response()->json(['succes'=>'Estado Cambiado con Éxito']); */
      
    }
}
