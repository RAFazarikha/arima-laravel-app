<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <table class="table-auto w-full border-collapse border border-slate-500">
        <thead>
            <tr>
                <th class="border border-slate-600">No</th>
                <th class="border border-slate-600">Tahun</th>
                <th class="border border-slate-600">Bulan</th>
                <th class="border border-slate-600">Jumlah Pengunjung</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($visit as $visitor)
                <tr>
                    <td class="border border-slate-700 ps-2">{{ $no++ }}</td>
                    <td class="border border-slate-700 ps-2">{{ $visitor['tahun'] }}</td>
                    <td class="border border-slate-700 ps-2">{{ $visitor['bulan'] }}</td>
                    <td class="border border-slate-700 ps-2">{{ $visitor['jumlah_pengunjung'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="relative h-screen" x-data="{ isOpen: false }">
        <button @click="isOpen = !isOpen" class="fixed bottom-10 right-10 w-12 h-12 bg-blue-500 text-white rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
            <span class="text-2xl font-bold">+</span>
        </button>
        <div id="popup" x-show="isOpen" 
            x-transition:enter="transition ease-out duration-100 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95" 
            class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50">
            <div class="bg-white border-1 border-black rounded-lg p-4 w-96">
                <h1 class="text-xl font-bold mb-4">Tambah Data</h1>
                <form action="{{ route('simpan.data') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="tahun" class="block font-medium">Tahun :</label>
                        <input type="text" name="tahun" id="tahun" class="border border-gray-300 rounded p-2 w-full" required>
                    </div>
                    <div class="mb-4">
                        <label for="bulan" class="block font-medium">Bulan</label>
                        <select id="bulan" name="bulan" class="border border-gray-300 rounded p-2 w-full focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm ">
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="jumlah_pengunjung" class="block font-medium">Jumlah Pengunjung :</label>
                        <input type="text" name="jumlah_pengunjung" id="jumlah_pengunjung" class="border border-gray-300 rounded p-2 w-full" required>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="isOpen = false" 
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Batal
                        </button>
                        <button type="submit" 
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>