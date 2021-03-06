<?php declare(strict_types=1);
namespace Ridibooks\OAuth2\Grant\DataTransferObject;

class Token
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var int
     */
    private $expires_in;

    /**
     * Token constructor.
     * @param string $token
     * @param int $expires_in
     */
    public function __construct(string $token, int $expires_in)
    {
        $this->token = $token;
        $this->expires_in = $expires_in;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expires_in;
    }
}
