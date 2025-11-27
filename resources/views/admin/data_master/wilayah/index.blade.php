@extends('layouts.admin')

@section('title', 'Data Wilayah')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-1/2 max-w-full px-3">
                        <h6>Data Wilayah</h6>
                        <p class="mb-0 text-sm leading-normal">Kelola data wilayah</p>
                    </div>

                </div>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Wilayah</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Detail</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jumlah Pendaftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wilayahs as $wilayah)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div>
                                            <div class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl bg-gradient-to-tl from-green-600 to-lime-400">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal">{{ $wilayah->kelurahan }}</h6>
                                            <p class="mb-0 text-xs text-slate-400">{{ $wilayah->kecamatan }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight">{{ $wilayah->kabupaten }}, {{ $wilayah->provinsi }}</p>
                                    @if($wilayah->kodepos)
                                        <p class="mb-0 text-xs text-slate-400">{{ $wilayah->kodepos }}</p>
                                    @endif
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="bg-gradient-to-tl from-blue-600 to-cyan-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        {{ $wilayah->dataSiswa->count() }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection