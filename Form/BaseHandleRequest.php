<?php

namespace Form;


class BaseHandleRequest
{
    private $errors;

    public function setEerrorsForm($errors)
    {
        $this->errors = $errors;
    }

    public function getEerrorsForm()
    {
        return $this->errors;
    }
    public function isValid()
    {
        $result = !empty($this->errors) ? false : true;
        return $result;
    }
    public function isSubmitted()
    {
        $result = empty($_POST) ? false : true;
        return $result;
    }
}