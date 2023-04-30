@extends('layouts.master')

@section('title', 'Tambah Kategori')

@section('content')

    <div class="container-fluid px-4">


        <div class="card mt-4">
            <div class="card-header">
                <h1 class="mt-4">Tambah Kategori</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Masukan informasi dibawah ini :</li>
                </ol>
            </div>
            <div class="card-body">

                


                <form action="{{ url('admin/add-category') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
