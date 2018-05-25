<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKataTest\Algorithm;

use CodelyTV\FinderKata\Algorithm\Finder;
use CodelyTV\FinderKata\Algorithm\Criteria;
use CodelyTV\FinderKata\Algorithm\Person;
use CodelyTV\FinderKata\Algorithm\PersonName;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class FinderTest extends TestCase
{
    /** @var Person */
    private $sue;

    /** @var Person */
    private $greg;

    /** @var Person */
    private $sarah;

    /** @var Person */
    private $mike;


    protected function setUp()
    {
        $this->sue = new Person(new PersonName("Sue"), new \DateTimeImmutable("1950-01-01"));
        $this->greg = new Person(new PersonName("Greg"), new \DateTimeImmutable("1952-05-01"));
        $this->sarah = new Person(new PersonName("Sarah"), new \DateTimeImmutable("1982-01-01"));
        $this->mike = new Person(new PersonName("Mike"), new \DateTimeImmutable("1979-01-01"));
    }

    /** @test */
    public function should_return_empty_when_given_empty_list()
    {
        $list   = [];
        $finder = new Finder($list);

        $result = $finder->find(Criteria::ONE);

        $this->assertEquals(null, $result->p1);
        $this->assertEquals(null, $result->p2);
    }

    /** @test */
    public function should_return_empty_when_given_one_person()
    {
        $list   = [];
        $list[] = $this->sue;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::ONE);

        $this->assertEquals(null, $result->p1);
        $this->assertEquals(null, $result->p2);
    }

    /** @test */
    public function should_return_closest_two_for_two_people()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::ONE);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->greg, $result->p2);
    }

    /** @test */
    public function should_return_furthest_two_for_two_people()
    {
        $list   = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::TWO);

        $this->assertEquals($this->greg, $result->p1);
        $this->assertEquals($this->mike, $result->p2);
    }

    /** @test */
    public function should_return_furthest_two_for_four_people()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::TWO);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->sarah, $result->p2);
    }

    /**
     * @test
     */
    public function should_return_closest_two_for_four_people()
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::ONE);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->greg, $result->p2);
    }

    /**
     * @test
     */
    public function name_should_not_have_more_than_ten_chars()
    {
        $this->expectException(InvalidArgumentException::class);
        $personWithLargeName = new Person(new PersonName("PersonWIthNameLargerThanTenChars"), new \DateTimeImmutable("1984-01-01"));
        $personWithLargeName->getName();
    }
}
