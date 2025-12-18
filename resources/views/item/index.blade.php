<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('Daftar Barang') }}
            </h2>
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-room')"
                class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition-all duration-300 transform hover:scale-105">
                + Tambah Barang
            </button>
        </div>
    </x-slot>

    <div class="py-12 bg-[#F8FAFC] dark:bg-slate-950 min-h-screen transition-colors duration-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            <div
                class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="overflow-x-auto min-h-[400px]">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="text-slate-400 dark:text-slate-500 text-[10px] uppercase tracking-[0.2em] font-black bg-slate-50/50 dark:bg-slate-800/50">
                                <th class="px-8 py-5">Nama & Kode</th>
                                <th class="px-8 py-5">Peyimpanan</th>
                                <th class="px-8 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse ($data as $item)
                                <tr class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                    <td class="px-8 py-2">
                                        <div class="font-bold text-slate-700 dark:text-slate-200 text-sm">
                                            {{ $item->item_name }}</div>
                                        <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 tracking-wider">
                                            {{ $item->item_code }}</div>
                                    </td>
                                    <td class="px-8 py-2">
                                        <span
                                            class="text-sm text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-lg">
                                            {{ $item->room->room_name }}
                                        </span>
                                    </td>

                                    <td class="px-8 py-2 text-right">
                                        <a href="{{ route('item.show', $item->slug) }}"
                                            class="text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors mx-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                    <td class="px-8 py-2 text-center" colspan="3">
                                        <span
                                            class="text-sm text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-lg">
                                            Item Not Found
                                        </span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 px-8 py-4">
                    {{ $data }}
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-room" :show="false" focusable>
        <div class="p-8 dark:bg-slate-900">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-xl font-black text-slate-800 dark:text-white">
                        Tambah Barang Baru
                    </h2>
                    <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">Daftarkan Aset anda.</p>
                </div>
                <div class="p-3 rounded-2xl bg-blue-50 dark:bg-blue-900/30 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="m11.492 4.067l5 2.857A2 2 0 0 1 17.5 8.661v4.678a2 2 0 0 1-1.008 1.737l-5 2.857a2 2 0 0 1-1.984 0l-5-2.857A2 2 0 0 1 3.5 13.339V8.661a2 2 0 0 1 1.008-1.737l5-2.857a2 2 0 0 1 1.984 0zM14 9.5l-7-4" />
                            <path d="m4 8l5.552 2.99a2 2 0 0 0 1.896 0L17 8m-6.5 3.5V18" />
                        </g>
                    </svg>
                </div>
            </div>

            <form method="post" action="{{ route('item.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="item_name" value="Nama Barang" class="dark:text-slate-400" />
                        <x-text-input id="item_name" name="item_name" type="text" required
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl"
                            placeholder="ex : Ruang Server" />
                        <x-input-error :messages="$errors->get('item_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="item_code" value="Kode Barang" class="dark:text-slate-400" />
                        <x-text-input id="item_code" name="item_code" type="text" required
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl"
                            placeholder="KODE-01" />
                        <x-input-error :messages="$errors->get('item_code')" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="qty" value="Stok/Qty" class="dark:text-slate-400" />
                        <x-text-input id="qty" name="qty" type="number" required
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
                    <x-input-label for="desc" value="Deskripsi Ruangan" required class="dark:text-slate-400" />
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
                        Simpan Ruangan
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</x-app-layout>
