<?php

use HoneyComb\Slugs\Models\HCSlug;

if (!function_exists('generateHCSlug')) {
    /**
     * Generating path based slug from string
     *
     * @param $path
     * @param $string
     * @param string $separator
     * @return string
     */
    function generateHCSlug(string $path, string $string, string $separator = '-')
    {
        $slug = str_slug($string, $separator);

        //TODO check if $path has '/' on both sides

        if (substr($path, -1) != '/') {
            $path .= '/';
        }

        $record = HCSlug::where('path', $path)->where('slug', $slug)->first();

        if (!$record) {
            HCSlug::create([
                "path" => $path,
                "slug" => $slug,
                'slug_count' => 1,
            ]);

            return $slug;
        }

        DB::table(HCSlug::getTableName())->where('path', $path)->where('slug', $slug)->increment('slug_count');

        $slug .= $separator . $record->slug_count;

        return $slug;
    }
}