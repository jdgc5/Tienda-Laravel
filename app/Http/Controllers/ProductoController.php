<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
    public function __construct() {
        $this->middleware('admin')->except('showAll');
    }
    
    private $bladeFolder = 'backend';
    const RPP = 10;
    const ORDERBY = 'productos.id';
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
             'productos.nombre' => 'productos.nombre',
             'productos.stock' => 'productos.stock',
                
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
     
    public function index(Request $request)
    {
        // $productos = Producto::all(); 
        // return view('backend.producto.index', ['productos' => $productos]); 
        
        $rpp = self::getFromRequest($request,'rowsPerPage',self::RPP);
        $orderBy = self::getFromRequest($request,'orderBy',self::ORDERBY);
        $orderType = self::getFromRequest($request,'orderType',self::ORDERTYPE);
        $q = self::getFromRequest($request,'q',null);
        if ($q == null){
            $productos = Producto::where('id', '>', 2 )->orderBy($orderBy,$orderType)->orderBy('nombre','asc')->paginate($rpp);
        } else{
            $productos = Producto::where('nombre', 'like', '%' . $q . '%')
            ->orWhere('id', $q)
            ->orderBy($orderBy,$orderType)
            ->orderBy('nombre','asc')
            ->paginate($rpp);
        }
        
        return view($this->getBladeFolder('producto.index'),
            [
                'productos' => $productos,
                'rpp' => $rpp,
                'rpps' => self::getRowsPerPage(),
                'orderBy' => $orderBy,
                'orderType' => $orderType,
                'q' => $q
            ]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('backend.producto.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'talla' => 'required',
            'genero' => 'required',
            'color' => 'required',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,gif,jpg',
        ]);
    
        $producto = new Producto($request->except('imagen'));
    
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $archivo = $request->file('imagen');
            $nombreArchivo = uniqid('image_') . '.' . $archivo->getClientOriginalExtension();
            $archivo->storeAs('producto_images', $nombreArchivo, 'public');
            $producto->imagen = 'producto_images/' . $nombreArchivo;
        }
    
        try {
            $producto->save();
            return redirect('admin')->with(['message' => 'El producto se ha guardado correctamente']);
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'El producto no se ha guardado correctamente']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {   
        $producto = Producto::find($id);
        return view('backend.producto.show', ['producto' => $producto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
        $producto = Producto::find($id);
        return view('backend.producto.edit', ['producto' => $producto]);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $producto = Producto::find($id);
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric|min:0',
        'talla' => 'required',
        'genero' => 'required',
        'color' => 'required',
        'stock' => 'required|integer|min:0',
        'imagen' => 'nullable|image|mimes:jpeg,png,gif,jpg',
    ]);

    // Actualizar los datos del producto
    $producto->update($request->except('imagen'));

    // Verificar si se cargó una nueva imagen
    if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
        // Eliminar la imagen anterior si existe
        if ($producto->imagen) {
            Storage::delete($producto->imagen);
        }

        // Guardar la nueva imagen
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            $archivo = $request->file('imagen');
            $nombreArchivo = uniqid('image_') . '.' . $archivo->getClientOriginalExtension();
            $archivo->storeAs('public/producto_images', $nombreArchivo);
            $producto->imagen = 'producto_images/' . $nombreArchivo;
        }

    }

    try {
        $producto->save();
        return redirect('admin')->with(['message' => 'El producto se ha actualizado correctamente']);
    } catch (\Exception $e) {
        return back()->withInput()->withErrors(['message' => 'El producto no se ha actualizado correctamente']);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $producto = Producto::find($id);
        try {
            $producto->delete();
            return redirect('admin')->with(['message' => 'El producto ha sido eliminado']); 
        } catch(\Exception $e) {
             return back()->withErrors(['message' => 'El producto no ha sido eliminado']);
        }
    }

    
    // public function showAll(Request $request) {
    //     $perPage = $request->get('per_page', 10);
        
    //     if ($request->has('genero') && $request->input('genero') === 'hombre') {
    //         $productos = Producto::where('genero', 'hombre')->paginate($perPage);
    //     } else if ($request->has('genero') && $request->input('genero') === 'mujer') {
    //         $productos = Producto::where('genero', 'mujer')->paginate($perPage);
    //     } else {
    //         $productos = Producto::paginate($perPage);
    //     }
    //     return response()->json($productos);
    // }
    
    public function showAll(Request $request) {
        $perPage = $request->get('per_page', 10);
        $genero = $request->input('genero', '*');
        $searchTerm = $request->input('search');
    
        // Obtener el rango de precios seleccionado
        $priceRange = $request->input('price_range');

    
        $query = Producto::query();
    
        // Aplicar filtros según el término de búsqueda
        if ($searchTerm) {
            $query->where('nombre', 'like', '%' . $searchTerm . '%');
        }
    
        // Aplicar filtro por género si se proporciona
        if ($genero !== '*') {
            $query->where('genero', $genero);
        }
    
        // Aplicar filtro por precio si se proporciona
        if ($priceRange) {
            // Obtener el precio máximo del rango
            $maxPrice = (float)explode('-', $priceRange)[1];
            // Aplicar el filtro
            $query->where('precio', '<=', $maxPrice);
        }
    
        // Obtener los productos paginados
        $productos = $query->paginate($perPage);
    
        return response()->json($productos);
    }


}
