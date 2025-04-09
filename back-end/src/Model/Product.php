<?php

namespace App\Model;

class Product implements \JsonSerializable
{
    public int $id;
    public string $name;
    public float $price;
    public ?string $description;

    public function __construct(int $id, string $name, float $price, ?string $description = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }
    function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
        ];
    }
}