<?php
# src/AppBundle/Form/Validator/Constraint/PriceTypeUniqueValidator.php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class PriceTypeUniqueValidator extends ConstraintValidator
{
    public function validate($prices, Constraint $constraint)
    {
        if (!($prices instanceof PriceTypeUnique)) {
            throw new UnexpectedTypeException($constraint, ContainsAlphanumeric::class);
        }

        $pricesType = [];

        foreach ($prices as $price) {
            if (in_array($price->getType(), $pricesType)) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
                return; // Si il y a un doublon, on arrête la recherche
            } else {
                // Sauvegarde des types de prix déjà présents
                $pricesType[] = $price->getType();
            }
        }
    }
}