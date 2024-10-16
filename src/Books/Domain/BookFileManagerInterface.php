<?php

namespace App\Books\Domain;

interface BookFileManagerInterface
{
    public function upload(string $extension, string $filename, string $data);

    public function remove(string $filename);
}
