<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function __construct() {
        $this->middleware('admin')->except('showAll','login','createUser','storeUser','processLogin','logout');
    }
    
    
    private $bladeFolder = 'user';
    const RPP = 10;
    const ORDERBY = 'users.id';
    const ORDERTYPE ='asc';
    const PARAMS = [
        'rowsPerPage' => [
            self::RPP => self::RPP,
            3 => 3,
            25 => 25,
            50 => 50
            ],
            'orderBy' => [
             self::ORDERBY => self::ORDERBY,
             'users.name' => 'users.name',
             'users.tipo' => 'users.tipo',
                
            ],
            'orderType' => [
                self::ORDERTYPE => self::ORDERTYPE,
                'desc' =>'desc'
                ]
        ];
    
    private function getBladeFolder(string $folder) {
        return $this->bladeFolder . '.' . $folder;
    }
    
    private static function getFromRequest($request, $nombre, $defaultValue) {
        $value = $defaultValue;
        if($request->$nombre != null) {
            $value = $request->$nombre;
        }
        if ($defaultValue != null && !isset(self::PARAMS[$nombre][$value])) {
            $value = current(self::PARAMS[$nombre]);
            $value = array_key_first(self::PARAMS[$nombre]);
        }
        return $value;
    }
    
    private static function getRowsPerPage() {
        return [
            3 => 3,
            10 => 10,
            25 => 25,
            50 => 50
        ];
    }
    
    public function index(Request $request) {
        // $users = User::all();
        // return view('user.index', ['users' => $users]);
        
        $rpp = self::getFromRequest($request,'rowsPerPage',self::RPP);
        $orderBy = self::getFromRequest($request,'orderBy',self::ORDERBY);
        $orderType = self::getFromRequest($request,'orderType',self::ORDERTYPE);
        $q = self::getFromRequest($request,'q',null);
        if ($q == null){
            $users = User::where('id', '>', 2 )->orderBy($orderBy,$orderType)->orderBy('name','asc')->paginate($rpp);
        } else{
            $users = User::where('name', 'like', '%' . $q . '%')
            ->orWhere('id', $q)
            ->orderBy($orderBy,$orderType)
            ->orderBy('name','asc')
            ->paginate($rpp);
        }
        
        return view($this->getBladeFolder('index'),
            [
                'users' => $users,
                'rpp' => $rpp,
                'rpps' => self::getRowsPerPage(),
                'orderBy' => $orderBy,
                'orderType' => $orderType,
                'q' => $q
            ]);
    }


    public function create() {
        return view('user.create');
    }


    public function store(Request $request) {
        $user = new User($request->except('password'));
        $user->password = Hash::make($request->password);
        $user->tipo = $request->tipo; 
    
        try {
            $user->save();
            return redirect('user')->with(['message' => 'El usuario se ha guardado correctamente']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El usuario no se ha guardado correctamente']);
        }
    }


    public function show($id) {
        $user = User::find($id);
        if ($user) {
            return view('user.show', ['user' => $user]);
        } else {
            return redirect('user')->with(['message' => 'Usuario no encontrado']);
        }
    }


    public function edit($id) {
        //
        $user = User::find($id);
        if ($user) {
            return view('user.edit', ['user' => $user]);
        } else {
            return redirect('user')->with(['message' => 'Usuario no encontrado']);
        }
    }


    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
    
        $user->fill($request->except('password'));
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->tipo = $request->tipo;
    
        try {
            $user->save();
            return redirect('user')->with(['message' => 'El usuario se ha actualizado correctamente']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El usuario no se ha actualizado correctamente']);
        }
    }


    public function destroy($id) {
        
        $user = User::find($id);
    
        if ($user) {
            $user->delete();
            return redirect('user')->with(['message' => 'Usuario eliminado con éxito']);
        } else {
            return redirect('user')->with(['message' => 'Usuario no encontrado']);
        }
    }

    public function login() {
        
        return view('user.connectUser');
    }
    
    public function createUser(){
        
        return view('user.createUser');
    }


    public function storeUser(Request $request) {

        $validatedData = $request->validate([
            'name' => 'required',
            'password'=> 'required',
            'email' => 'required|email',
        ]);
        
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->tipo = $request->tipo; 
        try {
            $user->save();
            return redirect('usera/login')->with(['message' => 'El usuario se ha guardado correctamente']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El usuario no se ha guardado correctamente' . $e->getMessage()]);
        }
        
    }

    public function processLogin(Request $request) {
    
    try {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->put('user', $user);
            return redirect()->intended('/');
        }

            return redirect()->back()->withInput()->withErrors(['message' => 'User/Password Incorrect']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['message' => 'Error logging in: ' . $e->getMessage()]);
        }
    }
    
        public function logout(Request $request) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/'); 
    }

}
