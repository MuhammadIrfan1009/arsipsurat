<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    public function index()
    {
        
        $pendingUsers = User::where('status', 'pending')->get();

        return view('user_approval.index', compact('pendingUsers'));
    }

    public function approve($id)
    {
        
        $user = User::find($id);
        
        if ($user) {
            $user->status = 'approved';
            $user->save();

            return redirect()->route('user_approval.index')->with('success', 'User berhasil diterima');
        }

        return redirect()->route('user_approval.index')->with('error', 'User not found');
    }
}
