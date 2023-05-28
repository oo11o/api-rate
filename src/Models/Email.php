<?php

namespace App\Models;

use App\Models\EmailInterface;
use Exception;

class Email implements EmailInterface
{
    private $filename;
    public function __construct($filename = null) {
        $this->filename = $filename ?? __DIR__ . '/../../storage/email.txt';
    }

    public function add(string $email): bool
    {
        $result = file_put_contents($this->filename, $email.PHP_EOL, FILE_APPEND | LOCK_EX);
        if ($result === false) {
            throw new Exception('Error Append to file');
        }

        return true;
    }

    public function getAll(): array
    {
        $emails = array();

        if (!file_exists($this->filename)) {
            throw new Exception('File not found: ' . $this->filename);
        }

        $file = fopen($this->filename, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $emails[] = trim($line);
            }
            fclose($file);
        } else {
            throw new Exception('File open error: ' .$this->filename);
        }

        return $emails;
    }

    public function isEmailExists(string $email): bool
    {
        $file = fopen($this->filename, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if ($line === $email) {
                    fclose($file);
                    return true;
                }
            }
            fclose($file);
        } else {
            throw new Exception('File open error: ' . $this->filename);
        }
        return false;
    }
}
