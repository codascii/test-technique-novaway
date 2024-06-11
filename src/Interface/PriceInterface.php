<?php

namespace App\Interface;

interface PriceInterface
{
    /**
     * Retourne le prix.
     */
    public function getPrice(): ?float;
}
