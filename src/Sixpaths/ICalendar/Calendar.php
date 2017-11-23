<?php

namespace Sixpaths\ICalendar;

use Sixpaths\ICalendar\Event;
use Sixpaths\ICalendar\Todo;
use Sixpaths\ICalendar\Journal;
use Sixpaths\ICalendar\Freebusy;
use Sixpaths\ICalendar\Timezone;
use Sixpaths\ICalendar\Alarm;
use Sixpaths\ICalendar\Property;
use Sixpaths\ICalendar\Interfaces\CalendarInterface;
use Sixpaths\ICalendar\Interfaces\EventInterface;
use Sixpaths\ICalendar\Interfaces\TodoInterface;
use Sixpaths\ICalendar\Interfaces\JournalInterface;
use Sixpaths\ICalendar\Interfaces\FreebusyInterface;
use Sixpaths\ICalendar\Interfaces\TimezoneInterface;
use Sixpaths\ICalendar\Interfaces\AlarmInterface;

class Calendar implements CalendarInterface
{
    protected $attributes = [];
    protected $nodes = [];

    public function __construct(
        string $method = null,
        float $version = null,
        string $prodId = null,
        string $calScale = null
    )
    {
        $this->setMethod($method ?? 'REQUEST');
        $this->setVersion($version ?? '2.0');
        $this->setProdId($prodId ?? 'Sixpaths ICalendar');
        $this->setCalScale($calScale ?? 'GREGORIAN');
    }

    public function setMethod(string $method): CalendarInterface
    {
        $this->setAttribute('method', [$method]);

        return $this;
    }

    public function setVersion(string $version): CalendarInterface
    {
        $this->setAttribute('version', [$version]);

        return $this;
    }

    public function setProdId(string $prodId): CalendarInterface
    {
        $this->setAttribute('prodid', [$prodId]);

        return $this;
    }

    public function setCalScale(string $calScale): CalendarInterface
    {
        $this->setAttribute('calscale', [$calScale]);

        return $this;
    }

    private function setAttribute($key, array $values = [])
    {
        $this->attributes[$key] = new Property($key, $values);
    }

    public function createEventNode(): EventInterface
    {
        return $this->nodes[] = new Event;
    }

    public function createTodoNode(): TodoInterface
    {
        return $this->nodes[] = new Todo;
    }

    public function createJournalNode(): JournalInterface
    {
        return $this->nodes[] = new Journal;
    }

    public function createFreebusyNode(): FreebusyInterface
    {
        return $this->nodes[] = new Freebusy;
    }

    public function createTimezoneNode(): TimezoneInterface
    {
        return $this->nodes[] = new Timezone;
    }

    public function createAlarmNode(): AlarmInterface
    {
        return $this->nodes[] = new Alarm;
    }

    public function __toString(): string
    {
        $output = array_filter([
            'BEGIN:VCALENDAR',
            implode("\r\n", $this->attributes),
            implode("\r\n", $this->nodes),
            'END:VCALENDAR',
        ], function ($value) {
            return !empty($value);
        });

        return implode("\r\n", $output);
    }
}
