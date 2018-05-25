<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

use DateTimeImmutable;

final class Person
{
    /** @var string */
    private $name;

    /** @var DateTimeImmutable */
    private $birthDate;

    public function __construct(PersonName $name, \DateTimeImmutable $birthDate)
    {
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBirthDate(): DateTimeImmutable
    {
        return $this->birthDate;
    }
}
