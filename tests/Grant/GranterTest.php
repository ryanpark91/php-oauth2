<?php
declare(strict_types=1);

namespace Ridibooks\Test\OAuth2\Grant;

use PHPUnit\Framework\TestCase;
use Ridibooks\OAuth2\Constant\ScopeConstant;
use Ridibooks\OAuth2\Grant\DataTransferObject\AuthorizationServerInfo;
use Ridibooks\OAuth2\Grant\DataTransferObject\ClientInfo;
use Ridibooks\OAuth2\Grant\Granter;
use Ridibooks\Test\OAuth2\Common\StringUtil;

final class GranterTest extends TestCase
{
    private $client_id = 'iax7OcCuYJ8Su5p9swjs7RNosL7zYZ4zdV5xyHVx';
    private $client_secret = 'vk31iDFzVM1EKQySvkp46TUNjWn9Bvc1wv7CLSwEWzAUDz5GA3iN0QjGktVXi53KCHxIcfq3V62q9aSQkWzB1zx8Um6OWYO4nEqtJYj4uPHnhjDKW7tV4zGeW9yygvZx';
    private $redirect_uri = 'https://fake.com/receive';

    private $authorization_url = 'https://account.ridibooks.com/oauth2/authorize/';
    private $token_url = 'https://account.ridibooks.com/oauth2/token/';

    public function testCanGenerateAuthorizationUrl()
    {
        $client_info = new ClientInfo($this->client_id, $this->client_secret, [ScopeConstant::ALL], $this->redirect_uri);
        $auth_server_info = new AuthorizationServerInfo($this->authorization_url, $this->token_url);
        $state = StringUtil::getRandomString(8);

        $granter = new Granter($client_info, $auth_server_info);
        $authorization_url = $granter->authorize($state);
        $this->assertStringStartsWith($this->authorization_url, $authorization_url);
        $this->assertRegexp('/' . 'client_id=' . $this->client_id . '/', $authorization_url);
        $this->assertRegexp('/' . 'state=' . urlencode($state) . '/', $authorization_url);
        $this->assertRegexp('/' . 'redirect_uri=' . urlencode($this->redirect_uri) . '/', $authorization_url);
        $this->assertRegexp('/' . 'response_type=code' . '/', $authorization_url);
    }
}
