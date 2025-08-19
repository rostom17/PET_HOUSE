
<?php
use App\Http\Controllers\VetJoinController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\VetDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\VetManagementController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\CheckoutController;

// Contact Message Route
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

// About Us route
Route::get('/about', function () {
    return view('about');
})->name('about');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// Payment Routes
Route::get('/payment/bkash', [CheckoutController::class, 'bkashPayment'])->name('payment.bkash');
Route::get('/payment/nagad', [CheckoutController::class, 'nagadPayment'])->name('payment.nagad');
Route::get('/payment/card', [CheckoutController::class, 'cardPayment'])->name('payment.card');
Route::post('/payment/process', [CheckoutController::class, 'processPayment'])->name('payment.process');

// Shop Beds Page
Route::get('/shop-beds', function () {
    return view('shop_beds');
});

// Vet Join Page
Route::get('/vet-join', [VetJoinController::class, 'show'])->name('vet.join');

// Vet Join Form Submission
Route::post('/vet-join', [VetJoinController::class, 'store'])->name('vet.join.submit');

// Admin Vet Management Routes
Route::prefix('admin')->middleware('admin')->group(function () {
    // User Management Routes
    Route::get('/user-management', [UserManagementController::class, 'index'])->name('admin.user.management');
    Route::post('/users/store', [UserManagementController::class, 'store'])->name('admin.users.store');
    Route::put('/users/update/{id}', [UserManagementController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/delete/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

    // Main vet management page
    Route::get('/vet-management', [VetManagementController::class, 'index'])->name('admin.vet.management');
    
    // Add new vet (admin)
    Route::get('/vet-management/create', [VetManagementController::class, 'create'])->name('admin.vet.create');
    Route::post('/vet-management/store', [VetManagementController::class, 'store'])->name('admin.vet.store');
    
    // Edit vet
    Route::get('/vet-management/edit/{id}', [VetManagementController::class, 'edit'])->name('admin.vet.edit');
    Route::put('/vet-management/update/{id}', [VetManagementController::class, 'update'])->name('admin.vet.update');
    
    // Delete vet
    Route::delete('/vet-management/delete/{id}', [VetManagementController::class, 'destroy'])->name('admin.vet.destroy');
    
    // Vet requests (pending applications)
    Route::get('/vet-management/requests', [VetManagementController::class, 'requests'])->name('admin.vet.requests');
    
    // Approve/Reject vet applications
    Route::put('/vet-management/approve/{id}', [VetManagementController::class, 'approve'])->name('admin.vet.approve');
    Route::put('/vet-management/reject/{id}', [VetManagementController::class, 'reject'])->name('admin.vet.reject');
    
    // Show all vets with pagination and filters
    Route::get('/vet-management/show-all', [VetManagementController::class, 'showAll'])->name('admin.vet.showAll');

    // Order Management Routes
    Route::prefix('order-management')->group(function () {
        Route::get('/', [OrderManagementController::class, 'index'])->name('admin.orders.index');
        Route::get('/show/{id}', [OrderManagementController::class, 'show'])->name('admin.orders.show');
        Route::put('/update-status/{id}', [OrderManagementController::class, 'updateStatus'])->name('admin.orders.update-status');
        Route::put('/update-payment-status/{id}', [OrderManagementController::class, 'updatePaymentStatus'])->name('admin.orders.update-payment-status');
        Route::delete('/delete/{id}', [OrderManagementController::class, 'destroy'])->name('admin.orders.destroy');
        Route::get('/stats', [OrderManagementController::class, 'stats'])->name('admin.orders.stats');
    });
});
// Search adoption post by ID for admin update/delete
Route::get('/admin/adoption-management/search-by-id/{id}', function($id) {
    $post = \App\Models\AdoptionPost::find($id);
    if (!$post) {
        return response()->json(['error' => 'Not found'], 404);
    }
    // Return only fillable fields to match what the JS expects
    $data = $post->only($post->getFillable());
    $data['id'] = $post->id;
    return response()->json($data);
});
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdoptionManagementController;
use App\Models\AdoptionRequest;
use App\Models\AdoptionPost;

// Edit adoption post form
Route::get('/admin/adoption-management/edit/{id}', [AdoptionManagementController::class, 'edit'])->name('admin.adoption.edit');
// Admin Adoption Management store (create new post)
Route::post('/admin/adoption-management/store', [AdoptionManagementController::class, 'store'])->name('admin.adoption.store');

// Admin Adoption Management main page
Route::get('/admin/adoption-management', [AdoptionManagementController::class, 'index'])->name('admin.adoption.management');

// Allow GET for confirm/cancel for testing in browser
Route::get('/admin/adoption-request/{id}/confirm', function ($id) {
    $req = AdoptionRequest::findOrFail($id);
    $req->status = 1; // 1 = confirmed
    $req->save();
    $petUpdated = false;
    if ($req->adoption_id) {
        $pet = AdoptionPost::find($req->adoption_id);
        if ($pet) {
            $pet->status = 'adopted';
            $petUpdated = $pet->save();
        }
    }
    if (!$petUpdated) {
        \Log::error('Pet status not updated for adoption request ID: ' . $id);
    }
    return redirect()->back()->with('success', 'Adoption request confirmed and pet marked as adopted!');
});

Route::get('/admin/adoption-request/{id}/cancel', function ($id) {
    $req = AdoptionRequest::findOrFail($id);
    $req->status = 2; // 2 = cancelled
    $req->save();
    $petUpdated = false;
    if ($req->adoption_id) {
        $pet = AdoptionPost::find($req->adoption_id);
        if ($pet) {
            $pet->status = 'active';
            $petUpdated = $pet->save();
        }
    }
    if (!$petUpdated) {
        \Log::error('Pet status not updated for adoption request ID: ' . $id);
    }
    return redirect()->back()->with('success', 'Adoption request cancelled and pet marked as available!');
});
// POST routes for adoption request confirm/cancel (for form submissions)
Route::post('/admin/adoption-request/{id}/confirm', function ($id) {
    $req = AdoptionRequest::findOrFail($id);
    $req->status = 1; // 1 = confirmed
    $req->save();
    $petUpdated = false;
    if ($req->adoption_id) {
        $pet = AdoptionPost::find($req->adoption_id);
        if ($pet) {
            $pet->status = 'adopted';
            $petUpdated = $pet->save();
        }
    }
    if (!$petUpdated) {
        \Log::error('Pet status not updated for adoption request ID: ' . $id);
    }
    return redirect()->back()->with('success', 'Adoption request confirmed and pet marked as adopted!');
});

Route::post('/admin/adoption-request/{id}/cancel', function ($id) {
    $req = AdoptionRequest::findOrFail($id);
    $req->status = 2; // 2 = cancelled
    $req->save();
    $petUpdated = false;
    if ($req->adoption_id) {
        $pet = AdoptionPost::find($req->adoption_id);
        if ($pet) {
            $pet->status = 'active';
            $petUpdated = $pet->save();
        }
    }
    if (!$petUpdated) {
        \Log::error('Pet status not updated for adoption request ID: ' . $id);
    }
    return redirect()->back()->with('success', 'Adoption request cancelled and pet marked as available!');
});
// ...existing code...
Route::post('/admin/adoption-management/update/{id}', function(\Illuminate\Http\Request $request, $id) {
    $post = \App\Models\AdoptionPost::findOrFail($id);
    $validated = $request->validate([
        'title' => 'required',
        'pet_name' => 'required',
        'pet_age' => 'required|integer',
        'gender' => 'required',
        'character' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    if ($request->hasFile('image')) {
        if ($post->image) { 
            \Illuminate\Support\Facades\Storage::disk('public')->delete($post->image);
            // Also delete from public/storage if exists
            $publicStoragePath = public_path('storage/' . $post->image);
            if (file_exists($publicStoragePath)) {
                unlink($publicStoragePath);
            }
        }
        $imagePath = $request->file('image')->store('adoption_images', 'public');
        $validated['image'] = $imagePath;
        
        // For Windows compatibility, ensure public/storage directory exists
        $publicStorageDir = public_path('storage');
        if (!file_exists($publicStorageDir)) {
            mkdir($publicStorageDir, 0755, true);
        }
        
        $publicAdoptionImagesDir = $publicStorageDir . DIRECTORY_SEPARATOR . 'adoption_images';
        if (!file_exists($publicAdoptionImagesDir)) {
            mkdir($publicAdoptionImagesDir, 0755, true);
        }
        
        // Copy the uploaded file to public/storage as well for Windows compatibility
        $sourceFile = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $imagePath);
        $destFile = $publicStorageDir . DIRECTORY_SEPARATOR . $imagePath;
        if (file_exists($sourceFile)) {
            copy($sourceFile, $destFile);
        }
    }
    $post->update($validated);
    return redirect()->back()->with('success', 'Adoption post updated successfully!');
});

// Delete adoption post
Route::post('/admin/adoption-management/delete/{id}', function($id) {
    $post = \App\Models\AdoptionPost::findOrFail($id);
    if ($post->image) { 
        \Illuminate\Support\Facades\Storage::disk('public')->delete($post->image);
        // Also delete from public/storage if exists
        $publicStoragePath = public_path('storage/' . $post->image);
        if (file_exists($publicStoragePath)) {
            unlink($publicStoragePath);
        }
    }
    $post->delete();
    return redirect()->back()->with('success', 'Adoption post deleted successfully!');
});

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('splash_screen');
});

Route::get('/landing', function () {
    return view('landing');
});

Route::get('/welcome', function () {
    // Simple session-based authentication check
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    
    try {
        // Fetch dynamic statistics from database
        $petsAdopted = \App\Models\AdoptionRequest::where('status', 1)->count(); // 1 = confirmed/approved
        $verifiedVets = \App\Models\VetDetails::count();
        $totalCustomers = \App\Models\AppUser::count();
        
        return view('welcome', compact(
            'petsAdopted',
            'verifiedVets', 
            'totalCustomers'
        ));
    } catch (Exception $e) {
        // Fallback to default values in case of database error
        return view('welcome', [
            'petsAdopted' => 0,
            'verifiedVets' => 0,
            'totalCustomers' => 0
        ]);
    }
});

// Vet Home (for support button)
Route::get('/vet-home', function () {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    return view('vet_home');
})->name('vet.home');

// Vet Dashboard (main vet page after login)
Route::get('/vet-dashboard', [VetDashboardController::class, 'index'])->name('vet.dashboard');

// Vet Contact Page (uses vet layout)
Route::get('/vet/contact', function () {
    if (!session('user_authenticated') || session('user_role') !== 'vet') {
        return redirect('/landing');
    }
    return view('vet_contact');
})->name('vet.contact');

// Login route with error handling
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Fallback route for 404 errors
use Illuminate\Support\Facades\View;
Route::fallback(function () {
    return View::exists('errors.404')
        ? response()->view('errors.404', [], 404)
        : response('Page not found', 404);
});
Route::middleware('guest')->group(function () {
    Route::get('/signup', function () {
        return view('signup');
    });

    Route::get('/login', function () {
        return view('login');
    });
});

Route::post('/signup', [AuthController::class, 'register'])->name('signup.submit');

// Google Authentication Routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
Route::post('/auth/google/signup', [AuthController::class, 'googleSignup'])->name('google.signup');

// Debug route (remove in production)
Route::get('/debug/google-config', [App\Http\Controllers\DebugController::class, 'checkGoogleConfig']);

// Vet Homepage (main vet page after login)
Route::get('/vet-homepage', function () {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    if (session('user_role') !== 'vet') {
        return redirect('/welcome');
    }
    
    try {
        // Fetch dynamic statistics from database
        $totalVets = \App\Models\VetDetails::count();
        $totalAppointments = \App\Models\Appointment::count();
        $totalPetOwners = \App\Models\AppUser::count();
        $completedAppointments = \App\Models\Appointment::where('status', 'completed')->count();
        
        return view('vet_homepage', compact(
            'totalVets', 
            'totalAppointments', 
            'totalPetOwners',
            'completedAppointments'
        ));
    } catch (Exception $e) {
        // Fallback to default values in case of database error
        return view('vet_homepage', [
            'totalVets' => 0,
            'totalAppointments' => 0,
            'totalPetOwners' => 0,
            'completedAppointments' => 0
        ]);
    }
});

Route::post('/logout', function () {
    session()->forget(['user_authenticated', 'user_email', 'user_role']);
    return redirect('/landing');
})->name('logout');

Route::get('/vet-home', function () {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    return view('vet_home');
});

Route::get('/book-appointment', [App\Http\Controllers\AppointmentController::class, 'index'])->name('book.appointment');
Route::post('/book-appointment', [App\Http\Controllers\AppointmentController::class, 'store'])->name('appointment.store');

// Appointment management routes
Route::get('/appointments/user', [App\Http\Controllers\AppointmentController::class, 'getUserAppointments'])->name('appointments.user');
Route::get('/appointments/vet/{vetId}', [App\Http\Controllers\AppointmentController::class, 'getVetAppointments'])->name('appointments.vet');
Route::post('/appointments/{id}/status', [App\Http\Controllers\AppointmentController::class, 'updateStatus'])->name('appointment.update.status');
Route::post('/appointments/{id}/cancel', [App\Http\Controllers\AppointmentController::class, 'cancel'])->name('appointment.cancel');
// Public appointment routes (no auth required for AJAX)
Route::get('/appointments/available-slots', [App\Http\Controllers\AppointmentController::class, 'getAvailableSlots'])->name('appointment.available.slots');

// Test route for debugging
Route::get('/test/slots', function(\Illuminate\Http\Request $request) {
    return response()->json([
        'status' => 'working',
        'date' => $request->get('date'),
        'slots' => [
            '09:00' => '9:00 AM',
            '10:00' => '10:00 AM',
            '14:00' => '2:00 PM'
        ]
    ]);
});

Route::get('/all-vets', [App\Http\Controllers\VetController::class, 'allVets'])->name('all.vets');

Route::get('/vet-profile/{id}', [App\Http\Controllers\VetController::class, 'showProfile'])->name('vet.profile');

Route::get('/vaccination-schedule', function () {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    return view('vaccination_schedule');
})->name('vaccination.schedule');

Route::get('/vaccination-booking', function () {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    return view('vaccination_booking');
})->name('vaccination.booking');

use App\Http\Controllers\AdoptHomeController;
Route::get('/adopt-home', [AdoptHomeController::class, 'index'])->name('adopt.home');

Route::get('/first-time-adopter', function () {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    return view('first_time_adopter');
})->name('first.time.adopter');

use App\Http\Controllers\AdoptionDetailsController;
Route::get('/adoption-details', [AdoptionDetailsController::class, 'show'])->name('adoption.details');

use App\Http\Controllers\AdoptionFormController;
Route::get('/adoption-form', [AdoptionFormController::class, 'show'])->name('adoption.form');

Route::post('/adoption-form', function (Illuminate\Http\Request $request) {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }

    $validated = $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'age' => 'required|integer|min:18|max:100',
        'address' => 'required|string|max:500',
        'city' => 'required|string|max:255',
        'housingType' => 'required|string',
        'ownRent' => 'required|string',
        'currentPets' => 'required|string',
        'previousPets' => 'required|string',
        'reasonForAdoption' => 'required|string|max:1000',
        'veterinaryCare' => 'required|string|max:1000',
        'financialCommitment' => 'required|string',
        'agreements' => 'required|array|min:5',
    ]);

    $userId = session('user_id');
    $userEmail = session('user_email');
    $adoptionId = $request->get('adoption_id');

    \App\Models\AdoptionRequest::create([
        'adoption_id' => $adoptionId,
        'user_id' => $userId,
        'email' => $userEmail,
        'firstName' => $request->firstName,
        'lastName' => $request->lastName,
        'phone' => $request->phone,
        'age' => $request->age,
        'address' => $request->address,
        'city' => $request->city,
        'housingType' => $request->housingType,
        'ownRent' => $request->ownRent,
        'currentPets' => $request->currentPets,
        'previousPets' => $request->previousPets,
        'reasonForAdoption' => $request->reasonForAdoption,
        'veterinaryCare' => $request->veterinaryCare,
        'financialCommitment' => $request->financialCommitment,
        'agreements' => json_encode($request->agreements),
        'status' => 0, // 0 = pending
    ]);

    session()->flash('success', 'Your adoption application has been submitted successfully! We will contact you within 2-3 business days.');
    $petName = $request->get('pet', 'milo');
    return redirect('/adoption-details?pet=' . urlencode($petName));
})->name('adoption.form.submit');

