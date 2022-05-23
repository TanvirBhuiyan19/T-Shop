<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Carbon\Carbon;
use App\Models\User;

class ChatController extends Controller
{
    // ===================== User Part ================================//
    //Message Send for User
    public function sendMessage(Request $request){
        $request->validate([
            'msg' => 'required',
        ]);
        $productId = $request->productId;
        $msg = $request->msg;
        if(auth()->user()->role_id == 2){
            Message::insert([
                'sender_id' => auth()->user()->id,
                'receiver_id' => 1,
                'product_id' => $productId,
                'msg' => $msg,
                'created_at' => Carbon::now(),
            ]);
            return response()->json('Message Send Successfully!');
        }else{
            return response()->json('Admin can not send Message!');
        }
        
    }
    
    //Read All Messages from User Dashboard
    public function userMessages(){
            $myId = auth()->id();
           $messages = Message::with(['user','product'])
                                ->where('sender_id',auth()->id())
                                ->orWhere('receiver_id',auth()->id())
                                ->get();
         
           return response()->json(['myId' => $myId, 'messages' => $messages ],200);
    }



    //=========================== Admin Part ================================//
    
    //Read All User Messages from Admin Dashboard
    public function adminChatPage(){
        return view('admin.chat.index');
    }

    //Get All Users who Message to Admin
    public function getAllUsers(){
        $chats = Message::orderBy('id','DESC')
                ->where('receiver_id', 1)
                ->get();

        $users = $chats->map(function($chat){
            if ($chat->receiver_id != 1) {
                return $chat->receiver;
            }
            return $chat->sender;

        })->unique();

        return $users;
    }

    //Get Selected User all Message
    public function useMsgById($userId){
        $user = User::find($userId);
        if ($user) {
            $messages = Message::where(function($q) use ($userId){
                // $q->where('sender_id',auth()->id());
                $q->where('receiver_id',$userId);
            })->orWhere(function($q) use ($userId){
                 $q->where('sender_id',$userId);
                //  $q->where('receiver_id',auth()->id());
            })->with(['user','product'])->get();
          
            return response()->json([
                'user' => $user,
                'messages' => $messages,
            ],200);
        }else {
            abort(404);
        }
     }

     //Send Message to User
    public function adminSendMsg(Request $request){
        $request->validate([
            'msg' => 'required',
            'receiver_id' => 'required',
        ]);
        $receiverId = $request->receiver_id;
        $msg = $request->msg;
        Message::insert([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $receiverId,
            'msg' => $msg,
            'created_at' => Carbon::now(),
        ]);
        return response()->json('Message Send Successfully!');
    }



}
