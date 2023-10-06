<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        // バリデーションルールの設定
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MBまでの画像を許可
        ]);

        // リクエストから画像ファイルを取得
        if ($request->file('image')) {
            $image = $request->file('image');

            // ファイル名を一意に生成
            $imageName = time() . '.' . $image->extension();

            // 画像を指定のディレクトリに移動・保存
            $image->move(public_path('uploads'), $imageName);

            // 画像の保存やデータベースへの登録などの追加の処理をここに追加できます

            // 成功メッセージをフラッシュデータに設定してリダイレクト
            return redirect()->back()->with('success', '画像がアップロードされました。');
        }

        // 何らかの理由で画像がアップロードできなかった場合の処理
        return redirect()->back()->with('error', '画像のアップロードに失敗しました。');
    }
}
