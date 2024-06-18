<?php

namespace BigbugGg\Zenlayer\Params;

/**
 *
 */
class ImageParams extends Base
{
    /** @var string[]|null  */
    public ?array $imageIds;

    /** @var string|null Image name */
    public ?string $imageName;

    /** @var string  */
    public string $zoneId;

    /** @var string|null Image category: CentOS\Windows\Ubuntu\ Debian  */
    public ?string $category;

    /** @var string|null  Image type.
     *   PUBLIC_IMAGE: the default images.
     *   CUSTOM_IMAGE: the newly created images by yourself
     */
    public ?string $imageType;

    /**
     * @var string|null Operating system type: Windows  or Linux
     */
    public ?string $osType;

    /**
     * @var string|null Image status
     * CREATING: creating.
     * AVAILABLE: able to use.
     * UNAVAILABLE: unable to use
     */
    public ?string $imageStatus;

    /** @var string|null  */
    public ?string $pageNum;

    /** @var string|null */
    public ?string $pageSize;

}