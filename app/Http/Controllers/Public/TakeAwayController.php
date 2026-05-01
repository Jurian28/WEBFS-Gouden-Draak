<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Sale;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;

class TakeAwayController extends Controller
{
    public function index() {
        $dishes = Dish::with(['discounts', 'type'])->get();

        $dishesByType = $dishes->groupBy(function ($dish) {
            return $dish->type->name;
        });

        return view('public.takeAway.index', [
            'dishesByType' => $dishesByType,
            'dishesList' => $dishes
        ]);
    }

    public function order(Request $request)
    {
        $validated = $request->validate([
            'cart' => 'required|array',
            'name' => 'required|string|max:255'
        ]);

        $order = new Order([
            'name' => $validated['name'],
            'group_id' => null
        ]);

        $order->save();

        foreach ($validated['cart'] as $id => $amount) {
            $dish = Dish::with('discounts')->findOrFail($id);

            $sale = new Sale([
                'dish_id' => $id,
                'amount' => $amount,
                'price' => $dish->discountedPrice(),
                'order_id' => $order->id
            ]);

            $sale->save();
        }

        return response()->json([
            'success' => true,
            'order_id' => $order->id
        ]);
    }

    public function thanksPage($orderId) {
        $order = Order::with('sales.dish')->findOrFail($orderId);
        $qrCode = $this->getQrCode($orderId);

        return view('public.takeAway.thanks', [
            'order' => $order,
            'qrCode' => $qrCode
        ]);
    }

    private function getQrCode($orderId): string {
        $qrCode = new Builder(
            writer: new PngWriter(),
            data: route('public.thanksPage', ['orderId' => $orderId])
        );

        return $qrCode->build()->getDataUri();
    }
}
