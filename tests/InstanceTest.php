<?php

use BigbugGg\Zenlayer\Instance;
use BigbugGg\Zenlayer\Params\ImageParams;
use PHPUnit\Framework\TestCase;

class InstanceTest extends TestCase
{
    protected string $zoneId = 'PAR-A';

    protected Instance $instance;
    
    protected function setUp(): void
    {
        parent::setUp();
        $appId = 'YOUR-APP-ID';
        $secretKey = 'YOUR-SECRET-KEY';
        $this->instance = new Instance($appId, $secretKey);
    }

    /**
     * 测试： 获取可用地区
     * @return void
     * @throws JsonException
     */
    public function testDescribeZones(): void
    {
        $data = $this->instance->describeZones();
        foreach ($data as $item) {
            echo $item->zoneId .' <-> ' . $item->zoneName . "\n";
        }
        $this->assertNotEmpty($data);
    }

    /**
     * 测试： 查询区域中的可用配置
     * @return void
     * @throws JsonException
     */
    public function testDescribeZoneInstanceConfigInfos(): void
    {
        $data = $this->instance->describeZoneInstanceConfigInfos(false, $this->zoneId);

        // 自定义排序函数
        $fn = static function($a, $b) {
            if ($a->memory == $a->memory) {
                return $a->cpuCount - $b->cpuCount;
            }
            return $a->memory - $b->memory;
        };

        // 使用 usort() 函数进行排序
        usort($data, $fn);

        echo "可用配置：\n";
        foreach ($data as $item) {
            echo "CUP ". $item->cpuCount. "核, 内存：".$item->memory." CODE: " . $item->instanceType ."\n";
        }
        $this->assertNotEmpty($data);
    }

    /**
     * 测试： 查询指定区域可用的Linux镜像
     * @return void
     * @throws JsonException
     */
    public function testDescribeImages(): void
    {
        $params = new ImageParams();
        $params->zoneId = $this->zoneId;
        $params->osType = 'linux';
        $data = $this->instance->describeImages($params);
        var_dump($data);
        $this->assertNotEmpty($data);
    }
    
}