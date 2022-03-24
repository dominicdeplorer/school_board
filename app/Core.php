<?php

namespace SchoolBoard;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Class Core
 *
 * @package SchoolBoard
 */
class Core implements HttpKernelInterface
{
    /**
     * @var RouteCollection
     */
    protected $routes;

    /**
     * Core constructor.
     */
    public function __construct()
    {
        $this->routes = new RouteCollection();
    }

    /**
     * @param  Request                                $request
     * @param  int|\Symfony\Component\HttpKernel\int  $type
     * @param  bool                                   $catch
     *
     * @return Response
     */
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true): Response
    {
        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($this->routes, $context);

        try {
            $attributes = $matcher->match($request->getPathInfo());
            $controller = $attributes['controller'];
            $method = $attributes['method'];
            unset($attributes['controller']);
            unset($attributes['method']);
            $obj = new $controller($attributes);
            $response = $obj->$method($attributes);
            if (is_array($response)) {
                if (isset($response[2])) {
                    $responseCode = $response[2];
                } else {
                    $responseCode = Response::HTTP_OK;
                }
                if ($response[1] == 'xml') {
                    $response = new Response($response[0], $responseCode, ['Content-Type' => 'text/xml']);
                } else {
                    $response = new Response($response[0], $responseCode, ['Content-Type' => 'application/json']);
                }
            } else {
                $response = new Response($response);
            }
        } catch (ResourceNotFoundException $e) {
            $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    /**
     * @param $path
     * @param $controller
     * @param $method
     */
    public function map($path, $controller, $method)
    {
        $this->routes->add(
            $path,
            new Route(
                $path,
                [
                    'controller' => $controller,
                    'method' => $method
                ]
            )
        );
    }
}