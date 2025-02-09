<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = auth()->user()->addresses;
        return view('customer.addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('customer.addresses.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateAddress($request);

        if (!empty($validated['is_primary'])) {
            auth()->user()->addresses()->update(['is_primary' => false]);
        }

        auth()->user()->addresses()->create($validated);

        return redirect()->route('customer.addresses.index')
            ->with('success', 'Address added successfully!');
    }

    public function edit(Address $address)
    {
        if (! Gate::allows('update', $address)) {
            abort(403);
        }
        return view('customer.addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        if (! Gate::allows('update', $address)) {
            abort(403);
        }

        $validated = $this->validateAddress($request);

        if (!empty($validated['is_primary'])) {
            auth()->user()->addresses()->where('id', '!=', $address->id)
                ->update(['is_primary' => false]);
        }

        $address->update($validated);

        return redirect()->route('customer.addresses.index')
            ->with('success', 'Address updated successfully!');
    }

    public function destroy(Address $address)
    {
        if (! Gate::allows('delete', $address)) {
            abort(403);
        }
        
        if ($address->is_primary) {
            $newPrimary = auth()->user()->addresses()
                ->where('id', '!=', $address->id)
                ->first();
            if ($newPrimary) {
                $newPrimary->update(['is_primary' => true]);
            }
        }

        $address->delete();

        return redirect()->route('customer.addresses.index')
            ->with('success', 'Address deleted successfully!');
    }

    public function setPrimary(Address $address)
    {
        if (! Gate::allows('update', $address)) {
            abort(403);
        }

        auth()->user()->addresses()->update(['is_primary' => false]);
        $address->update(['is_primary' => true]);

        return redirect()->route('customer.addresses.index')
            ->with('success', 'Primary address updated successfully!');
    }

    protected function validateAddress(Request $request)
    {
        return $request->validate([
            'label' => 'nullable|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'is_primary' => 'boolean'
        ]);
    }
} 