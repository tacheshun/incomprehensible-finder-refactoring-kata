<?php

namespace CodelyTV\FinderKata\Algorithm;


class PersonName
{
    const MAX_NR_FULLNAME = 10;
    private $fullName;

    public function __construct(string $fullName)
    {
        $this->setFullname($fullName);
    }


    private function setFullname(string $fullName): void
    {
        if($this->isValid($fullName)) {
            $this->fullName = $fullName;
        }
    }

    private function isValid(string $fullName): bool
    {
        $sanitizedString = filter_var($fullName, FILTER_SANITIZE_STRING);

        if( is_string($sanitizedString) && strlen($sanitizedString) <= self::MAX_NR_FULLNAME ) {
            return true;
        }

        throw new \InvalidArgumentException(sprintf('Full name %s not proper', $sanitizedString));
    }
}