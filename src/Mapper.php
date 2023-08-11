<?php

namespace EhsanMoradi\DataMapper;

use Illuminate\Support\Arr;
use EhsanMoradi\DataMapper\Exception\MethodNotFoundException;

class Mapper
{
    private $data;

    private array $config;

    public function __construct(string $data, array $config = null)
    {
        $this->data = $this->convertDataToArray($data);

        $this->setConfig($config ?? config('data-mapper.default'));
    }

    public function __call(string $name, array $arguments)
    {
        $key = $this->convertMethodNameToKey($name);

        return $this->getValue($key);
    }

    private function setConfig(array $config)
    {
        $this->config = $config;
    }

    private function convertMethodNameToKey(string $methodName): string
    {
        return $this->config[$methodName] ?? $methodName;
    }

    private function convertDataToArray($data):array
    {
        $array = $this->isJson($data) ? collect(json_decode($data))->toArray() : xml_to_array($data);

        return Arr::dot($array);
    }

    /**
     * @throws MethodNotFoundException
     */
    private function getValue(string $key)
    {
        if (!isset($this->data[$key])){
            throw new MethodNotFoundException("method \"{$key}\" not found");
        }

        return $this->data[$key];
    }

    private function isJson($string): bool
    {
        json_decode($string);

        return json_last_error() === JSON_ERROR_NONE;
    }
}
