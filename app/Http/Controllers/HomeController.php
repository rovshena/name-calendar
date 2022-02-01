<?php

namespace App\Http\Controllers;

use App\Models\Compatibility;
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
                    $allowed_keys = ['Jewish', 'Orthodox', 'Catholic', 'Muslim'];
                    if (!in_array($value, $allowed_keys)) {
                        abort(404);
                    } else {
                        $names = Translation::where('religion', 'LIKE', "%{$value}%")->get();
                        $names->map(function ($item) use ($value) {
                            $temp = json_decode($item->name, true);
                            $item['temp_name'] = isset($temp[$value]) ? $temp[$value] : $temp['main'];
                            return $item;
                        });
                        $page_name = $value . ' Names';
                    }
                } elseif ($key == 'nationality') {
                    $allowed_keys = ['American', 'English', 'Arabic', 'Kazakh', 'Italian', 'Spanish', 'French', 'Hebrew', 'Armenian', 'Greek', 'German', 'Russian', 'Tatar', 'Ukrainian', 'Ossetian', 'Slavic', 'Japanese'];
                    if (!in_array($value, $allowed_keys)) {
                        abort(404);
                    } else {
                        $names = Translation::where('nationality', 'LIKE', "%{$value}%")->get();
                        $names->map(function ($item) use ($value) {
                            $temp = json_decode($item->name, true);
                            $item['temp_name'] = isset($temp[$value]) ? $temp[$value] : $temp['main'];
                            return $item;
                        });
                        $page_name = $value . " Names";
                    }
                } elseif ($key == 'gender') {
                    $allowed_keys = ['Male', 'Female'];
                    if (!in_array($value, $allowed_keys)) {
                        abort(404);
                    } else {
                        $names = Translation::where('gender', $value)->get();
                        $names->map(function ($item) use ($value) {
                            $temp = json_decode($item->name, true);
                            $item['temp_name'] = isset($temp[$value]) ? $temp[$value] : $temp['main'];
                            return $item;
                        });
                        $page_name = $value . " Names";
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
        $compatibilities = Compatibility::where('first_id', $translation->id)
            ->orWhere('second_id', $translation->id)
            ->get()->all();

        return view('visitor.name.show', [
            'name' => $translation,
            'compatibilities' => $compatibilities
        ]);
    }

    public function showByLink($link)
    {
        $link = '/names/' . $link;
        $translation = Translation::where('link', $link)->firstOrFail();

        $compatibilities = Compatibility::where('first_id', $translation->id)
            ->orWhere('second_id', $translation->id)
            ->get()->all();

        return view('visitor.name.show', [
            'name' => $translation,
            'compatibilities' => $compatibilities
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

    public function compatibility($first, $second)
    {
        $compatibility = Compatibility::where(function ($query) use ($first, $second) {
            $query->where('first_id', $first)->where('second_id', $second);
        })->orWhere(function ($query) use ($first, $second) {
            $query->where('first_id', $second)->where('second_id', $first);
        })->firstOrFail();

        return view('visitor.name.compatibility', [
            'compatibility' => $compatibility->load(['firstName', 'secondName'])
        ]);
    }
}
