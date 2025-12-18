<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Item::paginate(5);
        $room = Room::all();
        return view('item.index', compact('data', 'room'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => ['string', 'required', 'min:5', 'max:30'],
            'item_code' => ['string', 'required', 'min:5', 'max:30', 'unique:items'],
            'qty' => ['integer', 'required', 'min:0', 'max:100'],
            'room_id' => ['integer', 'required'],
            'condition' => ['required', 'in:good,maintenance,broken'],
            'image' => ['file', 'required', 'mimes:png,jpg,jpeg,svg,heic', 'max:2048'],
            'desc' => ['required'],
        ]);

        // maping nilai dari request
        $simpan = [
            'item_name' => $request->input('item_name'),
            'qty' => $request->input('qty'),
            'desc' => $request->input('desc'),
            'room_id' => $request->input('room_id'),
            'condition' => $request->input('condition'),
            'item_code' => $request->input('item_code'),
            'slug' => Str::slug($request->input('item_name')) . random_int(0000, 9999),
        ];

        // kondisi saat ada input file (image)

        if ($request->hasFile('image')) {
            $img = $request->file('image'); //file yang diupload dari form.
            $path = 'public/images/items'; //tempat penyimpanan file yang diupload
            $ext = $img->getClientOriginalExtension();
            $name = 'item_' . Carbon::now('Asia/jakarta')->format('dmYhis') . '.' . $ext; //output : item_16122025173040.jpg
            $simpan['image'] = $name; //nilai yang disimpan ke database

            // simpan file ke folder storage
            $img->storeAs($path, $name);
        }

        // simpan semua data di request ke database.
        Item::create($simpan);

        return redirect()->route('item.index')->with('success', 'Item created');

    }

    /**
     * Display the specified resource.
     */
    public function show($param)
    {
        $data = Item::where('slug', $param)->firstOrFail();
        $room = Room::all();

        return view('item.detail', compact('data', 'room'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $param)
    {
        $item = Item::where('slug', $param)->firstOrFail();
        $data = Item::find($item->id);

        $request->validate([
            'item_name' => ['string', 'required', 'min:5', 'max:30'],
            'item_code' => ['string', 'required', 'min:5', 'max:30', Rule::unique('items')->ignore($data->id)],
            'qty' => ['integer', 'required', 'min:0', 'max:100'],
            'room_id' => ['integer', 'required'],
            'condition' => ['required', 'in:good,maintenance,broken'],
            'image' => ['file', 'mimes:png,jpg,jpeg,svg,heic', 'max:2048'],
            'desc' => ['required'],
        ]);

        // maping nilai dari request
        $simpan = [
            'item_name' => $request->input('item_name'),
            'qty' => $request->input('qty'),
            'desc' => $request->input('desc'),
            'room_id' => $request->input('room_id'),
            'condition' => $request->input('condition'),
            'item_code' => $request->input('item_code'),
            'slug' => Str::slug($request->input('item_name')) . random_int(0000, 9999),
        ];

        // kondisi saat ada input file (image)

        if ($request->hasFile('image')) {

            $old_path = 'public/images/items/'.$data->image;

            if($data->image && Storage::exists($old_path))
            {
                Storage::delete($old_path);
            }

            $img = $request->file('image'); //file yang diupload dari form.
            $path = 'public/images/items'; //tempat penyimpanan file yang diupload
            $ext = $img->getClientOriginalExtension();
            $name = 'item_' . Carbon::now('Asia/jakarta')->format('dmYhis') . '.' . $ext; //output : item_16122025173040.jpg
            $simpan['image'] = $name; //nilai yang disimpan ke database

            // simpan file ke folder storage
            $img->storeAs($path, $name);
        }
        // simpan semua data di request ke database.
        $data->update($simpan);
        return redirect()->route('item.show', $data->slug)->with('success', 'Item created');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
