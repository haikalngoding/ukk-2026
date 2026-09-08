@extends('layouts.app')

@section('content')

<h1>Tambah Kategori</h1>
<form action="{{ route('admin.kategori.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
</form>
@endsection