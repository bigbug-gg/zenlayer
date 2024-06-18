<?php

namespace BigbugGg\Zenlayer\Value;

/**
 * Details of images
 */
class DescribeImagesValue
{
    /** @var string 镜像版本 */
    public string $imageVersion;

    /** @var string 镜像ID */
    public string $imageId;

    /** @var string 镜像名称 */
    public string $imageName;

    /** @var string|null 描述 */
    public ?string $imageDescription;

    /** @var string 系统类型 */
    public string $osType;

    /** @var string 镜像大小(GB) */
    public string $imageSize;

    /** @var string 镜像状态 */
    public string $imageStatus;

    /** @var string 镜像类目 CentOS, Windows, Ubuntu, Debian */
    public string $category;

    /** @var string 镜像类型 PUBLIC_IMAGE: the default images. CUSTOM_IMAGE: the newly  */
    public string $imageType;
}