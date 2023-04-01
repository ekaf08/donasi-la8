<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\M_Role_Menu_sub;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $role = Role::with(['menu' => function ($query) {
        //     $query->with('menu_detail');
        //     $query->with('sub_menu.sub_menu_detail');
        // }])->where('id', Auth::user()->role_id)->first();

        // foreach ($role->menu as $menu) {
        //     foreach ($menu->sub_menu as $sub_menu) {
        //         dd($sub_menu->alias_sub_menu);
        //         $query = $sub_menu;
        //     }
        // }
        return view('setup.index');
    }

    public function data()
    {
        $query = Role::orderBy('name', 'asc')
            ->get();
        // dd($query);
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $role = Role::with(['menu' => function ($query) {
                    $query->with('menu_detail');
                    $query->with('sub_menu.sub_menu_detail');
                }])->where('id', Auth::user()->role_id)->first();

                foreach ($role->menu as $menu) {
                    foreach ($menu->sub_menu as $sub_menu) {
                        // dd($sub_menu);
                        if ($sub_menu->id_sub_menu == 11 && $sub_menu->c_update == 't') {
                            $update = '<button type="button" class="btn btn-link text-success" onclick="editForm(`' . route('setup.show', encrypt($query->id)) . '`, `Edit role ' . $query->name . '`, `' . encrypt($query->id) . '`)" title="Edit- `' . $query->name . '`"><i class="fas fa-edit"></i></button>';
                        } elseif ($sub_menu->id_sub_menu == 11 && $sub_menu->c_update != 't') {
                            $update = '';
                        }

                        if ($sub_menu->id_sub_menu == 11 && $sub_menu->c_delete == 't') {
                            $delete = ' <button type="button" class="btn btn-link text-danger" onclick="deleteData(`' . route('setup.destroy', encrypt($query->id)) . '`)" title="Hapus- `' . $query->name . '`"><i class="fas fa-trash-alt"></i></button>';
                        } elseif ($sub_menu->id_sub_menu == 11 && $sub_menu->c_delete != 't') {
                            $delete = '';
                        }
                    }
                }

                $action = '
                    <div class="text-center">
                        ' . $update . '
                    ' . $delete . '
                    </div>
                ';
                return $action;
            })
            ->rawColumns(['action'])
            ->escapeColumns([])
            ->make(true);
    }

    public function menu(Request $request)
    {
        $query = Role::distinct()
            ->select(
                'roles.name',
                'roles.id',
                'm_menu_sub.nama_sub_menu',
                'm_role_menu_sub.*'
            )
            ->leftJoin('m_role_menu', 'roles.id', 'm_role_menu.id_role')
            ->join('m_role_menu_sub', 'm_role_menu.id', 'm_role_menu_sub.id_role_menu')
            ->leftJoin('m_menu_sub', 'm_menu_sub.id', 'm_role_menu_sub.id_sub_menu')
            ->where('roles.id', decrypt($request->id_role))
            ->whereNull('m_role_menu_sub.deleted_at')
            ->orderBy('m_role_menu_sub.id_sub_menu', 'asc')
            ->get();

        // dd($query);
        return datatables($query)
            ->addIndexColumn()
            ->editColumn('c_select', function ($query) {
                $checked = $query->c_select ? 'checked' : '';
                return '<input type="checkbox" onclick="ceklis(`' . $query->id . '`)" name="c_select" ' . $checked . '>';
            })
            ->editColumn('c_insert', function ($query) {
                $checked = $query->c_insert ? 'checked' : '';
                return '<input type="checkbox" name="c_insert" ' . $checked . '>';
            })
            ->editColumn('c_update', function ($query) {
                $checked = $query->c_update ? 'checked' : '';
                return '<input type="checkbox" name="c_update" ' . $checked . '>';
            })
            ->editColumn('c_delete', function ($query) {
                $checked = $query->c_delete ? 'checked' : '';
                return '<input type="checkbox" name="c_delete" ' . $checked . '>';
            })
            ->editColumn('c_export', function ($query) {
                $checked = $query->c_export ? 'checked' : '';
                return '<input type="checkbox" name="c_export" ' . $checked . '>';
            })
            ->editColumn('c_import', function ($query) {
                $checked = $query->c_import ? 'checked' : '';
                return '<input type="checkbox" name="c_import" ' . $checked . '>';
            })
            ->rawColumns(['c_select', 'c_insert', 'c_update', 'c_delete', 'c_export', 'c_import'])
            ->escapeColumns([])
            ->make(true);
    }

    public function updateMenu($id)
    {
        //
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
    public function show($id)
    {
        $id = decrypt($id);
        // dd('show ' . $id . ', ok');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $id = decrypt($id);
        // dd('destroy ' . $id . ', ok');
    }
}
