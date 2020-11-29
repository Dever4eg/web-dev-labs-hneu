<?php

namespace src\Repository\Dto;

class ArticleCreateDto
{
    private ?string $title = '';
    private ?string $text = '';
    private ?string $image_url = '';

    public function __construct(?string $title, ?string  $text, ?string $image_url)
    {
        $this->title = $title;
        $this->text = $text;
        $this->image_url = $image_url;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): void
    {
        $this->image_url = $image_url;
    }
}
