<?php

namespace BigbugGg\Zenlayer;


use BigbugGg\Zenlayer\Params\CreateInstanceParams;
use BigbugGg\Zenlayer\Params\DescribeInstancesParams;
use BigbugGg\Zenlayer\Params\ImageParams;
use BigbugGg\Zenlayer\Params\ResetInstanceParams;
use BigbugGg\Zenlayer\Value\CreateInstanceValue;
use BigbugGg\Zenlayer\Value\DescribeImagesValue;
use BigbugGg\Zenlayer\Value\DescribeInstancesValue;
use BigbugGg\Zenlayer\Value\InstanceStatusValue;
use BigbugGg\Zenlayer\Value\ZoneInstanceConfigInfoValue;
use BigbugGg\Zenlayer\Value\ZoneValue;
use ReflectionClass;

/**
 * Zenlayer Instance
 *
 * About instance
 *
 * Doc link
 * @link https://docs.console.zenlayer.com/api-reference/vm/instance
 */
class Instance extends Fetch
{
    /**
     * describer zones
     *
     * Doc link
     * @link https://docs.console.zenlayer.com/api-reference/vm/common-info/describezones
     * @param array $zoneIds
     * @return ZoneValue[]
     * @throws \JsonException
     */
    public function describeZones(array $zoneIds = []): array
    {
        $parameter = [];
        if (count($zoneIds) > 0) {
            $parameter['zoneIds'] = $zoneIds;
        }
        $data = $this->fetch('DescribeZones', $parameter);
        $data = $data['zoneSet'] ?? [];
        /** @var ZoneValue[] $returnArr */
        $returnArr = [];
        foreach ($data as $item) {
            $value = new ZoneValue();
            $value->zoneId = $item['zoneId'] ?? '';
            $value->zoneName = $item['zoneName'] ?? '';
            $returnArr[] = $value;
        }
        return $returnArr;
    }

    /**
     * DescribeZoneInstanceConfigInfos
     *
     * @param bool $isPrepaid true:PREPAID false:POSTPAID,default false
     * @param string $zoneId Zone ID.
     * @param string $instanceType Instance model.
     * @return ZoneInstanceConfigInfoValue[]
     * @throws \JsonException
     */
    public function describeZoneInstanceConfigInfos(bool $isPrepaid = false, string $zoneId = '', string $instanceType = ''): array
    {
        $parameter = [
            'instanceChargeType' => $isPrepaid ? 'PREPAID' : 'POSTPAID',
        ];
        if (!empty($zoneId)) {
            $parameter['zoneId'] = $zoneId;
        }
        if (!empty($instanceType)) {
            $parameter['instanceType'] = $instanceType;
        }
        $data = $this->fetch('DescribeZoneInstanceConfigInfos', $parameter);

        $data = $data['instanceTypeQuotaSet'] ?? [];
        /** @var ZoneInstanceConfigInfoValue[] $returnArr */
        $returnArr = [];
        foreach ($data as $item) {
            $value = new ZoneInstanceConfigInfoValue();
            $value->zoneId = $item['zoneId'] ?? '';
            $value->instanceType = $item['instanceType'] ?? '';
            $value->instanceTypeName = $item['instanceTypeName'] ?? '';
            $value->cpuCount = $item['cpuCount'] ?? 0;
            $value->memory = $item['memory'] ?? 0;
            $value->internetMaxBandwidthOutLimit = $item['internetMaxBandwidthOutLimit'] ?? 0;
            $returnArr[] = $value;
        }
        return $returnArr;
    }

    /**
     * InquiryPriceCreateInstanceParams
     *
     * Doc link
     * @link https://docs.console.zenlayer.com/api-reference/vm/instance/inquirypricecreateinstance
     * @param InquiryPriceCreateInstanceParams $params
     * @return ZoneInstanceConfigInfoValue[]
     */
    public function inquiryPriceCreateInstance(InquiryPriceCreateInstanceParams $params): array
    {
        // TODO Non essential functions, to be further improved later
        return [];
    }

    /**
     * DescribeImages
     *
     * Doc link
     * @link https://docs.console.zenlayer.com/api-reference/vm/image/describeimages
     *
     * @param ImageParams $params
     * @return DescribeImagesValue[]
     * @throws \JsonException
     */
    public function describeImages(ImageParams $params): array
    {
        $parameter = $params->toArray();
        $data = $this->fetch('DescribeImages', $parameter);
        $data = $data['dataSet'] ?? [];

        /** @var DescribeImagesValue[] $returnArr */
        $returnArr = [];
        foreach ($data as $item) {
            $value = new DescribeImagesValue();
            $value->imageVersion = $item['imageVersion'] ?? '';
            $value->imageId = $item['imageId'] ?? '';
            $value->imageName = $item['imageName'] ?? '';
            $value->osType = $item['osType'] ?? '';
            $value->imageSize = $item['imageSize'] ?? '';
            $value->imageStatus = $item['imageStatus'] ?? '';
            $value->category = $item['category'] ?? '';
            $value->imageType = $item['imageType'] ?? '';
            $returnArr[] = $value;
        }
        return $returnArr;
    }

