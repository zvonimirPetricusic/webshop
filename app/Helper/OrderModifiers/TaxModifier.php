<?php

namespace App\Helper\OrderModifiers;

class TaxModifier implements OrderModifierInterface
{
    protected $value;

    public function __construct(float $value){
        $this->value = $value;
    }

    public function apply(float $totalPrice): float{
        return $totalPrice + ($totalPrice * $this->value);
    }

    public function getType(): string{
        return 'tax';
    }

    public function getValue(): float{
        return $this->value;
    }
}