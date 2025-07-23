<?php


use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;

#
require './BaseResource.php';



class JsonBodyParserMiddleware implements MiddlewareInterface {
    
    public function process(Request $request, RequestHandler $handler): Response{
        $contentType = $request->getHeaderLine('Content-Type');

        if (strstr($contentType, 'application/json')) {
            $contents = json_decode(file_get_contents('php://input'), true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $request = $request->withParsedBody($contents);
            }
        }

        return $handler->handle($request);
    }
}

// Create Container using PHP-DI
$container = new Container();

// Set container to create App with on AppFactory
AppFactory::setContainer($container);

/**
 * Instantiate App
 *
 * In order for the factory to work you need to ensure you have installed
 * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
 * ServerRequest creator (included with Slim PSR-7)
 */
$app = AppFactory::create();

$app->setBasePath('/controllers');
/*
$app->setBasePath((function () {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $uri = (string) parse_url('http://a' . $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    if (stripos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
        return $_SERVER['SCRIPT_NAME'];
    }
    if ($scriptDir !== '/' && stripos($uri, $scriptDir) === 0) {
        return $scriptDir;
    }
    return '';
})());
*/
/**
  * The routing middleware should be added earlier than the ErrorMiddleware
  * Otherwise exceptions thrown from it will not be handled by the middleware
  */
$app->addRoutingMiddleware();

/**
 * Add Error Middleware
 *
 * @param bool                  $displayErrorDetails -> Should be set to false in production
 * @param bool                  $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool                  $logErrorDetails -> Display error details in error log
 * @param LoggerInterface|null  $logger -> Optional PSR-3 Logger  
 *
 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
$errorMiddleware = $app->addErrorMiddleware(true, true, true);


#$registrationService = new RegistrationService();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello, You request for / rest endpoint.");
    return $response;
});

// Define app routes
$app->get('/hello', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello, You request for /hello rest endpoint.");
    return $response;
});

// Define app routes
$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name you request for /hello/$name rest endpoint.");
    return $response;
});


/**
 *
 * 
 * 
 */
$container->set('contactusServices', function () {
    $settings = [];
    return new CommonServices();
});

$connectArgs = array('param1' => "hello");
$app->post('/contactus', function (Request $request, Response $response, $connectArgs) {
    
    $logger = Logger::getLogger('ResourceController');
    $param = $connectArgs['param'] ?? "subscribeServices";
    $restResponse = new RestResponse();
    try {
        /*
        // Get the session from the request
        $session = $request->getAttribute('session');
        $logger->info('Session {}');
        $logger->info($session);
        // 
        //$params = $request->getServerParams();
        //$authorization = $params['HTTP_AUTHORIZATION'] ?? null;
        //$logger->info('$authorization {}', $authorization);
        
        // Get all POST parameters
        $params = (array)$request->getParsedBody();
        $logger->info('$params {}');
        $logger->info($params);
        // Get a single POST parameter
        $foo = $params['foo'];

        // 
        // URL: https://example.com/search?key1=value1&key2=value2
        $queryParams = $request->getQueryParams();
        $logger->info('$queryParams {}');
        $logger->info($queryParams);
        // Output: value1
        $key1 = $queryParams['key1'] ?? null;

        // Headers
        $headers = $request->getHeaders();
        foreach ($headers as $name => $values) {
            echo $name . ": " . implode(", ", $values);
        }
        $logger->info('$headers');
        $logger->info($headers);
        
        $headerValueArray = $request->getHeader('Accept');
        $headerValueString = $request->getHeaderLine('Accept');
        
        $parsedBody = $request->getParsedBody();
        $logger->info('$parsedBody');
        $logger->info("$parsedBody");
        */
        $jsonObj = $request->getBody();
        $logger->info('body type -- '. gettype($jsonObj));
        $logger->info('json-object -- '. $jsonObj);

        //
        // $json = json_encode($obj)
        // $json = '{"foo-bar": 12345}';
        // $obj  = json_decode($json);
        
        $dataStr = "$jsonObj";
        $logger->info('$dataStr -- '. $dataStr);
        if (!is_null($dataStr) && isset($dataStr)) {
            
            $dataObj = json_decode($dataStr);
            $commonServices = $this->get('commonServices');
            $commonServices->contactUs($dataObj,$restResponse);
            
            $msg = Message::Success("Email Notification successfully send.");
            $restResponse->addMessages($msg);
            $restResponse->setData($dataObj);
            $restResponse->setMessage("You have successfully registered.");
            $restResponse->setStatus(TRUE);
        } else {
            //header('HTTP/1.0 404 Not Found');
            //$app->notFound();
            $restResponse->setMessage("System error occurred while processing your request");
            $restResponse->setStatus(FALSE);
        }
    } catch (Exception $ex) {
        //header('HTTP/1.0 500 Internal Server Error');
        $logger->error("System error occurred while processing your request " . $ex->getTraceAsString());
        $msg = Message::Error("System error occurred while processing your request." .$ex->getTraceAsString());
        $restResponse->addMessages($msg);
        $restResponse->setMessage("System error occurred while processing your request");
        $restResponse->setStatus(FALSE);
    }
    
    $response->getBody()->write(json_encode($restResponse));
    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
});


/**
 *
 * 
 * 
 */
