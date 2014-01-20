<?php namespace Morrelinko;

/**
 * @author Morrison Laju <morrelinko@gmail.com>
 */
class ArrayTakeTest extends \PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $array = array(
            'username' => 'morrelinko',
            'password' => 'xxxxxx',
            'somekey' => 'somevalue'
        );

        $expected = array(
            "username" => "morrelinko",
            "password" => "xxxxxx",
        );

        $this->assertSame(array_take($array, array("username", "password")), $expected);
    }

    public function testRenameKeys()
    {
        $original = array(
            'name' => 'John Doe',
            'gender' => 'male'
        );

        $actual = array_take($original, array('name' => 'full_name'));

        $expected = array(
            'full_name' => 'John Doe'
        );

        $this->assertArrayHasKey('full_name', $actual);
        $this->assertArrayNotHasKey('name', $actual);
        $this->assertSame($expected, $actual);
    }

    public function testApplyCallbackOnKeys()
    {
        $original = array(
            'name' => 'John Doe',
            'password' => '123456',
            'gender' => 'male'
        );

        $actual = array_take($original, array(
            'name',
            'password' => function ($value) use (&$password) {
                return $password = md5($value);
            }
        ));

        $expected = array(
            'name' => 'John Doe',
            'password' => $password
        );

        $this->assertSame($expected, $actual);
    }
}
