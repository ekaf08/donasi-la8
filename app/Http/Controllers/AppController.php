<?php

namespace App\Http\Controllers;

use App\Models\M_Menu;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\M_Role_Menu;
use App\Models\M_Role_Menu_sub;
use Dotenv\Validator;
use Exception;
use Faker\Guesser\Name;

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
        $query = Role::orderBy('id', 'asc')
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
                            $update = '<button type="button" class="btn btn-link text-primary" onclick="editForm(`' . route('setup.show', encrypt($query->id)) . '`, `Edit role ' . $query->name . '`, `' . encrypt($query->id) . '`)" title="Edit- `' . $query->name . '`"><i class="nav-icon fas fa-cogs"></i></button>';
                        } elseif ($sub_menu->id_sub_menu == 11 && $sub_menu->c_update != 't') {
                            $update = '';
                        }

                        if ($sub_menu->id_sub_menu == 11 && $sub_menu->c_delete == 't') {
                            $delete = ' <button type="button" class="btn btn-link text-danger" onclick="deleteData(`' . route('setup.destroy', encrypt($query->id)) . '`, `Role ' . $query->name . '`)" title="Hapus- `' . $query->name . '`"><i class="fas fa-trash-alt"></i></button>';
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
        $menu = M_Role_Menu::leftJoin('roles', 'roles.id', 'm_role_menu.id_role')
            ->leftJoin('m_menu', 'm_menu.id', 'm_role_menu.id_menu')
            ->where('roles.id', decrypt($request->id_role))
            ->select('roles.id as role_id', 'm_menu.id as m_menu_id', 'm_menu.nama_menu', 'm_role_menu.*')
            ->orderBy('m_role_menu.urutan', 'asc')
            ->withTrashed()
            ->get();

        return datatables($menu)
            ->addIndexColumn()
            ->editColumn('deleted_at', function ($menu) {
                $checked = $menu->deleted_at ? '' : 'checked';
                return ' 
                <label class="container">
                    <input type="checkbox" name="is_active_menu[]" id="is_active_menu[]" data-id="' . encrypt($menu->id) . '" value=""  ' . $checked . '>
                    <span class="checkmark"></span>
                </label>
                   
                ';
            })
            ->addColumn('action', function ($menu) {
                $panah = '
                    <button type="button" class="btn btn-link text-success" id="atas" data-urutan="' . $menu->urutan . '" data-id="' . $menu->id . '" data-jumlah="7"><i class="fas fa-arrow-alt-circle-up"></i></button>
                    <button type="button" class="btn btn-link text-success" id="bawah" data-urutan="' . $menu->urutan . '" data-id="' . $menu->id . '" data-jumlah="7"><i class="fas fa-arrow-alt-circle-down"></i></button>
                ';
                $urutan = '<input type="text" class="form-control text-center" name="urutan" id="urutan" value="' . $menu->urutan . '" data-id="' . $menu->id . '">';
                return $panah;
            })
            ->rawColumns(['deleted_at', 'action'])
            ->escapeColumns([])
            ->make(true);
    }

    public function urutanMenu(Request $request)
    {
        $id        = $request->id;
        $direction = $request->direction;

        $item = M_Role_Menu::find($id);
        $currentOrder   = $item->urutan;
        $currentRole    = $item->id_role;
        // dd($id, $currentOrder, $currentRole);

        if ($direction == 'up') {
            // urutan Naik/ Panah Atas
            $itemAbove = M_Role_Menu::where('urutan', '<', $currentOrder)->where('id_role', $currentRole)->orderBy('urutan', 'desc')->first();
            if ($itemAbove) {
                $item->urutan = $itemAbove->urutan;
                $itemAbove->urutan = $currentOrder;
                $item->save();
                $itemAbove->save();
            }
        } elseif ($direction == 'down') {
            // urutan Turun/ Panah Bawah
            $itemBellow = M_Role_Menu::where('urutan', '>', $currentOrder)->where('id_role', $currentRole)->orderBy('urutan')->first();
            if ($itemBellow) {
                $item->urutan = $itemBellow->urutan;
                $itemBellow->urutan = $currentOrder;
                $item->save();
                $itemBellow->save();
            }
        }
        return response()->json(['message' => 'Menu Berhasil Diperbarui', 'success' => true]);
    }

    public function hapus_menu(Request $request)
    {
        $id = decrypt($request->id);
        // dd($id);
        $data = M_Role_Menu::find($id);
        $data->delete();

        return response()->json(['data' => null, 'message' => 'Menu Berhasil Di Non Aktifkan', 'success' => true]);
    }

    public function restore_menu(Request $request)
    {
        $id = decrypt($request->id);
        // dd($id);
        $data = M_Role_Menu::withTrashed()->find($id);
        $data->restore();

        return response()->json(['data' => null, 'message' => 'Menu Berhasil Di Aktifkan', 'success' => true]);
    }

    public function subMenu(Request $request)
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
                return '
                <label class="container">
                    <input type="checkbox" name="is_active[]" id="is_active" data-id="' .  encrypt($query->id) . '" data-kolom="c_select" value=""  ' . $checked . '>
                    <span class="checkmark"></span>
                </label>
                
                ';
            })
            ->editColumn('c_insert', function ($query) {
                $checked = $query->c_insert ? 'checked' : '';
                return '
                <label class="container">
                    <input type="checkbox" name="is_active[]" id="is_active" data-id="' .  encrypt($query->id) . '" data-kolom="c_insert" value="" ' . $checked . '>
                    <span class="checkmark"></span>
                </label>
                ';
            })
            ->editColumn('c_update', function ($query) {
                $checked = $query->c_update ? 'checked' : '';
                return '
                <label class="container">
                    <input type="checkbox" name="is_active[]" id="is_active" data-id="' .  encrypt($query->id) . '" data-kolom="c_update" value=""  ' . $checked . '>
                    <span class="checkmark"></span>
                </label>
                ';
            })
            ->editColumn('c_delete', function ($query) {
                $checked = $query->c_delete ? 'checked' : '';
                return '
                <label class="container">
                    <input type="checkbox" name="is_active[]" id="is_active" data-id="' .  encrypt($query->id) . '" data-kolom="c_delete" value=""  ' . $checked . '>
                    <span class="checkmark"></span>
                </label>
                ';
            })
            ->editColumn('c_export', function ($query) {
                $checked = $query->c_export ? 'checked' : ':not(:checked)';
                return '
                <label class="container">
                    <input type="checkbox" name="is_active[]" id="is_active" data-id="' .  encrypt($query->id) . '" data-kolom="c_export" value=""  ' . $checked . '>
                    <span class="checkmark"></span>
                </label>
                ';
            })
            ->editColumn('c_import', function ($query) {
                $checked = $query->c_import ? 'checked' : '';
                return '
                <label class="container">
                    <input type="checkbox" name="is_active[]" id="is_active" data-id="' .  encrypt($query->id) . '" data-kolom="c_import" value=""  ' . $checked . '>   
                    <span class="checkmark"></span>
                </label>
                ';
            })
            ->addColumn('action', function ($query) {
                return ' <button type="button" class="btn btn-link text-danger" onclick="deleteData(`' . route('setup.hapus_subMenu', encrypt($query->id)) . '`, `Menu ' . $query->nama_sub_menu . '`)" title="Hapus- `' . $query->nama_sub_menu . '`"><i class="fas fa-trash-alt"></i></button>';
            })
            ->rawColumns(['c_select', 'c_insert', 'c_update', 'c_delete', 'c_export', 'c_import', 'action'])
            ->escapeColumns([])
            ->make(true);
    }

    public function configMenu(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'is_active' => 'boolean'
        ]);
        try {
            $menu = M_Role_Menu_sub::where('id', decrypt($request->id))->first();
            $kolom = $request->kolom;
            $menu->$kolom = $request->boolean('value');
            $menu->save();

            return response()->json(['data' => $menu, 'message' => 'Menu Berhasil Diperbarui', 'success' => true]);
        } catch (Exception $e) {
            return response()->json(['message' => 'Mohon maaf telah terjadi kesalahan.'], 500);
            //throw $th;
        }
    }

    public function hapus_subMenu($id)
    {
        $id = decrypt($id);
        $menu = M_Role_Menu_sub::where('id', $id)->first();
        $menu->c_select = 'false';
        $menu->c_insert = 'false';
        $menu->c_update = 'false';
        $menu->c_delete = 'false';
        $menu->c_import = 'false';
        $menu->c_export = 'false';
        $menu->save();
        $menu->delete();
        return response()->json(['data' => null, 'message' => 'Sub Menu Berhasil Dihapus', 'success' => true]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = new Role;
        $data['name'] = $request->name;
        $data->save();
        $role_id = $data->id;

        $role_menu = M_Role_Menu::where('id_role', '2')->orderBy('id', 'asc')->get();
        foreach ($role_menu as $key => $value) {
            $data = new M_Role_Menu;

            $data['id_role'] = $role_id;
            $data['id_menu'] = $value->id_menu;
            $data['alias_menu'] = $value->alias_menu;
            $data['urutan'] = $value->urutan;
            $data->save();
        }

        if ($request->master != '' && $request->master == 'Master') {
            $master = Role::join('m_role_menu', 'roles.id', 'm_role_menu.id_role')
                ->join('m_menu', 'm_menu.id', 'm_role_menu.id_menu')
                ->join('m_menu_sub', 'm_menu_sub.id_menu', 'm_menu.id')
                ->select('roles.id as id', 'm_role_menu.id as id_m_role_menu', 'm_role_menu.id_menu as id_menu', 'm_role_menu.id_role as id_role', 'm_menu.id as id_m_menu', 'm_menu.nama_menu', 'm_menu_sub.nama_sub_menu', 'm_menu_sub.id as id_sub_menu', 'm_menu_sub.id_menu as id_m_menu_sub')
                ->where('roles.id', $role_id)
                ->orderBy('m_menu_sub.id', 'asc')
                ->where('m_menu.nama_menu', 'Master')->get();
            foreach ($master as $key => $value) {
                $data = new M_Role_Menu_sub;
                $data['id_role_menu'] = $value->id_m_role_menu;
                $data['id_sub_menu'] = $value->id_sub_menu;
                $data['alias_sub_menu'] = $value->nama_sub_menu;
                $data->save();
            }
        }

        if ($request->referensi != '' && $request->referensi == 'Referensi') {
            $referensi = Role::join('m_role_menu', 'roles.id', 'm_role_menu.id_role')
                ->join('m_menu', 'm_menu.id', 'm_role_menu.id_menu')
                ->join('m_menu_sub', 'm_menu_sub.id_menu', 'm_menu.id')
                ->select('roles.id as id', 'm_role_menu.id as id_m_role_menu', 'm_role_menu.id_menu as id_menu', 'm_role_menu.id_role as id_role', 'm_menu.id as id_m_menu', 'm_menu.nama_menu', 'm_menu_sub.nama_sub_menu', 'm_menu_sub.id as id_sub_menu', 'm_menu_sub.id_menu as id_m_menu_sub')
                ->where('roles.id', $role_id)
                ->orderBy('m_menu_sub.id', 'asc')
                ->where('m_menu.nama_menu', 'Referensi')->get();
            foreach ($referensi as $key => $value) {
                $data = new M_Role_Menu_sub;
                $data['id_role_menu'] = $value->id_m_role_menu;
                $data['id_sub_menu'] = $value->id_sub_menu;
                $data['alias_sub_menu'] = $value->nama_sub_menu;
                $data->save();
            }
        }

        if ($request->informasi != '' && $request->informasi == 'Informasi') {
            $informasi = Role::join('m_role_menu', 'roles.id', 'm_role_menu.id_role')
                ->join('m_menu', 'm_menu.id', 'm_role_menu.id_menu')
                ->join('m_menu_sub', 'm_menu_sub.id_menu', 'm_menu.id')
                ->select('roles.id as id', 'm_role_menu.id as id_m_role_menu', 'm_role_menu.id_menu as id_menu', 'm_role_menu.id_role as id_role', 'm_menu.id as id_m_menu', 'm_menu.nama_menu', 'm_menu_sub.nama_sub_menu', 'm_menu_sub.id as id_sub_menu', 'm_menu_sub.id_menu as id_m_menu_sub')
                ->where('roles.id', $role_id)
                ->orderBy('m_menu_sub.id', 'asc')
                ->where('m_menu.nama_menu', 'Informasi')->get();
            foreach ($informasi as $key => $value) {
                $data = new M_Role_Menu_sub;
                $data['id_role_menu'] = $value->id_m_role_menu;
                $data['id_sub_menu'] = $value->id_sub_menu;
                $data['alias_sub_menu'] = $value->nama_sub_menu;
                $data->save();
            }
        }

        if ($request->report != '' && $request->report == 'Report') {
            $report = Role::join('m_role_menu', 'roles.id', 'm_role_menu.id_role')
                ->join('m_menu', 'm_menu.id', 'm_role_menu.id_menu')
                ->join('m_menu_sub', 'm_menu_sub.id_menu', 'm_menu.id')
                ->select('roles.id as id', 'm_role_menu.id as id_m_role_menu', 'm_role_menu.id_menu as id_menu', 'm_role_menu.id_role as id_role', 'm_menu.id as id_m_menu', 'm_menu.nama_menu', 'm_menu_sub.nama_sub_menu', 'm_menu_sub.id as id_sub_menu', 'm_menu_sub.id_menu as id_m_menu_sub')
                ->where('roles.id', $role_id)
                ->orderBy('m_menu_sub.id', 'asc')
                ->where('m_menu.nama_menu', 'Report')->get();
            foreach ($report as $key => $value) {
                $data = new M_Role_Menu_sub;
                $data['id_role_menu'] = $value->id_m_role_menu;
                $data['id_sub_menu'] = $value->id_sub_menu;
                $data['alias_sub_menu'] = $value->nama_sub_menu;
                $data->save();
            }
        }

        if ($request->aktivitas != '' && $request->aktivitas == 'Aktivitas') {
            $aktivitas = Role::join('m_role_menu', 'roles.id', 'm_role_menu.id_role')
                ->join('m_menu', 'm_menu.id', 'm_role_menu.id_menu')
                ->join('m_menu_sub', 'm_menu_sub.id_menu', 'm_menu.id')
                ->select('roles.id as id', 'm_role_menu.id as id_m_role_menu', 'm_role_menu.id_menu as id_menu', 'm_role_menu.id_role as id_role', 'm_menu.id as id_m_menu', 'm_menu.nama_menu', 'm_menu_sub.nama_sub_menu', 'm_menu_sub.id as id_sub_menu', 'm_menu_sub.id_menu as id_m_menu_sub')
                ->where('roles.id', $role_id)
                ->orderBy('m_menu_sub.id', 'asc')
                ->where('m_menu.nama_menu', 'Aktivitas')->get();
            foreach ($aktivitas as $key => $value) {
                $data = new M_Role_Menu_sub;
                $data['id_role_menu'] = $value->id_m_role_menu;
                $data['id_sub_menu'] = $value->id_sub_menu;
                $data['alias_sub_menu'] = $value->nama_sub_menu;
                $data->save();
            }
        }

        if ($request->pengaturan != '' && $request->pengaturan == 'Pengaturan') {
            $pengaturan = Role::join('m_role_menu', 'roles.id', 'm_role_menu.id_role')
                ->join('m_menu', 'm_menu.id', 'm_role_menu.id_menu')
                ->join('m_menu_sub', 'm_menu_sub.id_menu', 'm_menu.id')
                ->select('roles.id as id', 'm_role_menu.id as id_m_role_menu', 'm_role_menu.id_menu as id_menu', 'm_role_menu.id_role as id_role', 'm_menu.id as id_m_menu', 'm_menu.nama_menu', 'm_menu_sub.nama_sub_menu', 'm_menu_sub.id as id_sub_menu', 'm_menu_sub.id_menu as id_m_menu_sub')
                ->where('roles.id', $role_id)
                ->orderBy('m_menu_sub.id', 'asc')
                ->where('m_menu.nama_menu', 'Pengaturan')->get();
            foreach ($pengaturan as $key => $value) {
                $data = new M_Role_Menu_sub;
                $data['id_role_menu'] = $value->id_m_role_menu;
                $data['id_sub_menu'] = $value->id_sub_menu;
                $data['alias_sub_menu'] = $value->nama_sub_menu;
                $data->save();
            }
        }
        return response()->json(['data' => $data, 'message' => 'Role Berhasil Ditambahkan', 'success' => true]);
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

        $role = Role::where('id', $id)->first();

        return response()->json(['data' => $role]);
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
        // dd($request->all());
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
        // dd($id);
        $role = Role::where('id', $id)->first();
        $role->delete();
        return response()->json(['data' => null, 'message' => 'Role Berhasil Dihapus', 'success' => true]);
    }
}
