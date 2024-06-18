<?php

namespace BigbugGg\Zenlayer\Params;

/**
 * 创建实例
 */
class CreateInstanceParams extends Base
{
    /** @var string 区域ID编码 */
    public string $zoneId;

    /** @var string 实例定价模型 PREPAID, POSTPAID  */
    public string $instanceChargeType;

    /** @var string[] 预付时间，单位 月, 方式赋值 value['period'] =  1 */
    public array $instanceChargePrepaid;

    /** @var string 实例类型（目标配置短字符串） */
    public string $instanceType;

    /** @var string 镜像ID  */
    public string $imageId;

    /** string|null 实例所在资源组ID */
    public ?string $resourceGroupId;

    /** @var string|null 实列名，默认 实例名称 */
    public ?string $instanceName;

    /** @var int 购买数量 */
    public int $instanceCount = 1;

    /** @var string|null 参数必须为8-16个字符 小写字母+大写字母+数字+特殊字符,password 和 keyId 二选一 */
    public ?string $password;

    /** @var string|null SSH密钥ID, password 和 keyId 二选一*/
    public ?string $keyId;

    /** @var string 互联网收费类型 ByBandwidth\ByTrafficPackage\ByClusterBandwidth95\BandwidthCluster */
    public string $internetChargeType = 'ByBandwidth';

    /** @var int|null 公网带宽上限 (Mbps)， 默认 1MB */
    public ?int $internetMaxBandwidthOut = 1;

    /**
     * @var string|null 流量包大小（TB）
     *
     * internetChargeType = ByTrafficPackage 该值才有效
     */
    public ?string $trafficPackageSize;

    /** @var string 子网ID */
    public string $subnetId;

    /** @var array|null 系统盘 */
    public ?array $systemDisk;

    /** @var string[]|null 数据盘 */
    public ?array $dataDisks;

    /**
     * @var string|null  安全组ID
     *
     * 要获取安全组ID，可以调用DescribeSecurityGroups，并在响应中找到 sgId
     */
    public ?string $securityGroupId;
}