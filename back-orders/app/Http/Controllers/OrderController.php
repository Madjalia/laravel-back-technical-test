<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    //List de toutes les commandes avec leurs produits
    public function index()
    {
        $orders = Order::with('items')->get();
        return response()->json($orders);
    }

    // Voir une commande 
    public function show(Order $order)
    {
        $order->load('items');
        return response()->json($order);
    }
// Créer une commande 
public function store(Request $request)
{
    $validatedData = $request->validate([
        'customer_name' => 'required|string',
        'customer_phone' => [
            'required',
            'digits:10',
            'numeric'
        ],
        'items' => 'required|array|min:1',
        'items.*.product_id' => 'required|integer',
        'items.*.product_name' => 'required|string',
        'items.*.unit' => 'required|string',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.unit_price' => 'required|integer|min:0',
        'items.*.product_img' => 'required|string|max:500',
    ]);

    // Calculer le total
    $total = 0;
    foreach ($request->items as $item) {
        $total += ($item['quantity'] * $item['unit_price']);
    }

    $order = Order::create([
        'customer_name' => $validatedData['customer_name'],
        'customer_phone' => $validatedData['customer_phone'],
        'total' => $total, 
    ]);

    // Créer items avec subtotal calculé
    foreach ($request->items as $item) {
        $order->items()->create([
            'product_id' => $item['product_id'],
            'product_name' => $item['product_name'],
            'unit' => $item['unit'],
            'quantity' => $item['quantity'],
            'unit_price' => $item['unit_price'],
            'subtotal' => $item['quantity'] * $item['unit_price'],
            'product_img' => $item['product_img'],
        ]);
    }

    return response()->json([
        'message' => 'Commande créée avec succès',
        'order' => $order->load('items'),
    ], 201);
}

// Modification d'une commande
    public function update(Request $request, Order $order)
    {
        // Validation : pas obligé de modifier tous les champs
        $validated = $request->validate([
            'customer_name' => 'sometimes|string',
            'customer_phone' => 'sometimes|digits:10',
            'total' => 'sometimes|integer',
            
            'items' => 'sometimes|array|min:1',
            'items.*.product_id' => 'required_with:items|integer',
            'items.*.product_name' => 'required_with:items|string',
            'items.*.unit' => 'required_with:items|string',
            'items.*.quantity' => 'required_with:items|integer',
            'items.*.unit_price' => 'required_with:items|integer',
            'items.*.subtotal' => 'required_with:items|integer',
            'items.*.product_img' => 'required_with:items|string|max:500',
        ]);

        // Mise à jour des champs simple
        $order->update($validated);

        // Si items envoyé faire mise à jour complète
        if ($request->has('items')) {
            $order->items()->delete();

            foreach ($request->items as $item) {
                $order->items()->create($item);
            }
        }

        return response()->json([
            'message' => 'Commande mise à jour',
            'order' => $order->load('items'),
        ]);
    }


 // Supprimer une commande
    public function destroy(Order $order)
    {
        $order->items()->delete(); // Supprimer les items
        $order->delete();           //  supprimer la commande

        return response()->json([
            'message' => 'Commande supprimée avec succès'
        ]);
    }
}
