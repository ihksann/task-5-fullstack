@extends('layouts.master')

@section('title', 'Edit Kategori')

@section('content')

    <div class="container-fluid px-4">


        <div class="card">
            <div class="card-header">
                <h1 class="mt-4">Edit Kategori</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Ubah informasi :</li>
                </ol>
            </div>
            <div class="card-body">

                


                <form action="{{ url('admin/update-category/'.$category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Perbarui Kategori</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
