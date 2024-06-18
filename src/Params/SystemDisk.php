<?php

namespace BigbugGg\Zenlayer\Params;

class SystemDisk
{
    /** @var string  数据盘ID */
    public string $diskId;

    /** @var string 数据盘大小。单位：GiB。 */
    public string $diskSize;

    /**
     * @var string 磁盘类型
     *
     * Standard Disk: Hard Disk Drive(机械硬盘) 默认
     * SSD: Solid State Drive SSD
     */
    public string $diskCategory;

}