<?php

use Illuminate\Foundation\Application;
use Kangoo13\Minecraft\JsonApi\Services\MinecraftJsonApiService;
use PHPUnit\Framework\TestCase;


/**
 * Class ExampleTest
 *
 * @package   Kangoo13\Minecraft\JsonApi\Tests
 * @author    Aurélien SCHILTZ <aurelien@myli.io>
 * @copyright 2016-2019 Myli
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class ExampleTest extends TestCase
{

    /**
     * Creates the application.
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $app = new Application(
            $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
        );

        return $app;
    }

    /**
     * A basic test example.
     */
    public function testExample()
    {
    }
}
