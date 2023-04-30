@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mt-3 text-center">Selamat Datang</h2>


                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if (!Auth::check())
                    <p class="text-center"><b>Untuk melakukan postingan artikel diperlukan login terlebih dahulu</b></p>
                @endif



                <div class="card">

                    <div class="card-header">{{ __('Postingan Artikel') }}</div>

                    <div class="card-body">

                        @include('frontend.post.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
