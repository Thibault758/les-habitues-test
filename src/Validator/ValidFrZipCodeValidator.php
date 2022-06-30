<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ValidFrZipCodeValidator extends ConstraintValidator
{
	public function validate($value, Constraint $constraint)
	{
		if (!$constraint instanceof ValidFrZipCode) {
			throw new UnexpectedTypeException($constraint, ValidFrZipCode::class);
		}

		if (!preg_match ("~^[0-9]{5}$~",$value)) {
			$this->context->buildViolation($constraint->message)
				->setParameter('{{ string }}', $value)
				->addViolation()
			;
		}
	}
}