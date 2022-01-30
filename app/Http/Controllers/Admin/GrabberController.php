<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grabber;
use App\Http\Requests\UpdateGrabberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class GrabberController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $grabbers = Grabber::all(['id', 'name', 'gender', 'nationality', 'letter', 'religion']);
            return DataTables::of($grabbers)
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
                    $edit = '<a href="' . route('admin.grabbers.edit', $row) . '" class="btn btn-subtle-success btn-sm mr-2"><i class="fas fa-edit fa-fw"></i></a>';
                    $delete = '<a href="javascript:void(0);" data-href="' . route('admin.grabbers.destroy', $row) . '" class="btn btn-subtle-danger btn-sm mr-2 delete-item"><i class="fas fa-trash-alt fa-fw"></i></a>';
                    return $edit . $delete;
                })
                ->rawColumns(['actions'])
                ->toJson();
        }

        return view('admin.grabber.index');
    }

    public function edit(Grabber $grabber)
    {
        return view('admin.grabber.edit', ['grabber' => $grabber]);
    }

    public function update(UpdateGrabberRequest $request, Grabber $grabber)
    {
        if ($grabber->update($request->validated())) {
            return redirect()->route('admin.grabbers.index')->with('success', 'The content updated successfully!');
        } else {
            return back()->with('error', 'Can not update the content!');
        }
    }

    public function destroy(Grabber $grabber)
    {
        if ($grabber->delete()) {
            return response()->json(['success' => 'The content deleted successfully!']);
        } else {
            return response()->json(['error' => 'Can not delete the content!']);
        }
    }
}
