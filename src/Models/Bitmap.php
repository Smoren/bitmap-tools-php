<?php

namespace Smoren\BitmapTools\Models;

use Smoren\BitmapTools\Interfaces\BitmapInterface;

/**
 * Bitmap class
 * @author <ofigate@gmail.com> Smoren
 */
class Bitmap implements BitmapInterface
{
    /**
     * @var int bitmap value
     */
    protected int $value;

    /**
     * @inheritDoc
     */
    public static function create($value): BitmapInterface
    {
        if(is_array($value)) {
            return static::createFromArray($value);
        }
        if($value instanceof BitmapInterface) {
            return new static($value->getValue());
        }
        return new static($value);
    }

    /**
     * @inheritDoc
     */
    public static function createFromArray(array $bits): BitmapInterface
    {
        $value = 0;
        foreach($bits as $code) {
            $value += 2**$code;
        }
        return new static($value);
    }

    /**
     * Bitmap constructor.
     * @param int $value bitmap value
     */
    final public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @inheritDoc
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function intersectsWith(BitmapInterface $bitmap): bool
    {
        return ($this->getValue() & $bitmap->getValue()) !== 0;
    }

    /**
     * @inheritDoc
     */
    public function includes(BitmapInterface $bitmap): bool
    {
        return ($this->getValue() & $bitmap->getValue()) === $bitmap->getValue();
    }

    /**
     * @inheritDoc
     */
    public function hasBit(int $bitPosition): bool
    {
        return $this->intersectsWith(Bitmap::createFromArray([$bitPosition]));
    }

    /**
     * @inheritDoc
     */
    public function isEqualWith(BitmapInterface $bitmap): bool
    {
        return $this->getValue() === $bitmap->getValue();
    }

    /**
     * @inheritDoc
     */
    public function add(BitmapInterface $bitmap): BitmapInterface
    {
        return new static($this->getValue() | $bitmap->getValue());
    }

    /**
     * @inheritDoc
     */
    public function sub(BitmapInterface $bitmap): BitmapInterface
    {
        return new static($this->getValue() & (~$bitmap->getValue()));
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        $bitmap = $this->getValue();
        $result = [];
        $i = 0;

        while($bitmap) {
            if($bitmap % 2) {
                $result[] = $i;
            }

            $bitmap = (int)($bitmap / 2);
            ++$i;
        }

        return $result;
    }
}
