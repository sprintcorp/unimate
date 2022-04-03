<?php


namespace App\Repository;


use App\Interfaces\GroupInterface;
use App\Models\Group;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;

class GroupRepository implements GroupInterface
{
    use ApiResponser;
    public function createGroup($data)
    {
        try{
            DB::beginTransaction();
                $group = Group::create($data);
                auth()->user()->groups()->attach($group->id,['created_at'=>now()]);
            DB::commit();
            return $this->showModelWithMessage($group,'group created successfully',201);
        }catch (\Exception $exception){
            DB::rollBack();
            return $this->errorResponse($exception->getMessage(),200);
        }
    }

    public function updateGroup($data, $id)
    {
        $group = Group::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if($group) {
            $group->update($data);
            return $this->showMessage('group updated successfully');
        }
        return $this->showMessage('User cannot update another user group',401);
    }

    public function getGroups()
    {
        return auth()->user()->groups;
    }

    public function getGroup($id)
    {
        $group = Group::with(['users.student','chat'])->findOrFail($id);
        return $group;
    }

    public function deleteGroup($id)
    {
        $group = Group::where('id',$id)->where('user_id',auth()->user()->id)->first();
        if($group) {
            $group->delete();
            return $this->showMessage('Group deleted successfully');
        }
        return $this->showMessage('User cannot delete another user group',401);
    }

    public function addUserToGroup($user, $group_id)
    {
        $group = Group::where('id',$group_id)->where('user_id',auth()->user()->id)->first();
        if($group) {
            $group->users()->attach($user['user_id'],['created_at'=>now()]);
            return $this->showMessage('User added to group successfully');
        }
        return $this->showMessage('User is not authorized to add user to this group',401);
    }

    public function removeUserFromGroup($user, $group_id)
    {
        $group = Group::where('id',$group_id)->where('user_id',auth()->user()->id)->first();
        if($group) {
            $group->users()->detach($user['user_id']);
            return $this->showMessage('User removed from group successfully');
        }
        return $this->showMessage('User is not authorized to remove user from this group',401);

    }
}
