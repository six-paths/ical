<?php

namespace Sixpaths\ICalendar;

use Sixpaths\ICalendar\Interfaces\PropertyInterface;

class Property implements PropertyInterface
{
    protected $type;
    protected $attributes = [];

    public function __construct(string $type, array $attributes = [])
    {
        $this->type = $type;
        $this->attributes = $attributes;
    }

    public function __toString(): string
    {
        $copyOfAttributes = $this->attributes;
        $copyOfAttributesKeys = array_keys($copyOfAttributes);

        $lastKey = array_pop($copyOfAttributesKeys);
        $lastValue = array_pop($copyOfAttributes);

        if (!is_numeric($lastKey)) {
            $lastValue = strtoupper($lastKey) . ':' . $lastValue;
        }

        $attributes = [];
        foreach ($copyOfAttributes as $key => $value) {
            $attributes[] = strtoupper($key) . '="' . $value . '"';
        }

        $attributes = implode(';', $attributes);
        if (!empty($attributes)) {
            $attributes = ';' . $attributes;
        }

        return substr(
            chunk_split(
                strtoupper($this->type) . $attributes . ':' . $lastValue,
                76,
                "\r\n "
            ), 0, -3
        );
    }
}
