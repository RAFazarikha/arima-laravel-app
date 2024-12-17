<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <table class="table-auto w-full border-collapse border border-slate-500">
        <thead>
            <tr>
                <th class="border border-slate-600">No</th>
                <th class="border border-slate-600">Jumlah Pengunjung</th>
                <th class="border border-slate-600">Differencing</th>
                <th class="border border-slate-600">Lag-1</th>
                <th class="border border-slate-600">Forecasting</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            {{-- @dd($data) --}}
            {{-- @dd($combinedData[1]['visit']['jumlah_pengunjung']) --}}
            @foreach ($combinedData as $data)
                <tr>
                    <td class="border border-slate-700 ps-2">{{ $no }}</td>
                    <td class="border border-slate-700 ps-2">{{ $data['visit']['jumlah_pengunjung'] }}</td>
                    <td class="border border-slate-700 ps-2">{{ $no-1 === 0 ? 0 : ($data['visit']['jumlah_pengunjung'] - ($combinedData[$no-2]['visit']['jumlah_pengunjung'] ?? 0)) }}</td>
                    <td class="border border-slate-700 ps-2">{{ $no-1 === 0 ? 0 : $combinedData[$no-2]['visit']['jumlah_pengunjung'] }}</td>
                    <td class="border border-slate-700 ps-2">{{ $data['forecast'] }}</td>
                </tr>
                    @php
                        $no++
                    @endphp
            @endforeach
        </tbody>
    </table>
</x-layout>