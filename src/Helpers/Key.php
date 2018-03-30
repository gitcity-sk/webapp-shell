<?php

namespace Webapp\Shell\Helpers;

use Psr\Http\Message\StreamInterface;
use Webapp\Shell\GitReference;

class Key
{

    /**
     * @var \Psr\Http\Message\StreamInterface
     */
    protected $body;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * Key constructor.
     * @param GitReference $gitReference
     */
    public function __construct(GitReference $gitReference)
    {
        $this->gitreference = $gitReference;
        $client = new \GuzzleHttp\Client(['base_uri' => SERVER_ADDRESS]);

        try {
            $response = $client->get('/api/git/key', [
                'query' => [
                    'shell_secret_key' => SHELL_KEY,
                    'key_id' => $this->gitreference->getKeyId()
                ]
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Console::print('Something went wrong');
            exit(1);
        }

        $this->body = $response->getBody();
        $this->data = json_decode($response->getBody());
    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getBody() : StreamInterface
    {
        return $this->body;
    }

    /**
     * Show project Data
     */
    public function get()
    {
        return $this->data->data;
    }

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->get()->user_id;
    }

}