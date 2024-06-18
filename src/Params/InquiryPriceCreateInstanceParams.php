<?php

namespace BigbugGg\Zenlayer\Params;

/**
 * 查询创建虚拟机费用
 * @todo 非必要功能，后面再完善
 */
class InquiryPriceCreateInstanceParams extends Base
{
    /** @var string 区域ID编码 */
    public string $zoneId;

    /** @var string 实例类型（目标配置短字符串） */
    public string $instanceType;

    /** @var string 镜像ID  */
    public string $imageId;

    /** @var string 实例定价模型 PREPAID, POSTPAID  */
    public string $instanceChargeType;

    /** @var string 互联网收费类型 ByBandwidth\ByTrafficPackage\ByClusterBandwidth95\BandwidthCluster */
    public string $internetChargeType;

    /** @var string[] 预付时间，单位 月, 方式赋值 value['period'] =  1 */
    public array $instanceChargePrepaid;

    /**
     * @var string|null 流量包大小（TB）
     *
     * internetChargeType = ByTrafficPackage 该值才有效
     */
    public ?string $trafficPackageSize;

    /** @var int|null 公网带宽上限 (Mbps) */
    public ?int $internetMaxBandwidthOut;

    /** @var array|null 系统盘 */
    public ?array $systemDisk;

    /** @var string[]|null 数据盘 */
    public ?array $dataDisks;
}