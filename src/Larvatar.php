<?php

namespace Renfordt\Larvatar;

use Renfordt\Larvatar\Enum\LarvatarTypes;

class Larvatar
{
    protected LarvatarTypes $type = LarvatarTypes::mp;
    protected string $name;
    protected string $email;
    protected string $font;
    protected string $fontPath;
    protected int $size = 100;
    public InitialsAvatar $initialsAvatar;

    public static function make(string $name = '', string $email = '', int|LarvatarTypes $type = LarvatarTypes::mp): static
    {
        return new static($name, $email, $type);
    }

    /**
     * Constructs a new instance of the class.
     *
     * @param  string  $name  The name. Default is an empty string.
     * @param  string  $email  The email. Default is an empty string.
     * @param  int|LarvatarTypes  $type  The type. Default is LarvatarTypes::mp.
     */
    public function __construct(string $name = '', string $email = '', int|LarvatarTypes $type = LarvatarTypes::mp)
    {
        $this->name = $name;
        $this->email = $email;
        if (is_int($type)) {
            $this->type = LarvatarTypes::from($type);
        } elseif ($type instanceof LarvatarTypes) {
            $this->type = $type;
        }

        if ($this->type == LarvatarTypes::InitialsAvatar) {
            $this->initialsAvatar = new InitialsAvatar($this->name);
        }
    }

    /**
     * Generates the HTML or SVG code directly for usage
     * @return string HTML or SVG code
     */
    public function getImageHTML(string $encoding = ''): string
    {
        if ($this->type == LarvatarTypes::InitialsAvatar) {
            if (isset($this->font) && $this->font != '' && $this->fontPath != '') {
                $this->initialsAvatar->setFont($this->font, $this->fontPath);
            }
            $this->initialsAvatar->setSize($this->size);
            if ($encoding == 'base64') {
                return '<img src="' . $this->initialsAvatar->generate(encoding: $encoding) . '" />';
            } else {
                return $this->initialsAvatar->generate();
            }
        }

        $gravatar = new Gravatar($this->email);
        $gravatar->setType($this->type);
        $gravatar->setSize($this->size);

        return '<img src="' . $gravatar->generateGravatarLink() . '" />';
    }

    /**
     * Get the base64 string representation of the initials' avatar.
     *
     * @return string The base64 encoded string of the initials' avatar.
     */
    public function getBase64(): string
    {
        if (isset($this->font) && $this->font != '' && $this->fontPath != '') {
            $this->initialsAvatar->setFont($this->font, $this->fontPath);
        }
        return $this->initialsAvatar->generate(encoding: 'base64');
    }

    /**
     * Set the font for Initial Avatar
     * @param  string  $fontFamily  Font family of the used font, e.g. 'Roboto'
     * @param  string  $path  Relative path to the true type font file, starting with a /, e.g. '/font/Roboto-Bold.ttf'
     * @return void
     */
    public function setFont(string $fontFamily, string $path): static
    {
        $this->font = $fontFamily;
        $this->fontPath = $path;

        return $this;
    }

    /**
     * Sets the size of the object.
     *
     * @param  int  $size  The size of the object.
     * @return void
     */
    public function setSize(int $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getInitialsAvatar(): ?InitialsAvatar
    {
        return $this->initialsAvatar;
    }
}
