<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('visitor.index');
    }

    public function names(Request $request)
    {
        $request = $request->query();

        if (!empty($request)) {
            foreach ($request as $key => $value) {
                if ($key == 'religion') {
                    $allowed_keys = ['jewish', 'orthodox', 'catholic', 'muslim'];
                    if (!in_array($value, $allowed_keys)) {
                        abort(404);
                    } else {
                        $names = Translation::where('religion', 'LIKE', "%{$value}%")->get();
                        $names->map(function ($item) use ($value) {
                            $temp = json_decode($item->name, true);
                            $item['temp_name'] = isset($temp[$value]) ? $temp[$value] : $temp['main'];
                            return $item;
                        });
                        $page_name = ucwords($value) . ' Names';
                    }
                } elseif ($key == 'nation') {
                    $allowed_keys = ['american', 'english', 'arabic', 'kazakh', 'italian', 'spanish', 'french', 'hebrew', 'armenian', 'greek', 'german', 'russian', 'tatar', 'ukrainian', 'ossetian', 'slavic', 'japanese'];
                    if (!in_array($value, $allowed_keys)) {
                        abort(404);
                    } else {
                        $names = Translation::where('nationality', 'LIKE', "%{$value}%")->get();
                        $names->map(function ($item) use ($value) {
                            $temp = json_decode($item->name, true);
                            $item['temp_name'] = isset($temp[$value]) ? $temp[$value] : $temp['main'];
                            return $item;
                        });
                        $page_name = ucwords($value) . " Names";
                    }
                } elseif ($key == 'gender') {
                    $allowed_keys = ['male', 'female'];
                    if (!in_array($value, $allowed_keys)) {
                        abort(404);
                    } else {
                        $names = Translation::where('gender', $value)->get();
                        $names->map(function ($item) use ($value) {
                            $temp = json_decode($item->name, true);
                            $item['temp_name'] = isset($temp[$value]) ? $temp[$value] : $temp['main'];
                            return $item;
                        });
                        $page_name = ucwords($value) . " Names";
                    }
                } elseif ($key == 'all') {
                    $names = Translation::all();
                    $names->map(function ($item) use ($value) {
                        $temp = json_decode($item->name, true);
                        $item['temp_name'] = $temp['main'];
                        return $item;
                    });
                    $page_name = "All Names";
                } else if ($key == 'letter') {
                    if (!in_array($value, range('A', 'Z'))) {
                        abort(404);
                    } else {
                        $names = Translation::where('letter', $value)->get();
                        $names->map(function ($item) use ($value) {
                            $temp = json_decode($item->name, true);
                            $item['temp_name'] = $temp['main'];
                            return $item;
                        });
                        $page_name = "Names Starting With " . $value;
                    }
                } else {
                    return abort(404);
                }
            }
        } else {
            $names = Translation::all();
            $names->map(function ($item) {
                $temp = json_decode($item->name, true);
                $item['temp_name'] = $temp['main'];
                return $item;
            });
            $page_name = "All Names";
        }

        return view('visitor.name.list', [
            'names' => $names->sortBy('temp_name'),
            'page_name' => $page_name
        ]);
    }

    public function showById(Translation $translation)
    {
        $randomNames = Translation::inRandomOrder()->limit(10)->get();
        $randomNames->map(function ($item) {
            $temp = json_decode($item->name, true);
            $item['temp_name'] = $temp['main'];
            return $item;
        });
        return view('visitor.name.show', [
            'name' => $translation,
            'randomNames' => $randomNames
        ]);
    }

    public function showByLink($link)
    {
        $link = '/names/' . $link;
        $translation = Translation::where('link', $link)->firstOrFail();
        $randomNames = Translation::inRandomOrder()->limit(10)->get();
        $randomNames->map(function ($item) {
            $temp = json_decode($item->name, true);
            $item['temp_name'] = $temp['main'];
            return $item;
        });
        return view('visitor.name.show', [
            'name' => $translation,
            'randomNames' => $randomNames
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->query('search', '');
        $names = Translation::where('name', 'LIKE', "%{$keyword}%")->get();
        $names->map(function ($item) {
            $temp = json_decode($item->name, true);
            $item['temp_name'] = $temp['main'];
            return $item;
        });
        return view('visitor.name.search', [
            'names' => $names->sortBy('temp_name'),
            'search' => $keyword
        ]);
    }

    public function checkCompatibility($first, $second)
    {
        $compatibility = rand(75, 90);
        return view('visitor.name.compatibility', [
            'first' => $first,
            'second' => $second,
            'compatibility' => $compatibility
        ]);
    }
}
