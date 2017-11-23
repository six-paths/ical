<?php

namespace Sixpaths\ICalendar;

use Sixpaths\ICalendar\Property;
use Sixpaths\ICalendar\Interfaces\OrganizerInterface;

class Organizer extends Property implements OrganizerInterface
{
    protected $attributes = [];
    protected $email;

    public function __construct(string $email, array $attibutes = null)
    {
        $this->email = $email;
        $this->setAttributes($attibutes);
    }

    private function setAttribute(string $key, $value)
    {
        $this->attributes[$key] = $value;
    }

    private function setAttributes(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    public function __toString(): string
    {

        return new Property('organizer', array_merge($this->attributes, ['mailto' => $this->email]));
    }
}
