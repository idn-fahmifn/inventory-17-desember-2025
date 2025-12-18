<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('is_admin', false)->get();
        $rooms = collect([
        (object)['id' => 1, 'name' => 'Gudang Utama', 'code' => 'WRH-01', 'category' => 'Penyimpanan', 'total_assets' => 450, 'status' => 'Penuh'],
        (object)['id' => 2, 'name' => 'Laboratorium Komputer', 'code' => 'LAB-02', 'category' => 'Fasilitas', 'total_assets' => 120, 'status' => 'Tersedia'],
        (object)['id' => 3, 'name' => 'Studio Kreatif', 'code' => 'STD-05', 'category' => 'Produksi', 'total_assets' => 45, 'status' => 'Tersedia'],
        (object)['id' => 4, 'name' => 'Ruang Meeting Lt. 2', 'code' => 'MTG-02', 'category' => 'Fasilitas', 'total_assets' => 15, 'status' => 'Terbatas'],
    ]);
        
        return view('room.index', compact('rooms', 'user')); 
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
            'room_name' => ['string', 'required', 'min:3', 'max:30'],
            'room_code' => ['string', 'required', 'min:3', 'max:30', 'unique:rooms,room_code'],
            'desc' => ['required'],
            'user_id' => ['required', 'integer'],
        ]);

        $simpan = $request->all();
        $simpan['slug'] = random_int(000,999).'-'.Str::slug($request->input('room_name'));

        Room::create($simpan);

        return back()->with('success', 'Room Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
