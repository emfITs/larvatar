<?php

use Renfordt\Larvatar\Color;
use PHPUnit\Framework\TestCase;
use Renfordt\Larvatar\Enum\ColorType;

/**
 * Class ColorTest
 *
 * Tests for methods in the Color class.
 */
class ColorTest extends TestCase
{
    /**
     * Tests the HexToRGB method.
     *
     * @throws \Exception
     */
    public function testHexToRGB(): void
    {
        // Test case 1: White
        $hexColor = '#ffffff';
        $expectedResult = [255, 255, 255];
        $actualResult = Color::HexToRGB($hexColor);
        $this->assertEquals($expectedResult, $actualResult, 'Case 1 failed: White');

        // Test case 2: black
        $hexColor = '#000000';
        $expectedResult = [0, 0, 0];
        $actualResult = Color::HexToRGB($hexColor);
        $this->assertEquals($expectedResult, $actualResult, 'Case 2 failed: Black');

        // Test case 3: Mountain Meadow
        $hexColor = '#11c380';
        $expectedResult = [17, 195, 128];
        $actualResult = Color::HexToRGB($hexColor);
        $this->assertEquals($expectedResult, $actualResult, 'Case 3 failed: Mountain Meadow');

        // Test case 4: #8c5a45
        $hexColor = '#8c5a45';
        $expectedResult = [140, 90, 69];
        $actualResult = Color::HexToRGB($hexColor);
        $this->assertEquals($expectedResult, $actualResult, 'Case 4 failed: #8c5a45');

        // Test case 4: #8c5a45
        $hexColor = '#345';
        $expectedResult = [51, 68, 85];
        $actualResult = Color::HexToRGB($hexColor);
        $this->assertEquals($expectedResult, $actualResult, 'Case  failed: #345');


    }

