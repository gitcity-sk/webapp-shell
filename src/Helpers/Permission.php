<?php

namespace Webapp\Shell\Helpers;

use Webapp\Shell\GitReference;


class Permission
{
    protected $project;

    public function isAllowedToPush(Project $project)
    {
        if (in_array($project->getReference()->getRef(), $project->getProtectedBranches())) {
            $branch = $project->getReference()->getRef();
            Console::print("not allowed, $branch is protected branch but allowing to push");
            //exit(1);
        }
    }   
}