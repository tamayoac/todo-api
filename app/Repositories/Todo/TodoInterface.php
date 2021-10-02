<?php
namespace App\Repositories\Todo;

interface TodoInterface
{
    public function getAll($user);

    public function getById($user, $todo);

    public function create(array $attributes, $user);

    public function update(array $attributes, $user, $todo);

    public function delete($user, $todo);
}