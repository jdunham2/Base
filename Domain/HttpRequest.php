<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 4/23/18
 * Time: 7:31 PM
 */

namespace Domain;


use App\Core\Database\Collection;

class HttpRequest extends Collection
{
    public $validation_errors;

    protected $items;

    private $invalidInputs;
    private $validInputs;

    public function __construct($request)
    {
        $this->items = $request;
    }

    public function validate(Array $toValidate, $redirect_if_errors = true)
    {
        foreach ($toValidate as $input => $rulesToApply) {
            $rules = $this->getValidators($rulesToApply);

            if ($error = $this->validateRules($input, $rules)->all()) {
                $this->addInvalidInputs($error);
            } else {
                $this->addValidInput($input);
            }
        }

        $this->setValidationErrors();
        $this->cleanup();

        if ($this->validation_errors && $redirect_if_errors)
            $this->redirectWithErrors();
    }

    private function validateRules($input, $rules)
    {
        $all_errors = $rules->reduce(function ($errors, $validator) use ($input) {
            $item = isset($this->items[$input]) ? $this->items[$input] : null;

            if (!$validator->isValid($item))
                $errors[$input][] = $validator->getInvalidMessage();

            return $errors;
        });

        return $all_errors;
    }

    private function getValidators($rules)
    {
        $rules = collect(explode('|', $rules));

        return $rules->map(function ($rule) {
            $rule_parts = explode(":", $rule);
            $rule_class = "\\Domain\\HttpValidation\\" .
                str_replace(' ', '', ucwords(implode(' ',explode('_', $rule_parts[0]))))
            . "Validator";

            return new $rule_class(isset($rule_parts[1]) ? $rule_parts[1]: null);
        });
    }

    private function addInvalidInputs($input_errors)
    {
        foreach ($input_errors as $input => $errors) {
            $this->invalidInputs[$input] = $errors;
            $this->invalidInputs[$input]['value'] = isset($_REQUEST[$input]) ? $_REQUEST[$input] : null;
            $this->items[$input] = null;
        }
    }

    private function addValidInput($input_name)
    {
        $this->items[$input_name] = $this->validInputs[$input_name] = htmlentities($this->items[$input_name]);
    }

    private function setValidationErrors()
    {
        if (empty($this->invalidInputs))
            return;

        foreach ($this->invalidInputs as $input => $errors) {
            if (in_array('is required', $errors) && empty($errors['value'])){
                $this->validation_errors[$input] = $errors;
                continue;
            }

            if (!empty($errors['value'])) {
                $this->validation_errors[$input] = $errors;
            }
        }
    }

    private function redirectWithErrors()
    {
        dd($_SERVER['HTTP_REFERER']);
    }

    private function cleanup()
    {
        unset($this->invalidInputs);
        unset($this->validInputs);
    }
}