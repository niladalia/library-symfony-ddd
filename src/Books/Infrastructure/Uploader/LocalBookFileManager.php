<?php

namespace App\Books\Infrastructure\Uploader;

use App\Books\Domain\BookFileManagerInterface;
use League\Flysystem\FilesystemOperator;

class LocalBookFileManager implements BookFileManagerInterface
{
    private $defaultStorage;

    public function __construct(FilesystemOperator $defaultStorage)
    {
        $this->defaultStorage = $defaultStorage;
    }

    public function upload(string $extension, string $filename, string $data): string
    {
        $finalName = "local_" . $filename;
        $this->defaultStorage->write($finalName, $data);
        return $finalName;
    }

    public function remove(string $filename): void
    {
        $this->defaultStorage->delete($filename);
    }
}
