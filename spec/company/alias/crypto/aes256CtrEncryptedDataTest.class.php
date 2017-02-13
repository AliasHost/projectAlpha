<?php
use company\alias\crypto\Aes256CtrEncryptedData;

class Aes256CtrEncryptedDataTest extends PHPUnit_Framework_TestCase
{
    public function testHasMcrypt()
    {
        $this->assertInternalType('bool', Aes256CtrEncryptedData::hasMcrypt());
    }

    public function testHasOpenSsl()
    {
        $this->assertInternalType('bool', Aes256CtrEncryptedData::hasOpenSsl());
    }

    public function testConstruct()
    {
        $this->assertTrue(false);
        $this->markTestIncomplete();
    }

    /**
     * @depends testConstruct
     * @depends testHasMcrypt
     * @depends testHasOpenSsl
     * @depends NonceTest::testConstruct
     */
    public function testEncrypt()
    {
        $this->assertTrue(false);
        $this->markTestIncomplete();
    }

    /**
     * @depends testConstruct
     * @depends testHasMcrypt
     * @depends testHasOpenSsl
     */
    public function testDecrypt()
    {
        $this->assertTrue(false);
        $this->markTestIncomplete();
    }

    /**
     * @depends testEncrypt
     * @depends testDecrypt
     */
    public function testGetPlaintextData()
    {
        $this->assertTrue(false);
        $this->markTestIncomplete();
    }

    /**
     * @depends testEncrypt
     * @depends testDecrypt
     */
    public function testGetEncryptedData()
    {
        $this->assertTrue(false);
        $this->markTestIncomplete();
    }

    /**
     * @depends testGetEncryptedData
     */
    public function testToString()
    {
        $this->assertTrue(false);
        $this->markTestIncomplete();
    }

    /**
     * @depends testToString
     */
    public function testCompare()
    {
        $this->assertTrue(false);
        $this->markTestIncomplete();
    }

    /**
     * @depends testCompare
     */
    public function testEquals()
    {
        $this->assertTrue(false);
        $this->markTestIncomplete();
    }

    /**
     * @depends testToString
     */
    public function testSerialize()
    {
        $this->assertTrue(false);
        $this->markTestIncomplete();
    }

    /**
     * @depends testSerialize
     */
    public function testUnserialize()
    {
        $this->assertTrue(false);
        $this->markTestIncomplete();
    }

}

?>
