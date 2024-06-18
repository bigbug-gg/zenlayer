<?php

namespace BigbugGg\Zenlayer\Sign;

/**
 * The Zenlayer's  request tools class
 *
 * Doc link
 * @link https://docs.console.zenlayer.com/api-reference/v/cn/vm/common-info/describezones
 */
class HttpRequest
{
    const string ZENLAYRE_API_URL = 'https://console.zenlayer.com/api/v2/vm';

    private string $accessKey;
    private string $secretKey;

    public function __construct(string $accessKey, string $secretKey)
    {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
    }

    /**
     * @param string $action
     * @param array $body
     * @return HttpResponse
     * @throws \JsonException
     */
    public function request(string $action, array $body = []): HttpResponse
    {
        // Default return '[]' when body is empty, need change to '{}'
        $jsonBody = (count($body) <= 0 ) ? "{}": json_encode($body, JSON_THROW_ON_ERROR);

        $headArr = $this->buildHeaders($action);
        $authorizationStr = $this->authorization($headArr, $jsonBody);
        $headArr['Authorization'] = $authorizationStr;
        unset($headArr['Host']);

        $headKeyValueMapArr = [];
        foreach ($headArr as $key => $value) {
            $headKeyValueMapArr[] = "{$key}: {$value}";
        }

        // 使用 cURL 发起请求
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::ZENLAYRE_API_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headKeyValueMapArr);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        return (new HttpResponse($response));
    }
    /**
     * 组装请求头数据
     *
     * @param string $action 对应功能清单名称
     * @return array
     * @link https://docs.console.zenlayer.com/api-reference/v/cn/vm/instance  功能清单
     */
    private function buildHeaders(string $action): array
    {
        return [
            'Authorization' => "",
            'Host' => 'console.zenlayer.com',
            'Content-Type' => 'application/json; charset=utf-8',
            'X-ZC-Action' => $action,
            'X-ZC-Timestamp' => (string)time(),
            'X-ZC-Signature-Method' => 'ZC2-HMAC-SHA256',
            'X-ZC-Version' => '2022-11-20'
        ];
    }

    /**
     * 认证字符串
     *
     * @param array $headArr 参与签名的头部信息
     * @param string $bodyJson
     * @return string
     * @throws \JsonException
     */
    private function authorization(array $headArr, string $bodyJson): string
    {
        $needJoinKey = ['Content-Type', 'Host'];
        $signedHeadersStr = $this->signedHeaders($needJoinKey);
        $signatureStr = $this->signature($headArr, $bodyJson, $needJoinKey);
        return "ZC2-HMAC-SHA256 Credential={$this->accessKey}, SignedHeaders={$signedHeadersStr}, Signature={$signatureStr}";
    }

    /**
     * 拼接规范请求串
     *
     * @param string $canonicalHeaders 参与签名的头部信息，可加入自定义的头部参与签名以提高自身请求的唯一性和安全性
     * 拼接规则：头部 key 和 value 统一转成小写，并去掉首尾空格，按照 key:value\n 格式拼接；多个头部，按照头部 key（小写）的 ASCII 升序进行拼接
     * @param string $signedHeaders 说明此次请求有哪些头部参与了签名,
     * 和 CanonicalHeaders 包含的头部内容是一一对应的。
     * content-type 和 host 为必选头部。
     * 拼接规则：头部 key 统一转成小写；多个头部 key（小写）按照 ASCII 升序进行拼接，并且以分号（;）分隔
     * @param string $hashedRequestPayload HTTP 请求正文做 SHA256 哈希，然后十六进制编码
     * @return string
     */
    private function canonicalRequest(string $canonicalHeaders, string $signedHeaders, string $hashedRequestPayload): string
    {
        return implode("\n", [
            "POST",
            "/",
            "",
            $canonicalHeaders,
            $signedHeaders,
            $hashedRequestPayload
        ]);
    }

    /**
     * 基于 AK 和 StringToSign 计算出签名
     *
     * @param array $headArr 请求头数据
     * @param string $bodyJson 请求主体
     * @param array $needJoinKey 需要用于加签的 请求头 key
     * @return string
     * @throws \JsonException
     */
    private function signature(array $headArr, string $bodyJson, array $needJoinKey): string
    {
        $stringToSign = $this->stringToSign($headArr, $bodyJson, $needJoinKey);
        return hash_hmac('sha256', $stringToSign, $this->secretKey);
    }

    /**
     * 拼接待签字符串
     *
     * @param array $headArr 请求头数据
     * @param string $bodyJson 请求主体
     * @param array $needJoinKey 需要用于加签的 请求头 key
     * @return string
     * @throws \JsonException
     */
    private function stringToSign(array $headArr, string $bodyJson, array $needJoinKey): string
    {
        $canonicalHeaders = $this->canonicalHeaders($headArr, $needJoinKey);

        $signedHeaders = $this->signedHeaders($needJoinKey);

        $hashedRequestPayload =  hash('sha256', $bodyJson);

        $canonicalRequest = $this->canonicalRequest($canonicalHeaders, $signedHeaders, $hashedRequestPayload);

        $hashedCanonicalRequest = strtolower(hash('sha256', $canonicalRequest));

        return implode("\n", [
            'ZC2-HMAC-SHA256',
            $headArr['X-ZC-Timestamp'],
            $hashedCanonicalRequest
        ]);
    }

    /**
     * 参与签名的头部信息，可加入自定义的头部参与签名以提高自身请求的唯一性和安全性。
     *
     * 拼接规则：头部 key 和 value 统一转成小写，并去掉首尾空格，按照 key:value\n 格式拼接；多个头部，按照头部 key（小写）的 ASCII 升序进行拼接。
     * @param array $headArr
     * @param string[] $needJoinKey 需要进行加密的头部 key
     * @return string
     */
    private function canonicalHeaders(array $headArr, array $needJoinKey): string
    {
        $result = [];
        foreach ($needJoinKey as $key) {
            $value = $headArr[$key] ?? null;

            if ($value === null) {
                throw new \RuntimeException("Need join key: {$key}");
            }

            $lowercaseKey = strtolower(trim($key));
            $lowercaseValue = strtolower(trim($value));
            $result[$lowercaseKey] = "$lowercaseKey:$lowercaseValue";
        }
        ksort($result);
        return implode("\n", $result)."\n";
    }

    /**
     * 参与签名的头部信息
     *
     * 说明此次请求有哪些头部参与了签名，
     * 和 CanonicalHeaders 包含的头部内容是一一对应的。
     * content-type 和 host 为必选头部。
     * 拼接规则：头部 key 统一转成小写；多个头部 key（小写）按照 ASCII 升序进行拼接，并且以分号（;）分隔。
     * @param array $needJoinKey
     * @return string
     */
    private function signedHeaders(array $needJoinKey): string
    {
        $lowercaseKeys = array_map('strtolower', $needJoinKey);
        sort($lowercaseKeys);
        return implode(';', $lowercaseKeys);
    }
}
