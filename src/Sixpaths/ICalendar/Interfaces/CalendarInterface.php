<?php

namespace Sixpaths\ICalendar\Interfaces;

use Sixpaths\ICalendar\Interfaces\EventInterface;
use Sixpaths\ICalendar\Interfaces\TodoInterface;
use Sixpaths\ICalendar\Interfaces\JournalInterface;
use Sixpaths\ICalendar\Interfaces\FreebusyInterface;
use Sixpaths\ICalendar\Interfaces\TimezoneInterface;
use Sixpaths\ICalendar\Interfaces\AlarmInterface;

interface CalendarInterface
{
    public function setMethod(string $method): CalendarInterface;
    public function setVersion(string $version): CalendarInterface;
    public function setProdId(string $prodId): CalendarInterface;
    public function setCalScale(string $calScale): CalendarInterface;

    public function createEventNode(): EventInterface;
    public function createTodoNode(): TodoInterface;
    public function createJournalNode(): JournalInterface;
    public function createFreebusyNode(): FreebusyInterface;
    public function createTimezoneNode(): TimezoneInterface;
    public function createAlarmNode(): AlarmInterface;

    public function __toString(): string;
}
