<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $paginate = 5;
    public function index(Request $request)
    {
        $category = Category::orderBy('name')
            ->when($request->has('cari') && $request->cari != "", function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->cari . '%');
            })
            ->paginate($request->rows ?? $this->paginate)
            ->appends($request->only('rows', 'cari'));

        // dd($category)->toArray();
        return view('category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.form');
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
            'name' => 'required|unique:categories,name|regex:/^[\w-]*$/'
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);
        $data['f_status'] = $request->f_status;
        Category::create($data);

        return redirect()->route('category.index')->with([
            'message'   => 'Kategori berhasil ditambahkan',
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decryptString($id);
        $edit_category = Category::find($id);
        return view('category.form', compact('edit_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = Crypt::decryptString($id);
        $category = Category::find($id);
        $this->validate($request, [
            'name' => 'required|unique:categories,name,' . $category->id
        ]);

        $data = $request->only('name');
        $data['slug'] = Str::slug($request->name);
        $data['f_status'] = $request->f_status;
        $category->update($data);

        return redirect()->route('category.index')->with([
            'message'   => 'Kategori berhasil diperbarui',
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decryptString($id);
        // dd($id);
        $data = Category::find($id);
        $data['f_status'] = 'f';
        $data->update();
        $data->delete();

        return redirect()->route('category.index')->with([
            'message' => 'kategori berhasil dihapus',
            'success' => true,
        ]);
    }
}
