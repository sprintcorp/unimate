<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\User\ChatRequest;
use App\Interfaces\ChatInterface;

class ChatController extends Controller
{
    public function __construct(protected ChatInterface $chat){}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGroupChat($groupId)
    {
        return $this->chat->getGroupChat($groupId);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCourseChat($courseId)
    {
        return $this->chat->getCourseChat($courseId);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserChat($id)
    {
        return $this->chat->getUserChat($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChatRequest $request)
    {
        return $this->chat->createChat($request->all());
    }

    public function searchUser(ChatRequest $request)
    {
        return $this->chat->searchUser($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(ChatRequest $request, $id)
    {
        return $this->chat->updateChat($request->all(),$id);
    }

    public function addUserToChat(ChatRequest $request)
    {
        return $this->chat->addUserToChat($request->user_id);
    }

    public function removeUserFromChat($id)
    {
        return $this->chat->removeUserFromChat($id);
    }

    public function getChatUsers()
    {
        return $this->chat->getChatUsers();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->chat->deleteChat($id);
    }
}
