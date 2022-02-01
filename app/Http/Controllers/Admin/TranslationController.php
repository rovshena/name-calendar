<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Translation;
use App\Http\Requests\UpdateTranslationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $translations = Translation::all(['id', 'name', 'gender', 'nationality', 'letter', 'religion']);
            return DataTables::of($translations)
                ->editColumn('name', function ($row) {
                    return Str::limit($row->name, 50);
                })
                ->editColumn('nationality', function ($row) {
                    return Str::limit($row->nationality, 25);
                })
                ->editColumn('religion', function ($row) {
                    return Str::limit($row->religion, 25);
                })
                ->addColumn('actions', function ($row) {
                    $edit = '<a href="' . route('admin.translations.edit', $row) . '" class="btn btn-subtle-success btn-sm mr-2"><i class="fas fa-edit fa-fw"></i></a>';
                    $delete = '<a href="javascript:void(0);" data-href="' . route('admin.translations.destroy', $row) . '" class="btn btn-subtle-danger btn-sm mr-2 delete-item"><i class="fas fa-trash-alt fa-fw"></i></a>';
                    return $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        return view('admin.translation.index');
    }

    public function getNames(Request $request)
    {
        if ($request->ajax()) {
            $term = trim($request->term);
            $names = Translation::where('name', 'LIKE', "%". '"main":"' . $term ."%")->simplePaginate(30);
            $names->map(function ($item) {
                $temp = json_decode($item->name, true);
                $item['temp_name'] = $temp['main'];
                return $item;
            });
            return response()->json([
                'results' => $names->pluck('temp_name', 'id'),
                'hasMorePages' => $names->hasMorePages()
            ]);
        }

        return false;
    }

    public function edit(Translation $translation)
    {
        return view('admin.translation.edit', ['translation' => $translation]);
    }

    public function update(UpdateTranslationRequest $request, Translation $translation)
    {
        if ($translation->update($request->validated())) {
            return redirect()->route('admin.translations.index')->with('success', 'The translation updated successfully!');
        } else {
            return back()->with('error', 'Can not update the translation!');
        }
    }

    public function destroy(Translation $translation)
    {
        if ($translation->delete()) {
            return response()->json(['success' => 'The translation deleted successfully!']);
        } else {
            return response()->json(['error' => 'Can not delete the translation!']);
        }
    }
}
