<?php

namespace BigbugGg\Zenlayer\Sign;

/**
 * Response
 */
class HttpResponse
{
    protected ?string $requestId;

    protected bool $requestOk = false;

    protected array $response = [];

    public function __construct(array $response = [])
    {
        $this->response = $response;
        $this->requestId = $response['requestId'] ?? null;

        // 成功情况下，响应里面会包含一个 'response' 字段，没有则没成功
        $this->requestOk = array_key_exists('response', $response);

    }

    /**
     * 成功获取到数据
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->requestOk;
    }

    /**
     * 获取所有响应数据
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }

    public function errorMessage(): string
    {
        if ($this->requestOk) {
            return "";
        }

        return $this->response['message'] ?? '调用服务失败';
    }

}