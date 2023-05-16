@extends('layouts.app')

@section('content')
<?php
    $article = $article["data"];
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __($article["title"]) }}

                    <a href="{{ route('articles.index') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">
                        Back
                    </a>
                </div>
                <img src='{{ $article["thumbnail"] }}' class="card-img-top" alt="...">
                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($article["tags"] as $tag)
                        <span class="badge badge-secondary">{{ $tag["value"] }}</span>
                    @endforeach

                    <br/>

                    {{ $article["description"] }}

                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="/articles/{{$article['id']}}/view" class="card-link">Veiws ({{ count($article["views"]) }})</a>
                            <a href="/articles/{{$article['id']}}/like" class="card-link">Likes ({{ count($article["likes"]) }})</a>
                        </div>
                        <div>
                            {{ $article["created_at"] }}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        let axios = null;

        const registerView = function() {
            console.log(axios)
        }

        window.onload = function() {
            axios = window.axios
            setTimeout(() => {
                registerView()
            }, 5000)
        }
    </script>
@endpush
