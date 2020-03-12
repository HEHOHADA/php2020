<?php


class Validation
{
    private $password = null;
    private array $errors = [];

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function validate()
    {
        if (strlen($this->password) < 10) {
            array_push($this->errors, "Длина пароля не менее 10 символов");
        }
        $this->categoryValidate("[a-z]", "латинских прописных букв");
        $this->categoryValidate("[A-Z]", "латинских строчних букв");
        $this->categoryValidate("[0-9]", "цифр");
        $this->categoryValidate("[%$#_*]", "символов %$#_*");
        if (count($this->errors) !== 0) {
            echo "<div style='color:red'>{$this->errors[0]}</div>";
        }else{
            echo "Success";
        }
    }

    private function categoryValidate($category, $exception)
    {
        if (!preg_match("/.*$category.*$category.*/", $this->password)) {
            array_push($this->errors, "В пароле содержится менее 2 $exception");
        }

        if (preg_match("/.*$category{3,}.*/", $this->password)) {
            array_push($this->errors, "Пароль содержит более 3 $exception подряд");
        }

    }
}