<?php

namespace Renfordt\Larvatar;

use Renfordt\Larvatar\Enum\ColorType;
use Renfordt\Larvatar\Enum\FormTypes;
use SVG\Nodes\Shapes\SVGCircle;
use SVG\Nodes\Shapes\SVGPolygon;
use SVG\Nodes\Shapes\SVGRect;
use SVG\Nodes\Texts\SVGText;
use SVG\SVG;

class InitialsAvatar
{
    private string $fontPath = '';
    private string $fontFamily = '';
    private array $names = [];
    private int $size = 128;
    private int $fontSize = 0;
    private FormTypes $form = FormTypes::Circle;
    private int $rotation;
    private string $fontWeight = 'normal';
    private float $backgroundLightness = 0.8;
    private float $textLightness = 0.35;
    private int $offset = 0;

    /**
     * Create an instance of InitialsAvatar
     * @param  string  $name  First and last name or username, seperated by a space
     */
    public function __construct(string $name = '')
    {
        $this->setName($name);
    }

    /**
     * Sets the names for the avatar
     * @param  string  $name  Names seperated by a space for generating the avatar
     * @return static
     */
    public function setName(string $name): static
    {
        $this->names = explode(' ', $name);
        return $this;
    }

    /**
     * Generates an avatar based on the given names and encoding
     *
     * @param  array  $names  An array of names to generate initials from
     * @param  string|null  $encoding  The encoding type for the output ('base64' or null)
     *
     * @return string The generated avatar in SVG format or the base64-encoded avatar image
     */
    public function generate(array $names = [], string|null $encoding = null): string
    {
        $names = $this->getNames($names);
        $larvatar = new SVG($this->size, $this->size);
        $doc = $larvatar->getDocument();

        $this->addFontIfNotEmpty();

        $color = $this->getColor($names);
        list($darkColor, $lightColor) = $color->getColorSet($this->textLightness, $this->backgroundLightness);

        if ($this->form == FormTypes::Circle) {
            $halfSize = $this->size / 2;
            $outlineForm = $this->getCircle($halfSize, $lightColor);
        } elseif ($this->form == FormTypes::Square) {
            $outlineForm = $this->getSquare($this->size, $lightColor);
        } elseif ($this->form == FormTypes::Hexagon) {
            $outlineForm = $this->getHexagon($this->size, $lightColor, $this->rotation);
        }


        $initials = $this->getInitials($names, $darkColor);

        $doc->addChild($outlineForm);
        $doc->addChild($initials);

        if ($encoding == 'base64') {
            return 'data:image/svg+xml;base64,' . base64_encode($larvatar);
        }
        return $larvatar;
    }

    /**
     * Retrieves the names array
     * If the provided $names array is empty,
     * it returns the default names array
     *
     * @param  array  $names  The names array
     * @return array  The names array to be returned
     */
    private function getNames(array $names): array
    {
        return empty($names) ? $this->names : $names;
    }

    /**
     * Adds a font if the font path and font family are not empty
     * @return void
     */
    private function addFontIfNotEmpty(): void
    {
        if ($this->fontPath != '' && $this->fontFamily != '') {
            SVG::addFont($this->fontPath);
        }
    }

    /**
     * Retrieves the color based on the given array of names
     *
     * @param  array  $names  An array of names
     * @return Color  The color object with the generated hex color
     */
    private function getColor(array $names): Color
    {
        return new Color(ColorType::Hex, $this->generateHexColor($names, $this->offset));
    }

    /**
     * Generates a hex color code based on the names
     * @param  array|null  $names  Array of names used to generate the hex color code.
     * @param  int  $offset  Offset of the hash, similar to a seed
     * @return string Returns a color hash code, e.g. '#123456'
     */
    public function generateHexColor(array $names = null, int $offset = 0): string
    {
        if ($names == null) {
            $names = $this->names;
        }
        $name = implode(' ', $names);
        $hash = md5($name);
        return '#' . substr($hash, $offset, 6);
    }

    /**
     * Get a circle SVG element
     *
     * @param  float  $halfSize  Half of the size of the circle
     * @param  Color  $lightColor  The light color to fill the circle with
     * @return  SVGCircle                     The circle SVG element
     */
    private function getCircle(float $halfSize, Color $lightColor): SVGCircle
    {
        $circle = new SVGCircle($halfSize, $halfSize, $halfSize);
        $circle->setStyle('fill', $lightColor->getHex());

        return $circle;
    }

    /**
     * Get a square SVGRect
     *
     * @param  float  $size  Half of the square size
     * @param  Color  $lightColor  The color of the square
     *
     * @return SVGRect The generated square SVGRect object
     */
    private function getSquare(float $size, Color $lightColor): SVGRect
    {
        $square = new SVGRect(0, 0, $size, $size);
        $square->setStyle('fill', $lightColor->getHex());
        return $square;
    }

