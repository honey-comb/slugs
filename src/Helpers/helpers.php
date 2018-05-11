<?php
/**
 * @copyright 2018 interactivesolutions
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * Contact InteractiveSolutions:
 * E-mail: hello@interactivesolutions.lt
 * http://www.interactivesolutions.lt
 */

declare(strict_types = 1);

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