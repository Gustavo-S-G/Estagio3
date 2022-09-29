<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
        $this->middleware('auth');
        $this->middleware(['auth', 'role_or_permission:admin|Criar função|Criar permissão']);
    }

    public function index()
    {
        $permissions = $this->permission::all();

        return view("permission.index", ['permissions' => $permissions]);
    }

    public function getAllPermissions()
    {
        $permissions = $this->permission::all();

        return response()->json([
            'permissions' => $permissions
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("permission.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions'
        ]);

        $this->permission->create([
            'name' => $request->name
        ]);

        return redirect()->route('permission.index')->with('success', 'Permissão Criada com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function getAll(){
        $permissions = $this->permission->all();
        return response()->json([
            'permissions' => $permissions
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->permission->find($id);

        return view("permission.edit", ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$id
        ]);

        $permission = $this->permission->find($id);

        $permission->update([
            'name' => $request->name
        ]);

        return redirect()->route('permission.index')
            ->with('success', 'Permissão Atualizada com Sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->permission->findOrFail($id);

        $permission->delete();

        return redirect()->route('permission.index')
                        ->with('success','Permissão Deletada com sucesso!');
    }
}
