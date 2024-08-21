<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AddressController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $addresses = Auth::user()->addresses;
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        if (Auth::user()->addresses()->count() >= 3) {
            return redirect()->route('addresses.index')->with('status', 'You can only have up to 3 addresses.');
        }
        return view('addresses.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        // Добавление user_id в данные перед сохранением
        $validatedData['user_id'] = Auth::id();

        // Создание нового адреса
        Auth::user()->addresses()->create($validatedData);

        return redirect()->route('addresses.index')->with('status', 'Address added successfully.');
    }

    public function edit(Address $address)
    {
        $this->authorize('update', $address);
        return view('addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        $this->authorize('update', $address);

        $validatedData = $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        // Обновление адреса
        $address->update($validatedData);

        return redirect()->route('addresses.index')->with('status', 'Address updated successfully.');
    }

    public function destroy(Address $address)
    {
        $this->authorize('delete', $address);
        $address->delete();

        return redirect()->route('addresses.index')->with('status', 'Address deleted successfully.');
    }
}
