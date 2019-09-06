<?php

namespace Kangoo13\Minecraft\JsonApi\Services;

use GuzzleHttp\Exception\GuzzleException;
use Kangoo13\Minecraft\JsonApi\Exceptions\ServerOfflineException;
use Kangoo13\Minecraft\JsonApi\Models\Player;

/**
 * Class MinecraftJsonApiService
 *
 * @package   Kangoo13\Minecraft\JsonApi\Services
 * @author    Aurélien SCHILTZ <aurelienschiltz@gmail.com>
 * @copyright 2016-2019 Aurélien SCHILTZ
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class MinecraftJsonApiService extends MinecraftJsonApiClient
{
    /**
     * Is the player connected to the game
     *
     * @param string $username
     *
     * @return bool
     * @throws GuzzleException
     * @throws ServerOfflineException
     */
    public function isPlayerConnected(string $username) : bool
    {
        $player = $this->getPlayer($username);


        return $player->isConnected();
    }

    /**
     * Get a player's informations
     *
     * @param string $username
     *
     * @return Player
     * @throws GuzzleException
     * @throws ServerOfflineException
     */
    public function getPlayer(string $username)
    {
        $player = $this->call('getPlayer', [$username]);
        if ($player === null) {
            return null;
        }

        return $this->serializer->deserialize(json_encode($player), Player::class, 'json');
    }

    /**
     * Short description here
     *
     * @return bool
     * @throws GuzzleException
     */
    public function isServerOnline()
    {
        try {
            $this->getPlayersCountOnline();
        } catch (ServerOfflineException $e) {
            return false;
        }

        return true;
    }

    /**
     * Get total online players count
     *
     * @return int
     * @throws GuzzleException
     * @throws ServerOfflineException
     */
    public function getPlayersCountOnline() : int
    {
        return $this->call('getPlayerCount');
    }

    /**
     * Get the players cap
     *
     * @return int
     * @throws GuzzleException
     * @throws ServerOfflineException
     */
    public function getPlayersLimit() : int
    {
        return $this->call('getPlayerLimit');
    }

    /**
     * Run a command in the console
     *
     * @param string $command
     *
     * @return mixed
     * @throws GuzzleException
     * @throws ServerOfflineException
     */
    public function performConsoleCommand(string $command)
    {
        return $this->call('runConsoleCommand', [$command]);
    }
}
