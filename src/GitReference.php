<?php

namespace Webapp\Shell;

class GitReference
{
    protected $ref;

    protected $originalSSHCommand;

    public function __construct($ref)
    {
        if (null !== $ref && is_array($ref)) {
            $this->ref = $ref['argv'][1];
            $this->originalSSHCommand = $ref['SSH_ORIGINAL_COMMAND'];
        }
    }

    public function getRef()
    {
        return $this->ref;
    }

    public function getSshCommand()
    {
        return $this->originalSSHCommand;
    }

}