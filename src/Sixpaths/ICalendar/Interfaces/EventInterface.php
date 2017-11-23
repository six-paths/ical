<?php

namespace Sixpaths\ICalendar\Interfaces;

use Sixpaths\ICalendar\Interfaces\OrganizerInterface;

interface EventInterface
{
    const DATETIME_FORMAT = 'Ymd\THis\Z';
    const ATTRIBUTE_UID = 'uid';

    const VALID_ATTRIBUTES = [
        self::ATTRIBUTE_UID,
    ];

    const STANDARD_CLASS_PUBLIC = 'PUBLIC';
    const STANDARD_CLASS_PRIVATE = 'PRIVATE';
    const STANDARD_CLASS_CONFIDENTIAL = 'CONFIDENTIAL';
    const VALID_STANDARD_CLASSES = [
        self::STANDARD_CLASS_PUBLIC,
        self::STANDARD_CLASS_PRIVATE,
        self::STANDARD_CLASS_CONFIDENTIAL,
    ];

    public function createOrganizer(string $email, array $attributes = []): OrganizerInterface;




    public function __toString(): string;
}
