<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\Hello;
use App\Models\Message;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
    //

    public function get()
    {
        //get all users execpt the auth one

        $contacts = User::where('id','!=',auth()->id())->get();
// dd(auth()->id());
        // $contacts.
        //get all messages from user
        $messages = Message::where('to',auth()->id())
                            ->orWhere('from',auth()->id())
                             ->get();
        // dd( $messages );



        $unreadIds = Message::select(DB::raw('`from` as sender_id, count(`from`) as messages_count'))
                        ->where('to', auth()->id())
                        ->where('read', false)
                        ->groupBy('from')
                        ->get();
                        // dd(  $unreadIds );
        
      // add an unread key to each contact with the count of unread messages
      $contactFinal = $contacts->map(function($contact) use ($unreadIds,$messages) {
                    $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

                    $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

                    $messagesStartedTo = $messages->where('to',$contact->id)->first();
                    $messagesStartedFrom= $messages->where('from',$contact->id)->first();
           
                    
                    $contact->conversationTo =$messagesStartedTo ?'yes':'no';
                    $contact->conversationFrom =$messagesStartedFrom ?'yes':'no';
                    return $contact;
       
         });
         
        // dd( $contacts );
         //loop throught contact filter out contacts with messages
        //  foreach ($contacts as $contact_message) {
        //     //  $contact_message->message;
   
        //          $test = $contact_message->message->where([
        //              'from',auth()->id(),
        //              'to',$contact_message->id
        //          ]);
         
            
        //  }
// $test = $contacts->filter(function($item,$index){
 

//       if(!empty($item->message[$index])){
   
//         if($item->message[$index]->from == auth()->id){
//                 return $item;
//         }
    
//       }
//             // die();
  
// }); 
//     dd($test);

         


        // $contact_ids = array();
        //         foreach ($contacts as $key) {
         
        //                 array_push($contact_ids,$key->id);
        //         }
        //         foreach($contact_ids as $contact_id){

                    
                
                //  foreach($contacts as $contactMessage){
                //    $contacts =  $contactMessage->message->where(function($q) use ($contactMessage){
                //         $q->where('from',auth()->id());
                //         $q->whereIn('to',$contactMessage->id);
                //     })->orWhere(function($q) use ($contactMessage){
                //         $q->where('from',$contactMessage->id);
                //         $q->whereIn('to',auth()->id());
                //     });
                //     // return $contacts;
                // }
            // $messages

        return response()->json($contactFinal);
        
    }
    public function conversationFor($id)
    {
         Message::where('from',$id)->where('to',auth()->id())->update(['read'=>true]);

        $messages = Message::where(function($q) use ($id){
                $q->where('from',auth()->id());
                $q->where('to',$id);
        })->orWhere(function($q) use ($id){
                $q->where('from',$id);
                $q->where('to',auth()->id());
        })->get();
        return response()->json($messages);



    }
    public function send(Request $request)
    {
        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ]);

        broadcast(new NewMessage($message));
        // dd($message,'message');
        // broadcast(new Hello($message));
        // broadcast(new NewMessage($message));
        return response()->json($message);
    }
}