Route::get('/pet-supplies', function () {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    return view('pet_supplies');
})->name('pet.supplies');

Route::get('/shop-food', function () {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    return view('shop_food');
})->name('shop.food');

Route::get('/shop-toys', function () {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    return view('shop_toys');
})->name('shop.toys');

Route::get('/shop', function () {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    return view('shop');
})->name('shop');

Route::get('/contact', function () {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    return view('contact');
})->name('contact');

// User Dashboard Route
Route::get('/user/dashboard', function () {
    if (!session('user_authenticated')) {
        return redirect('/landing');
    }
    $user = null;
    $adoptionRequests = collect();
    $appointments = collect();
    if (session('user_id')) {
        $user = \App\Models\AppUser::find(session('user_id'));
        $adoptionRequests = \App\Models\AdoptionRequest::with('adoptionPost')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $appointments = \App\Models\Appointment::with('vet')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
    }
    return view('user_dashboard', ['user' => $user, 'adoptionRequests' => $adoptionRequests, 'appointments' => $appointments]);
})->name('user.dashboard');

// Admin Routes
use Illuminate\Support\Facades\Storage;
Route::get('/admin/login', function () {
    return view('admin_login');
})->name('admin.login');

Route::post('/admin/login', function (Illuminate\Http\Request $request) {
    $request->validate([
        'admin_username' => 'required|string',
        'admin_password' => 'required|string',
    ]);

    $admin = \App\Models\AdminLogin::where('username', $request->admin_username)
        ->where('password', $request->admin_password)
        ->first();

    if ($admin) {
        session([
            'admin_authenticated' => true,
            'admin_username' => $admin->username,
            'admin_role' => 'admin'
        ]);
        return redirect('/admin/dashboard');
    }

    return back()->withErrors(['admin_username' => 'Invalid admin credentials']);
})->name('admin.login.submit');

