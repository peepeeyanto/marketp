<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class sellerChatListController extends Controller
{
    public function index(){
        $userId = Auth::user()->id;
        $messages = message::select('from_user_id', 'to_user_id', 'message', 'id')
        ->where(function($query) use ($userId) {
            // Search for messages where the user is either the sender or recipient
            $query->where('from_user_id', $userId)
                ->orWhere('to_user_id', $userId);
        })
        ->whereIn('id', function($query) use ($userId) {
            // Get the latest message for each user conversation involving the current user
            $query->select(DB::raw('MAX(id)'))
              ->from('messages')
              ->where('from_user_id', $userId)
              ->orWhere('to_user_id', $userId)
              ->groupBy(DB::raw('LEAST(from_user_id, to_user_id), GREATEST(from_user_id, to_user_id)'));
        })
        ->get();
        // dd($messages)->all();
        return view('seller.chatlist.index', compact('messages'));
    }
}
