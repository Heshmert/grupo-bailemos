<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use Cake\Core\Configure;
use Cake\Core\ContainerInterface;
use Cake\Datasource\FactoryLocator;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Event\EventManagerInterface;
use Cake\Http\BaseApplication;
use Cake\Http\Middleware\BodyParserMiddleware;
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\ORM\Locator\TableLocator;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Authentication\AuthenticationService;
use Authentication\AuthenticationServiceInterface;
use Authentication\AuthenticationServiceProviderInterface;
use Authentication\Identifier\AbstractIdentifier;
use Authentication\Identifier\IdentifierInterface;
use Authentication\Middleware\AuthenticationMiddleware;
use Cake\Routing\Router;
use Psr\Http\Message\ServerRequestInterface;
use Cake\Http\Middleware\CorsMiddleware;
/**
 * Application setup class.
 *
 * This defines the bootstrapping logic and middleware layers you
 * want to use in your application.
 *
 * @extends \Cake\Http\BaseApplication<\App\Application>
 */
class Application extends BaseApplication implements AuthenticationServiceProviderInterface
{
    /**
     * Load all the application configuration and bootstrap logic.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        // Call parent to load bootstrap from files.
        parent::bootstrap();

        $this->addPlugin('Authentication');

        // By default, does not allow fallback classes.
        FactoryLocator::add('Table', (new TableLocator())->allowFallbackClass(false));

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
        }
        
        if (PHP_SAPI !== 'cli') { 
                // Aquí adentro mete todo lo que use $_SERVER
                if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
                    header('Access-Control-Allow-Origin: *');
                    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
                    header('Access-Control-Allow-Headers: Content-Type, Authorization');
                    exit;
                }
            }
    }

    /**
     * Setup the middleware queue your application will use.
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue The middleware queue to setup.
     * @return \Cake\Http\MiddlewareQueue The updated middleware queue.
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        $middlewareQueue

            // Catch any exceptions in the lower layers,
            // and make an error page/response
            ->add(new ErrorHandlerMiddleware(Configure::read('Error'), $this))

            // Handle plugin/theme assets like CakePHP normally does.
            ->add(new AssetMiddleware([
                'cacheTime' => Configure::read('Asset.cacheTime'),
            ]))

            // Add routing middleware.
            // If you have a large number of routes connected, turning on routes
            // caching in production could improve performance.
            // See https://github.com/CakeDC/cakephp-cached-routing
            ->add(new RoutingMiddleware($this))

            // Parse various types of encoded request bodies so that they are
            // available as array through $request->getData()
            // https://book.cakephp.org/5/en/controllers/middleware.html#body-parser-middleware
            ->add(new BodyParserMiddleware())

            ->add(new AuthenticationMiddleware($this));
        return $middlewareQueue;
    }

    /**
     * Register application container services.
     *
     * @param \Cake\Core\ContainerInterface $container The Container to update.
     * @return void
     * @link https://book.cakephp.org/5/en/development/dependency-injection.html#dependency-injection
     */
    public function services(ContainerInterface $container): void
    {
        // Allow your Tables to be dependency injected
        //$container->delegate(new \Cake\ORM\Locator\TableContainer());
    }

    /**
     * Register custom event listeners here
     *
     * @param \Cake\Event\EventManagerInterface $eventManager
     * @return \Cake\Event\EventManagerInterface
     * @link https://book.cakephp.org/5/en/core-libraries/events.html#registering-listeners
     */
    public function events(EventManagerInterface $eventManager): EventManagerInterface
    {
        // $eventManager->on(new SomeCustomListenerClass());

        return $eventManager;
    }

    /**
 * Returns a service provider instance.
 *
 * @param \Psr\Http\Message\ServerRequestInterface $request Request
 * @return \Authentication\AuthenticationServiceInterface
 */
public function getAuthenticationService(ServerRequestInterface $request): AuthenticationServiceInterface
{
    $service = new AuthenticationService();

    // 1. IDENTIFICADORES (Quién es el usuario)
    // Usamos el identificador ORM para ambos (Form y JWT)
    $service->loadIdentifier('Authentication.Password', [
        'fields' => ['username' => 'email', 'password' => 'password'],
        'resolver' => [
            'className' => 'Authentication.Orm',
            'userModel' => 'Users'
        ]
    ]);

    // 1. Cargamos el identificador para mapear el token a la DB
    // En src/Application.php -> getAuthenticationService

    $service->loadAuthenticator('Authentication.Jwt', [
        'secretKey' => 'ClaveSuperSecretaDePrueba1234567890', // PEGADA DIRECTA
        'algorithm' => 'HS256', // Algoritmo simple de una sola clave
        'returnPayload' => false,
        'header' => 'Authorization',
        'prefix' => 'Bearer', 
    ]);

    $service->loadIdentifier('Authentication.JwtSubject', [
        'resolver' => [
            'className' => 'Authentication.Orm',
            'userModel' => 'Users'
        ],
        'fields' => ['id' => 'id'] 
    ]);

    // FORM AUTHENTICATOR
    $service->loadAuthenticator('Authentication.Form', [
        'fields' => [
            'username' => 'email',
            'password' => 'password'
        ],
        'loginUrl' => Router::url('/api/users/login'), // Asegúrate que esta ruta sea exacta
    ]);

    return $service;
}


}
