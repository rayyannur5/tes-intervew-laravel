@extends('layouts.main')
@section('container')
<div class="flex justify-between">
    <h1 class="text-2xl font-bold">Surat Perintah Kerja Operator</h1>
    <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="{{ url('/') }}">Spko</a></li>
            <li>print</li>
        </ul>
    </div>
</div>
    <div class="divider mb-0"></div>
    <button class="btn btn-sm btn-primary mb-4" id="button-print">Print</button>

    <div id="printableArea">
        <div class="bg-green-50 p-2 border  border-green-600">
            <h1 class="text-lg font-bold ms-2">Surat Perintah Kerja Operator</h1>
            <div class="flex">
                <table class="table table-xs w-1/2">
                    <tr class="border-none">
                        <td>ID Operator</td>
                        <td>: {{ $spko->employee }}</td>
                    </tr>
                    <tr class="border-none">
                        <td>Nama Operator</td>
                        <td>: {{ $spko->employee_user->nama }}</td>
                    </tr>
                    <tr class="border-none">
                        <td>Tanggal</td>
                        <td>: {{ Carbon\Carbon::parse($spko->created_at)->locale('id')->translatedFormat('d F Y H:i:s') }}</td>
                    </tr>
                </table>
                <table class="table table-xs w-1/2">
                    <tr class="border-none">
                        <td>No SPKO</td>
                        <td>: {{ $spko->sw }}</td>
                    </tr>
                    <tr class="border-none">
                        <td>Proses</td>
                        <td>: {{ $spko->process }}</td>
                    </tr>
                    <tr class="border-none">
                        <td>Catatan</td>
                        <td>: {{ $spko->remarks }}</td>
                    </tr>
                </table>
            </div>
        </div>
    
        <table class="table mt-4">
            <thead class="border-2 border-double border-gray-900 text-black border-b-4 text-center">
                <tr>
                    <th class="border-2 border-black">No.</th>
                    <th class="border-2 border-black">Deskripsi</th>
                    <th class="border-2 border-black">Carat</th>
                    <th class="border-2 border-black">SKU</th>
                    <th class="border-2 border-black">Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($spko_items as $key => $spko_item)
                    <tr class="text-center">
                        <td class="border-2 border-black">{{ $key+1 }}</td>
                        <td class="border-2 border-black">{{ $spko_item->product->description }}</td>
                        <td class="border-2 border-black">{{ $spko_item->product->carat }}</td>
                        <td class="border-2 border-black">{{ $spko_item->sku  }}</td>
                        <td class="border-2 border-black">{{ $spko_item->qty }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#button-print').on('click', function () {
                var printContents = $('#printableArea').html();
                var originalContents = $('body').html();

                $('body').html(printContents);
                window.print();
                $('body').html(originalContents);
                location.reload();
            });
    </script>

@endsection