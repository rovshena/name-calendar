<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Compatibility;
use App\Http\Requests\CompatibilityRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CompatibilityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $compatibilities = Compatibility::all(['first_id', 'second_id', 'compatibility', 'content']);
            return DataTables::of($compatibilities)
                ->addColumn('first_name', function ($row) {
                    $translation = $row->firstName()->first();
                    $temp = json_decode($translation->name, true);
                    return $temp['main'];
                })
                ->addColumn('second_name', function ($row) {
                    $translation = $row->secondName()->first();
                    $temp = json_decode($translation->name, true);
                    return $temp['main'];
                })
                ->editColumn('compatibility', function ($row) {
                    if (!empty($row->compatibility)) {
                        return $row->compatibility . '%';
                    }
                    return '';
                })
                ->editColumn('content', function ($row) {
                    return strip_tags(Str::limit($row->content, 25));
                })
                ->addColumn('actions', function ($row) {
                    $view = '<a href="' . route('admin.compatibilities.show', [$row->first_id, $row->second_id]) . '" class="btn btn-subtle-primary btn-sm mr-2"><i class="fas fa-eye fa-fw"></i></a>';
                    $edit = '<a href="' . route('admin.compatibilities.edit', [$row->first_id, $row->second_id]) . '" class="btn btn-subtle-success btn-sm mr-2"><i class="fas fa-edit fa-fw"></i></a>';
                    $delete = '<a href="javascript:void(0);" data-href="' . route('admin.compatibilities.destroy', [$row->first_id, $row->second_id]) . '" class="btn btn-subtle-danger btn-sm mr-2 delete-item"><i class="fas fa-trash-alt fa-fw"></i></a>';
                    return $view . $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        return view('admin.compatibility.index');
    }

    public function store(CompatibilityRequest $request)
    {
        $compatibility = Compatibility::where(function ($query) use ($request) {
            $query->where('first_id', $request->first_id)->where('second_id', $request->second_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('first_id', $request->second_id)->where('second_id', $request->first_id);
        })->first();

        if (isset($compatibility) && $compatibility != false) {
            return redirect()->route('admin.compatibilities.edit', [$compatibility->first_id, $compatibility->second_id])->with('info', 'The compatibility already created!');
        }

        $compatibility = Compatibility::create($request->validated());
        return redirect()->route('admin.compatibilities.edit', [$compatibility->first_id, $compatibility->second_id])->with('success', 'The compatibility created successfully!');
    }

    public function show($first, $second)
    {
        $compatibility = Compatibility::where(function ($query) use ($first, $second) {
            $query->where('first_id', $first)->where('second_id', $second);
        })->orWhere(function ($query) use ($first, $second) {
            $query->where('first_id', $second)->where('second_id', $first);
        })->firstOrFail();

        return view('admin.compatibility.view', [
            'compatibility' => $compatibility->load(['firstName', 'secondName'])
        ]);
    }

    public function edit($first, $second)
    {
        $compatibility = Compatibility::where(function ($query) use ($first, $second) {
            $query->where('first_id', $first)->where('second_id', $second);
        })->orWhere(function ($query) use ($first, $second) {
            $query->where('first_id', $second)->where('second_id', $first);
        })->firstOrFail();

        return view('admin.compatibility.edit', [
            'compatibility' => $compatibility->load(['firstName', 'secondName'])
        ]);
    }

    public function update(CompatibilityRequest $request, $first, $second)
    {
        $response = Compatibility::where(function ($query) use ($first, $second) {
            $query->where('first_id', $first)->where('second_id', $second);
        })->orWhere(function ($query) use ($first, $second) {
            $query->where('first_id', $second)->where('second_id', $first);
        })->update([
            'compatibility' => $request->input('compatibility'),
            'content' => $request->input('content'),
        ]);

        if ($response) {
            return redirect()->route('admin.compatibilities.edit', [$first, $second])->with('success', 'The compatibility updated successfully!');
        } else {
            return back()->with('error', 'Can not update the compatibility!');
        }
    }

    public function destroy($first, $second)
    {
        $response = Compatibility::where(function ($query) use ($first, $second) {
            $query->where('first_id', $first)->where('second_id', $second);
        })->orWhere(function ($query) use ($first, $second) {
            $query->where('first_id', $second)->where('second_id', $first);
        })->delete();

        if ($response) {
            return response()->json(['success' => 'The compatibility deleted successfully!']);
        } else {
            return response()->json(['error' => 'Can not delete the compatibility!']);
        }
    }
}
