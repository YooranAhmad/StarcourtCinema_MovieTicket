<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\User;
use App\Models\Movie;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Gather statistics
        $totalUsers = User::count();
        $totalBookings = Bookings::where('payment_status', 'completed')->count();
        $pendingBookings = Bookings::where('payment_status', 'pending')->count();
        $totalRevenue = Bookings::where('payment_status', 'completed')->sum('total_price');
        
        // Recent bookings (last 10)
        $recentBookings = Bookings::where('payment_status', 'completed')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        // Today's stats
        $todayBookings = Bookings::where('payment_status', 'completed')
            ->whereDate('created_at', today())
            ->count();
        
        $todayRevenue = Bookings::where('payment_status', 'completed')
            ->whereDate('created_at', today())
            ->sum('total_price');
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBookings',
            'pendingBookings',
            'totalRevenue',
            'recentBookings',
            'todayBookings',
            'todayRevenue'
        ));
    }

    public function bookings(Request $request)
    {   
        $query = Bookings::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('booking_code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%");
        }

        $bookings = $query->get();
        return view('admin.bookings', compact('bookings'));
    }

    public function destroyBooking($id)
    {
        $booking = Bookings::findOrFail($id);
        $booking->delete();
        return redirect()->route('admin.bookings')->with('success', 'Booking deleted successfully!');
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        $users = $query->get();
        return view('admin.users', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean'
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['is_admin'] = $request->has('is_admin') ? 1 : 0;

        User::create($validated);

        return redirect()->route('admin.users')->with('success', 'User created successfully!');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'boolean'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['is_admin'] = $request->has('is_admin') ? 1 : 0;

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }

    // Movies CRUD
    public function movies()
    {
        $movies = Movie::all();
        return view('admin.movies.index', compact('movies'));
    }

    public function createMovie()
    {
        return view('admin.movies.create');
    }

    public function storeMovie(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'rating' => 'required|string|max:10',
            'duration' => 'required|string|max:50',
            'price' => 'required|integer|min:0',
            'stars' => 'required|integer|min:1|max:5',
            'description' => 'required|string',
            'showtimes' => 'required|string', // Will be converted to array
            'image' => 'nullable|string|max:255',
            'trailer' => 'nullable|string|max:255',
        ]);

        // Convert showtimes from comma-separated string to array
        $validated['showtimes'] = array_map('trim', explode(',', $validated['showtimes']));

        Movie::create($validated);

        return redirect()->route('admin.movies')->with('success', 'Movie created successfully!');
    }

    public function editMovie($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }

    public function updateMovie(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'rating' => 'required|string|max:10',
            'duration' => 'required|string|max:50',
            'price' => 'required|integer|min:0',
            'stars' => 'required|integer|min:1|max:5',
            'description' => 'required|string',
            'showtimes' => 'required|string',
            'image' => 'nullable|string|max:255',
            'trailer' => 'nullable|string|max:255',
        ]);

        // Convert showtimes from comma-separated string to array
        $validated['showtimes'] = array_map('trim', explode(',', $validated['showtimes']));

        $movie->update($validated);

        return redirect()->route('admin.movies')->with('success', 'Movie updated successfully!');
    }

    public function destroyMovie($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return redirect()->route('admin.movies')->with('success', 'Movie deleted successfully!');
    }
}