Route::post('/admin/logout', function () {
    session()->forget(['admin_authenticated', 'admin_email', 'admin_role']);
    return redirect('/landing');
})->name('admin.logout');

Route::get('/admin/dashboard', function () {
    if (!session('admin_authenticated')) {
        return redirect('/admin/login');
    }
    
    try {
        // Get dynamic counts from database
        $totalUsers = \App\Models\User::count();
        $totalAppUsers = \App\Models\AppUser::count();
        $totalPets = \App\Models\AdoptionPost::count();
        $successfulAdoptions = \App\Models\AdoptionRequest::where('status', 1)->count();
        $totalVets = \App\Models\VetDetails::count();
        $totalAppointments = \App\Models\Appointment::count();
        
        // Additional statistics
        $pendingAdoptions = \App\Models\AdoptionRequest::where('status', 0)->count();
        $activeAdoptionPosts = \App\Models\AdoptionPost::where('status', 'active')->count();
        
        // Combine regular users and app users for total user count
        $allUsers = $totalUsers + $totalAppUsers;
        
        $adoptionPosts = AdoptionPost::with('requests')->orderBy('id','desc')->get();
        
    } catch (\Exception $e) {
        // Fallback values if database queries fail
        $allUsers = 0;
        $totalPets = 0;
        $successfulAdoptions = 0;
        $totalVets = 0;
        $totalAppointments = 0;
        $pendingAdoptions = 0;
        $activeAdoptionPosts = 0;
        $adoptionPosts = collect([]);
        
        // Log the error for debugging
        \Log::error('Admin Dashboard Stats Error: ' . $e->getMessage());
    }
    
    return view('admin_dashboard', compact(
        'adoptionPosts', 
        'allUsers', 
        'totalPets', 
        'successfulAdoptions', 
        'totalVets',
        'totalAppointments',
        'pendingAdoptions',
        'activeAdoptionPosts'
    ));
})->name('admin.dashboard');

