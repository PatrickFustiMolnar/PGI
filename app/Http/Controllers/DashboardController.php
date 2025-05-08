<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Discount;
use App\Models\Employee;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Filtre de période
        $period = $request->input('period', 'today');
        $startDate = match ($period) {
            '7days' => Carbon::today()->subDays(7),
            '30days' => Carbon::today()->subDays(30),
            default => Carbon::today(), // 'today'
        };

        // Statistiques clés
        $totalCustomers = Customer::count();
        $ordersToday = Order::whereDate('transaction_time', Carbon::today())->count();
        $revenueToday = Order::whereDate('transaction_time', Carbon::today())->sum('payment_amount');
        $upcomingReservations = Reservation::where('reservation_date', '>=', Carbon::today())->count();
        $lowStockItems = Inventory::where('stock', '<', 10)->get(); // Exemple : seuil à 10
        $activeDiscounts = Discount::where('status', 'active')
            ->where('expired_date', '>=', Carbon::today())
            ->count();

        // Données pour le graphique des ventes
        $salesData = Order::where('transaction_time', '>=', $startDate)
            ->selectRaw('DATE(transaction_time) as date, SUM(payment_amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $salesDates = $salesData->pluck('date');
        $salesTotals = $salesData->pluck('total');

        // Répartition des commandes par type (ready/preparation)
        $orderStatusData = Order::selectRaw('order_type as status, COUNT(*) as count')
            ->where('transaction_time', '>=', $startDate)
            ->groupBy('order_type')
            ->get();
        $orderStatusLabels = $orderStatusData->pluck('status');
        $orderStatusCounts = $orderStatusData->pluck('count');

        // État de l'inventaire (5 produits avec stock le plus bas)
        $inventoryData = Inventory::orderBy('stock', 'asc')->take(5)->get();
        $inventoryNames = $inventoryData->pluck('name');
        $inventoryStocks = $inventoryData->pluck('stock');

        // Réservations par période
        $reservationData = Reservation::where('reservation_date', '>=', $startDate)
            ->selectRaw('DATE(reservation_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $reservationDates = $reservationData->pluck('date');
        $reservationCounts = $reservationData->pluck('count');

        // Activités récentes
        $lastOrders = Order::with('customer')
            ->orderBy('transaction_time', 'desc')
            ->take(5)
            ->get();
        $upcomingReservationsList = Reservation::where('reservation_date', '>=', Carbon::today())
            ->orderBy('reservation_date')
            ->take(5)
            ->get();

        // Alertes : commandes prêtes au lieu de commandes en attente
        $readyOrders = Order::where('order_type', 'ready')->get();
        $expiringDiscounts = Discount::where('expired_date', '>=', Carbon::today())
            ->where('expired_date', '<=', Carbon::today()->addDays(7))
            ->count();

        return view('pages.dashboard', compact(
            'totalCustomers', 'ordersToday', 'revenueToday', 'upcomingReservations',
            'lowStockItems', 'activeDiscounts', 'salesDates', 'salesTotals',
            'orderStatusLabels', 'orderStatusCounts', 'inventoryNames', 'inventoryStocks',
            'reservationDates', 'reservationCounts', 'lastOrders', 'upcomingReservationsList',
            'readyOrders', 'expiringDiscounts'
        ));
    }
}