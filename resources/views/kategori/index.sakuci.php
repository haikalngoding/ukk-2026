@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Daftar Kategori</h1>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary mb-3 btn-sm">Tambah kategori</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($data as $kategori)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $kategori->keterangan }}</td>
                    <td>
                        <a href="" class="btn btn-success btn-sm">Edit</a>
                        <a href="" class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $data->links() !!}
</div>
@endsection