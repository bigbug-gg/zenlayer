<?php

namespace BigbugGg\Zenlayer\Params;

class ResetInstanceParams extends Base
{
    /** @var string 实例ID */
    public string $instanceId;

    /** @var string|null 镜像ID */
    public ?string $imageId;

    /** @var string|null 密码 (和 keyId 二选一） */
    public ?string $password;

    /** @var string|null SSH key Id (和 password 二选一） */
    public ?string $keyId;

}