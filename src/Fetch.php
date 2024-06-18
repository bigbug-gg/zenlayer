<?php

namespace BigbugGg\Zenlayer;

use BigbugGg\Zenlayer\Sign\HttpRequest;

/**
 * 获取数据
 * Fetch Data
 */
abstract class Fetch
{
    protected HttpRequest $httpRequest;
    public function __construct(string $accessId, string $accessPassword)
    {
        $this->httpRequest =  (new HttpRequest($accessId, $accessPassword));
    }



    /**
     * Fetch Data
     *
     * It will throw an exception when there is an error message
     * @param string $operateName
     * @param array $parameter
     * @return array
     * @throws \JsonException
     */
    protected function fetch(string $operateName, array $parameter): array
    {
        $responseObj = $this->httpRequest->request($operateName, $parameter);
        if (!$responseObj->isSuccess()) {
            throw new \RuntimeException($responseObj->errorMessage());
        }
        $resultArr = $responseObj->getResponse();
        unset($responseObj);
        return $resultArr['response'] ?? [];
    }
}