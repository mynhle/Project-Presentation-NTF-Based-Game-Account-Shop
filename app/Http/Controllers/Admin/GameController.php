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
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.games.';
    const PATH_UPLOAD = 'games';

    public function index() {

        $data = Game::all();
        // dd($data);
        return view(Self::PATH_VIEW.__FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(Self::PATH_VIEW.__FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
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

            Game::query()->create($data);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->with('message', 'Lỗi');
        }


        return redirect()->route(self::PATH_VIEW.'index')->with('message', 'Create successful!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game, $slug)
    {

        $game = Game::query()->where('slug', $slug)->first();
        return view(Self::PATH_VIEW.__FUNCTION__, compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game)
    {

        dd($game);
        $data = $request->except('image');
        dd($data);
        $data['is_active'] ??= 0;
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            if (!empty($game->image) && Storage::exists($game->image)) {
                Storage::delete($game->image);
            }
        } else {
            $data['image'] = $game->image;
        }

        $data['slug'] = Str::slug($data['name']);

        try {
            DB::beginTransaction();
            
            $game->update($data);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->with('message', 'Lỗi');
        }
        return redirect()->route(self::PATH_VIEW . 'index')->with('message', 'Update successful!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game, $id)
    {

        try {
            DB::beginTransaction();
            $game = Game::query()->where('id', $id)->first();
            $game->delete();
            // DELETE IMAGE in Storage
            if ($game->image) {
                Storage::delete($game->image);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            return back()->with('message', 'Lỗi');
        }
        return back()->with('message', 'Xóa thành công');
    }
}