    /**
     * Tests the RGBToHSL method with a variety of colors.
     *
     * @throws \Exception
     */
    public function testRGBToHSL(): void
    {
        // Test case 1: White
        $rgbColor = [255, 255, 255];
        $expectedResult = [0, 0, 1];
        $actualResult = Color::RGBToHSL($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult);

        // Test case 2: Black
        $rgbColor = [0, 0, 0];
        $expectedResult = [0, 0, 0];
        $actualResult = Color::RGBToHSL($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult);

        // Test case 3: Red
        $rgbColor = [255, 0, 0];
        $expectedResult = [0, 1, 0.5];
        $actualResult = Color::RGBToHSL($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult);

        // Test case 4: Green
        $rgbColor = [0, 255, 0];
        $expectedResult = [120, 1, 0.5];
        $actualResult = Color::RGBToHSL($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult);

        // Test case 5: Blue
        $rgbColor = [0, 0, 255];
        $expectedResult = [240, 1, 0.5];
        $actualResult = Color::RGBToHSL($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult);

        // Test case 6: Mountain Meadow
        $rgbColor = [17, 195, 128];
        $expectedResult = [157, 0.84, 0.42];
        $actualResult = Color::RGBToHSL($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 6 failed: Mountain Meadow');

        // Test case 6: #8c5a45
        $rgbColor = [140, 90, 69];
        $expectedResult = [18, 0.34, 0.41];
        $actualResult = Color::RGBToHSL($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 7 failed: #8c5a45');
    }

    /**
     * Tests the RGBToHSV method with a variety of colors.
     *
     * @throws \Exception
     */
    public function testRGBToHSV(): void
    {
        // Test case 1: White
        $rgbColor = [255, 255, 255];
        $expectedResult = [0, 0, 1];
        $actualResult = Color::RGBToHSV($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 1 failed: White');

        // Test case 2: Black
        $rgbColor = [0, 0, 0];
        $expectedResult = [0, 0, 0];
        $actualResult = Color::RGBToHSV($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 2 failed: Black');

        // Test case 3: Red
        $rgbColor = [255, 0, 0];
        $expectedResult = [0, 100, 1];
        $actualResult = Color::RGBToHSV($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 3 failed: Red');

        // Test case 4: Green
        $rgbColor = [0, 255, 0];
        $expectedResult = [120, 100, 1];
        $actualResult = Color::RGBToHSV($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 4 failed: Green');

        // Test case 5: Blue
        $rgbColor = [0, 0, 255];
        $expectedResult = [240, 100, 1];
        $actualResult = Color::RGBToHSV($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 5 failed: Blue');
    }

    /**
     * Tests the RGBToHex method.
     *
     * @throws \Exception
     */
    public function testRGBToHex(): void
    {
        // Test case 1: White
        $rgbColor = [255, 255, 255];
        $expectedResult = 'ffffff';
        $actualResult = Color::RGBToHex($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 1 failed: White');

        // Test case 2: Black
        $rgbColor = [0, 0, 0];
        $expectedResult = '000000';
        $actualResult = Color::RGBToHex($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 2 failed: Black');

        // Test case 3: Red
        $rgbColor = [255, 0, 0];
        $expectedResult = 'ff0000';
        $actualResult = Color::RGBToHex($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 3 failed: Red');

        // Test case 4: Green
        $rgbColor = [0, 255, 0];
        $expectedResult = '00ff00';
        $actualResult = Color::RGBToHex($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 4 failed: Green');

        // Test case 5: Blue
        $rgbColor = [0, 0, 255];
        $expectedResult = '0000ff';
        $actualResult = Color::RGBToHex($rgbColor[0], $rgbColor[1], $rgbColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 5 failed: Blue');

    }

    /**
     * Tests the HSVToRGB method.
     *
     * @throws \Exception
     */
    public function testHSVToRGB(): void
    {
        // Test case 1: White
        $HSVColor = [0, 0, 1];
        $expectedResult = [255, 255, 255];
        $actualResult = Color::HSVToRGB($HSVColor[0], $HSVColor[1], $HSVColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 1 failed: White');

        // Test case 2: Black
        $HSVColor = [0, 0, 0];
        $expectedResult = [0, 0, 0];
        $actualResult = Color::HSVToRGB($HSVColor[0], $HSVColor[1], $HSVColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 2 failed: Black');

        // Test case 3: Red
        $HSVColor = [0, 1, 1];
        $expectedResult = [255, 0, 0];
        $actualResult = Color::HSVToRGB($HSVColor[0], $HSVColor[1], $HSVColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 3 failed: Red');

        // Test case 4: Green
        $HSVColor = [120, 1, 1];
        $expectedResult = [0, 255, 0];
        $actualResult = Color::HSVToRGB($HSVColor[0], $HSVColor[1], $HSVColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 4 failed: Green');

        // Test case 5: Blue
        $HSVColor = [240, 1, 1];
        $expectedResult = [0, 0, 255];
        $actualResult = Color::HSVToRGB($HSVColor[0], $HSVColor[1], $HSVColor[2]);
        $this->assertEquals($expectedResult, $actualResult, 'Case 5 failed: Blue');
    }

    /**
     * Tests the calculateCVH method.
     *
     * @throws \Exception
     */
    public function testCalculateCVH(): void
    {
        // Test case 1: RGB (255, 255, 255)
        $expectedResult = [1.0, 1.0, 0, 1.0, 0];
        $actualResult = Color::calculateCVH(255, 255, 255);
        $this->assertEquals($expectedResult, $actualResult, 'Case 1 failed: White');

        // Test case 2: RGB (0, 0, 0)
        $expectedResult = [0, 0, 0, 0, 0];
        $actualResult = Color::calculateCVH(0, 0, 0);
        $this->assertEquals($expectedResult, $actualResult, 'Case 2 failed: Black');

        // Test case 3: RGB (255, 0, 0)
        $expectedResult = [1.0, 0, 1.0, 1.0, 0];
        $actualResult = Color::calculateCVH(255, 0, 0);
        $this->assertEquals($expectedResult, $actualResult, 'Case 3 failed: Red');

        // Test case 4: RGB (0, 255, 0)
        $expectedResult = [1.0, 0, 1.0, 1.0, 120];
        $actualResult = Color::calculateCVH(0, 255, 0);
        $this->assertEquals($expectedResult, $actualResult, 'Case 4 failed: Green');

        // Test case 5: RGB (0, 0, 255)
        $expectedResult = [1, 0, 1.0, 1.0, 240];
        $actualResult = Color::calculateCVH(0, 0, 255);
        $this->assertEquals($expectedResult, $actualResult, 'Case 5 failed: Blue');
    }

    /**
     * Tests the setHex method in different scenarios.
     *
     * @return void
     */
    public function testSetHex(): void
    {
        $color = new Color(ColorType::RGB, [255, 255, 255]);

        $color->setHex('#000000');
        $this->assertEquals([0, 0, 0], $color->getRGB());
        $this->assertEquals('#000000', $color->getHex());
        $this->assertEquals([0, 0, 0], $color->getHSL());

        $color->setHex('#FF0000');
        $this->assertEquals([255, 0, 0], $color->getRGB());
        $this->assertEquals('#FF0000', $color->getHex());
        $this->assertEquals([0, 1, 0.5], $color->getHSL());

        $color->setHex('#00FF00');
        $this->assertEquals([0, 255, 0], $color->getRGB());
        $this->assertEquals('#00FF00', $color->getHex());
        $this->assertEquals([120, 1, 0.5], $color->getHSL());

        $color->setHex('#0000FF');
        $this->assertEquals([0, 0, 255], $color->getRGB());
        $this->assertEquals('#0000FF', $color->getHex());
        $this->assertEquals([240, 1, 0.5], $color->getHSL());
    }

    /**
     * Tests the setRGB method in different scenarios.
     *
     * @return void
     */
    public function testSetRGB(): void
    {
        $color = new Color(ColorType::Hex, '#ffffff');

        $color->setRGB([0, 0, 0]);
        $this->assertEquals([0, 0, 0], $color->getRGB());
        $this->assertEquals([0, 0, 0], $color->getHSL());
        $this->assertEquals('#000000', $color->getHex());

        $color->setRGB([255, 0, 0]);
        $this->assertEquals([255, 0, 0], $color->getRGB());
        $this->assertEquals([0, 1, 0.5], $color->getHSL());
        $this->assertEquals('#ff0000', $color->getHex());

        $color->setRGB([0, 255, 0]);
        $this->assertEquals([0, 255, 0], $color->getRGB());
        $this->assertEquals([120, 1, 0.5], $color->getHSL());
        $this->assertEquals('#00ff00', $color->getHex());

        $color->setRGB([0, 0, 255]);
        $this->assertEquals([0, 0, 255], $color->getRGB());
        $this->assertEquals([240, 1, 0.5], $color->getHSL());
        $this->assertEquals('#0000ff', $color->getHex());
    }

    public function testGetColorSet(): void
    {
        $color = new Color(ColorType::HSL, [240, 0.5, 0.5]);
        list($dark, $light) = $color->getColorSet();

        $this->assertEquals([240, 0.5, 0.35], $dark->getHSL());
        $this->assertEquals([240, 0.5, 0.8], $light->getHSL());
    }

    public function testBrightenWithoutParameter(): void
    {
        $color = new Color(ColorType::HSL, [240, 0.5, 0.5]);
        $color->brighten();
        $this->assertEquals([240, 0.5, 0.6], $color->getHSL());
    }

    public function testBrightenWithParameter(): void
    {
        $color = new Color(ColorType::HSL, [240, 0.5, 0.5]);
        $color->brighten(20);
        $this->assertEquals([240, 0.5, 0.7], $color->getHSL());
    }

    public function testBrightenWithOutOfRangeParameter(): void
    {
        $color = new Color(ColorType::HSL, [240, 0.5, 0.5]);
        $color->brighten(120);
        $this->assertEquals([240, 0.5, 1.0], $color->getHSL());

        $color->brighten(-120);
        $this->assertEquals([240, 0.5, 0.0], $color->getHSL());
    }

    public function testDarkenWithoutParameter(): void
    {
        $color = new Color(ColorType::HSL, [240, 0.5, 0.5]);
        $color->darken();
        $this->assertEquals([240, 0.5, 0.4], $color->getHSL());
    }

    public function testDarkenWithParameter(): void
    {
        $color = new Color(ColorType::HSL, [240, 0.5, 0.5]);
        $color->darken(20);
        $this->assertEquals([240, 0.5, 0.3], $color->getHSL());
    }

    public function testDarkenWithOutOfRangeParameter(): void
    {
        $color = new Color(ColorType::HSL, [240, 0.5, 0.5]);
        $color->darken(120);
        $this->assertEquals([240, 0.5, 0.0], $color->getHSL());

        $color->darken(-120);
        $this->assertEquals([240, 0.5, 1.0], $color->getHSL());
    }

}
