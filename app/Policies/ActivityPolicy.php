<?php

namespace App\Policies;

use App\Constants\ActivityStatus;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ActivityPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Activity $activity): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isPic();
    }

    public function update(User $user, Activity $activity): bool
    {
        return $user->isPic() &&
            $user->pic->id == $activity->pic_id;
    }

    public function delete(User $user, Activity $activity): bool
    {
        return $user->isPic();
    }

    public function restore(User $user, Activity $activity): bool
    {
        return $user->isPic();
    }

    public function forceDelete(User $user, Activity $activity): bool
    {
        return $user->isPic();
    }

    public function confirm(User $user, Activity $activity): bool
    {
        return $activity->status == ActivityStatus::PENDING &&
            $activity->documentations->isNotEmpty() &&
            $user->isDepartmentHead() &&
            $user->departmentHead->department == $activity->pic->department;
    }

    public function notifyPic(User $user, Activity $activity): bool
    {
        return $activity->status == ActivityStatus::PENDING &&
            $activity->documentations->isEmpty() &&
            $user->isDepartmentHead() &&
            $user->departmentHead->department == $activity->pic->department;
    }
}
