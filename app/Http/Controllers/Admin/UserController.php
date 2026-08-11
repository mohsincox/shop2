<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * List all customers.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'customer')->withCount('orders');

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->q.'%')
                    ->orWhere('email', 'like', '%'.$request->q.'%');
            });
        }

        $users = $query->latest()->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show a customer's details and order history.
     */
    public function show(User $user)
    {
        abort_if($user->role !== 'customer', 404);

        $user->loadCount('orders');
        $orders = $user->orders()->latest()->take(20)->get();

        return view('admin.users.show', compact('user', 'orders'));
    }

    /**
     * Remove the customer.
     */
    public function destroy(User $user)
    {
        abort_if($user->role !== 'customer', 404);

        $user->delete();

        return back()->with('success', 'Customer deleted successfully.');
    }
}
