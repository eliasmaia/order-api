<?php

namespace App\Http\Controllers\Api;

use App\Core\Application\UseCases\CreateOrderUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use InvalidArgumentException;

class OrderController extends Controller
{
    public function store(Request $request,  CreateOrderUseCase $useCase): JsonResponse
    {
        $request->validate([
            'customer_email'    =>  'required|email',
            'total_amount'      =>  'required|numeric'
        ]);

        try {
            $order = $useCase->execute(
                $request->input('customer_email'),
                (float) $request->input('total_amount')
            );
        

            return response()->json([
                'id'                => $order->getId(),
                'customer_email'    => $order->getCustomerEmail(),
                'total_amount'      => $order->getTotalAmount(),
                'status'            => $order->getStatus(),
                'created_at'        => $order->getCreatedAt()->format('Y-m-d H:i-s'),    
            ], 201);
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
