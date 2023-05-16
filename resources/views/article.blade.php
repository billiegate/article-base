@extends('layouts.app')

@section('content')
<?php
    $articles = json_encode($articles);
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __('Articles') }}
                    <button type="submit" class="btn btn-primary">
                        {{ __('Add New') }}
                    </button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <artictles data="{{$articles}}" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
