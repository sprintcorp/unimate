<?php


namespace App\Repository;


use App\Events\MessageSent;
use App\Http\Resources\User\StudentResources;
use App\Interfaces\ChatInterface;
use App\Models\Chat;
use App\Models\User;
use App\Traits\ApiResponser;

class ChatRepository implements ChatInterface
{
    use ApiResponser;
    public function createChat($data)
    {
        $data['type'] = 'text';
        $chat = Chat::create($data);
        broadcast(new MessageSent(auth()->user()->id, $data['receiver_id'] ?? '',$data['course_id'] ?? '',
            $data['group_id']?? '', auth()->user()->student->university_id ?? '',$data['message'] ?? '',$data['type'] ?? ''))->toOthers();
        return $this->showOne($chat,201);
    }

    public function updateChat($data, $id)
    {
        $chat = Chat::findorFail($id);
        $chat->update($data);
        broadcast(new MessageSent(auth()->user()->id, $data['receiver_id'] ?? '',$data['course_id'] ?? '',
            $data['group_id']?? '', auth()->user()->student->university_id ?? '',$data['message'] ?? '',$data['type'] ?? ''))->toOthers();
        return $this->showMessage('chat updated successful');
    }

    public function getGroupChat($id)
    {
        $chat = Chat::where('group_id',$id)->latest()->get();
        return $this->showAll($chat,200,100);
    }

    public function getCourseChat($id)
    {
        $chat = Chat::where('course_id',$id)->latest()->get();
        return $this->showAll($chat,200,100);
    }

    public function deleteChat($id)
    {
        $chat = Chat::findorFail($id);
        $chat->delete();
        return $this->showMessage('chat deleted successfully',200);
    }

    public function getUserChat($id)
    {
        $chat = Chat::where(function ($query) use($id){
           return $query->where('user_id',auth()->user()->id)->where('receiver_id',$id);
        })->orWhere(function ($query) use($id){
            return $query->where('user_id',$id)->where('receiver_id',auth()->user()->id);
        })->get();
        return $this->showAll($chat,200,100);
    }

    public function searchUser($data)
    {
        $user = User::with('student')->whereHas('student',function ($query) use($data){
                return $query->where('firstname', 'like', "%".$data['search'] . "%")
                    ->orWhere('lastname', 'like', "%".$data['search'] . "%")
                    ->orWhere('other_name', 'like', "%".$data['search'] . "%");
        })->latest()->get();
        return $this->showAll(StudentResources::collection($user),200,20);
    }

    public function addUserToChat($userId)
    {
        if (!auth()->user()->sender->contains($userId)) {
            auth()->user()->sender()->attach($userId);
            return $this->successResponse('user added successfully', 201);
        }
        return $this->successResponse('connection exist', 200);
    }

    public function removeUserFromChat($userId)
    {
        auth()->user()->sender()->detach($userId);
        return $this->successResponse('user removed successfully',200);
    }

    public function getChatUsers()
    {
        $user = User::where('id',auth()->user()->id)->with(['sender.student','receiver.student'])
            ->get();
        $sender = $user->pluck('sender')->collapse();
        $receiver = $user->pluck('receiver')->collapse();
        $sende_receiver = $sender->merge($receiver);
        return $sende_receiver;
    }
}
