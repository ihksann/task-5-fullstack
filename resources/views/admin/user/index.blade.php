@extends('layouts.master')

@section('title', 'Lihat Users')

@section('content')

    <div class="container-fluid px-4">




        <div class="card mt-4">
            <div class="card-header">
                <h4>Daftar Pengguna
                    
                </h4>
            </div>
            <div class="card-body">
                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif


                <table id="myDataTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pengguna</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)                        
                            <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                
            </div>
        </div>
    </div>
@endsection