$container->set('subscribeServices', function () {
    $settings = [];
    return new SubscribeServices();
});
$subcribeArgs = array('param' => "subscribeServices");
$app->post('/subcribe-services', function (Request $request, Response $response, $subcribeArgs) {
    
    $logger = Logger::getLogger('ResourceController');
    $param = $subcribeArgs['param'] ?? "subscribeServices";
    $restResponse = new RestResponse();
    try {
        
        $jsonObj = $request->getBody();
        $logger->info('body type -- '. gettype($jsonObj));
        $logger->info('json-object -- '. $jsonObj);

        $dataStr = "$jsonObj";
        $logger->info('$dataStr -- '. $dataStr);
        if (!is_null($dataStr) && isset($dataStr)) {
            
            $dataObj = json_decode($dataStr);
            $subscribeServices = $this->get('subscribeServices');
            $subscribeServices->forNewletter($dataObj,$restResponse);
            
            $msg = Message::Success("Email Notification successfully send.");
            $restResponse->addMessages($msg);
            $restResponse->setData($dataObj);
            $restResponse->setMessage("You have successfully subcribed for our newsletters.");
            $restResponse->setStatus(TRUE);
        } else {
            //header('HTTP/1.0 404 Not Found');
            //$app->notFound();
            $restResponse->setMessage("System error occurred while processing your request");
            $restResponse->setStatus(FALSE);
        }
    } catch (Exception $ex) {
        //header('HTTP/1.0 500 Internal Server Error');
        $logger->error("System error occurred while processing your request " . $ex->getTraceAsString());
        $msg = Message::Error("System error occurred while processing your request." .$ex->getTraceAsString());
        $restResponse->addMessages($msg);
        $restResponse->setMessage("System error occurred while processing your request");
        $restResponse->setStatus(FALSE);
    }
    
    $response->getBody()->write(json_encode($restResponse));
    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
});


/**
 *
 * 
 * 
 */
$container->set('collaborationServices', function () {
    $settings = [];
    return new SubscribeServices();
});
$collaborationArgs = array('param' => "collaborationServices");
$app->post('/collaboration', function (Request $request, Response $response, $collaborationArgs) {
    
    $logger = Logger::getLogger('ResourceController');
    $param = $collaborationArgs['param'] ?? "bookingServices";
    $restResponse = new RestResponse();
    try {
        
        $jsonObj = $request->getBody();
        $logger->info('body type -- '. gettype($jsonObj));
        $logger->info('json-object -- '. $jsonObj);

        $dataStr = "$jsonObj";
        $logger->info('$dataStr -- '. $dataStr);
        if (!is_null($dataStr) && isset($dataStr)) {
            
            $dataObj = json_decode($dataStr);
            $collaborationServices = $this->get('collaborationServices');
            $collaborationServices->forCollaboration($dataObj,$restResponse);
            
            $msg = Message::Success("Email Notification successfully send.");
            $restResponse->addMessages($msg);
            $restResponse->setData($dataObj);
            $restResponse->setMessage("Your collobration request shared for review.");
            $restResponse->setStatus(TRUE);
        } else {
            //header('HTTP/1.0 404 Not Found');
            //$app->notFound();
            $restResponse->setMessage("System error occurred while processing your request");
            $restResponse->setStatus(FALSE);
        }
    } catch (Exception $ex) {
        //header('HTTP/1.0 500 Internal Server Error');
        $logger->error("System error occurred while processing your request " . $ex->getTraceAsString());
        $msg = Message::Error("System error occurred while processing your request." .$ex->getTraceAsString());
        $restResponse->addMessages($msg);
        $restResponse->setMessage("System error occurred while processing your request");
        $restResponse->setStatus(FALSE);
    }
    
    $response->getBody()->write(json_encode($restResponse));
    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
});


/**
 *
 * 
 * 
 */
$container->set('bookingServices', function () {
    $settings = [];
    return new SubscribeServices();
});
$bookingArgs = array('param' => "bookingServices");
$app->post('/photo-session', function (Request $request, Response $response, $bookingArgs) {
    
    $logger = Logger::getLogger('ResourceController');
    $param = $bookingArgs['param'] ?? "bookingServices";
    
    $restResponse = new RestResponse();
    try {
        
        $jsonObj = $request->getBody();
        $logger->info('body type -- '. gettype($jsonObj));
        $logger->info('json-object -- '. $jsonObj);

        $dataStr = "$jsonObj";
        $logger->info('$dataStr -- '. $dataStr);
        if (!is_null($dataStr) && isset($dataStr)) {
            
            $dataObj = json_decode($dataStr);
            $collaborationServices = $this->get('bookingServices');
            $collaborationServices->forCollaboration($dataObj,$restResponse);
            
            $msg = Message::Success("Email Notification successfully send.");
            $restResponse->addMessages($msg);
            $restResponse->setData($dataObj);
            $restResponse->setMessage("Your collobration request shared for review.");
            $restResponse->setStatus(TRUE);
        } else {
            //header('HTTP/1.0 404 Not Found');
            //$app->notFound();
            $restResponse->setMessage("System error occurred while processing your request");
            $restResponse->setStatus(FALSE);
        }
    } catch (Exception $ex) {
        //header('HTTP/1.0 500 Internal Server Error');
        $logger->error("System error occurred while processing your request " . $ex->getTraceAsString());
        $msg = Message::Error("System error occurred while processing your request." .$ex->getTraceAsString());
        $restResponse->addMessages($msg);
        $restResponse->setMessage("System error occurred while processing your request");
        $restResponse->setStatus(FALSE);
    }
    
    $response->getBody()->write(json_encode($restResponse));
    return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
});



/**
 *
 * // Run app
 * 
 */
$app->run();