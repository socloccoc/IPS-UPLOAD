@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Upload IP system
        </div>
        <div class="card-body">
            @include('errors.errorlist')
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import Ips</button>
            </form>
        </div>
    </div>
</div>

@endsection