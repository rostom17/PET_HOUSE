@extends('layouts.app')

@section('title', 'Order Management - PETSROLOGY Admin')

@section('styles')
<style>
    .admin-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }

    .admin-header {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }

    .admin-header h1 {
        margin: 0;
        font-size: 2rem;
        font-weight: 700;
    }

    .admin-header p {
        margin: 5px 0 0 0;
        opacity: 0.9;
    }

    .filters-section {
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        margin-bottom: 25px;
        border: 1px solid rgba(255,255,255,0.8);
    }

    .filter-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }

    .filter-group input,
    .filter-group select {
        padding: 10px 15px;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        font-size: 0.95rem;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: #ff6f61;
    }

    .filter-btn {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(52, 152, 219, 0.15);
    }

    .filter-btn:hover {
        background: linear-gradient(135deg, #2980b9 0%, #3498db 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.2);
    }

    .orders-table-container {
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.8);
    }

    .orders-table {
        width: 100%;
        border-collapse: collapse;
    }

    .orders-table th,
    .orders-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }

    .orders-table th {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        font-weight: 600;
        color: #fff;
        border-bottom: 2px solid #3498db;
    }

    .orders-table tbody tr:hover {
        background: #eaf1fb;
    }

    .order-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-confirmed { background: #d4edda; color: #155724; }
    .status-processing { background: #d1ecf1; color: #0c5460; }
    .status-shipped { background: #e2e3e5; color: #41464b; }
    .status-delivered { background: #d4edda; color: #155724; }
    .status-cancelled { background: #f8d7da; color: #721c24; }

    .payment-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .payment-pending { background: #fff3cd; color: #856404; }
    .payment-paid { background: #d4edda; color: #155724; }
    .payment-failed { background: #f8d7da; color: #721c24; }
    .payment-refunded { background: #e2e3e5; color: #41464b; }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-view {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(52, 152, 219, 0.15);
    }

    .btn-view:hover {
        background: linear-gradient(135deg, #2980b9 0%, #3498db 100%);
        color: white;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.2);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        text-align: center;
        border: 1px solid rgba(255,255,255,0.8);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #3498db;
        margin-bottom: 10px;
        background: linear-gradient(45deg, #2c3e50, #3498db);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        color: #666;
        font-weight: 600;
    }

    .pagination-wrapper {
        padding: 20px;
        display: flex;
        justify-content: center;
    }

    .no-orders {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .no-orders i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .admin-container {
            padding: 15px;
        }

        .filter-row {
            grid-template-columns: 1fr;
        }

        .orders-table-container {
            overflow-x: auto;
        }

        .orders-table {
            min-width: 800px;
        }
    }
</style>
@endsection

@section('content')
<div class="admin-container">
    <!-- Header -->
    <div class="admin-header">
        <h1><i class="fas fa-shopping-cart"></i> Order Management</h1>
        <p>Manage customer orders and track their status</p>
    </div>

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $stats['total_orders'] }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['pending_orders'] }}</div>
            <div class="stat-label">Pending Orders</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $stats['confirmed_orders'] }}</div>
            <div class="stat-label">Confirmed Orders</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">৳{{ number_format($stats['total_revenue'], 2) }}</div>
            <div class="stat-label">Total Revenue</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-section">
        <form method="GET" action="{{ route('admin.orders.index') }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="search">Search</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" 
                           placeholder="Order number, customer name, email...">
                </div>
                <div class="filter-group">
                    <label for="status">Order Status</label>
                    <select id="status" name="status">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="payment_status">Payment Status</label>
                    <select id="payment_status" name="payment_status">
                        <option value="">All Payment Statuses</option>
                        <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ request('payment_status') === 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ request('payment_status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="payment_method">Payment Method</label>
                    <select id="payment_method" name="payment_method">
                        <option value="">All Methods</option>
                        <option value="cash_on_delivery" {{ request('payment_method') === 'cash_on_delivery' ? 'selected' : '' }}>Cash on Delivery</option>
                        <option value="bkash" {{ request('payment_method') === 'bkash' ? 'selected' : '' }}>bKash</option>
                        <option value="nagad" {{ request('payment_method') === 'nagad' ? 'selected' : '' }}>Nagad</option>
                        <option value="card" {{ request('payment_method') === 'card' ? 'selected' : '' }}>Card</option>
                    </select>
                </div>
                <div class="filter-group">
                    <button type="submit" class="filter-btn">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="orders-table-container">
        @if($orders->count() > 0)
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <strong>PF-{{ $order->order_number }}</strong>
                            </td>
                            <td>
                                <div>
                                    <strong>{{ $order->customer_full_name }}</strong><br>
                                    <small class="text-muted">{{ $order->customer_email }}</small><br>
                                    <small class="text-muted">{{ $order->customer_phone }}</small>
                                </div>
                            </td>
                            <td>
                                {{ $order->orderItems->count() }} item(s)
                            </td>
                            <td>
                                <strong>৳{{ number_format($order->total_amount, 2) }}</strong>
                            </td>
                            <td>
                                <div>
                                    <span class="payment-status payment-{{ $order->payment_status }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span><br>
                                    <small class="text-muted">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="order-status status-{{ $order->order_status }}">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </td>
                            <td>
                                {{ $order->created_at->format('M d, Y') }}<br>
                                <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-view">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $orders->appends(request()->query())->links() }}
            </div>
        @else
            <div class="no-orders">
                <i class="fas fa-shopping-cart"></i>
                <h3>No Orders Found</h3>
                <p>No orders match your current filters. Try adjusting your search criteria.</p>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Optionally, you can add a script to hide the navbar if needed
    document.addEventListener('DOMContentLoaded', function() {
        var navbar = document.querySelector('.navbar');
        if (navbar) navbar.style.display = 'none';
    });
</script>
@endsection
