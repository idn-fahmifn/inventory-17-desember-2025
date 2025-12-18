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
        $rooms = Room::all();
        
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
    public function show($param)
    {
        $room = Room::where('slug', $param)->firstOrFail();
        $user = User::where('is_admin', false)->get();
        return view('room.detail', compact('room', 'user'));
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
