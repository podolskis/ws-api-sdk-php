<?php
namespace Dokobit\Tests\Http;

use GuzzleHttp\Exception\ClientException;
use Dokobit\Http\GuzzleClientAdapter;

class GuzzleClientAdapterTest extends \PHPUnit\Framework\TestCase
{
    private $adapter;
    private $client;

    public function setUp()
    {
        $this->client = $this->getMockBuilder('GuzzleHttp\Client')
            ->disableOriginalConstructor()
            ->getMock();

        $this->adapter = new GuzzleClientAdapter($this->client);
    }

    public function testPost()
    {
        $this->client
            ->method('request')
            ->with(
                $this->equalTo('POST'),
                $this->equalTo('https://developers.dokobit.com'),
                []
            )
            ->willReturn(
                $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
                    ->disableOriginalConstructor()
                    ->getMock()
            );

        $response
            ->expects($this->once())
            ->method('getBody')
        ;

        $this->client
            ->expects($this->once())
            ->method('request')
        ;

        $this->adapter->sendRequest('POST', 'https://developers.dokobit.com');
    }

    /**
     * @expectedException Dokobit\Exception\InvalidData
     * @expectedExceptionCode 400
     */
    public function testDataValidationError400()
    {
        $request = $this->getMockBuilder('Psr\Http\Message\RequestInterface')->getMock();
        $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')->getMock();

        $response
            ->method('getStatusCode')
            ->willReturn(400)
        ;
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn('response body')
        ;

        $this->client
            ->method('request')
            ->will(
                $this->throwException(
                    new ClientException(
                        'Error',
                        $request,
                        $response
                    )
                )
            )
        ;

        $this->adapter->sendRequest('POST', 'https://developers.dokobit.com');
    }

    /**
     * @expectedException Dokobit\Exception\InvalidApiKey
     * @expectedExceptionCode 403
     */
    public function testInvalidApiKeyError403()
    {
        $request = $this->getMockBuilder('Psr\Http\Message\RequestInterface')->getMock();
        $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')->getMock();

        $response
            ->method('getStatusCode')
            ->willReturn(403)
        ;
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn('response body')
        ;

        $this->client
            ->method('request')
            ->will(
                $this->throwException(
                    new ClientException(
                        'Error',
                        $request,
                        $response
                    )
                )
            )
        ;

        $this->adapter->sendRequest('POST', 'https://developers.dokobit.com');
    }

    /**
     * @expectedException Dokobit\Exception\ServerError
     * @expectedExceptionCode 500
     */
    public function testServerError500()
    {
        $request = $this->getMockBuilder('Psr\Http\Message\RequestInterface')->getMock();
        $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')->getMock();

        $response
            ->method('getStatusCode')
            ->willReturn(500)
        ;
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn('response body')
        ;

        $this->client
            ->method('request')
            ->will(
                $this->throwException(
                    new ClientException(
                        'Error',
                        $request,
                        $response
                    )
                )
            )
        ;

        $this->adapter->sendRequest('POST', 'https://developers.dokobit.com');
    }

    /**
     * @expectedException Dokobit\Exception\Timeout
     * @expectedExceptionCode 504
     */
    public function testTimeout504()
    {
        $request = $this->getMockBuilder('Psr\Http\Message\RequestInterface')->getMock();
        $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')->getMock();

        $response
            ->method('getStatusCode')
            ->willReturn(504)
        ;
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn('response body')
        ;

        $this->client
            ->method('request')
            ->will(
                $this->throwException(
                    new ClientException(
                        'Error',
                        $request,
                        $response
                    )
                )
            )
        ;

        $this->adapter->sendRequest('POST', 'https://developers.dokobit.com');
    }

    /**
     * @expectedException Dokobit\Exception\UnexpectedResponse
     * @expectedExceptionCode 101
     */
    public function testUnexpectedResponseStatusCode()
    {
        $request = $this->getMockBuilder('Psr\Http\Message\RequestInterface')->getMock();
        $response = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')->getMock();

        $response
            ->method('getStatusCode')
            ->willReturn(101)
        ;
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn('response body')
        ;

        $this->client
            ->method('request')
            ->will(
                $this->throwException(
                    new ClientException(
                        'Error',
                        $request,
                        $response
                    )
                )
            )
        ;

        $this->adapter->sendRequest('POST', 'https://developers.dokobit.com');
    }

    /**
     * @expectedException Dokobit\Exception\UnexpectedError
     */
    public function testUnexpectedError()
    {
        $this->client
            ->method('request')
            ->will(
                $this->throwException(
                    new \Exception()
                )
            )
        ;

        $this->adapter->sendRequest('POST', 'https://developers.dokobit.com');
    }
}
