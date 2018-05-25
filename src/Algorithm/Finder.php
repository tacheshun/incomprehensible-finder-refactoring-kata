<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

final class Finder
{
    /** @var Person[] */
    private $_p;

    public function __construct(array $p)
    {
        $this->_p = $p;
    }

    public function find(int $ft): PersonPair
    {
        /** @var PersonPair[] $tr */
        $tr = [];

        for ($i = 0; $i < count($this->_p); $i++) {
            for ($j = $i + 1; $j < count($this->_p); $j++) {
                $r = new PersonPair();

                if ($this->_p[$i]->getBirthDate() < $this->_p[$j]->getBirthDate()) {
                    $r->p1 = $this->_p[$i];
                    $r->p2 = $this->_p[$j];
                } else {
                    $r->p1 = $this->_p[$j];
                    $r->p2 = $this->_p[$i];
                }

                $r->birthDaysDistanceInSeconds = $r->p2->getBirthDate()->getTimestamp()
                    - $r->p1->getBirthDate()->getTimestamp();

                $tr[] = $r;
            }
        }

        if (count($tr) < 1) {
            return new PersonPair();
        }

        $answer = $tr[0];

        foreach ($tr as $result) {
            switch ($ft) {
                case Criteria::ONE:
                    if ($result->birthDaysDistanceInSeconds < $answer->birthDaysDistanceInSeconds) {
                        $answer = $result;
                    }
                    break;

                case Criteria::TWO:
                    if ($result->birthDaysDistanceInSeconds > $answer->birthDaysDistanceInSeconds) {
                        $answer = $result;
                    }
                    break;
            }
        }

        return $answer;
    }
}
