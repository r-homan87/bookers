@extends('layouts.app') {{-- 適宜変更してください --}}

@section('content')
<div class="container">
    <h1>{{ $book->title }}</h1>
    <p>{{ $book->body }}</p>
    <p>投稿者：{{ $book->user->name }}</p>
    <p>投稿日：{{ $book->created_at->format('Y年m月d日 H:i') }}</p>

    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">一覧に戻る</a>
</div>
@endsection