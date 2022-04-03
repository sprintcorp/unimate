<?php

namespace App\Http\Controllers\v1;

use App\Http\Requests\User\GroupRequest;
use App\Interfaces\GroupInterface;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __construct(protected GroupInterface $group){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->group->getGroups();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        return $this->group->createGroup($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->group->getGroup($id);
    }


    public function addUserToGroup(GroupRequest $request,$id)
    {
        return $this->group->addUserToGroup($request->all(),$id);
    }

    public function removeUserFromGroup(GroupRequest $request,$id)
    {
        return $this->group->removeUserFromGroup($request->all(),$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->group->updateGroup($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->group->deleteGroup($id);
    }
}
