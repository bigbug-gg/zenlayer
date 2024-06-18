<?php

namespace BigbugGg\Zenlayer\Value;

/**
 * 区域实例配置信息
 */
class ZoneInstanceConfigInfoValue
{
    /** @var string 地区ID编码 */
    public string $zoneId;

    /** @var string 实例类型 */
    public string $instanceType;

    /** @var string 实例名称 */
    public string $instanceTypeName;

    /** @var int CUP 核心 */
    public int $cpuCount;

    /** @var int 内存 */
    public int $memory;

    /** @var int 带宽上限 */
    public int $internetMaxBandwidthOutLimit;

}
