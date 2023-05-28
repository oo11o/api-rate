<?php

namespace App\Models;

class EmailRepository
{
    private $email;
    public function __construct(EmailInterface $email)
    {
        $this->email = $email;
    }
    public function addEmail($email)
    {
        if ($this->email->isEmailExists($email)) {
            return false;
        }
        return $this->email->add($email);
    }

    public function getAllEmail(): array
    {
        return $this->email->getAll();
    }
}
