<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PreparePostInput
{

    /**
     * @param array $input this method for preaparing the slug format
     * if the user didn't enter the slug with processiong unique values
     * depend on title value
     * 
     * @return array
     */
    public static function prepareSlug(array $input): array
    {
        $data = $input;

        if (empty($data['slug']) && !empty($data['title'])) {
            $baseSlug = Str::slug($data['title']);
            $slug = $baseSlug;

            while (DB::table('posts')->where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . Str::lower(Str::random(6));
            }

            $data['slug'] = $slug;
        }

        return $data;
    }
}
