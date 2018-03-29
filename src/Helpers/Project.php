<?php

namespace Webapp\Shell\Helpers;

use Webapp\Shell\GitReference;

class Project
{
    protected const PATTERN = '/[^git\-recieve\-pack][\~\/].(.*)[\']/';

    protected $protectedBranches = [
        "refs/heads/master"
    ];

    protected $gitreference;

    protected $body;

    protected $data;

    public function __construct(GitReference $gitReference)
    {
        $this->gitreference = $gitReference;
        $client = new \GuzzleHttp\Client(['base_uri' => SERVER_ADDRESS]);

        try {
            $response = $client->get('/api/git/project', [
                'query' => [
                    'shell_secret_key' => SHELL_KEY,
                    'project' => $this->getProjectName()
                    ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Console::print('Something went wrong');
            exit(1);
        }

        $this->body = $response->getBody();
        $this->data = json_decode($response->getBody());
    }

    public function get()
    {
        return $this->data;
    }

    public function getReference()
    {
        return $this->gitreference;
    }

    public function getBody()
    {
        return $this->body;
    }

    protected function getPath()
    {
        preg_match_all(static::PATTERN, $this->getReference()->getSshCommand(), $matches, PREG_SET_ORDER, 0);

        return $matches[0][1];
    }

    protected function getProjectName()
    {
        $matches = explode('.', $this->getPath());

        return $matches[0];
    }

    public function getProtectedBranches()
    {
        return $this->protectedBranches;
    }
}