<?php

namespace Sixpaths\ICalendar;

use DateTime;
use DateTimeZone;
use Sixpaths\ICalendar\Organizer;
use Sixpaths\ICalendar\Property;
use Sixpaths\ICalendar\Interfaces\EventInterface;
use Sixpaths\ICalendar\Interfaces\OrganizerInterface;
use Sixpaths\ICalendar\Interfaces\PropertyInterface;

class Event implements EventInterface
{
    protected $attributes = [];
    protected $nodes = [];

    public function createClass(string $class): PropertyInterface
    {
        return $this->attributes['class'] = new Property('class', [$class]);
    }

    public function createCreated(DateTime $created): PropertyInterface
    {
        $created->setTimezone(new DateTimeZone('UTC'));
        return $this->attributes['created'] = new Property('created', [$created->format(self::DATETIME_FORMAT)]);
    }

    public function createDescription(string $description): PropertyInterface
    {
        return $this->attributes['description'] = new Property('description', [$description]);
    }

    public function createDtStart(DateTime $dtStart): PropertyInterface
    {
        $dtStart->setTimezone(new DateTimeZone('UTC'));
        return $this->attributes['dtstart'] = new Property('dtstart', [$dtStart->format(self::DATETIME_FORMAT)]);
    }

    public function createGeo(float $lat, float $lon): PropertyInterface
    {
        return $this->attributes['geo'] = new Property('geo', [$lat . ';' . $lon]);
    }

    public function createLastModified(DateTime $lastModified): PropertyInterface
    {
        $lastModified->setTimezone(new DateTimeZone('UTC'));
        return $this->attributes['last-modified'] = new Property('last-modified', [$lastModified->format(self::DATETIME_FORMAT)]);
    }

    public function createOrganizer(
        string $email,
        array $attributes = []
    ): OrganizerInterface
    {
        return $this->attributes['organizer'] = new Organizer($email, $attributes);
    }

    public function createSummary(string $summary): PropertyInterface
    {
        return $this->attributes['summary'] = new Property('summary', [$summary]);
    }

    public function createUid(string $uid): PropertyInterface
    {
        return $this->attributes['uid'] = new Property('uid', [$uid]);
    }

    public function __toString(): string
    {
        $output = array_filter([
            new Property('begin', ['VEVENT']),
            implode("\r\n", $this->attributes),
            implode("\r\n", $this->nodes),
            new Property('end', ['VEVENT']),
        ], function ($value) {
            return !empty($value);
        });

        return implode("\r\n", $output);
    }
}
