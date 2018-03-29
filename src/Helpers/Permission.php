<?php

namespace Webapp\Shell\Helpers;

use Webapp\Shell\GitReference;


class Permission
{
    protected $project;

    public function isAllowedToPush(Project $project, Key $key)
    {
        // If user is owner return true
        if ($project->get()->user_id == $key->getOwner()) return true;

        // Check if branches are protected
        if (in_array($project->getReference()->getRefs(), $project->getProtectedBranches())) {
            $branch = $project->getReference()->getRefs();
            Console::print("not allowed, $branch is protected branch but allowing to push");
            exit(1);
        }
    }   
}