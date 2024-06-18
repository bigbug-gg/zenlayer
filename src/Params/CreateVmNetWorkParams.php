<?php

namespace BigbugGg\Zenlayer\Params;

/**
 * 创建子网入参
 */
class CreateVmNetWorkParams extends Base
{
    /** @var string 子网的 CIDR 块 10.0.0.0/24, 172.16.0.0/24, 192.168.0.0/24 及其子集 */
    public string $cidrBlock = '10.0.0.0/16';

    /** @var string|null 子网名称, 参数必须以数字或字母开头和结尾 2-63个字符*/
    public ?string $subnetName = null;

    /** @var string 子网的区域 ID */
    public string $zoneId;

    /** @var string|null 子网描述 */
    public ?string $subnetDescription;

    public function toArray(): array
    {
        $data = parent::toArray();
        if (!is_null($this->subnetName)) {
            return $data;
        }
        // 没有设置子网名称时 生成默认名称
        $data['subnetName'] = 'Network-' . $this->zoneId.'-default';
        return $data;
    }
}