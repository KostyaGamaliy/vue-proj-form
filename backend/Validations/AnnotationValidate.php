<?php

	namespace Validations;

	class AnnotationValidate extends Validation
	{
		public function validate($value): ?string
		{
			if (strlen($value) > 500) {
				return "Поле аннотация не должно превышать 500 символов";
			} else {
				return null;
			}
		}
	}