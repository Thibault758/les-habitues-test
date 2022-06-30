<?php

namespace App\Validator;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class EntityValidator
{
	protected $validator;

	public function __construct(ValidatorInterface $validator)
	{
		$this->validator = $validator;
	}

	public function validate(Object $entity)
	{
		$errors = $this->validator->validate($entity);
		if (count($errors) > 0) {
			$errorsString = (string) $errors;
			Throw new \Exception($errorsString);
		}
	}
}