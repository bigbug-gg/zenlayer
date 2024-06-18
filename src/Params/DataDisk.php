<?php

namespace BigbugGg\Zenlayer\Params;

class DataDisk
{
    /** @var string  数据盘ID */
    public string $diskId;

    /** @var string 数据盘大小。单位：GiB。 */
    public string $diskSize;

    /** @var string 数据盘名称 */
    public string $diskName;

    /** @var string 磁盘类型 */
    public string $diskCategory;

    /**
     * @var string 数据盘是否可拆卸
     * true ：数据盘是可拆卸的 因此在删除其附加实例时不会被删除。
     * false ：数据盘不可拆卸 因此在删除其附加实例时会同时删除
     */
    public string $portable;

    /** @var string 数据盘数量  */
    public string $diskAmount;

    /** @var string 数据盘价格  */
    public string $diskPrice;
}