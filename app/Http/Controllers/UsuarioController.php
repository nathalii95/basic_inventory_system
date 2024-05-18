<?php

namespace sisInv\Http\Controllers;

use Illuminate\Http\Request;

use sisInv\Http\Requests;
use sisInv\User;
use sisInv\Empresa;
use sisInv\Sucursal;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisInv\Http\Requests\UsuarioFormRequest;
use mervick\aesEverywhere\AES256;
use Illuminate\Support\Arr;
use DB;


class UsuarioController extends Controller
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
           
           $usuarios = DB::table('users as u')
           ->join('cargo as c','c.id_cargo', '=','u.id_cargo') 
           ->select('u.*','c.nombre')->orderBy('u.id','desc')->get();

           $aux = [];

           foreach ($usuarios as $k => $v) {
            $data = $this->DecryptAES256($v->pass);
               array_push($aux, [
                   "id"=> $v->id,
                   "name"=> $v->name,
                   "email"=> $v->email,
                   "pass"=> $v->pass,
                   "password"=> $v->password,
                   "password_confirmation"=> $v->password_confirmation,
                   "remember_token"=> $v->remember_token,
                   "id_cargo"=> $v->id_cargo,
                   "id_empresa"=> $v->id_empresa,
                   "id_sucursal"=> $v->id_sucursal,
                   "cedula"=> $v->cedula,
                   "imagen"=> $v->imagen,
                   "status"=> $v->status,
                   "nombre"=> $v->nombre,
                   "passconv" => $data,
               ]);
           }

           $usuarioa = $aux; 
/*            ->where('u.name','LIKE','%'.$query.'%')
           ->orwhere('c.nombre','LIKE','%'.$query.'%')
           ->orderBy('u.id', 'desc')
           ->paginate(7); */
           return view('acceso.usuario.index', ['usuarioa' => $usuarioa]);  
        }
    }

    public function create()
    {
        $cargo=DB::table('cargo')->where('estado','=','1')->get();

   $empresa= Empresa::all();
return view('acceso.usuario.create',["cargo"=>$cargo,"empresa"=>$empresa]);

    }

    public function store (UsuarioFormRequest $request)
    {
           $usuario=new User;
           $usuario->id=$request->get('id');
           $usuario->name=$request->get('name');
           $usuario->email=$request->get('email');
           $usuario->pass=$this->EncryptAES256($request->get('pass'));
           $usuario->password= bcrypt($request->get('password'));
           $usuario->password_confirmation= $this->EncryptAES256($request->get('passconfir'));
           $usuario->id_cargo=$request->get('id_cargo');
           $usuario->id_empresa=$request->get('id_empresa');
           $usuario->id_sucursal=$request->get('id_sucursals');
           $usuario->cedula=$request->get('cedula');
           $usuario->status='1';  
           if(Input::hasFile('imagen')){
               $file=Input::file('imagen');
               $file->move(public_path().'/imagenes/usuarios/',$file->getClientOriginalName());
               $usuario->imagen=$file->getClientOriginalName();
           }     

           
           $usuario->save();
           /* return Redirect::to('acceso/usuario'); */
           $id = $usuario->id;
           return isset($id) ? Redirect::to('acceso/usuario')->with('message', "Guardado Exitoso") : Redirect::to('acceso/usuario')->with('messagerr', "Error al Guardar");
    }


    public function edit($id)
    {
        $cargo=DB::table('cargo')->where('estado','=','1')->get();
        $empresa= Empresa::all();
        $sucursal= Sucursal::all();
        $pass = DB::table('users')
        ->select('pass','password_confirmation')
        ->where('id','=', $id)
        ->first();
        $data = $this->DecryptAES256($pass->pass);
        $dataconf = $this->DecryptAES256($pass->password_confirmation);
        
     return view("acceso.usuario.edit",["data"=>$data,"dataconf"=>$dataconf,"cargo"=>$cargo,"empresa"=>$empresa,"sucursal"=>$sucursal,"usuario"=>User::findOrFail($id)]);
    }



    public function update(UsuarioFormRequest $request,$id)
    {
          $usuario=User::findOrFail($id);
          $usuario->name=$request->get('name');
          $usuario->email=$request->get('email');
          $usuario->pass=$this->EncryptAES256($request->get('pass'));
          $usuario->password=bcrypt($request->get('password'));
          $usuario->password_confirmation= $this->EncryptAES256($request->get('passconfir'));
          $usuario->id_cargo=$request->get('id_cargo');
          $usuario->id_empresa=$request->get('id_empresa');
          $usuario->id_sucursal=$request->get('id_sucursal');
          $usuario->cedula=$request->get('cedula');
          $usuario->status='1';      
          if(Input::hasFile('imagen')){
              $file=Input::file('imagen');
              $file->move(public_path().'/imagenes/usuarios/',$file->getClientOriginalName());
              $usuario->imagen=$file->getClientOriginalName();
          }   
          $usuario->update();
          /* return Redirect::to('acceso/usuario'); */
          return isset($id) ? Redirect::to('acceso/usuario')->with('message', "Actualización Exitosa") : Redirect::to('acceso/usuario')->with('messagerr', "Error al Actualizar");

    }

    public function byProyect($id)
    { 
       return Sucursal::where('id_empresa',$id)->get();
    }

    
    public function destroy($id)
    {
        $usuario=User::findOrFail($id);
        $usuario->estado='0';
        $usuario->update();
        return Redirect::to('acceso/usuario');
    }

    public function changStatusu(Request $request)
    {
       $usuario = User::find($request->id);
       $usuario->status= $request->status;
       $usuario->update();
    /* return response()->json(['succes'=>'Estado Cambiado con Éxito']); */
      
    }

    function EncryptAES256($text) {
        $aes256 = new AES256();
        $encrypted = $aes256::encrypt(json_encode($text, true), env('AES_SECRET'));
        return  json_decode(json_encode($encrypted), true);
    }

    function DecryptAES256($encrypted) {
            $aes256 = new AES256();
            $decrypted = $aes256::decrypt($encrypted, env('AES_SECRET'));
            return json_decode($decrypted);
    }

}
