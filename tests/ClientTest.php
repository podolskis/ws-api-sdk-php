<?php
namespace Dokobit\Tests;

use Dokobit\Client;
use Dokobit\Exception\InvalidApiKey;
use Dokobit\Exception\QueryValidator;
use Dokobit\Http\ClientInterface;
use Dokobit\QueryInterface;
use Dokobit\ResponseMapperInterface;
use GuzzleHttp\Middleware;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\RecursiveValidator;

class ClientTest extends \PHPUnit\Framework\TestCase
{
    /** @var QueryInterface */
    private $methodStub;

    /** @var ClientInterface */
    private $clientStub;

    /** @var ResponseMapperInterface */
    private $responseMapperStub;

    /** @var RecursiveValidator */
    private $validatorStub;

    /** @var Client */
    private $client;

    public function setUp(): void
    {
        $this->methodStub = $this->getMockBuilder('Dokobit\QueryInterface')
            ->setMethods(['getAction', 'getMethod', 'getFields', 'createResult', 'getValidationConstraints'])
            ->disableOriginalConstructor()
            ->getMock();
        $this->methodStub->method('getAction')
            ->willReturn('login');
        $this->methodStub->method('getMethod')
            ->willReturn('post');
        $this->methodStub->method('getFields')
            ->willReturn(['phone' => '+3706xxxxxxx', 'code' => 'xxxxxxxxxxx'])
        ;


        $this->clientStub = $this->getMockBuilder('Dokobit\Http\ClientInterface')
            ->setMethods(['sendRequest'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMapperStub = $this->getMockBuilder('Dokobit\ResponseMapperInterface')
            ->setMethods(['map'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->validatorStub = $this->getMockBuilder(RecursiveValidator::class)
            ->disableOriginalConstructor()
            // ->setMethods(['validateValue'])
            ->getMock();

        $this->client = new Client(
            $this->clientStub,
            $this->responseMapperStub,
            $this->validatorStub,
            ['apiKey' => 'xxx', 'sandbox' => true]
        );
    }

    public function testFactoryCreate()
    {
        $client = Client::create(['sandbox' => true, 'apiKey' => 'xxx']);
        $this->assertInstanceOf('Dokobit\Client', $client);
        $this->assertTrue($client->isSandbox());
    }

    public function testFactoryCreateWithLogger()
    {
        $monologLogger = $this->getMockBuilder('Monolog\Logger')
            ->disableOriginalConstructor()
            ->getMock();
        $messageFormatter = $this->getMockBuilder('GuzzleHttp\MessageFormatter')
            ->disableOriginalConstructor()
            ->getMock();

        $logger = Middleware::log($monologLogger, $messageFormatter);

        $client = Client::create(
            ['sandbox' => true, 'apiKey' => 'xxx'],
            $logger
        );
        $this->assertInstanceOf('Dokobit\Client', $client);
    }

    public function testDefaultClientConfiguration()
    {
        $client = new Client(
            $this->clientStub,
            $this->responseMapperStub,
            $this->validatorStub,
            ['apiKey' => 'xxx']
        );

        $this->assertSame(false, $client->isSandbox());
        $this->assertSame('https://ws.dokobit.com', $client->getUrl());
        $this->assertSame('https://developers.dokobit.com', $client->getSandboxUrl());
    }

    public function testCustomClientConfiguration()
    {
        $client = new Client(
            $this->clientStub,
            $this->responseMapperStub,
            $this->validatorStub,
            [
                'sandbox' => true,
                'apiKey' => 'l33t',
                'url' => 'https://custom-api.isign.io',
                'sandboxUrl' => 'https://custom-developers.isign.io',
            ]
        );
        $this->assertSame(true, $client->isSandbox());
        $this->assertSame('l33t', $client->getApiKey());
        $this->assertSame('https://custom-api.isign.io', $client->getUrl());
        $this->assertSame('https://custom-developers.isign.io', $client->getSandboxUrl());
    }

    public function testApiKeyRequired()
    {
        $this->expectException(InvalidApiKey::class);
        $client = new Client(
            $this->clientStub,
            $this->responseMapperStub,
            $this->validatorStub
        );
    }

    public function testGetFullMethodUrlForProduction()
    {
        $client = new Client(
            $this->clientStub,
            $this->responseMapperStub,
            $this->validatorStub,
            ['apiKey' => 'xxxxxx']
        );
        $this->assertEquals(
            'https://ws.dokobit.com/mobile/login.json',
            $client->getFullMethodUrl('mobile/login')
        );
    }

    public function testGetFullMethodUrlForSandbox()
    {
        $this->assertEquals(
            'https://developers.dokobit.com/mobile/login.json',
            $this->client->getFullMethodUrl('mobile/login')
        );
    }

    public function testGetFullMethodWithToken()
    {
        $this->assertEquals(
            'https://developers.dokobit.com/mobile/login/status/secrectToken.json',
            $this->client->getFullMethodUrl('mobile/login/status', 'secrectToken')
        );
    }

    public function testGetTokenFromDefaultQuery()
    {
        $query = $this->getMockBuilder('Dokobit\QueryInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertEquals('', $this->client->getToken($query));
    }

    public function testGetTokenFromTokenizedQuery()
    {
        $query = $this->getMockBuilder('Dokobit\TokenizedQueryInterface')
            ->setMethods(['getToken', 'getFields', 'getAction', 'createResult', 'getValidationConstraints', 'getMethod'])
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $query->expects($this->once())
            ->method('getToken')
            ->willReturn('SuperSecretToken')
        ;

        $this->assertEquals('SuperSecretToken', $this->client->getToken($query));
    }

    public function testGet()
    {
        $this->methodStub
            ->expects($this->once())
            ->method('createResult')
            ->willReturn(
                $this->getMockBuilder('Dokobit\ResultInterface')
                    ->disableOriginalConstructor()
                    ->getMock()
            )
        ;
        $this->methodStub
            ->expects($this->once())
            ->method('getMethod')
        ;
        $this->methodStub
            ->expects($this->once())
            ->method('getAction')
        ;
        $this->methodStub
            ->expects($this->once())
            ->method('getValidationConstraints')
        ;

        $this->responseMapperStub
            ->expects($this->once())
            ->method('map')
        ;

        $this->clientStub
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturn([])
        ;

        $violations = $this->getMockBuilder(ConstraintViolationList::class)
            ->disableOriginalConstructor()
            ->getMock();
        $violations
            ->method('count')
            ->willReturn(0);

        $this->validatorStub
            ->expects($this->once())
            ->method('validate')
            ->willReturn($violations)
        ;

        $this->client->get($this->methodStub);
    }

    public function testGetValidationFailed()
    {
        $this->expectExceptionMessage("Query parameters validation failed");
        $this->expectException(QueryValidator::class);
        $violations = $this->getMockBuilder(ConstraintViolationList::class)
            ->disableOriginalConstructor()
            ->getMock();
        $violations
            ->method('count')
            ->willReturn(1)
        ;

        $this->validatorStub
            ->expects($this->once())
            ->method('validate')
            ->willReturn($violations)
        ;

        $this->client->get($this->methodStub);
    }
}
