<?php
namespace Isign\Tests\Login;

use Isign\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /** @var Isign\QueryInterface */
    private $methodStub;

    /** @var Isign\Http\ClientInterface */
    private $clientStub;

    /** @var Isign\ResponseMapperInterface */
    private $responseMapperStub;

    /** @var Symfony\Component\Validator\Validator */
    private $validatorStub;

    /** @var Client */
    private $client;

    public function setUp()
    {
        $this->methodStub = $this->getMockBuilder('Isign\QueryInterface')
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


        $this->clientStub = $this->getMockBuilder('Isign\Http\ClientInterface')
            ->setMethods(['sendRequest'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->responseMapperStub = $this->getMockBuilder('Isign\ResponseMapperInterface')
            ->setMethods(['map'])
            ->disableOriginalConstructor()
            ->getMock();

        $this->validatorStub = $this->getMockBuilder('Symfony\Component\Validator\Validator\RecursiveValidator')
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
        $this->assertInstanceOf('Isign\Client', $client);
        $this->assertTrue($client->isSandbox());
    }

    public function testFactoryCreateWithLogger()
    {
        $logger = $this->getMockBuilder('Psr\Log\LoggerInterface')
            ->getMock()
        ;
        $client = Client::create(
            ['sandbox' => true, 'apiKey' => 'xxx'],
            $logger
        );
        $this->assertInstanceOf('Isign\Client', $client);
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
        $this->assertSame('https://api2.isign.io', $client->getUrl());
        $this->assertSame('https://developers.isign.io', $client->getSandboxUrl());
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

    /**
     * @expectedException Isign\Exception\InvalidApiKey
     */
    public function testApiKeyRequired()
    {
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
            'https://api2.isign.io/login.json',
            $client->getFullMethodUrl('login')
        );
    }

    public function testGetFullMethodUrlForSandbox()
    {
        $this->assertEquals(
            'https://developers.isign.io/login.json',
            $this->client->getFullMethodUrl('login')
        );
    }

    public function testGetFullMethodWithToken()
    {
        $this->assertEquals(
            'https://developers.isign.io/login/status/secrectToken.json',
            $this->client->getFullMethodUrl('login/status', 'secrectToken')
        );
    }

    public function testGetTokenFromDefaultQuery()
    {
        $query = $this->getMockBuilder('Isign\QueryInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertEquals('', $this->client->getToken($query));
    }

    public function testGetTokenFromTokenizedQuery()
    {
        $query = $this->getMockBuilder('Isign\TokenizedQueryInterface')
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
                $this->getMockBuilder('Isign\ResultInterface')
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

        $this->validatorStub
            ->expects($this->once())
            ->method('validate')
            ->willReturn([])
        ;

        $this->client->get($this->methodStub);
    }

    /**
     * @expectedException Isign\Exception\QueryValidator
     * @expectedExceptionMessage Query parameters validation failed
     */
    public function testGetValidationFailed()
    {
        $violations = $this->getMockBuilder('Symfony\Component\Validator\ConstraintViolationList')
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
