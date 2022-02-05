<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Traits\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    use Permission;

    private $config;

    public function __construct(){
        $permission = 'role';
        $config = [
            'permissions' => [
                'list'      =>   $permission.'_list',
                'show'      =>   $permission.'_show',
                'add'       =>   $permission.'_add',
                'edit'      =>   $permission.'_edit',
                'delete'    =>   $permission.'_delete',
            ],
            'model' => Role::class,
            'route' => 'roles',
            'path'  => 'roles'
        ];
        $this->config = $config;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = $this->config['model']::query();

        if ($request->ajax()) {
            //USING PACKAGE YAJRABOX DATATABLE - https://datatables.yajrabox.com/
            return DataTables::of($datas)
                ->addColumn('actions', function($data){
                    $column = "";

                    //CHECK PERMISSION TO EDIT
                    if(auth()->user()->can($this->config['permissions']['edit']))
                        $column .= "<a href='" . route($this->config['route'].'.edit', $data->id) . "' title='Edit' class='btn btn-xs text-gray btn-box-tool p-0'><i class='fa fa-edit'></i></a>";

                    //CHECK PERMISSION TO DELETE DATA
                    if(auth()->user()->can($this->config['permissions']['delete']))
                        $column .= "<a href='#' title='Delete' class='btn btn-xs text-gray btn-box-tool p-0'><i class='fa fa-trash'></i></a>";

                    return $column;
                })
                ->addColumn('permissions', function($data){
                    return $data->permissions->count();
                })
                ->addColumn('module', function($data){
                    if($data->name != config('permission')['super-admin']){
                        $array = array();
                        $labels = array();
                        $list = $data->permissions;
                        foreach ($list as $item){
                            $permission = substr($item->name, 0, strpos($item->name, '_'));
                            if(!in_array($permission, $array)){
                                $array[] = $permission;
                                $labels[] = "<span class='right badge badge-success'>{$permission}</span>";
                            }
                        }
                        return $labels;
                    }
                    return "<span class='right badge badge-danger'>".config('permission')['super-admin']."</span>";
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view($this->config['route'].'.index',[
            'data' => $this->config['model']::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view($this->config['route'].'.edit',[
            'data' => Role::findById($id)
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
