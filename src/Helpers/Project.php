<?php

namespace Webapp\Shell\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\StreamInterface;
use Webapp\Shell\GitReference;

class Project
{
    /**
     *
     */
    protected const PATTERN = '/[^git\-recieve\-pack][\~\/].(.*)[\']/';

    /**
     * @var array
     */
    protected $protectedBranches = [
        "refs/heads/master"
    ];

    /**
     * @var GitReference
     */
    protected $gitreference;

    /**
     * @var \Psr\Http\Message\StreamInterface
     */
    protected $body;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * Project constructor.
     * @param GitReference $gitReference
     */
    public function __construct(GitReference $gitReference)
    {
        $this->gitreference = $gitReference;
        $client = new Client(['base_uri' => SERVER_ADDRESS]);

        try {
            $response = $client->get(new Uri('/api/git/update'), [
                'query' => [
                    'shell_secret_key' => SHELL_KEY,
                    'project' => $this->getProjectName(),
                    'key_id' => $this->gitreference->getKeyId()
                    ]
            ]);
        } catch (ClientException $e) {
            Console::print('Something went wrong');
            exit(1);
        }

        $this->body = $response->getBody();
        $this->data = json_decode($response->getBody());
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->data->data;
    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getBody() : StreamInterface
    {
        return $this->body;
    }

    /**
     * @return GitReference
     */
    public function getReference() : GitReference
    {
        return $this->gitreference;
    }

    /**
     * @return mixed
     */
    protected function getPath()
    {
        preg_match_all(static::PATTERN, $this->getReference()->getSshCommand(), $matches, PREG_SET_ORDER, 0);

        return $matches[0][1];
    }

    /**
     * @return string
     */
    protected function getProjectName() : string
    {
        $matches = explode('.', $this->getPath());

        return $matches[0];
    }

    /**
     * @return array
     */
    public function getProtectedBranches()
    {
        return $this->protectedBranches;
    }

    /**
     * @return bool
     */
    public function isOwner() : bool
    {
        if ($this->data->data->user_id == $this->gitreference->getKeyId()) return true;

        return false;
    }
}