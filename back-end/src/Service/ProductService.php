<?php
namespace App\Service;

use App\Model\Product;

class ProductService
{
    private array $products = [];
    private $dataFile = __DIR__ . '/products.json';

    public function __construct()
    {
        if (!file_exists($this->dataFile)) {
            $this->saveProducts([
                1 => new Product(1, 'Laptop', 699, 'A Laptop'),
                2 => new Product(2, 'Smartphone', 785, 'A Smartphone'),
                3 => new Product(3, 'Watch', 89.90, 'A Watch'),
                4 => new Product(4, 'Headset', 19.99, 'A Headset',),
                5 => new Product(5, 'Keyboard', 10, 'A Keyboard'),
            ]);
        }
    }

    public function getAll(): array
    {
        return array_values($this->loadProducts());
    }

    public function find(int $id): ?Product
    {
        return $this->loadProducts()[$id] ?? null;
    }

    public function create(array $data): Product
    {
        $products = $this->loadProducts();

        // Create the ID based on the current stored values
        $id = empty($products) ? 1 : max(array_keys($products)) + 1;

        $product = new Product($id, $data['name'], $data['price'], $data['description'] ?? null);
        $products[$id] = $product;

        $this->saveProducts($products);

        return $product;
    }

    public function update(int $id, array $data): ?Product
    {
        $products = $this->loadProducts();

        if (!isset($products[$id])) {
            return null;
        }

        $product = $products[$id];

        $product->name = $data['name'] ?? $product->name;
        $product->price = $data['price'] ?? $product->price;
        $product->description = $data['description'] ?? $product->description;

        $products[$id] = $product;
        $this->saveProducts($products);

        return $product;
    }

    public function delete(int $id): bool
    {
        $products = $this->loadProducts();

        if (!isset($products[$id])) {
            return false;
        }

        unset($products[$id]);
        $this->saveProducts($products);

        return true;
    }

    //Methods to load and persist data

    private function loadProducts(): array
    {
        $json = file_get_contents($this->dataFile);
        $array = json_decode($json, true);
        $products = [];

        foreach ($array as $item) {
            $products[$item['id']] = new Product(
                $item['id'],
                $item['name'],
                $item['price'],
                $item['description'] ?? null
            );
        }

        return $products;
    }

    private function saveProducts(array $products): void
    {
        file_put_contents(
            $this->dataFile,
            json_encode(array_values($products), JSON_PRETTY_PRINT)
        );
    }
}