// Admin Food Products Management Routes
Route::middleware('admin')->group(function () {
    Route::get('/admin/food-products', [App\Http\Controllers\Admin\AdminFoodProductController::class, 'index'])->name('admin.food.products.index');
    Route::get('/admin/supply-management', [App\Http\Controllers\Admin\SupplyManagementController::class, 'index'])->name('admin.supply.management');
    Route::get('/admin/food-products/create', [App\Http\Controllers\Admin\AdminFoodProductController::class, 'create'])->name('admin.food.products.create');
    Route::post('/admin/food-products', [App\Http\Controllers\Admin\AdminFoodProductController::class, 'store'])->name('admin.food.products.store');
    Route::get('/admin/food-products/{product}', [App\Http\Controllers\Admin\AdminFoodProductController::class, 'show'])->name('admin.food.products.show');
    Route::get('/admin/food-products/{product}/edit', [App\Http\Controllers\Admin\AdminFoodProductController::class, 'edit'])->name('admin.food.products.edit');
    Route::put('/admin/food-products/{product}', [App\Http\Controllers\Admin\AdminFoodProductController::class, 'update'])->name('admin.food.products.update');
    Route::delete('/admin/food-products/{product}', [App\Http\Controllers\Admin\AdminFoodProductController::class, 'destroy'])->name('admin.food.products.destroy');
    Route::patch('/admin/food-products/{product}/toggle-status', [App\Http\Controllers\Admin\AdminFoodProductController::class, 'toggleStatus'])->name('admin.food.products.toggle-status');
});

