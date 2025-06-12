@extends('layouts.app')

@section('content')
<div class="text-center mt-10">
    <h1 class="text-2xl font-bold">リダイレクト中...</h1>
    <p class="mt-4 text-gray-500">自動的に本の一覧ページへ移動します。</p>
</div>

<script>
    setTimeout(() => {
        window.location.href = "{{ route('books.index') }}"; // books一覧のルートに変更
    }, 2000); // 2000ミリ秒 = 2秒
</script>
@endsection