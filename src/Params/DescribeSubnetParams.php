<?php

namespace BigbugGg\Zenlayer\Params;

/**
 * 查询子网可用的入参
 */
class DescribeSubnetParams extends Base
{
    /** @var string[]|null 子网 ID */
    public ?array $subnetIds;

    /** @var string|null 子网的 CIDR 块 */
    public ?string $cidrBlock;

    /** @var string|null 子网所属的区域ID */
    public ?string $zoneId;

    /** @var string|null 子网状态 Creating、vailable、Failed */
    public ?string $subnetStatus;

    /** @var string|null 子网名称 */
    public ?string $subnetName;

    /** @var int|null  */
    public ?int $pageSize;
    /** @var int|null  */
    public ?int $pageNum;
}