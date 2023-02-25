<?php

namespace App\Contracts;

interface TextSourceInterface
{
    public function getText(): string|null;
}
