<?php

namespace Webapp\Shell;

class GitReference
{
    /**
     * @var
     */
    protected $ref;

    /**
     * @var
     */
    protected $originalSSHCommand;

    /**
     * @var
     */
    protected $keyId;

    /**
     * @return mixed
     */
    public function getRefs()
    {
        return $this->ref;
    }

    /**
     * @return mixed
     */
    public function getSshCommand()
    {
        return $this->originalSSHCommand;
    }

    /**
     * @return mixed
     */
    public function getKeyId()
    {
        return $this->keyId;
    }

    /**
     * @param $refs
     * @return $this
     */
    public function setRefs($refs)
    {
        $this->ref = $refs;

        return $this;
    }

    /**
     * @param $sshCommand
     * @return $this
     */
    public function setSshCommand($sshCommand)
    {
        $this->originalSSHCommand = $sshCommand;

        return $this;
    }

    /**
     * @param $keyId
     * @return $this
     */
    public function setKeyId($keyId)
    {
        $this->keyId = $keyId;

        return $this;
    }

}