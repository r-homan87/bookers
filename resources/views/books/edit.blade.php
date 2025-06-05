@extends('layouts.app')

@section('content')
<div class="container">
    <h2>投稿を編集する</h2>

    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>タイトル</label><br>
            <input type="text" name="title" value="{{ old('title', $book->title) }}">
        </div>
        <br>
        <div>
            <label>本文</label><br>
            <textarea name="body" rows="5">{{ old('body', $book->body) }}</textarea>
        </div>
        <br>
        <button type="submit">更新する</button>
    </form>
</div>
@endsection