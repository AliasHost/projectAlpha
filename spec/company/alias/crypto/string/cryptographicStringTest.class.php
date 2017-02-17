<?php
use \company\alias\crypto\string\CryptographicString;
use \PHPUnit\Framework\TestCase;

class CryptographicStringTest extends TestCase
{

    public function testConstruct()
    {
        $string = "Test";
        $cryptoString = new CryptographicString($string);
        $this->assertAttributeSame($string, 'wrapped', $cryptoString);
    }

    /**
     * @depends testConstruct
     */
    public function testToString()
    {
        $string = "Test";
        $cryptoString = new CryptographicString($string);
        $this->assertSame($string, $cryptoString->__toString());
    }

    /**
     * @depends testConstruct
     */
    public function testGetString()
    {
        $string = "Test";
        $cryptoString = new CryptographicString($string);
        $this->assertSame($string, $cryptoString->getString());
    }

    public function testHasMultiByte()
    {
        $this->assertInternalType('bool', CryptographicString::hasMultiByte());
    }

    public function testHasHashEquals()
    {
        $this->assertInternalType('bool', CryptographicString::hasHashEquals());
    }

    /**
     * @depends testConstruct
     */
    public function testSetString()
    {
        $string = "Test";
        $cryptoString = new CryptographicString('');
        $cryptoString->setString($string);
        $this->assertAttributeSame($string, 'wrapped', $cryptoString);
    }

    /**
     * @depends testConstruct
     * @depends testToString
     * @depends testGetString
     * @depends testHasMultiByte
     * @depends testHasHashEquals
     * @dataProvider compareProvider
     */
    public function testCompare($succeed, $expected, $actual)
    {
        $e = new CryptographicString($expected);
        $a = new CryptographicString($actual);
        if($succeed)
        {
            $this->assertTrue(CryptographicString::compare($e,$a));
        }
        else
        {
            $this->assertFalse(CryptographicString::compare($e,$a));
        }
    }

    /**
     * @depends testCompare
     * @dataProvider compareProvider
     */
    public function testEquals($succeed, $expected, $actual)
    {
        $e = new CryptographicString($expected);
        $a = new CryptographicString($actual);
        if($succeed)
        {
            $this->assertTrue($e->equals($a));
        }
        else
        {
            $this->assertFalse($e->equals($a));
        }
    }

    public function compareProvider()
    {
        return array(
            array(false,'Test','Fail'),
            array(true,'Test','Test'),
            array(false,'0001','001'),
            array(false,'0000',0)
        );
    }
}

?>
