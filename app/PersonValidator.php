<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

class PersonValidator {

    public static function validate($data, $rules) {
        if (empty($rules)) {
            return true;
        }

        $errors = [];
        $unique = [];


        foreach ($rules as $elementName => $elemtRules) {
            if (!isset($data[$elementName])) {
                throw new Exception('Invalid authentication rule ' . $data[$elementName] . '!');
            }

            $element = $data[$elementName];
            foreach ($elemtRules as $validationMethod => $ruleValue) {
                if (self::$validationMethod($element, $ruleValue, $elementName) !== true) {
                    array_push($errors, self::$validationMethod($element, $ruleValue, $elementName));
                   $unique = array_unique($errors);
                }
            }
        }
        return $unique;
    }

    public static function required($element, $rule, $elementName) {
        if ($element && $rule == 1) {
            return true;
        }
        return $elementName . ' field is required';
    }

    public static function size($element, $rule, $elementName) {
        if (strlen($element) > $rule) {
            return 'Maximum-size for ' . $elementName . ' passed!';
        }
        return true;
    }

    public static function numbersOnly($element, $rule, $elementName) {
        if (($rule == false) || ($rule == true && is_numeric($element))) {
            return true;
        }
        return $elementName . ' field must contain numbers only!';
    }
    
    public static function checkEmail($element, $rule, $elementName) {
            if (filter_var($element, FILTER_VALIDATE_EMAIL)) {
                return true;
            }
        return $elementName . ' seems wrong!';
    }

}
