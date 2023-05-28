<?php

namespace App\Models;

interface EmailInterface
{
    public function add(string $email): bool;
    public function getAll(): array;
    public function isEmailExists(string $email): bool;
}
