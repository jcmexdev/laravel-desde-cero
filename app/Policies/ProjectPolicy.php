<?php

namespace App\Policies;

use App\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any projects.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function view(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can create projects.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can update the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function update(User $user, Project $project)
    {
        //aquí podemos verificar si el usuario es el creador de este proyecto y lo dejamos editar
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can delete the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function delete(User $user, Project $project)
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can restore the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function restore(User $user, Project $project)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function forceDelete(User $user, Project $project)
    {
        //
    }
}
