<?php
use \company\alias\crypto\Nonce;
use \PHPUnit\Framework\TestCase;

class NonceTest extends TestCase
{
    public function testHasRandomBytes()
    {
        $this->assertInternalType('bool',Nonce::hasRandomBytes());
    }

    public function testHasMcryptCreateIV()
    {
        $this->assertInternalType('bool',Nonce::hasMcryptCreateIV());
    }

    public function testHasOpenSSLRandomPseudoBytes()
    {
        $this->assertInternalType('bool',Nonce::hasOpenSSLRandomPseudoBytes());
    }

    /**
     * @depends testHasRandomBytes
     * @depends testHasMcryptCreateIV
     * @depends testHasOpenSSLRandomPseudoBytes
     * @depends CryptographicStringTest::testHasMultiByte
     * @depends CryptographicStringTest::testToString
     * @depends CryptographicStringTest::testConstruct
     * @dataProvider constructProvider
     */
    public function testConstruct($length, $error)
    {
        if($error)
        {
            $this->expectException(InvalidArgumentException::class);
        }
        $nonce = new Nonce($length);
        if(Nonce::hasMultiByte())
        {
            $this->assertSame($length, mb_strlen($nonce,'8bit'));
        }
        else
        {
            $this->assertSame($length, strlen($nonce));
        }
    }

    public function constructProvider()
    {
        return array(
            array(1, false),
            array(13, false),
            array(101, false),
            array(-1, true),
            array(0, true)
        );
    }
}

?>
