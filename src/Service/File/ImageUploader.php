<?php

namespace App\Service\File;

use App\Model\Image;
;

use Imagine\Image\Box;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;

class ImageUploader
{
    /**
     * @var string
     */
    private $uploadDir;
    /**
     * @var string
     */
    private $rootDir;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * FileUploader constructor.
     * @param string $uploadDir
     * @param string $rootDir
     * @param LoggerInterface $logger
     */
    public function __construct(string $uploadDir, string $rootDir, LoggerInterface $logger)
    {
        $this->uploadDir = $uploadDir;
        $this->rootDir = $rootDir;
        $this->logger = $logger;
    }

    /**
     * @param Image $image
     * @return Image|null
     */
    public function upload(Image $image): ?Image
    {
        $file = $image->getFile();
        $uploadedFileSize = $file->getClientSize();
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $path = sprintf('%s/../public%s', $this->rootDir, $this->uploadDir);
        try {
            $file->move($path, $fileName);
//            $imagine = new \Imagine\Imagick\Imagine();
//            $resizedImage = $imagine->open(sprintf('%s/%s', $path, $fileName));
//            $resizedImage->resize(new Box($image->getWidth(), $image->getHeight()));
//            $resizedImage->save(sprintf('%s/%s', $path, $fileName));
            $image->setPath(sprintf('%s/%s', $this->uploadDir, $fileName));
            $this->logger->info(sprintf('File Uploaded! Size: %d, Name: %s', $uploadedFileSize, $fileName));
        } catch (UploadException $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
        return $image;
    }
}