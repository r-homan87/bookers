@extends('layouts.app')

@section('content')
<div class="container">
    <h2>投稿一覧</h2>

    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">新規投稿</a>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($books->isEmpty())
    <p>投稿はまだありません。</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>タイトル</th>
                <th>本文</th>
                <th>投稿者</th>
                <th>作成日時</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ Str::limit($book->body, 50) }}</td>
                <td>{{ $book->user->name ?? '不明' }}</td>
                <td>{{ $book->created_at->format('Y/m/d H:i') }}</td>
                <td>
                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info">詳細</a>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">編集</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection