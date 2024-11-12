<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    const PATH_VIEW = 'admin.games.';
    const PATH_UPLOAD = 'games';

    public function index() {
        $data = Game::all();
        return view(self::PATH_VIEW . 'index', compact('data'));
    }

    public function create()
    {
        return view(self::PATH_VIEW . 'create');
    }

    public function store(StoreGameRequest $request)
    {
        $data = $request->except('image');
        $data['is_active'] ??= 0;
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        } else {
            $data['image'] = '';
        }
        $data['slug'] = Str::slug($data['name']);
        $data['accounts_count'] = 0;

        try {
            DB::beginTransaction();
            Game::create($data);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->with('message', __('Lỗi trong quá trình tạo game'));
        }

        return redirect()->route('admin.games.index')->with('message', __('Tạo game thành công!'));
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return view(self::PATH_VIEW . 'edit', compact('game'));
    }

    public function update(UpdateGameRequest $request, $id)
    {
        $game = Game::findOrFail($id);
        $data = $request->except('image');
        $data['is_active'] ??= 0;

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            if ($game->image && Storage::exists($game->image)) {
                Storage::delete($game->image);
            }
        } else {
            $data['image'] = $game->image;
        }

        $data['slug'] = Str::slug($data['name']);
        $data['accounts_count'] = $game->accounts_count;

        try {
            DB::beginTransaction();
            $game->update($data);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->with('message', __('Lỗi trong quá trình cập nhật game'));
        }

        return redirect()->route('admin.games.index')->with('message', __('Cập nhật game thành công!'));
    }

    public function destroy($id)
    {
        $game = Game::find($id);
        if (!$game) {
            return back()->with('message', __('Game không tồn tại.'));
        }

        try {
            DB::beginTransaction();
            if ($game->image && Storage::exists($game->image)) {
                Storage::delete($game->image);
            }
            $game->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->with('message', __('Lỗi trong quá trình xóa game'));
        }

        return back()->with('message', __('Xóa game thành công'));
    }
}
