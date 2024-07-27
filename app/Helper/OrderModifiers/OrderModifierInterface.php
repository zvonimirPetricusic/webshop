<?php

namespace App\Helper\OrderModifiers;

interface OrderModifierInterface
{
    public function apply(float $totalPrice): float;
    public function getType(): string;
    public function getValue(): float;
}
