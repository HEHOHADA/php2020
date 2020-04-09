<?php


class Network
{
    private string $address;
    private ?string $ping = null;
    private $trace = null;
    private ?string $format;
    private int $numberOfPackets = 5;
    private int $milliseconds = 1;
    private int $numberOfJumps = 5;

    public function __construct($address, $ping, $trace = null)
    {
        if (!isset($trace)) {
            $this->format = $ping === "ping" ? "ping" : "trace";
        }

        $this->address = $address;
        $this->ping = $ping;
        $this->trace = $trace;
    }


    public function run()
    {
        echo "<b>" . $this->address . "</b></br>";
        if (isset($this->format)) {
            $this->format === "ping" ? $this->ping() : $this->trace();
        } else {
            $this->ping();
            $this->trace();
        }
    }


    private function ping()
    {
        try {
            $command = "ping -n $this->numberOfPackets $this->address";
            $command = escapeshellcmd($command);
            exec($command, $array);
            if (!preg_match("/[0-9]{1,3}\%/", implode(" ", $array), $percent)) {
                echo "Сбой в ping";
                return;
            }
            preg_match("/[0-9]{1,3}/", $percent[0], $percentNumber);
            $percent = (100 - floatval($percentNumber[0])) . "%";
            echo "PING </br>";
            echo $percent;
            echo "</br>";
        } catch (Exception $e) {
            echo $e;
        }

    }


    private function trace()
    {
        try {
            $command = "tracert -w $this->milliseconds -h $this->numberOfJumps $this->address";
            $cmd = escapeshellcmd($command);
            exec($cmd, $array);
            if (!preg_match_all("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", implode(" ", $array), $ip)) {
                echo "Сбой в trace";
                return;
            }
            echo "TRACE </br>";
            foreach ($ip[0] as $value) {
                echo $value . " ";
            }
        } catch (Exception $e) {
            echo $e;
        }

    }

}