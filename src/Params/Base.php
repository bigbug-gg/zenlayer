<?php

namespace BigbugGg\Zenlayer\Params;

abstract class Base
{
    /**
     * 对象产生转数组
     *
     * @return array
     */
    public function toArray(): array
    {
        $returnArr = [];
        foreach ($this as $key => $value) {
            if (is_null($value)) {
                continue;
            }
            if (is_array($value) && count($value) === 0) {
                continue;
            }

            $returnArr[$key] = $value;
        }
        return $returnArr;
    }
}