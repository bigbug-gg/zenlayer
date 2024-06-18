<?php

namespace BigbugGg\Zenlayer\Value;

/**
 * 实例详细信息
 */
class DescribeInstancesValue
{
    /** @var string 实例ID  */
    public string $instanceId;

    /** @var string 区域ID字符串  */
     public string $zoneId;

     /** @var string  实例名称 */
     public string $instanceName;

     /** @var string 实例配置类型字符串  */
     public string $instanceType;

     /** @var bool 自动付费 */
     public bool $autoRenew;

     /** @var int cup核心数量   */
     public string $cpuCount;

     /** @var int 内存 */
     public string $memory;

     /** @var string 镜像ID字符串  */
     public string $imageId;

     /** @var string 镜像名称 */
     public string $imageName;

     /** @var string 实体付费类型 */
     public string $instanceChargeType;

     /** @var string 公网带宽 */
     public string $internetMaxBandwidthOut;

     /** @var string 公网支付类型 */
     public string $internetChargeType;

     /** @var string  */
     public string $period;

     /** @var string|array 公网 */
     public string|array $publicIpAddresses;

     /** @var string|array 私网 */
     public string|array $privateIpAddresses;

     /** @var string 子网 */
     public string $subnetId;

     /** @var string 创建时间 */
     public string $createTime;

     /** @var string 过期时间 */
     public string $expiredTime;

     /** @var string 资源组  */
     public string $resourceGroupId;

     /** @var string 资源组名称 */
     public string $resourceGroupName;

     /** @var string 实例状态 */
     public string $instanceStatus;

     /** @var array  安装全组 */
     public array $securityGroupIds;

     /** @var array 系统磁盘 */
     public array $systemDisk;
 }