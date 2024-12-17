<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <table class="table-auto w-full border-collapse border border-slate-500">
        <thead>
            <tr>
                <th class="border border-slate-600">No</th>
                <th class="border border-slate-600">Tahun</th>
                <th class="border border-slate-600">Bulan</th>
                <th class="border border-slate-600">Forecasting</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            {{-- @dd($visit) --}}
            @foreach ($visit as $data)
                <tr>
                    <td class="border border-slate-700 ps-2">{{ $no }}</td>
                    <td class="border border-slate-700 ps-2">{{ $data['tahun'] }}</td>
                    <td class="border border-slate-700 ps-2">{{ $data['bulan'] }}</td>
                    <td class="border border-slate-700 ps-2">{{ $forecast[$no-1] }}</td>
                </tr>
                @php
                    $no++;
                @endphp
            @endforeach

            @foreach ($dump as $data1)
                <tr>
                    <td class="border border-slate-700 ps-2">{{ $no }}</td>
                    <td class="border border-slate-700 ps-2">{{ $visit[59]['tahun'] + 1 }}</td>
                    <td class="border border-slate-700 ps-2">{{ $data1 }}</td>
                    <td class="border border-slate-700 ps-2">{{ $forecast[$no-1] }}</td>
                </tr>
                @php
                    $no++;
                @endphp
            @endforeach
        </tbody>
    </table>
</x-layout>