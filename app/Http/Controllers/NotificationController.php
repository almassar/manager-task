<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        Auth::user()->notifications()->where('id', $id)->first()->markAsRead();

        return response()->json('ok');
    }
}
