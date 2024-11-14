<?php

namespace App\Http\Controllers\Admin;

use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\AccountAttribute;
use App\Models\AccountGallery;
use App\Models\Game;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    const PATH_VIEW = 'admin.accounts.';
    const PATH_UPLOAD = 'accounts';

    public function index()
    {
        $data = Account::all();
        return view(Self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gameCategory = Game::all();
        return view(Self::PATH_VIEW . __FUNCTION__, compact('gameCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        // dd($request);
        if ($request->hasFile('image')) {
            $image = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        } else {
            $image = "";
        }

        try {
            $accounts = Account::create([
                'game_id' => $request->game_id,
                'sku' => $request->sku,
                'username' => $request->username,
                'password' => $request->password,
                'image' => $image,
                'price' => $request->price,
                'status' => $request->status
            ]);

            foreach ($request->attribute_name as $index => $name) {
                AccountAttribute::create([
                    'account_id' => $accounts->id,
                    'attribute_name' => $name,
                    'attribute_value' => $request->attribute_value[$index],
                ]);
            }

            if ($request->hasFile('images') && count($request->file('images')) > 0) {
                foreach ($request->file('images') as $index => $img) {
                    $galleryImagePath = $img->store('gallery_images', 'public');
                    AccountGallery::create([
                        'account_id' => $accounts->id,
                        'image_path' => $galleryImagePath,
                        'caption' => $request->caption[$index] ?? '', // Sử dụng giá trị mặc định
                    ]);
                }
            }

            return redirect()->back()->with('message_create_product', 'Thêm tài khoản game thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Lỗi không thể thêm tài khoản game: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $account = Account::findOrFail($id);
        // dd( $account->toArray());
        $game = $account->game;
        $accountAttribute = $account->accountAttribute;
        $accountGallery = $account->accountGalleries;
        return view(Self::PATH_VIEW . __FUNCTION__, compact('account', 'accountAttribute', 'accountGallery', 'game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $account = Account::findOrFail($id);
        // dd( $account->toArray());
        $gameCategory = Game::all();
        $game = $account->game;
        $accountAttribute = $account->accountAttribute;
        $accountGallery = $account->accountGalleries;
        return view(Self::PATH_VIEW . __FUNCTION__, compact('account', 'accountAttribute', 'accountGallery', 'game', 'gameCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, $id)
    {
        // dd($request->all());
        // Tìm tài khoản theo ID
        $account = Account::findOrFail($id);

        // Cập nhật thông tin tài khoản
        $account->username = $request->username;
        $account->password = $request->password; // Mã hóa mật khẩu
        $account->price = $request->price;
        $account->game_id = $request->game_id;
        $account->status = $request->status;

        // Xử lý ảnh chính
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($account->image) {
                Storage::delete($account->image);
            }
            $account->image = $request->file('image')->store('accounts'); // Lưu ảnh mới
        }

        $account->save(); // Lưu thông tin tài khoản

        // Cập nhật thuộc tính tài khoản
        $account->accountAttribute()->delete(); // Xóa tất cả thuộc tính cũ
        foreach ($request->attribute_name as $key => $name) {
            $account->accountAttribute()->create([
                'attribute_name' => $name,
                'attribute_value' => $request->attribute_value[$key],
            ]);
        }

        // Xử lý ảnh gallery
        if ($request->hasFile('images')) {
            // Lưu số lượng ảnh hiện tại
            $currentGalleries = $account->accountGalleries;

            // Duyệt qua các ảnh mới
            foreach ($request->file('images') as $key => $image) {
                if ($key < count($currentGalleries)) {
                    // Nếu có ảnh mới, cập nhật ảnh cũ
                    $gallery = $currentGalleries[$key];
                    // Xóa ảnh cũ từ hệ thống tệp
                    Storage::delete($gallery->image_path);

                    // Lưu ảnh mới vào thư mục gallery
                    $path = $image->store('gallery_images', 'public');
                    $gallery->update([
                        'image_path' => $path,
                        'caption' => $request->caption[$key] ?? null,
                    ]);
                } else {
                    // Nếu không có ảnh cũ tương ứng, thêm bản ghi mới
                    $path = $image->store('gallery_images', 'public'); // Lưu ảnh mới
                    $account->accountGalleries()->create([
                        'image_path' => $path,
                        'caption' => $request->caption[$key] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('admin.accounts.index')->with('message_create_product', 'Account updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        foreach ($account->accountAttribute as $attribute) {
            $attribute->delete();
        }

        foreach ($account->accountGalleries as $gallery) {
            Storage::delete($gallery->image_path);
            $gallery->delete();
        }
        Storage::delete($account->image);
        $account->delete();

        return redirect()->route('admin.accounts.index');
    }


    public function destroyGallery($id)
    {
        $gallery = AccountGallery::findOrFail($id);
        $gallery->delete();

        // Xóa ảnh khỏi hệ thống tệp tin
        Storage::delete($gallery->image_path);

        return redirect()->route('admin.accounts.index');
    }
}
