@extends('layouts.app') {{-- 共通レイアウト使用時（不要なら削除OK） --}}

@section('content')
<div class="container">
    <h1>新規投稿</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">内容</label>
            <textarea name="body" id="body" class="form-control" rows="4" required>{{ old('body') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">投稿</button>
    </form>
</div>
@endsection