// Admin Toy Products Management Routes
Route::middleware('admin')->group(function () {
    Route::get('/admin/toy-products', [App\Http\Controllers\Admin\AdminToyProductController::class, 'index'])->name('admin.toy.products.index');
    Route::get('/admin/toy-products/create', [App\Http\Controllers\Admin\AdminToyProductController::class, 'create'])->name('admin.toy.products.create');
    Route::post('/admin/toy-products', [App\Http\Controllers\Admin\AdminToyProductController::class, 'store'])->name('admin.toy.products.store');
    Route::get('/admin/toy-products/{product}', [App\Http\Controllers\Admin\AdminToyProductController::class, 'show'])->name('admin.toy.products.show');
    Route::get('/admin/toy-products/{product}/edit', [App\Http\Controllers\Admin\AdminToyProductController::class, 'edit'])->name('admin.toy.products.edit');
    Route::put('/admin/toy-products/{product}', [App\Http\Controllers\Admin\AdminToyProductController::class, 'update'])->name('admin.toy.products.update');
    Route::delete('/admin/toy-products/{product}', [App\Http\Controllers\Admin\AdminToyProductController::class, 'destroy'])->name('admin.toy.products.destroy');
    Route::patch('/admin/toy-products/{product}/toggle-status', [App\Http\Controllers\Admin\AdminToyProductController::class, 'toggleStatus'])->name('admin.toy.products.toggle-status');
});

