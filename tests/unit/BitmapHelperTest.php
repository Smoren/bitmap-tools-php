<?php

namespace Smoren\BitmapTools\Tests\Unit;

use Smoren\BitmapTools\Helpers\BitmapHelper;

class BitmapHelperTest extends \Codeception\Test\Unit
{
    public function testCreate()
    {
        $this->assertEquals(132, BitmapHelper::create([2, 7]));
        $this->assertEquals(132, BitmapHelper::create([7, 2]));
        $this->assertEquals(7, BitmapHelper::create([0, 1, 2]));
        $this->assertEquals(7, BitmapHelper::create([1, 2, 0]));
        $this->assertEquals(7, BitmapHelper::create([2, 1, 0]));
        $this->assertEquals(6, BitmapHelper::create([1, 2]));
        $this->assertEquals(5, BitmapHelper::create([0, 2]));
        $this->assertEquals(4, BitmapHelper::create([2]));
        $this->assertEquals(1, BitmapHelper::create([0]));
        $this->assertEquals(0, BitmapHelper::create([]));
    }

    public function testParse()
    {
        $this->assertEquals([2, 7], BitmapHelper::parse(132));
        $this->assertEquals([0, 1, 2], BitmapHelper::parse(7));
        $this->assertEquals([1, 2], BitmapHelper::parse(6));
        $this->assertEquals([0, 2], BitmapHelper::parse(5));
        $this->assertEquals([2], BitmapHelper::parse(4));
        $this->assertEquals([0], BitmapHelper::parse(1));
        $this->assertEquals([], BitmapHelper::parse(0));
    }

    public function testIntersections()
    {
        $this->assertFalse(BitmapHelper::intersects([], []));
        $this->assertFalse(BitmapHelper::intersects([], 0));
        $this->assertFalse(BitmapHelper::intersects(0, []));
        $this->assertFalse(BitmapHelper::intersects(0, 0));

        $this->assertTrue(BitmapHelper::intersects([0, 1, 2], [1, 2, 0]));
        $this->assertTrue(BitmapHelper::intersects(7, [1, 2, 0]));
        $this->assertTrue(BitmapHelper::intersects([0, 1, 2], 7));
        $this->assertTrue(BitmapHelper::intersects(7, 7));

        $this->assertTrue(BitmapHelper::intersects([1, 2], [1, 2, 0]));
        $this->assertTrue(BitmapHelper::intersects(6, [1, 2, 0]));
        $this->assertTrue(BitmapHelper::intersects([1, 2, 0], 6));
        $this->assertTrue(BitmapHelper::intersects([1, 2], 7));
        $this->assertTrue(BitmapHelper::intersects(7, [1, 2]));

        $this->assertTrue(BitmapHelper::intersects([2], [1, 2, 0]));
        $this->assertTrue(BitmapHelper::intersects(4, [1, 2, 0]));
        $this->assertTrue(BitmapHelper::intersects([1, 2, 0], 4));
        $this->assertTrue(BitmapHelper::intersects([2], 7));
        $this->assertTrue(BitmapHelper::intersects(7, [2]));
        $this->assertTrue(BitmapHelper::intersects(7, 1));

        $this->assertTrue(BitmapHelper::intersects([2, 7], [1, 2, 0]));
        $this->assertTrue(BitmapHelper::intersects([2, 7], 7));
        $this->assertTrue(BitmapHelper::intersects(7, [2, 7]));
        $this->assertTrue(BitmapHelper::intersects(132, [1, 2, 0]));
        $this->assertTrue(BitmapHelper::intersects([2, 7], 132));

        $this->assertFalse(BitmapHelper::intersects([], [1, 2, 0]));
        $this->assertFalse(BitmapHelper::intersects(0, [1, 2, 0]));
        $this->assertFalse(BitmapHelper::intersects([1, 2, 0], []));
        $this->assertFalse(BitmapHelper::intersects([1, 2, 0], 0));

        $this->assertFalse(BitmapHelper::intersects([5, 7], [1, 2, 0]));
        $this->assertFalse(BitmapHelper::intersects([5, 7], 7));
        $this->assertFalse(BitmapHelper::intersects([1, 2, 3], [5, 7]));
        $this->assertFalse(BitmapHelper::intersects(7, [5, 7]));
    }

    public function testInclusions()
    {
        $this->assertTrue(BitmapHelper::includes([], []));
        $this->assertTrue(BitmapHelper::includes(0, []));
        $this->assertTrue(BitmapHelper::includes([], 0));

        $this->assertTrue(BitmapHelper::includes([0, 1, 2], [0]));
        $this->assertTrue(BitmapHelper::includes([0, 1, 2], 1));
        $this->assertTrue(BitmapHelper::includes(7, [0]));
        $this->assertTrue(BitmapHelper::includes(7, 1));
        $this->assertTrue(BitmapHelper::includes([0, 1, 2], [1]));
        $this->assertTrue(BitmapHelper::includes([0, 1, 2], [2]));

        $this->assertFalse(BitmapHelper::includes([0], [0, 1, 2]));
        $this->assertFalse(BitmapHelper::includes(1, [0, 1, 2]));
        $this->assertFalse(BitmapHelper::includes([0], 7));
        $this->assertFalse(BitmapHelper::includes(1, 7));
        $this->assertFalse(BitmapHelper::includes([1], [0, 1, 2]));
        $this->assertFalse(BitmapHelper::includes([2], [0, 1, 2]));

        $this->assertTrue(BitmapHelper::includes(133, [2, 7]));
        $this->assertTrue(BitmapHelper::includes(133, [0, 7]));
        $this->assertFalse(BitmapHelper::includes(133, [1, 7]));
        $this->assertFalse(BitmapHelper::includes(133, [0, 1, 7]));
    }
}
