<?php namespace Morrelinko;

/**
 * @author Morrison Laju <morrelinko@gmail.com>
 */
class ArrayTakeTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $array = array(
            "username" => "morrelinko",
            "password" => "xxxxxx",
            "somekey" => "somevalue"
        );

        $expected = array(
            "username" => "morrelinko",
            "password" => "xxxxxx",
        );

        $this->assertSame(array_take($array, array("username", "password")), $expected);
    }
}