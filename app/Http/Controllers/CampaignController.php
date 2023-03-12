<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Campaign;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('name')->get()->pluck('name', 'id');
        return view('campaign.index', compact('category'));
    }

    public function data(Request $request)
    {
        $query = Campaign::orderBy('publish_date', 'desc')->get();

        return datatables($query)
            ->addIndexColumn()
            ->editColumn('short_description', function ($query) {
                return $query->title . '<br><small>' . Str::limit($query->short_description, 500) . '</small>';
            })
            ->editColumn('path_image', function ($query) {
                return '<img src="' . Storage::disk('local')->url($query->path_image) . '" class="img-thumbnail mx-auto d-block">';
            })
            ->addColumn('author', function ($query) {
                return $query->user->name;
            })->addColumn('action', function ($query) {
                return
                    '
                    <div class="text-center">
                        <a href="' . route('campaign.detail', encrypt($query->id)) . '" class="btn btn-link text-primary" title="Detail- `' . $query->title . '`"><i class="fas fa-search-plus"></i></a>
                        <button type="button" class="btn btn-link text-success" onclick="editForm(`' . route('campaign.show', encrypt($query->id)) . '`)" title="Edit- `' . $query->title . '`"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-link text-danger" onclick="deleteData(`' . route('campaign.destroy', encrypt($query->id)) . '`)" title="Hapus- `' . $query->title . '`"><i class="fas fa-trash-alt"></i></button>
                    </div>
                ';
            })
            ->rawColumns(['short_description', 'path_image', 'author', 'action'])
            ->escapeColumns([])
            ->make(true);
    }

    public function detail($id)
    {
        $id = decrypt($id);
        dd('detail ' . $id . ', ok');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:8',
            'categories' => 'required|array',
            'short_description' => 'required',
            'body' => 'required|min:8',
            'publish_date' => 'required|date_format:Y-m-d H:i',
            'end_date' => 'required|date_format:Y-m-d H:i',
            'goal' => 'required',
            'note' => 'nullable',
            'receiver' => 'required',
            'status' => 'required',
            'path_image' => 'mimes:png,jpg,jpeg|max:1048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->except('path_image', 'categories', 'goal');
        $data['slug'] = Str::slug($request->title);
        $data['path_image'] = upload('img_campaign', $request->file('path_image'), 'campaign');
        $data['goal'] = Str::replace(',', '', $request->goal);
        $data['user_id'] = auth()->id();
        // return $data;
        $campaign = Campaign::create($data);
        $campaign->category_campaign()->attach($request->categories);

        return response()->json(['data' => $campaign, 'message' => 'Projek berhasil ditambahkan', 'success' => true]);
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
        dd('show ' . $id . ', ok');
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

        $campaign = Campaign::where('id', $id)->first();
        if (Storage::disk('public')->exists($campaign->path_image)) {
            // hapus foto dari folder storage 
            Storage::disk('public')->delete($campaign->path_image);
        }

        $campaign->delete();
        return response()->json(['data' => null, 'message' => 'Projek berhasil dihapus', 'success' => true]);
    }
}
