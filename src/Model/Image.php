<?php

namespace App\Model;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Image
{
    /**
     * @var UploadedFile
     */
    private $file;
    /**
     * @var string
     */
    private $name;
    /**
     * @var integer
     */
    private $height;
    /**
     * @var integer
     */
    private $width;
    /**
     * @var string|null
     */
    private $path;

    /**
     * @return UploadedFile
     */
    public function getFile(): UploadedFile
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file): void
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return null|string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param null|string $path
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }
}