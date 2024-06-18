<?php

namespace BigbugGg\Zenlayer\Params;

/**
 * 查询详细的实例信息
 *
 * query the details of instances
 */
class DescribeInstancesParams extends Base
{
    /** @var string[]|null 实例ID字符串数组 */
    public ?array $instanceId;

    /** @var string|null 区域ID字符串 */
    public ?string $zoneId;

    /** @var string|null 资源组ID字符串 */
    public ?string $resourceGroupId;

    /** @var string|null 实例配置字符串类型e.g. c2g8 */
    public ?string $instanceType;

    /** @var string|null 网络付费类型字符串 */
    public ?string $internetChargeType;

    /** @var string|null 镜像ID字符串 */
    public ?string $imageId;

    /** @var string|null 子网络ID */
    public ?string $subnetId;

    /** @var string|null 实例状态 */
    public ?string $instanceStatus;

    /** @var string|null 实例名称 */
    public ?string $instanceName;

    /** @var string|null 安全组ID */
    public ?string $securityGroupId;

    /** @var string|null 公共IP地址*/
    public ?string $publicIpAddresses;

    /** @var string|null 私有地址 */
    public ?string $privateIpAddresses;

    /** @var int|null */
    public ?int $pageSize = 1;

    /** @var int|null */
    public ?int $pageNum = 1;
}