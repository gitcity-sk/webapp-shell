<?php

namespace Webapp\Shell;

class GitReference
{
    protected $ref;

    protected $originalSSHCommand;

    protected $keyId;

    public function getRefs()
    {
        return $this->ref;
    }

    public function getSshCommand()
    {
        return $this->originalSSHCommand;
    }

    public function getKeyId()
    {
        return $this->keyId;
    }

    public function setRefs($refs)
    {
        $this->ref = $refs;

        return $this;
    }

    public function setSshCommand($sshCommand)
    {
        $this->originalSSHCommand = $sshCommand;

        return $this;
    }

    public function setKeyId($keyId)
    {
        $this->keyId = $keyId;

        return $this;
    }

}