<?php

namespace App\Shared\Application;

use App\Books\Domain\BookFileManagerInterface;

class DeleteFile
{
    private $fileUploaderInterface;

    public function __construct(BookFileManagerInterface $fileUploaderInterface)
    {
        $this->fileUploaderInterface = $fileUploaderInterface;
    }

    public function __invoke(string $filename)
    {
        $this->fileUploaderInterface->remove($filename);
    }
}
