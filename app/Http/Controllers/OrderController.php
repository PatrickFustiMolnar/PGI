<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer; 
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->filled('type')) {
            $query->where('order_type', $request->type);
        }

        $orders = $query->paginate(5);
        return view('pages.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::where('is_available', 1)->get();
        return view('pages.order.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_customer' => 'nullable|exists:customers,id',
            'order_type' => 'required|in:dinein,takeaway,reservation',
            'items' => 'required|array',
            'items.*.id_product' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'sub_total' => 'required|numeric',
            'tax' => 'required|numeric',
            'discount' => 'required|numeric',
            'service_charge' => 'required|numeric',
            'payment_amount' => 'required|numeric',
            'payment_method' => 'required|integer',
        ]);

        // Créer la commande
        $order = new Order();
        $order->id_customer = $request->id_customer;
        $order->order_type = $request->order_type;
        $order->sub_total = $request->sub_total;
        $order->tax = $request->tax;
        $order->discount = $request->discount;
        $order->service_charge = $request->service_charge;
        $order->total = $request->sub_total + $request->tax + $request->service_charge - $request->discount;
        $order->payment_amount = $request->payment_amount;
        $order->payment_method = $request->payment_method;
        $order->total_item = count($request->items);
        $order->transaction_time = now()->toDateTimeString();
        $order->status = 'pending'; // Statut initial
        $order->save();

        // Ajouter les articles
        foreach ($request->items as $item) {
            $orderItem = new OrderItem();
            $orderItem->id_order = $order->id;
            $orderItem->id_product = $item['id_product'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = Product::find($item['id_product'])->price * $item['quantity'];
            $orderItem->save();
        }

        return redirect()->route('order.index')->with('success', 'Commande créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('pages.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        return view('pages.order.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
    
        $request->validate([
            'id_customer' => 'nullable|exists:customers,id',
            'order_type' => 'required|in:dinein,takeaway,reservation',
            'status' => 'required|in:pending,completed,cancelled',
            'sub_total' => 'required|numeric',
            'tax' => 'required|numeric',
            'discount' => 'required|numeric',
            'service_charge' => 'required|numeric',
            'payment_amount' => 'required|numeric',
            'payment_method' => 'required|string|in:especes,carte',
        ]);
    
        $order->id_customer = $request->id_customer;
        $order->order_type = $request->order_type;
        $order->status = $request->status;
        $order->sub_total = $request->sub_total;
        $order->tax = $request->tax;
        $order->discount = $request->discount;
        $order->service_charge = $request->service_charge;
        $order->total = $request->sub_total + $request->tax + $request->service_charge - $request->discount;
        $order->payment_amount = $request->payment_amount;
        $order->payment_method = $request->payment_method;
    
        $order->save();
    
        return redirect()->route('order.index')->with('success', 'Commande mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->items()->delete(); // Supprime les articles associés
        $order->delete(); // Supprime la commande
        return redirect()->route('order.index')->with('success', 'Commande supprimée avec succès.');
    }
}