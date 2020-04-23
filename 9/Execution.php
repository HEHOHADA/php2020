<?php


class Execution
{
    private $format;
    private $file;
    private $text;
    private Logger $logger;
    private $check = false;

    public function __construct($log, $format, $text, $file = null)
    {
        $this->file = $file;
        $this->text = $text;
        if ($log === 'file') {
            $this->logger = new FileLogger($this->file);
        } else $this->logger = new BrowserLogger();
        switch ($format) {
            case "1":
                $this->format = $this->logger->time_year;
                break;
            case "2":
                $this->format = $this->logger->time;
                break;
            case "3":
                $this->format = $this->logger->without;
                break;
        }
    }

    public function run()
    {
        foreach (explode("\n", $this->text) as $line) {
            for ($i = 0; $i < strlen($line); $i++) {
                if (ctype_upper($line[$i])) {
                    $this->check = true;
                    break;
                }
            }$symb = $this->check ? ' ' : ' не ';
            $this->logger->print("Строка $line $symb содержит заглавные буквы", $this->format);
        }

    }
}
