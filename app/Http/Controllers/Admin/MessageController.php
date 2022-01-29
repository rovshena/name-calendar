<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $messages = Message::all(['id', 'name', 'phone', 'email', 'is_read', 'created_at']);
            return DataTables::of($messages)
                ->editColumn('is_read', function ($row) {
                    return '<a href="' . route('admin.messages.show', $row) . '"><i class="' . ($row->is_read ? 'far fa-envelope-open' : 'fas fa-envelope') . ' text-warning fa-fw fa-2x"></i></a>';
                })
                ->editColumn('created_at', function ($row) {
                    return optional($row->created_at)->format('d.m.Y H:i:s');
                })
                ->addColumn('icon', function ($row) {
                    return $row->is_read ? '' : '<i class="fas fa-circle text-primary"></i>';
                })
                ->addColumn('actions', function ($row) {
                    $view = '<a href="' . route('admin.messages.show', $row) . '" class="btn btn-subtle-primary btn-sm mr-2"><i class="fas fa-eye fa-fw"></i></a>';
                    $delete = '<a href="javascript:void(0);" data-href="' . route('admin.messages.destroy', $row) . '" class="btn btn-subtle-danger btn-sm mr-2 delete-item"><i class="fas fa-trash-alt fa-fw"></i></a>';
                    return $view . $delete;
                })
                ->setRowClass(function ($row) {
                    return $row->is_read ? '' : 'font-weight-bold bg-secondary';
                })
                ->rawColumns(['actions', 'is_read', 'icon'])
                ->toJson();
        }

        return view('admin.message.index');
    }

    public function show(Message $message)
    {
        $message->update(['is_read' => 1]);
        return view('admin.message.view', ['message' => $message]);
    }

    public function destroy(Message $message)
    {
        if ($message->delete()) {
            return response()->json(['success' => 'The message deleted successfully!']);
        } else {
            return response()->json(['error' => 'Can not delete the message!']);
        }
    }

    public function markAllAsRead()
    {
        Message::unread()->update(['is_read' => 1]);
        return back()->with('success', 'All messages marked as read');
    }
}