    /**
     * CreateInstances
     *
     * Doc link
     * @link https://docs.console.zenlayer.com/api-reference/vm/instance/createinstances
     *
     * @param CreateInstanceParams $params
     * @return CreateInstanceValue
     * @throws \JsonException
     */
    public function createInstances(CreateInstanceParams $params): CreateInstanceValue
    {
        $parameter = $params->toArray();
        $data = $this->fetch('CreateInstances', $parameter);

        $value = new CreateInstanceValue();
        $value->instanceIdSet = $data['instanceIdSet'] ?? [];
        $value->orderNumber = $data['orderNumber'] ?? '';
        return $value;
    }

    /**
     * DescribeInstances
     *
     * Doc link
     * @link https://docs.console.zenlayer.com/api-reference/vm/instance/describeinstances
     * @param DescribeInstancesParams $params
     * @return DescribeInstancesValue[]
     * @throws \JsonException
     */
    public function describeInstances(DescribeInstancesParams $params): array
    {
        $parameter = $params->toArray();
        $data = $this->fetch('DescribeInstances', $parameter);

        $data = $data['dataSet'] ?? [];
        $value = new DescribeInstancesValue();
        return self::fillValue($data, $value);
    }

    /**
     * StopInstances
     *
     * Doc link
     * @link https://docs.console.zenlayer.com/api-reference/vm/instance/stopinstances
     * @param string[] $instanceIds
     * @throws \JsonException
     */
    public function stopInstances(array $instanceIds): bool
    {
        $this->fetch('StopInstances', ['instanceIds' => $instanceIds]);
        return true;
    }


    /**
     * ResetInstance
     *
     * Doc link
     * @link https://docs.console.zenlayer.com/api-reference/vm/instance/resetinstance
     * @param ResetInstanceParams $parameter
     * @return bool
     * @throws \JsonException
     */
    public function resetInstance(ResetInstanceParams $parameter): bool
    {
        $parameter = $parameter->toArray();
        $this->fetch('ResetInstance', $parameter);
        return true;
    }

    /**
     * StartInstances
     *
     * Doc link
     * @link https://docs.console.zenlayer.com/api-reference/vm/instance/startinstances
     * @param string[] $instanceIds
     * @throws \JsonException
     */
    public function startInstances(array $instanceIds): bool
    {
        $this->fetch('StartInstances', ['instanceIds' => $instanceIds]);
        return true;
    }

    /**
     * DescribeInstancesStatus
     *
     * Doc link
     * @link https://docs.console.zenlayer.com/api-reference/vm/instance/describeinstancesstatus
     * @param string[] $instanceIds
     * @param int $pageSize
     * @param int $pageNum
     * @return InstanceStatusValue[]
     * @throws \JsonException
     */
    public function describeInstancesStatus(array $instanceIds = [], int $pageSize = 20, int $pageNum = 1): array
    {
        $parameter = [
            'pageSize' => $pageSize,
            'pageNum' => $pageNum,
        ];

        if (count($instanceIds) > 0) {
            $parameter['instanceIds'] = $instanceIds;
        }

        $data = $this->fetch('DescribeInstancesStatus', $parameter);
        $data = $data['dataSet'] ?? [];
        /** @var InstanceStatusValue[] $returnArr */
        $returnArr = [];
        foreach ($data as $item) {
            $value = new InstanceStatusValue();
            $value->instanceId = $item['instanceId'] ?? '';
            $value->instanceStatus = $item['instanceStatus'] ?? '';
            $returnArr[] = $value;
        }
        return $returnArr;
    }

    /**
     * TerminateInstance
     *
     * Doc link
     * @link https://docs.console.zenlayer.com/api-reference/vm/instance/terminateinstance
     * @param string $instanceId
     * @return bool
     * @throws \JsonException
     */
    public function terminateInstance(string $instanceId): bool
    {
        $data = $this->fetch('TerminateInstance', [
            'instanceId' => $instanceId,
        ]);
        return true;
    }

    /**
     * ModifyInstancesAttribute
     * Doc link
     * @link  https://docs.console.zenlayer.com/api-reference/vm/instance/modifyinstancesattribute
     * @param array $instanceIds
     * @param string $instanceName This parameter can contain up to 64 characters.
     * Only letters, numbers, - and periods (.) are supported.
     * @return bool
     * @throws \JsonException
     */
    public function modifyInstancesAttribute(array $instanceIds, string $instanceName): bool
    {
        $_data = $this->fetch('ModifyInstancesAttribute', [
            'instanceIds' => $instanceIds,
            'instanceName' => $instanceName,
        ]);
        return true;
    }

    /**
     * fillValue
     *
     * Fills return data.
     * @param array $data
     * @param $obj
     * @return array it will return $obj[]
     */
    private static function fillValue(array $data, $obj): array
    {
        $reflectionObj = new ReflectionClass($obj);
        $properties = $reflectionObj->getProperties();
        $returnArr = [];
        foreach ($data as $items) {
            $_obj = clone $obj;
            foreach ($properties as $property) {
                $_key = $property->getName();
                $v = $items[$_key] ?? null;

                // No data no fill.
                if (is_null($v)) {
                    continue;
                }
                $_obj->{$_key} = $v;
            }
            $returnArr[] = $_obj;
        }
        unset($properties);
        return $returnArr;
    }

}
