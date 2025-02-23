@extends('layouts.main')
@section('container')
    <h1 class="text-2xl font-bold">Spko</h1>
    <div class="divider"></div>
    <div class="flex justify-end">
        <a href="{{ url('/create') }}">
            <button class="btn btn-primary">New Spko</button>
        </a>
    </div>
    <div class="card bg-base-100 overflow-auto p-4 mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>remarks</th>
                    <th>employee</th>
                    <th>trans_date</th>
                    <th>process</th>
                    <th>sw</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($spkos as $spko)
                    <tr>
                        <td>{{ $spko->id_spko }}</td>
                        <td>{{ $spko->remarks }}</td>
                        <td>{{ $spko->employee_user->nama }}</td>
                        <td>{{ Carbon\Carbon::parse($spko->trans_date)->translatedFormat('d F Y') }}</td>
                        <td>{{ $spko->process }}</td>
                        <td>{{ $spko->sw }}</td>
                        <td>
                            <a href="{{ url("/print/$spko->id_spko") }}">
                                <button class="btn btn-xs btn-success">Print</button>
                            </a>
                            <a href="{{ url("/update/$spko->id_spko") }}">
                                <button class="btn btn-xs btn-warning">Update</button>
                            </a>
                            <button class="btn btn-xs btn-error" onclick="modal_delete_spko_{{ $spko->id_spko }}.showModal()">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach ($spkos as $spko)   
        <dialog id="modal_delete_spko_{{ $spko->id_spko }}" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Delete Spko {{ $spko->id_spko }} ?</h3>
                <div class="modal-action">
                    <form action="{{ url("/delete/$spko->id_spko") }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-error">Delete</button>
                    </form>
                    <form method="dialog">
                        <button class="btn btn-warning">Cancel</button>
                    </form>
                </div>
            </div>
        </dialog>
    @endforeach
@endsection
