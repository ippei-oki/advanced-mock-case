<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Migrations\Migration;

class UpdateImagePathsInShopsTable extends Migration
{
    public function up()
    {
        $shops = DB::table('shops')->get();

        foreach ($shops as $shop) {
            if ($shop->image) {
                $filename = basename($shop->image);

                $oldPath = public_path('images/' . $filename);
                $newPath = storage_path('app/public/images/' . $filename);

                if (file_exists($oldPath)) {
                    Storage::disk('public')->put('images/' . $filename, file_get_contents($oldPath));
                }

                DB::table('shops')->where('id', $shop->id)->update([
                    'image' => $filename
                ]);
            }
        }
    }

    public function down()
    {
        //
    }
}
