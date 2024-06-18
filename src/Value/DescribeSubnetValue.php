<?php

namespace BigbugGg\Zenlayer\Value;

class DescribeSubnetValue
{
    /** @var string 子网ID */
    public string $subnetId;

    /** @var string[] 已有列表[实列ID,..]} */
    public array $instanceIdList;

    /** @var string 总IP数 */
    public int $totalIpCount;

    /** @var string 创建时间 世界协调时间*/
    public string $createTime;

    /** @var string  */
    public string $cidrBlock;

    /** @var string[]  */
    public array $cidrBlockList;
    /** @var string  */
    public string $zoneId;

    /** @var string 状态
     * Creating
     * Available
     * Failed
     */
    public string $subnetStatus;

    /** @var string 子网描述 */
    public string $subnetDescription;

    /** @var string 已使用IP数量 */
    public string $usageIpCount;

    /** @var string 子网名称 */
    public string $subnetName;

    /** @var string 是否为默认网络  */
    public string $isDefault;
}