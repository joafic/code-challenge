<?php

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api/product')]
final class ProductController extends AbstractController{

    public function __construct(private ProductService $productService) {}

    #[Route('', methods: ['GET'], name: 'app_api_product')]
    public function index(): JsonResponse
    {
        return $this->json($this->productService->getAll(), 200);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function findById(int $id): JsonResponse
    {
        $product = $this->productService->find($id);
        return $product
            ? $this->json($product, 200)
            : $this->json(['error' => 'Product not found!'], 404);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['name'], $data['price'])) {
            return $this->json(['error' => 'Missing product name or price'], 400);
        }

        $product = $this->productService->create($data);
        return $this->json($product, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->json(['error' => 'Invalid JSON'], 400);
        }

        $product = $this->productService->update($id, $data);

        return $product
            ? $this->json($product, 200)
            : $this->json(['error' => 'Product not found'], 404);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $deleted = $this->productService->delete($id);

        return $deleted
            ? new JsonResponse(null, 204)
            : $this->json(['error' => 'Product not found'], 404);
    }
}
