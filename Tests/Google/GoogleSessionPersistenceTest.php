<?php
namespace BIT\GoogleBundle\Tests\Google;

use BIT\GoogleBundle\Google\GoogleSessionPersistence;

class GoogleSessionPersistenceTest extends \PHPUnit_Framework_TestCase
{
    private $googleClient;
    private $session;

    protected function setUp()
    {
        $this->session = $this
            ->getMockBuilder('\Symfony\Component\HttpFoundation\Session\Session')
            ->disableOriginalConstructor()
            ->getMock();

        $this->googleClient = new GoogleSessionPersistence(
            [
                'app_name' => 'test',
                'client_id' => 'test',
                'client_secret' => 'test',
                'callback_url' => 'http://test.com',
                'scopes' => [],
                'state' => 'test',
                'access_type' => 'test',
                'approval_prompt' => 'test,'
            ],
            $this->session
        );
    }

    public function testGetNullAccessToken()
    {
        $this->assertNull($this->googleClient->getAccessToken());
        $this->assertEquals(
            $this->googleClient->getPersistentData('access_token'),
            $this->googleClient->getAccessToken()
        );
    }

    public function testGetAccessTokenFromSession()
    {
        $token = '{"access_token":"TOKEN", "refresh_token":"TOKEN", "token_type":"Bearer", "expires_in":3600, "id_token":"TOKEN", "created":1320790426}';

        $this->session->expects($this->any())->method('has')->will($this->returnValue(true));
        $this->session->expects($this->any())->method('get')->will($this->returnValue($token));

        $this->assertEquals(json_decode($token), json_decode($this->googleClient->getPersistentData('access_token')));
        $this->assertEquals(json_decode($token), json_decode($this->googleClient->getAccessToken()));
    }
}
