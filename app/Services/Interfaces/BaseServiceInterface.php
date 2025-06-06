<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseServiceInterface
{
    public function getAll(array $filters = []);
    public function get(string $id);
    public function store(array $data);
    public function update(array $data, string|Model $modelOrId);
    public function destroy(string $id);
}

