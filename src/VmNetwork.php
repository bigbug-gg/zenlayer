<?php

namespace BigbugGg\Zenlayer;

use BigbugGg\Zenlayer\Params\CreateVmNetWorkParams;
use BigbugGg\Zenlayer\Params\DescribeSubnetParams;
use BigbugGg\Zenlayer\Value\DescribeSubnetValue;

/**
 * Classic Network
 *
 * About network
 */
class VmNetwork extends Fetch
{
    /**
     * describe subnets
     *
     * Doc link
     * @link https://docs.console.zenlayer.com/api-reference/vm/network/describesubnets
     *
     * @param DescribeSubnetParams $params
     * @return DescribeSubnetValue[]
     * @throws \JsonException
     */
    public function describeSubnets(DescribeSubnetParams $params): array
    {
        $parameter = $params->toArray();
        $data = $this->fetch('DescribeSubnets', $parameter);
        $data = $data['dataSet'] ?? [];
        /** @var DescribeSubnetValue[] $returnArr */
        $returnArr = [];
        foreach ($data as $item) {
            $value = new DescribeSubnetValue();
            $value->subnetId = $item['subnetId'] ?? '';
            $value->instanceIdList = $item['instanceIdList'] ?? [];
            $value->totalIpCount = $item['totalIpCount'] ?? '';
            $value->createTime = $item['createTime'] ?? '';
            $value->cidrBlock = $item['cidrBlock'] ?? '';
            $value->cidrBlockList = $item['cidrBlockList'] ?? [];
            $value->zoneId = $item['zoneId'] ?? '';
            $value->subnetStatus = $item['subnetStatus'] ?? '';
            $value->subnetDescription = $item['subnetDescription'] ?? '';
            $value->usageIpCount = $item['usageIpCount'] ?? '';
            $value->subnetName = $item['subnetName'] ?? '';
            $value->isDefault = $item['isDefault'] ?? '';
            $returnArr[] = $value;
        }
        return $returnArr;
    }

    /**
     * create subnet
     *
     * Doc link
     * @link https://docs.console.zenlayer.com/api-reference/vm/network/createsubnet
     * @param CreateVmNetWorkParams $params
     * @return string
     * @throws \JsonException
     */
    public function createSubnet(CreateVmNetWorkParams $params): string
    {
        $parameter = $params->toArray();
        $data = $this->fetch('CreateSubnet', $parameter);
        return $data['subnetId'] ?? '';
    }

    /**
     * Delete subnet
     *
     * Doc line
     * https://docs.console.zenlayer.com/api-reference/vm/network/deletesubnet
     * @param string $subnetId
     * @return bool
     * @throws \JsonException
     */
    public function deleteSubnet(string $subnetId): bool
    {
        $this->fetch('DeleteSubnet', ['subnetId' => $subnetId]);
        return true;
    }
}