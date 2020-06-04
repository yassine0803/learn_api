<?php
# src/Validator/Constraint/PriceTypeUnique.php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PriceTypeUnique extends Constraint
{
    public $message = 'A place cannot contain prices with same type';
}