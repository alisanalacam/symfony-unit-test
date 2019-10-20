<?php
namespace App\Tests\Util;

use App\Exception\HexConverterFormatException;
use App\Util\HexConverter;
use PHPUnit\Framework\TestCase;

/**
 * Class HexConverterTest
 * @package App\Tests\Util
 */
class HexConverterTest extends TestCase
{

    /**
     *
     */
    public function testHexToRgbaHashtagHexAndStringAlpha()
    {
        $hexConverter = new HexConverter();

        $string = '';

        try {
            $string = $hexConverter->convert('#FFF', '0.3');
        } catch (HexConverterFormatException $e) {

        }
        $this->assertStringMatchesFormat($string, 'rgba(255,255,255, .3)');
    }

    public function testHexToRgbaHashtagHexAndIntegerAlpha()
    {
        $hexConverter = new HexConverter();

        /** @var string $string */
        $string = '';

        try {
            $string = $hexConverter->convert('#FFFFFF', 1);
        } catch (HexConverterFormatException $e) {

        }
        $this->assertStringMatchesFormat((string) $string, 'rgba(255,255,255, 1)');
    }

    public function testHexToRgbaHexAndStringAlpha()
    {
        $hexConverter = new HexConverter();

        /** @var string $string */
        $string = '';

        try {
            $string = $hexConverter->convert('FFF', '.5');
        } catch (HexConverterFormatException $e) {

        }
        $this->assertStringMatchesFormat((string) $string, 'rgba(255,255,255, .5)');

    }

    public function testHexToRgbaHexAndIntegerAlpha()
    {
        $hexConverter = new HexConverter();

        /** @var string $string */
        $string = '';

        try {
            $string = $hexConverter->convert('FFFFFF', 1);
        } catch (HexConverterFormatException $e) {

        }
        $this->assertStringMatchesFormat($string, 'rgba(255,255,255, 1)');
    }

    public function testHexToRgbaHexIntegerAlphaFormatError()
    {
        $this->expectException(HexConverterFormatException::class);

        $hexConverter = new HexConverter();
        $hexConverter->convert('FFFFF', 1);
    }
}
