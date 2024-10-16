<?php

namespace App\Books\Application\UploadFile;

use App\Books\Domain\BookFileManagerInterface;

class BookFileUploader
{
    public function __construct(private BookFileManagerInterface $fileUploaderInterface) {}

    public function __invoke(string $base64data, string $aggregateId, string $title): string
    {
        $extension = explode('/', mime_content_type($base64data))[1];
        $data = explode(',', $base64data);
        $name = sprintf('%s.%s', 'book_' . $aggregateId . '_' . preg_replace('/\s+/', '_', $title), $extension);

        $filename = $this->fileUploaderInterface->upload($extension, $name, base64_decode($data[1]));

        return $filename;
    }
}
