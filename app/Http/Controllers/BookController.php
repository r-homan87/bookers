<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // 一覧表示
    public function index()
    {
        $books = Book::with('user')->latest()->get();
        return view('books.index', compact('books'));
    }

    // 作成フォーム
    public function create()
    {
        return view('books.create');
    }

    // 新規登録処理
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->body = $request->body;
        $book->user_id = Auth::id();
        $book->save();

        return redirect()->route('books.index')->with('success', '投稿が完了しました。');
    }

    // 詳細表示
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // 編集フォーム
    public function edit(Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            return redirect()->route('books.index')->with('error', '他人の投稿は編集できません。');
        }

        return view('books.edit', compact('book'));
    }

    // 更新処理
    public function update(Request $request, Book $book)
    {
        if ($book->user_id !== Auth::id()) {
            return redirect()->route('books.index')->with('error', '他人の投稿は編集できません。');
        }

        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $book->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('books.show', $book)->with('success', '更新が完了しました。');
    }

    // 削除処理
    public function destroy(Book $book)
    {
        if ($book->user_id === Auth::id()) {
            $book->delete();
            return redirect()->route('books.index')->with('success', '投稿を削除しました。');
        }



        return redirect()->route('books.index')->with('error', '削除権限がありません。');
    }
}
