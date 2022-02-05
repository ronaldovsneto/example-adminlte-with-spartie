<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use Permission;

    private $config;

    public function __construct(){
        $permission = 'user';
        $config = [
            'permissions' => [
                'list'      =>   $permission.'_list',
                'show'      =>   $permission.'_show',
                'add'       =>   $permission.'_add',
                'edit'      =>   $permission.'_edit',
                'delete'    =>   $permission.'_delete',
            ],
            'model' => User::class,
            'route' => 'users',
            'path'  =>  'users'
        ];
        $this->config = $config;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            //USING PACKAGE YAJRABOX DATATABLE - https://datatables.yajrabox.com/
            return DataTables::of($this->config['model']::query())
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
                ->escapeColumns([])
                ->make(true);
        }
        return view($this->config['route'].'.index',[
           'data' => $this->config['model']::all()
        ]);
    }

    public function edit($id){
        return view($this->config['route'].'.edit',[
            'data' => $this->config['model']::find($id)
        ]);
    }
}
