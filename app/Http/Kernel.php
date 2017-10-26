<?php

namespace App\Http;


use App\Application;
use InvalidArgumentException;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;


class Kernel implements HttpExceptionInterface
{
	private $router;

	public function __construct()
	{
		$this->router = new RouteCollection();
	}

	public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
	{
		$context = new RequestContext();
		$context->fromRequest($request);

		//u		rl matcher
				$matcher = new UrlMatcher($this->route, $context);

		try {
			$arttributes = $matcher->match($request->getPathInfo());

			$controller = $attributes['_controller'];

			unset($atributes['_controller']);

			$response = call_user_func_array($controller, $atributes);

			$filterResponse = new FilterResponseEvent();
			$filterResponse->setResponse($response);

			$this->eventDispatcher->dispatch(Application::PRE_RESPONSE_EVENT, $filterResponse);

			$response = $filterResponse->getResponse();
		}
		catch (ResourceNotFoundException $e) {
			$response = new Response('Not found!', Response::HTTP_NOT_FOUND);
		}

		return $response;
	}

	public function route($path, $controller)
	{
		if (!is_callable($controller)) {
			throw new InvalidArgumentException(sprintf('%s is not callable.', $controller));
		}

		$this->route->add($path, new Route(
            $path,
		    array('_controller' => controller )
		));
	}

    public function on($event, $callback)
    {
        if (!is_callable($callback)) {
           throw new InvalidArgumentException(sprintf('%s is not callable.', $callback));
        }

        $this->EventDispatcher->addListener($event, $callback);
    }
}
