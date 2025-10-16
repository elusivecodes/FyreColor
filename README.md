# FyreColor

**FyreColor** is a free, open-source immutable color manipulation library for *PHP*.

It is a modern library, and features full support for all CSS color-spaces.


## Table Of Contents
- [Installation](#installation)
- [Basic Usage](#basic-usage)
- [Color Creation](#color-creation)
- [Colors](#colors)
    - [A98 Rgb](#a98-rgb)
    - [Display P3](#display-p3)
    - [Display P3 Linear](#display-p3-linear)
    - [Hex](#hex)
    - [Hsl](#hsl)
    - [Hwb](#hwb)
    - [Lab](#lab)
    - [Lch](#lch)
    - [OkLab](#oklab)
    - [OkLch](#oklch)
    - [ProPhoto Rgb](#prophoto-rgb)
    - [Rec2020](#rec2020)
    - [Rgb](#rgb)
    - [Srgb](#srgb)
    - [Srgb Linear](#srgb-linear)
    - [Xyz D50](#xyz-d50)
    - [Xyz D65](#xyz-d65)



## Installation

**Using Composer**

```
composer require fyre/color
```

In PHP:

```php
use Fyre\Color\Color;
```


## Basic Usage

- `$string` is a string representing the CSS color.

```php
$color = Color::createFromString($string);
```


## Color Creation

**Create From A98 RGB**

- `$red` is a number between *0* and *1*, and will default to *0*.
- `$green` is a number between *0* and *1*, and will default to *0*.
- `$blue` is a number between *0* and *1*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromA98Rgb($red, $green, $blue, $alpha);
```

**Create From Display P3**

- `$red` is a number between *0* and *1*, and will default to *0*.
- `$green` is a number between *0* and *1*, and will default to *0*.
- `$blue` is a number between *0* and *1*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromDisplayP3($red, $green, $blue, $alpha);
```

**Create From Display P3 Linear**

- `$red` is a number between *0* and *1*, and will default to *0*.
- `$green` is a number between *0* and *1*, and will default to *0*.
- `$blue` is a number between *0* and *1*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromDisplayP3Linear($red, $green, $blue, $alpha);
```

**Create From HSL**

- `$hue` is a number between *0* and *360*, and will default to *0*.
- `$saturation` is a number between *0* and *100*, and will default to *0*.
- `$lightness` is a number between *0* and *100*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromHsl($hue, $saturation, $lightness, $alpha);
```

**Create From HWB**

- `$hue` is a number between *0* and *360*, and will default to *0*.
- `$whiteness` is a number between *0* and *100*, and will default to *0*.
- `$blackness` is a number between *0* and *100*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromHwb($hue, $whiteness, $blackness, $alpha);
```

**Create From Lab**

- `$lightness` is a number between *0* and *100*, and will default to *0*.
- `$a` is a number between *-128* and *127*, and will default to *0*.
- `$b` is a number between *-128* and *127*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromLab($lightness, $a, $b, $alpha);
```

**Create From Lch**

- `$lightness` is a number between *0* and *100*, and will default to *0*.
- `$chroma` is a number between *0* and *230*, and will default to *0*.
- `$hue` is a number between *0* and *360*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromLch($lightness, $chroma, $hue, $alpha);
```

**Create From OkLab**

- `$lightness` is a number between *0* and *1*, and will default to *0*.
- `$a` is a number between *-0.4* and *0.4*, and will default to *0*.
- `$b` is a number between *-0.4* and *0.4*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromOkLab($lightness, $a, $b, $alpha);
```

**Create From OkLch**

- `$lightness` is a number between *0* and *1*, and will default to *0*.
- `$chroma` is a number between *0* and *0.4*, and will default to *0*.
- `$hue` is a number between *0* and *360*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromOkLch($lightness, $chroma, $hue, $alpha);
```

**Create From ProPhoto Rgb**

- `$red` is a number between *0* and *1*, and will default to *0*.
- `$green` is a number between *0* and *1*, and will default to *0*.
- `$blue` is a number between *0* and *1*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromProPhotoRgb($red, $green, $blue, $alpha);
```

**Create From Rec 2020**

- `$red` is a number between *0* and *1*, and will default to *0*.
- `$green` is a number between *0* and *1*, and will default to *0*.
- `$blue` is a number between *0* and *1*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromRec2020($red, $green, $blue, $alpha);
```

**Create From Rgb**

- `$red` is a number between *0* and *255*, and will default to *0*.
- `$green` is a number between *0* and *255*, and will default to *0*.
- `$blue` is a number between *0* and *255*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromRgb($red, $green, $blue, $alpha);
```

**Create From Srgb**

- `$red` is a number between *0* and *1*, and will default to *0*.
- `$green` is a number between *0* and *1*, and will default to *0*.
- `$blue` is a number between *0* and *1*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromSrgb($red, $green, $blue, $alpha);
```

**Create From Srgb Linear**

- `$red` is a number between *0* and *1*, and will default to *0*.
- `$green` is a number between *0* and *1*, and will default to *0*.
- `$blue` is a number between *0* and *1*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromSrgbLinear($red, $green, $blue, $alpha);
```

**Create From Xyz D50**

- `$x` is a number between *0* and *1*, and will default to *0*.
- `$y` is a number between *0* and *1*, and will default to *0*.
- `$z` is a number between *0* and *1*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromXyzD50($x, $y, $z, $alpha);
```

**Create From Xyz D65**

- `$x` is a number between *0* and *1*, and will default to *0*.
- `$y` is a number between *0* and *1*, and will default to *0*.
- `$z` is a number between *0* and *1*, and will default to *0*.
- `$alpha` is a number between *0* and *1*, and will default to *1*.

```php
$color = Color::createFromXyzD65($x, $y, $z, $alpha);
```


## Colors

**Contrast**

Calculate the contrast between this and another Color.

- `$other` is a *Color*.

```php
$contrast = $color->contrast($other);
```

**Get Alpha**

Get the alpha value.

```php
$alpha = $color->getAlpha();
```

**Label**

Find the closest HTML color name for this color (in current color space).

```php
$label = $color->label();
```

**Luma**

Calculate the relative luminance value.

```php
$luma = $color->luma();
```

**Space**

Get the current color space.

```php
$space = $color->space();
```

**To**

Convert the *Color* to a named color space.

- `$space` is a string representing the color space, and must be one of either "*a98-rgb*", "*display-p3*", "*display-p3-linear*", "*hex*", "*hsl*", "hwb**", "*lab*", "*lch*", "*oklab*", "*oklch*", "*prophoto-rgb*", "*rec2020*", "*rgb*", "*srgb*", "*srgb-linear*", "*xyz-d50*" or "*xyz-d65*".

```php
$newColor = $color->to($space);
```

**To A98 RGB**

Convert the *Color* to [*A98Rgb*](#a98-rgb).

```php
$newColor = $color->toA98Rgb();
```

**To Array**

Get the color components as an array.

```php
$data = $color->toArray();
```

**To Display P3**

Convert the *Color* to [*DisplayP3*](#display-p3).

```php
$newColor = $color->toDisplayP3();
```

**To Display P3 Linear**

Convert the *Color* to [*DisplayP3Linear*](#display-p3-linear).

```php
$newColor = $color->toDisplayP3Linear();
```

**To Hex**

Convert the *Color* to [*Hex*](#hex).

```php
$newColor = $color->toHex();
```

**To HSL**

Convert the *Color* to [*Hsl*](#hsl).

```php
$newColor = $color->toHsl();
```

**To HWB**

Convert the *Color* to [*Hwb*](#hwb).

```php
$newColor = $color->toHwb();
```

**To Lab**

Convert the *Color* to [*Lab*](#lab).

```php
$newColor = $color->toLab();
```

**To Lch**

Convert the *Color* to [*Lch*](#lch).

```php
$newColor = $color->toLch();
```

**To OkLab**

Convert the *Color* to [*OkLab*](#oklab).

```php
$newColor = $color->toOkLab();
```

**To OkLch**

Convert the *Color* to [*OkLch*](#oklch).

```php
$newColor = $color->toOkLch();
```

**To ProPhoto Rgb**

Convert the *Color* to [*ProPhotoRgb*](#prophoto-rgb).

```php
$newColor = $color->toProPhotoRgb();
```

**To Rec 2020**

Convert the *Color* to [*Rec2020*](#rec2020).

```php
$newColor = $color->toRec2020();
```

**To Rgb**

Convert the *Color* to [*Rgb*](#rgb).

```php
$newColor = $color->toRgb();
```

**To Srgb**

Convert the *Color* to [*Srgb*](#srgb).

```php
$newColor = $color->toSrgb();
```

**To Srgb Linear**

Convert the *Color* to [*SrgbLinear*](#srgb-linear).

```php
$newColor = $color->toSrgbLinear();
```

**To String**

Get the CSS color string.

- `$alpha` is a boolean indicating whether to include the alpha component in the string, and will default to *null*.
- `$precision` is a number representing the decimal precision, and will default to *2*.

```php
$colorString = $color->toString($alpha, $precision);
```

**To Xyz D50**

Convert the *Color* to [*XyzD50*](#xyz-d50).

```php
$newColor = $color->toXyzD50();
```

**To Xyz D65**

Convert the *Color* to [*XyzD65*](#xyz-d65).

```php
$newColor = $color->toXyzD65();
```

**With Alpha**

Clone the *Color* with a new alpha value.

- `$alpha` is a number between *0* and *1*.

```php
$newColor = $color->withAlpha($alpha);
```


### A98 RGB

```php
use Fyre\Color\Colors\A98Rgb;
```

**Get Blue**

Get the blue value.

```php
$blue = $color->getBlue();
```

**Get Green**

Get the green value.

```php
$green = $color->getGreen();
```

**Get Red**

Get the red value.

```php
$red = $color->getRed();
```

**With Blue**

Clone the *Color* with a new blue value.

- `$blue` is a number between *0* and *1*.

```php
$newColor = $color->withBlue($blue);
```

**With Green**

Clone the *Color* with a new green value.

- `$green` is a number between *0* and *1*.

```php
$newColor = $color->withGreen($green);
```

**With Red**

Clone the *Color* with a new red value.

- `$red` is a number between *0* and *1*.

```php
$newColor = $color->withRed($red);
```


### Display P3

```php
use Fyre\Color\Colors\DisplayP3;
```

**Get Blue**

Get the blue value.

```php
$blue = $color->getBlue();
```

**Get Green**

Get the green value.

```php
$green = $color->getGreen();
```

**Get Red**

Get the red value.

```php
$red = $color->getRed();
```

**With Blue**

Clone the *Color* with a new blue value.

- `$blue` is a number between *0* and *1*.

```php
$newColor = $color->withBlue($blue);
```

**With Green**

Clone the *Color* with a new green value.

- `$green` is a number between *0* and *1*.

```php
$newColor = $color->withGreen($green);
```

**With Red**

Clone the *Color* with a new red value.

- `$red` is a number between *0* and *1*.

```php
$newColor = $color->withRed($red);
```


### Display P3 Linear

```php
use Fyre\Color\Colors\DisplayP3Linear;
```

**Get Blue**

Get the blue value.

```php
$blue = $color->getBlue();
```

**Get Green**

Get the green value.

```php
$green = $color->getGreen();
```

**Get Red**

Get the red value.

```php
$red = $color->getRed();
```

**With Blue**

Clone the *Color* with a new blue value.

- `$blue` is a number between *0* and *1*.

```php
$newColor = $color->withBlue($blue);
```

**With Green**

Clone the *Color* with a new green value.

- `$green` is a number between *0* and *1*.

```php
$newColor = $color->withGreen($green);
```

**With Red**

Clone the *Color* with a new red value.

- `$red` is a number between *0* and *1*.

```php
$newColor = $color->withRed($red);
```


### Hex

```php
use Fyre\Color\Colors\Hex;
```

**Get Blue**

Get the blue value.

```php
$blue = $color->getBlue();
```

**Get Green**

Get the green value.

```php
$green = $color->getGreen();
```

**Get Red**

Get the red value.

```php
$red = $color->getRed();
```

**To String**

Get the CSS color string.

- `$alpha` is a boolean indicating whether to include the alpha component in the string, and will default to *null*.
- `$precision` is a number representing the decimal precision, and will default to *2* (unused).
- `$shortenHex` is a boolean indicating whether shorten hex output, and will default to *true*.
- `$name` is a boolean indicating whether to use CSS color names, and will default to *false*.

```php
$colorString = $color->toString($alpha, $precision, $shortenHex, $name);
```

**With Blue**

Clone the *Color* with a new blue value.

- `$blue` is a number between *0* and *255*.

```php
$newColor = $color->withBlue($blue);
```

**With Green**

Clone the *Color* with a new green value.

- `$green` is a number between *0* and *255*.

```php
$newColor = $color->withGreen($green);
```

**With Red**

Clone the *Color* with a new red value.

- `$red` is a number between *0* and *255*.

```php
$newColor = $color->withRed($red);
```


### Hsl

```php
use Fyre\Color\Colors\Hsl;
```

**Get Hue**

Get the hue value.

```php
$hue = $color->getHue();
```

**Get Lightness**

Get the lightness value.

```php
$lightness = $color->getLightness();
```

**Get Saturation**

Get the saturation value.

```php
$saturation = $color->getSaturation();
```

**With Hue**

Clone the *Color* with a new hue value.

- `$hue` is a number between *0* and *360*.

```php
$newColor = $color->withHue($hue);
```

**With Lightness**

Clone the *Color* with a new lightness value.

- `$lightness` is a number between *0* and *100*.

```php
$newColor = $color->withLightness($lightness);
```

**With Saturation**

Clone the *Color* with a new saturation value.

- `$saturation` is a number between *0* and *100*.

```php
$newColor = $color->withSaturation($saturation);
```


### Hwb

```php
use Fyre\Color\Colors\Hwb;
```

**Get Blackness**

Get the blackness value.

```php
$blackness = $color->getBlackness();
```

**Get Hue**

Get the hue value.

```php
$hue = $color->getHue();
```

**Get Whiteness**

Get the whiteness value.

```php
$whiteness = $color->getWhiteness();
```

**With Blackness**

Clone the *Color* with a new blackness value.

- `$blackness` is a number between *0* and *100*.

```php
$newColor = $color->withBlackness($blackness);
```

**With Hue**

Clone the *Color* with a new hue value.

- `$hue` is a number between *0* and *360*.

```php
$newColor = $color->withHue($hue);
```

**With Whiteness**

Clone the *Color* with a new whiteness value.

- `$whiteness` is a number between *0* and *100*.

```php
$newColor = $color->withWhiteness($whiteness);
```


### Lab

```php
use Fyre\Color\Colors\Lab;
```

**Get A**

Get the a value.

```php
$a = $color->getA();
```

**Get B**

Get the b value.

```php
$b = $color->getB();
```

**Get Lightness**

Get the lightness value.

```php
$lightness = $color->getLightness();
```

**With A**

Clone the *Color* with a new a value.

- `$a` is a number between *-128* and *127*.

```php
$newColor = $color->withA($a);
```

**With B**

- `$b` is a number between *-128* and *127*.

```php
$newColor = $color->withB($b);
```

**With Lightness**

Clone the *Color* with a new lightness value.

- `$lightness` is a number between *0* and *100*.

```php
$newColor = $color->withLightness($lightness);
```


### Lch

```php
use Fyre\Color\Colors\Lch;
```

**Get Chroma**

Get the chroma value.

```php
$chroma = $color->getChroma();
```

**Get Hue**

Get the hue value.

```php
$hue = $color->getHue();
```

**Get Lightness**

Get the lightness value.

```php
$lightness = $color->getLightness();
```

**With Chroma**

Clone the *Color* with a new chroma value.

- `$chroma` is a number between *0* and *230*.

```php
$newColor = $color->withChroma($chroma);
```

**With Hue**

Clone the *Color* with a new hue value.

- `$hue` is a number between *0* and *360*.

```php
$newColor = $color->withHue($hue);
```

**With Lightness**

Clone the *Color* with a new lightness value.

- `$lightness` is a number between *0* and *100*.

```php
$newColor = $color->withLightness($lightness);
```


### OkLab

```php
use Fyre\Color\Colors\OkLab;
```

**Get A**

Get the a value.

```php
$a = $color->getA();
```

**Get B**

Get the b value.

```php
$b = $color->getB();
```

**Get Lightness**

Get the lightness value.

```php
$lightness = $color->getLightness();
```

**With A**

Clone the *Color* with a new a value.

- `$a` is a number between *-0.4* and *0.4*.

```php
$newColor = $color->withA($a);
```

**With B**

- `$b` is a number between *-0.4* and *0.4*.

```php
$newColor = $color->withB($b);
```

**With Lightness**

Clone the *Color* with a new lightness value.

- `$lightness` is a number between *0* and *1*.

```php
$newColor = $color->withLightness($lightness);
```


### OkLch

```php
use Fyre\Color\Colors\OkLch;
```

**Get Chroma**

Get the chroma value.

```php
$chroma = $color->getChroma();
```

**Get Hue**

Get the hue value.

```php
$hue = $color->getHue();
```

**Get Lightness**

Get the lightness value.

```php
$lightness = $color->getLightness();
```

**With Chroma**

Clone the *Color* with a new chroma value.

- `$chroma` is a number between *0* and *0.4*.

```php
$newColor = $color->withChroma($chroma);
```

**With Hue**

Clone the *Color* with a new hue value.

- `$hue` is a number between *0* and *360*.

```php
$newColor = $color->withHue($hue);
```

**With Lightness**

Clone the *Color* with a new lightness value.

- `$lightness` is a number between *0* and *1*.

```php
$newColor = $color->withLightness($lightness);
```


### ProPhoto Rgb

```php
use Fyre\Color\Colors\ProPhotoRgb;
```

**Get Blue**

Get the blue value.

```php
$blue = $color->getBlue();
```

**Get Green**

Get the green value.

```php
$green = $color->getGreen();
```

**Get Red**

Get the red value.

```php
$red = $color->getRed();
```

**With Blue**

Clone the *Color* with a new blue value.

- `$blue` is a number between *0* and *1*.

```php
$newColor = $color->withBlue($blue);
```

**With Green**

Clone the *Color* with a new green value.

- `$green` is a number between *0* and *1*.

```php
$newColor = $color->withGreen($green);
```

**With Red**

Clone the *Color* with a new red value.

- `$red` is a number between *0* and *1*.

```php
$newColor = $color->withRed($red);
```


### Rec2020

```php
use Fyre\Color\Colors\Rec2020;
```

**Get Blue**

Get the blue value.

```php
$blue = $color->getBlue();
```

**Get Green**

Get the green value.

```php
$green = $color->getGreen();
```

**Get Red**

Get the red value.

```php
$red = $color->getRed();
```

**With Blue**

Clone the *Color* with a new blue value.

- `$blue` is a number between *0* and *1*.

```php
$newColor = $color->withBlue($blue);
```

**With Green**

Clone the *Color* with a new green value.

- `$green` is a number between *0* and *1*.

```php
$newColor = $color->withGreen($green);
```

**With Red**

Clone the *Color* with a new red value.

- `$red` is a number between *0* and *1*.

```php
$newColor = $color->withRed($red);
```


### Rgb

```php
use Fyre\Color\Colors\Rgb;
```

**Get Blue**

Get the blue value.

```php
$blue = $color->getBlue();
```

**Get Green**

Get the green value.

```php
$green = $color->getGreen();
```

**Get Red**

Get the red value.

```php
$red = $color->getRed();
```

**To String**

Get the CSS color string.

- `$alpha` is a boolean indicating whether to include the alpha component in the string, and will default to *null*.
- `$precision` is a number representing the decimal precision, and will default to *2*.
- `$name` is a boolean indicating whether to use CSS color names, and will default to *false*.

```php
$colorString = $color->toString($alpha, $precision, $name);
```

**With Blue**

Clone the *Color* with a new blue value.

- `$blue` is a number between *0* and *255*.

```php
$newColor = $color->withBlue($blue);
```

**With Green**

Clone the *Color* with a new green value.

- `$green` is a number between *0* and *255*.

```php
$newColor = $color->withGreen($green);
```

**With Red**

Clone the *Color* with a new red value.

- `$red` is a number between *0* and *255*.

```php
$newColor = $color->withRed($red);
```


### Srgb

```php
use Fyre\Color\Colors\Srgb;
```

**Get Blue**

Get the blue value.

```php
$blue = $color->getBlue();
```

**Get Green**

Get the green value.

```php
$green = $color->getGreen();
```

**Get Red**

Get the red value.

```php
$red = $color->getRed();
```

**With Blue**

Clone the *Color* with a new blue value.

- `$blue` is a number between *0* and *1*.

```php
$newColor = $color->withBlue($blue);
```

**With Green**

Clone the *Color* with a new green value.

- `$green` is a number between *0* and *1*.

```php
$newColor = $color->withGreen($green);
```

**With Red**

Clone the *Color* with a new red value.

- `$red` is a number between *0* and *1*.

```php
$newColor = $color->withRed($red);
```


### Srgb Linear

```php
use Fyre\Color\Colors\SrgbLinear;
```

**Get Blue**

Get the blue value.

```php
$blue = $color->getBlue();
```

**Get Green**

Get the green value.

```php
$green = $color->getGreen();
```

**Get Red**

Get the red value.

```php
$red = $color->getRed();
```

**With Blue**

Clone the *Color* with a new blue value.

- `$blue` is a number between *0* and *1*.

```php
$newColor = $color->withBlue($blue);
```

**With Green**

Clone the *Color* with a new green value.

- `$green` is a number between *0* and *1*.

```php
$newColor = $color->withGreen($green);
```

**With Red**

Clone the *Color* with a new red value.

- `$red` is a number between *0* and *1*.

```php
$newColor = $color->withRed($red);
```


### Xyz D50

```php
use Fyre\Color\Colors\XyzD50;
```

**Get X**

Get the x value.

```php
$x = $color->getX();
```

**Get Y**

Get the y value.

```php
$y = $color->getY();
```

**Get Z**

Get the z value.

```php
$z = $color->getZ();
```

**With X**

Clone the *Color* with a new x value.

- `$x` is a number between *0* and *1*.

```php
$newColor = $color->withX($x);
```

**With Y**

Clone the *Color* with a new y value.

- `$y` is a number between *0* and *1*.

```php
$newColor = $color->withY($y);
```

**With Z**

Clone the *Color* with a new z value.

- `$z` is a number between *0* and *1*.

```php
$newColor = $color->withZ($z);
```


### Xyz D65

```php
use Fyre\Color\Colors\XyzD65;
```

**Get X**

Get the x value.

```php
$x = $color->getX();
```

**Get Y**

Get the y value.

```php
$y = $color->getY();
```

**Get Z**

Get the z value.

```php
$z = $color->getZ();
```

**With X**

Clone the *Color* with a new x value.

- `$x` is a number between *0* and *1*.

```php
$newColor = $color->withX($x);
```

**With Y**

Clone the *Color* with a new y value.

- `$y` is a number between *0* and *1*.

```php
$newColor = $color->withY($y);
```

**With Z**

Clone the *Color* with a new z value.

- `$z` is a number between *0* and *1*.

```php
$newColor = $color->withZ($z);
```