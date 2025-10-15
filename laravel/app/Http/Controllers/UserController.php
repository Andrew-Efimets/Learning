<?php

declare (strict_types=1);

namespace App\Http\Controllers;

class UserController
{
    private array $users = [
        ['id'=>1, 'name'=>'Alex'],
        ['id'=>2, 'name'=>'John'],
        ['id'=>3, 'name'=>'George'],
    ];

    public function getAll(): void
    {
        foreach ($this->users as $user) {
            echo implode(' ', $user) . ' | ';
        }
    }
}
