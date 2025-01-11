<?php

namespace Modules\Shared\Traits;


use function PHPUnit\Framework\isNull;

trait EntityTrait
{
    public static function createFromArray(array $data): static
    {
        $reflection = new \ReflectionClass(static::class);
        $properties = $reflection->getProperties();

        $args = [];
        foreach ($properties as $property) {
            $name = $property->getName();
            $args[$name] = $data[$name] ?? null;
        }

        return $reflection->newInstanceArgs($args);
    }

    public function toArray(): array
    {
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties();

        $data = [];
        foreach ($properties as $property) {
            $value = $property->getValue($this);
            if ($value !== null) {
                $data[$property->getName()] = $value;
            }
        }

        return $data;
    }

    public function update(array $dataUpdate): void
    {
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            $name = $property->getName();

            if (array_key_exists($name, $dataUpdate)) {
                $property->setValue($this, $dataUpdate[$name]);
            }
        }
    }
}
