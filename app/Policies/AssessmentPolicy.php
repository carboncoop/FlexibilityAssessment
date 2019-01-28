<?php

namespace App\Policies;

use App\User;
use App\Assessment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssessmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the assessment.
     *
     * @param  \App\User  $user
     * @param  \App\Assessment  $assessment
     * @return mixed
     */
    public function view(User $user, Assessment $assessment)
    {
        return $this->update($user, $assessment);
    }

    /**
     * Determine whether the user can create assessments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Every authenticated user can create an assessment
    }

    /**
     * Determine whether the user can update the assessment.
     *
     * @param  \App\User  $user
     * @param  \App\Assessment  $assessment
     * @return mixed
     */
    public function update(User $user, Assessment $assessment)
    {
        if ($user->id === $assessment->owner_id)
            return true;
        else if($user->role === "administrator" && ($user->organisation_id === $assessment->user->organisation_id))
            return true;
        else 
            return false;
    }

    /**
     * Determine whether the user can delete the assessment.
     *
     * @param  \App\User  $user
     * @param  \App\Assessment  $assessment
     * @return mixed
     */
    public function delete(User $user, Assessment $assessment)
    {
        return $this->update($user, $assessment);
    }

    /**
     * Determine whether the user can restore the assessment.
     *
     * @param  \App\User  $user
     * @param  \App\Assessment  $assessment
     * @return mixed
     */
    public function restore(User $user, Assessment $assessment)
    {
        return $this->update($user, $assessment);
    }

    /**
     * Determine whether the user can permanently delete the assessment.
     *
     * @param  \App\User  $user
     * @param  \App\Assessment  $assessment
     * @return mixed
     */
    public function forceDelete(User $user, Assessment $assessment)
    {
        return $this->update($user, $assessment);
    }
}
