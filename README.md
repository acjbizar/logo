# Logo

[My logo](https://acjs.net/logo/), [delogo van ACJ](https://deidee.nl/acj).

## Base

```binary
01110 01111
10001 10000
11111 10000
10001 10000
10001 01111

00000 01111
00000 00001
00000 00001
00000 10001
00000 01110
```

## Installation

```shell
composer require acj/logo
```

## Usage

```php
$logo = new Acj\Logo;
$logo->parse();
```

(To parse the logo inline (without XML declaration), just echo ``$logo``.)

## Example

![Logo.](https://acjs.net/kabk/eindexamen/GODekkerACJ2.png)