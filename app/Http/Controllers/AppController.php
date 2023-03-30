<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setup.index');
    }

    public function data()
    {
        $query = Role::leftJoin('m_role_menu', 'm_role_menu.id_role', 'roles.id')
            ->leftJoin('m_role_menu_sub', 'm_role_menu_sub.id_role_menu', 'm_role_menu.id')
            ->select(
                'roles.*',
                'roles.id as role.id',
                'm_role_menu.id as role_menu',
                'm_role_menu_sub.id as m_role_menu_sub',
                'm_role_menu_sub.c_update',
                'm_role_menu_sub.c_delete'
            )
            ->where('m_role_menu_sub.id', '11')
            ->orderBy('name', 'asc')
            ->get();
        dd($query);
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
            })
            ->rawColumns([])
            ->escapeColumns([])
            ->make(true);
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
        //
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
        //
    }
}
