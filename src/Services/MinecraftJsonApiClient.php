<?php

namespace Kangoo13\Minecraft\JsonApi\Services;

use Doctrine\Common\Annotations\AnnotationRegistry;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use JMS\Serializer\SerializerBuilder;
use Kangoo13\Minecraft\JsonApi\Exceptions\ServerOfflineException;

/**
 * Class MinecraftJsonApiClient
 *
 * @package   Kangoo13\Minecraft\JsonApi\Services
 * @author    Aurélien SCHILTZ <aurelienschiltz@gmail.com>
 * @copyright 2016-2019 Aurélien SCHILTZ
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
abstract class MinecraftJsonApiClient
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var \JMS\Serializer\SerializerInterface
     */
    protected $serializer;

    /**
     * MinecraftJsonApiService constructor.
     *
     * @param string $ip
     * @param int    $port
     * @param string $username
     * @param string $password
     */
    public function __construct(
        string $ip = '127.0.0.1',
        int $port = 20059,
        string $username = 'admin',
        string $password = 'changeme'
    ) {
        $this->client   = new Client([
            'base_uri' => "http://$ip:$port/api/2/",
            'timeout'  => 2,
        ]);
        $this->username = $username;
        $this->password = $password;
        AnnotationRegistry::registerLoader('class_exists');
        $this->serializer = SerializerBuilder::create()->build();
    }

    /**
     * Create key for API call
     *
     * @param string $method
     *
     * @return string
     */
    private function getKey(string $method)
    {
        return hash('sha256', $this->username . $method . $this->password);
    }

    /**
     * Set custom http client
     *
     * @param ClientInterface $client
     *
     * @return $this
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Make the API call
     *
     * @param string $commandName
     * @param array  $commandArguments
     *
     * @return mixed
     * @throws GuzzleException
     * @throws ServerOfflineException
     */
    protected function call(string $commandName, array $commandArguments = [])
    {
        try {
            $response = $this->client->request('GET', 'call', [
                'query' => [
                    'json' => json_encode([
                        'name'      => $commandName,
                        'arguments' => $commandArguments,
                        'key'       => $this->getKey($commandName),
                        'username'  => $this->username
                    ])
                ],
            ]);
        } catch (ConnectException $e) {
            throw new ServerOfflineException();
        }

        if ($response->getStatusCode() >= 400) {
            throw new \Exception('Call failed to minecraft server', $response->getStatusCode());
        }

        $body = (string) $response->getBody();
        if (!($bodyDecoded = json_decode($body, true))) {
            throw new \Exception('Cannot decode response of minecraft server', 500);
        }

        return $bodyDecoded[0]['success'];
    }
}
