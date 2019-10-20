<?php
namespace App\Util;

use App\Exception\HexConverterFormatException;

/**
 * Class HexConverter
 * @package App\Util
 */
class HexConverter
{
    /**
     * @var string $hex
     */
    private $hex = '000000';

    /**
     * @var array $convert
     */
    private $convert = [];

    /**
     * Number format
     *
     * @param $opacity
     * @return string
     */
    protected function numberFormatOpacity($opacity): string
    {
        if (abs($opacity) > 1 || !is_numeric($opacity)) {
            $opacity = 1;
        }
        $opacity = ltrim($opacity, 0);
        return $opacity;
    }

    /**
     * @param string $code
     * @return string
     */
    protected function sanitize(string $code): string
    {
        if (substr($code, 0, 1) === '#') {
            $code = substr($code, 1);
        }
        $this->hex = $code;

        return $this->hex;
    }

    /**
     * Determinate hexadecimal code length to normalize
     *
     * @throws HexConverterFormatException
     */
    protected function normalize(): void
    {
        if (strlen($this->hex) === 6) {
            $this->convert = array( $this->hex[0] . $this->hex[1], $this->hex[2] . $this->hex[3], $this->hex[4] . $this->hex[5] );
        } elseif (strlen($this->hex ) === 3) {
            $this->convert = array( $this->hex[0] . $this->hex[0], $this->hex[1] . $this->hex[1], $this->hex[2] . $this->hex[2] );
        } else {
            throw new HexConverterFormatException('Format sorunu: ' . $this->hex);
        }
    }

    /**
     * Hexadecimal to RGBA
     *
     * @param string $hex
     * @param $opacity
     * @return string
     *
     * @throws HexConverterFormatException
     */
    public function convert(string $hex = '', $opacity = 1): string
    {
        if (!empty($hex) && is_string($hex)) {
            $this->sanitize($hex);
        }
        $this->normalize();
        $rgb     = array_map('hexdec', $this->convert);
        $opacity = $this->numberFormatOpacity($opacity);
        $output  = 'rgba(' . implode(',', $rgb) . ', ' . $opacity . ')';

        return $output;
    }
}
