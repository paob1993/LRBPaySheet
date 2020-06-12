<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Cargo;
use App\Models\Empleado;
use App\OwnModels\Utilidades;
use App\Http\Requests\UserForm;
use Illuminate\Http\Request;

use Auth;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        /**
         * Verificar que el usuario en sesión tenga permisos de ver el index
         */
        if (Auth::user()->cannot('index', User::class)){
            return redirect()->route('/');
        }

        /**
         * Filtros
         */
        $cantidad = Utilidades::getWithDefault(filter_input(INPUT_GET, 'cantidad', FILTER_SANITIZE_NUMBER_INT), 15);
        $nombres = filter_input(INPUT_GET, 'nombres', FILTER_SANITIZE_STRING);
        $apellidos = filter_input(INPUT_GET, 'apellidos', FILTER_SANITIZE_STRING);
        $cargo_filtro = filter_input(INPUT_GET, 'cargo_filtro', FILTER_SANITIZE_NUMBER_INT);
        $cedula = filter_input(INPUT_GET, 'cedula', FILTER_SANITIZE_STRING);

        /**
         * Obtener todos los usuarios
         */
        $users = Empleado::with(['user', 'cargo'])
            ->orderBy('empleado.id', 'desc');
        $cargos = Cargo::all();        

        /**
         * Aplicar filtros
         */
        if ($nombres) {
            $users = $users->where('nombres', 'LIKE', "%$nombres%");
        }
        if ($apellidos) {
            $users = $users->where('apellidos', 'LIKE', "%$apellidos%");
        }
        if ($cargo_filtro) {
            $users= $users->where('cargo_id',$cargo_filtro);
        }

        if ($cedula) {
            $users = $users->where('cedula', $cedula);
        }


        /**
         * Retorno la vista con las variables necesarias
         */
        return view('pages.users.index', [
            'users' => $users->paginate($cantidad), 
            'busqueda_cantidad' => $cantidad,
            'nombres' => $nombres, 
            'apellidos' => $apellidos,
            'cedula' => $cedula,
            'cargo_filtro' => $cargo_filtro,
            'cargos' => $cargos
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserForm $request) {
        /**
         * Verificar que el usuario en sesión tenga permisos de crear
         */
        if (Auth::user()->cannot('create', User::class)){
            return redirect()->route('/');
        }

        /**
         * Crear la nueva instancia de usuario y asignarle los valores
         */
        $user_to_add = new User();
        $user_to_add->cedula = $request->cedula;
        $user_to_add->empleado_id = $request->empleado_id;
        $user_to_add->rol_id = $request->rol_id;
        $user_to_add->password = bcrypt($request->password);

        /**
         * Si no guarda enviar la alerta de que no se pudo agregar correctamente
         */
        if(!$user_to_add->save()) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido agregar el usuario correctamente."))->withInput();
        }

        /**
         * Al guardar enviar la alerta de que se guardo correctamente
         */
        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "Se ha agregado el usuario correctamente."));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        /**
         * Buscar el usuario especificado
         */
        $user_to_find = User::with(['rol', 'empleado', 'empleado.cargo'])
            ->where('user.id', $id)
            ->first();

        /**
         * Si no se encuentra el usuario o si quien está logueado no tiene permisos para acceder a la vista de usuario se
         * retorna falso en el resultado.
         */
        if(!$user_to_find || Auth::user()->cannot('view',$user_to_find)){
            return json_encode(['result'=>false,'data'=>[]]);
        };  

        /**
         * Se retorna el resultado en true y la data solicitada
         */      
        return json_encode(['result'=>true,'data'=>$user_to_find]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserForm $request, $id) {
        /**
         * Buscar el usuario especificado
         */      
        $user_to_find = User::find($id);

        /**
         * Si no se encuentra el usuario se envía una alerta
         */
        if(!$user_to_find){
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "El usuario no existe o no se encuentra disponible."))->withInput();
        }  

        /**
         * Se verifica que el usuario logueado tenga permisos para editar un usuario.
         */
        if(Auth::user()->cannot('update',$user_to_find)){
            return redirect()->route('/');
        }

        /**
         * Se verifica si se editó la contraseña del usuario.
         */
        if($request->password){
            $user_to_find->password = bcrypt($request->password);
        }

        /**
         * Si no guarda enviar la alerta de que no se pudo actualizar correctamente
         */
        if(!$user_to_find->save()) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido actualizar correctamente."))->withInput();
        }

        /**
         * Al actualizar enviar la alerta de que se actualizó correctamente
         */
        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "La actualización se ha realizado correctamente."));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        /**
         * Buscar el usuario especificado
         */      
        $user_to_find = User::find($id);

        /**
         * Si no se encuentra el usuario se envía una alerta
         */
        if(!$user_to_find) {
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "El usuario no existe o no se encuentra disponible."))->withInput();
        }

        /**
         * Se verifica que el usuario logueado tenga permisos para eliminar un usuario.
         */
        if(Auth::user()->cannot('delete',$user_to_find)){
            return redirect()->route('/');
        }
        
        /**
         * Si no elimina enviar la alerta de que no se pudo eliminar correctamente
         */
        if(!$user_to_find->delete()){
            return redirect()->back()->with("alert",Utilidades::getAlert("danger", "Error", "No se ha podido eliminar correctamente."))->withInput();
        }

        /**
         * Al eliminar enviar la alerta de que se eliminó correctamente
         */
        return redirect()->back()->with("alert",Utilidades::getAlert("success", "Éxito", "La eliminación se ha realizado correctamente."));
    }
}
