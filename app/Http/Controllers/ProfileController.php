<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'icon' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'introduction' => 'nullable|string|max:1000',
        ]);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');

            Log::info('ファイルがアップロードされました:');
            Log::info('ファイル名: ' . $file->getClientOriginalName());
            Log::info('ファイルサイズ: ' . $file->getSize());
            Log::info('一時ファイルパス: ' . $file->getPathname());

            // 既存アイコンがあれば削除（任意）
            if ($user->icon) {
                $oldPath = str_replace('storage/', 'public/', $user->icon);
                Storage::delete($oldPath);
            }

            $path = $file->store('public/icons');
            Log::info('アップロード画像の保存パス: ' . $path);

            $user->icon = str_replace('public/', 'storage/', $path);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->introduction = $request->introduction;
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