    /**
     * Get a polygon shape
     *
     * @param  float  $size  The size of the polygon
     * @param  Color  $lightColor  The light color to fill the polygon
     * @return SVGPolygon The polygon shape with the specified size and color
     */
    private function getHexagon(float $size, Color $lightColor, int $rotation = 0): SVGPolygon
    {
        $rotation = pi() / 180 * $rotation;

        for ($i = 0; $i <= 5; $i++) {
            $xCoordinate = $size / 2 * cos(pi() / 3 * $i + $rotation) + $size / 2;
            $yCoordinate = $size / 2 * sin(pi() / 3 * $i + $rotation) + $size / 2;
            $edgePoints[] = [$xCoordinate, $yCoordinate];
        }

        $polygon = new SVGPolygon($edgePoints);
        $polygon->setStyle('fill', $lightColor->getHex());
        return $polygon;
    }

    /**
     * Generates initials for the given names and returns SVGText object
     * @param  array  $names  List of names
     * @param  Color  $darkColor  Dark color object
     * @return SVGText  SVGText object containing the initials
     */
    private function getInitials(array $names, Color $darkColor): SVGText
    {
        $initialsText = '';
        foreach ($names as $name) {
            $initialsText .= substr($name, 0, 1);
        }

        $initials = new SVGText($initialsText, '50%', '55%');
        $initials->setStyle('fill', $darkColor->getHex());
        $initials->setStyle('text-anchor', 'middle');
        $initials->setStyle('dominant-baseline', 'middle');
        $initials->setStyle('font-weight', $this->fontWeight);
        $initials->setFontFamily($this->fontFamily);
        if ($this->fontSize == 0) {
            $this->fontSize = $this->calculateFontSize($initialsText);
        }
        $initials->setFontSize($this->fontSize . 'px');

        return $initials;
    }

    /**
     * Calculate the font size based on the initials length
     *
     * @param  string  $initials  The initials to calculate the font size for
     * @return int  The calculated font size
     */
    protected function calculateFontSize(string $initials): int
    {
        return intval($this->size * (0.5 - sin(0.5 * strlen($initials) - 1) / 5));
    }

    /**
     * Sets the font size for the text
     *
     * @param  int  $size  The font size in pixel
     * @return static
     */
    public function setFontSize(int $size): static
    {
        $this->fontSize = $size;
        return $this;
    }

    /**
     * Sets the size of the avatar
     * @param  int  $size  Size in pixel
     * @return static
     */
    public function setSize(int $size): static
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Sets the font which shall be used for the avatar
     * @param  string  $fontFamily  Font Family, e.g. 'Roboto'
     * @param  string  $path Absolute path to the true type font with a leading slash, e.g. '/font/Roboto-Bold.ttf'
     * @return static
     */
    public function setFont(string $fontFamily, string $path): static
    {
        $this->fontFamily = $fontFamily;
        $this->fontPath = $path;
        return $this;
    }

    /**
     * Sets the form of the application
     *
     * @param  string|FormTypes  $form  The form type
     * @return static
     */
    public function setForm(string|FormTypes $form): static
    {
        if (is_string($form)) {
            $form = FormTypes::from($form);
        }

        $this->form = $form;
        return $this;
    }

    /**
     * Sets the rotation angle of the element
     *
     * @param  int  $angle  The rotation angle value
     *
     * @return static
     */
    public function setRotation(int $angle): static
    {
        $this->rotation = $angle;
        return $this;
    }

    /**
     * Sets the font weight
     * @param  string  $fontWeight  The font weight to set
     * @return static
     */
    public function setFontWeight(string $fontWeight): static
    {
        $this->fontWeight = $fontWeight;
        return $this;
    }

    /**
     * Get the lightness of the background color.
     *
     * @return float The lightness value of the background color.
     */
    public function getBackgroundLightness(): float
    {
        return $this->backgroundLightness;
    }

    /**
     * Sets the lightness of the background
     *
     * @param  float  $lightness  Lightness value (between 0 and 1)
     * @return static
     */
    public function setBackgroundLightness(float $lightness): static
    {
        $this->backgroundLightness = clamp($lightness, 0, 1);
        return $this;
    }

    /**
     * Get the lightness of the text
     *
     * @return float The lightness of the text
     */
    public function getTextLightness(): float
    {
        return $this->textLightness;
    }

    /**
     * Sets the lightness of the text
     *
     * @param  float  $lightness  Lightness value ranging from 0 to 1
     * @return static
     */
    public function setTextLightness(float $lightness): static
    {
        $this->textLightness = clamp($lightness, 0, 1);
        return $this;
    }

    /**
     * Retrieves the offset of the object
     *
     * @return int The offset value
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Sets the offset for the avatar
     *
     * @param  int  $offset  The offset in pixel
     * @return static
     */
    public function setOffset(int $offset): static
    {
        $this->offset = $offset;
        return $this;
    }
}
