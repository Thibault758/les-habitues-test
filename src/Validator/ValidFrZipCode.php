<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ValidFrZipCode extends Constraint
{
	public $message = 'Wrong ZipCode format for "{{ string }}" value.';

	public function validatedBy()
	{
		return static::class.'Validator';
	}
}