// Admin Adoption Management Actions
Route::post('/admin/adoption-post', function (Illuminate\Http\Request $request) {
    $request->validate([
        'title' => 'required',
        'pet_name' => 'required',
        'description' => 'required',
        'image' => 'nullable|image|max:2048',
    ]);
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('adoptions', 'public');
    }
    AdoptionPost::create([
        'title' => $request->title,
        'pet_name' => $request->pet_name,
        'description' => $request->description,
        'image' => $imagePath,
    ]);
    return redirect()->back()->with('success', 'Adoption post created!');
});

Route::post('/admin/adoption-post/{id}/delete', function ($id) {
    $post = AdoptionPost::findOrFail($id);
    if ($post->image) {
        Storage::disk('public')->delete($post->image);
    }
    $post->delete();
    return redirect()->back()->with('success', 'Adoption post deleted!');
});

// POST routes for adoption request confirm/cancel (for form submissions)
Route::post('/admin/adoption-request/{id}/confirm', function ($id) {
    $req = AdoptionRequest::findOrFail($id);
    $req->status = 1; // 1 = confirmed
    $req->save();
    $petUpdated = false;
    if ($req->adoption_id) {
        $pet = AdoptionPost::find($req->adoption_id);
        if ($pet) {
            $pet->status = 'adopted';
            $petUpdated = $pet->save();
        }
    }
    if (!$petUpdated) {
        \Log::error('Pet status not updated for adoption request ID: ' . $id);
    }
    return redirect()->back()->with('success', 'Adoption request confirmed and pet marked as adopted!');
});

Route::post('/admin/adoption-request/{id}/cancel', function ($id) {
    $req = AdoptionRequest::findOrFail($id);
    $req->status = 2; // 2 = cancelled
    $req->save();
    $petUpdated = false;
    if ($req->adoption_id) {
        $pet = AdoptionPost::find($req->adoption_id);
        if ($pet) {
            $pet->status = 'active';
            $petUpdated = $pet->save();
        }
    }
    if (!$petUpdated) {
        \Log::error('Pet status not updated for adoption request ID: ' . $id);
    }
    return redirect()->back()->with('success', 'Adoption request cancelled and pet marked as available!');
});

