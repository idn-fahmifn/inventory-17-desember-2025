<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ $data->item_name }}
            </h2>

            <form action="{{ route('item.destroy', $data->slug) }}" method="post">

                @csrf
                @method('delete')

                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-room')"
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </button>

                <button type="submit" onclick="return confirm('Yakin mau')"
                    class="bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition-all duration-300 transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3" />
                    </svg>
                </button>
            </form>


        </div>
    </x-slot>

    <div class="py-12 bg-[#F8FAFC] dark:bg-slate-950 min-h-screen transition-colors duration-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div
                class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="text-slate-400 dark:text-slate-500 text-[10px] uppercase tracking-[0.2em] font-black bg-slate-50/50 dark:bg-slate-800/50">
                                <th class="px-8 py-5">Detail Barang</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">

                            <tr class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="font-bold text-slate-700 dark:text-slate-200 text-sm">
                                        Nama Barang</div>
                                    <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 tracking-wider">
                                        {{ $data->item_name }}</div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="font-bold text-slate-700 dark:text-slate-200 text-sm">
                                        Kode Ruangan</div>
                                    <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 tracking-wider">
                                        {{ $data->item_code }}</div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="font-bold text-slate-700 dark:text-slate-200 text-sm">
                                        Lokasi Penyimpanan</div>
                                    <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 tracking-wider">
                                        {{ $data->room->room_name }}</div>
                                </td>
                            </tr>
                            <tr class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                <td class="px-8 py-4">
                                    <div class="font-bold text-slate-700 dark:text-slate-200 text-sm">
                                        Deskripsi Barang</div>
                                    <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 tracking-wider">
                                        {{ $data->desc }}</div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-room" :show="false" focusable>
        <div class="p-8 dark:bg-slate-900">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-xl font-black text-slate-800 dark:text-white">
                        Edit {{ $data->item_name }}
                    </h2>
                    <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">Ubah data {{ $data->item_name }}</p>
                </div>
                <div class="p-3 rounded-2xl bg-blue-50 dark:bg-blue-900/30 text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>

            <form method="post" action="{{ route('item.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="item_name" value="Nama Barang" class="dark:text-slate-400" />
                        <x-text-input id="item_name" name="item_name" type="text" required :value="old('item_name')"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl"
                            placeholder="ex : Ruang Server" />
                        <x-input-error :messages="$errors->get('item_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="item_code" value="Kode Barang" class="dark:text-slate-400" />
                        <x-text-input id="item_code" name="item_code" type="text" required :value="old('item_code')"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl"
                            placeholder="KODE-01" />
                        <x-input-error :messages="$errors->get('item_code')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="qty" value="Stok/Qty" class="dark:text-slate-400" />
                        <x-text-input id="qty" name="qty" type="number" required :value="old('qty')"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl" />
                        <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="condition" value="Kondisi Barang" class="dark:text-slate-400" />
                        <select id="condition" name="condition" required
                            class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm">
                            <option>Kondisi Barang</option>
                            <option value="good">Good</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="broken">Broken</option>
                        </select>
                        <x-input-error :messages="$errors->get('condition')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="room_id" value="Lokasi Penyimpanan" class="dark:text-slate-400" />
                    <select id="room_id" name="room_id" required
                        class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm">
                        <option>Lokasi Penyimpanan</option>
                        @foreach ($room as $item)
                            <option value="{{ $item->id }}">{{ $item->room_name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('room_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="image" value="Gambar Barang" class="dark:text-slate-400" />
                    <x-text-input id="image" name="image" type="file" required accept="image/*"
                        class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl p-6 border"
                        placeholder="KODE-01" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <div class="">
                    <x-input-label for="desc" value="Deskripsi Barang" required class="dark:text-slate-400" />
                    <textarea name="desc"
                        class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm"
                        id=""></textarea>
                    <x-input-error :messages="$errors->get('desc')" class="mt-2" />
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close')"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition transform active:scale-95">
                        Simpan Barang
                    </button>
                </div>
            </form>

            
        </div>
    </x-modal>
</x-app-layout>
