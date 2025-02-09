<!-- Search Location -->
<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Search Location</label>
    <div class="relative">
        <input type="text" id="searchInput" placeholder="Enter location (e.g., Kota Bandung, Jakarta Selatan)"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#0f172a] focus:border-[#0f172a]"
            autocomplete="off">

        <!-- Search Results Dropdown -->
        <div id="searchResults"
            class="absolute z-10 w-full mt-1 bg-white rounded-lg shadow-lg border border-gray-200 hidden">
            <ul class="max-h-60 overflow-auto py-1" id="resultsList">
                <!-- Results will be inserted here -->
            </ul>
            <div id="loadingIndicator" class="text-center py-2 hidden">
                <svg class="w-5 h-5 animate-spin mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Coordinates -->
<input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $address->latitude ?? '') }}">
<input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $address->longitude ?? '') }}">

<!-- Two Column Form -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Label & Recipient -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Label (Optional)</label>
        <input type="text" name="label" value="{{ old('label', $address->label ?? '') }}"
            placeholder="e.g., Home, Office"
            class="w-full rounded-lg border-gray-300 focus:border-[#0f172a] focus:ring-[#0f172a]">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Recipient Name</label>
        <input type="text" name="recipient_name" value="{{ old('recipient_name', $address->recipient_name ?? '') }}"
            required class="w-full rounded-lg border-gray-300 focus:border-[#0f172a] focus:ring-[#0f172a]">
    </div>

    <!-- Phone & Postal Code -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
        <input type="tel" name="phone_number" value="{{ old('phone_number', $address->phone_number ?? '') }}"
            required class="w-full rounded-lg border-gray-300 focus:border-[#0f172a] focus:ring-[#0f172a]">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code</label>
        <input type="text" name="postal_code" id="postal_code"
            value="{{ old('postal_code', $address->postal_code ?? '') }}" required
            class="w-full rounded-lg border-gray-300 focus:border-[#0f172a] focus:ring-[#0f172a]">
    </div>

    <!-- Province & City -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Province</label>
        <input type="text" name="province" id="province" value="{{ old('province', $address->province ?? '') }}"
            required class="w-full rounded-lg border-gray-300 focus:border-[#0f172a] focus:ring-[#0f172a]">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
        <input type="text" name="city" id="city" value="{{ old('city', $address->city ?? '') }}" required
            class="w-full rounded-lg border-gray-300 focus:border-[#0f172a] focus:ring-[#0f172a]">
    </div>

    <!-- District & Sub-district -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">District (Kecamatan)</label>
        <input type="text" name="district" id="district" value="{{ old('district', $address->district ?? '') }}"
            required class="w-full rounded-lg border-gray-300 focus:border-[#0f172a] focus:ring-[#0f172a]">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Sub-district (Kelurahan)</label>
        <input type="text" name="subdistrict" id="subdistrict"
            value="{{ old('subdistrict', $address->subdistrict ?? '') }}" required
            class="w-full rounded-lg border-gray-300 focus:border-[#0f172a] focus:ring-[#0f172a]">
    </div>

    <!-- Full Address -->
    <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-2">Full Address</label>
        <textarea name="address" id="address" rows="3" required placeholder="Street name, building number, etc."
            class="w-full rounded-lg border-gray-300 focus:border-[#0f172a] focus:ring-[#0f172a]">{{ old('address', $address->address ?? '') }}</textarea>
    </div>

    <!-- Primary Address Checkbox -->
    <div class="md:col-span-2">
        <label class="flex items-center">
            <input type="checkbox" name="is_primary" value="1"
                {{ old('is_primary', $address->is_primary ?? false) ? 'checked' : '' }}
                class="rounded border-gray-300 text-[#0f172a] focus:ring-[#0f172a]">
            <span class="ml-2 text-sm text-gray-600">Set as primary address</span>
        </label>
    </div>
</div>

<!-- Buttons -->
<div class="flex justify-end space-x-2 mt-6">
    <a href="{{ route('customer.addresses.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
        Cancel
    </a>
    <button type="submit"
        class="px-4 py-2 bg-gradient-to-r from-[#0f172a] to-[#334155] text-white rounded-lg hover:opacity-90">
        {{ isset($address) ? 'Update Address' : 'Save Address' }}
    </button>
</div>

<script>
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    const resultsList = document.getElementById('resultsList');
    const loadingIndicator = document.getElementById('loadingIndicator');
    let debounceTimer;

    // Show/hide results dropdown
    searchInput.addEventListener('focus', () => searchResults.classList.remove('hidden'));
    document.addEventListener('click', (e) => {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.add('hidden');
        }
    });

    // Handle input changes
    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        const query = this.value.trim();

        if (query.length < 3) {
            searchResults.classList.add('hidden');
            return;
        }

        debounceTimer = setTimeout(() => {
            searchLocation(query);
        }, 500);
    });

    function searchLocation(query) {
        // Show loading
        resultsList.innerHTML = '';
        loadingIndicator.classList.remove('hidden');
        searchResults.classList.remove('hidden');

        // Fetch results from Nominatim
        fetch(
                `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&addressdetails=1&countrycodes=id`)
            .then(response => response.json())
            .then(data => {
                resultsList.innerHTML = '';

                if (data.length === 0) {
                    resultsList.innerHTML = '<li class="px-4 py-2 text-gray-500">No results found</li>';
                    return;
                }

                data.forEach(location => {
                    const li = document.createElement('li');
                    li.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer';
                    li.innerHTML = location.display_name;

                    li.addEventListener('click', () => {
                        selectLocation(location);
                        searchResults.classList.add('hidden');
                        searchInput.value = location.display_name;
                    });

                    resultsList.appendChild(li);
                });
            })
            .catch(error => {
                console.error('Error:', error);
                resultsList.innerHTML = '<li class="px-4 py-2 text-red-500">Error searching location</li>';
            })
            .finally(() => {
                loadingIndicator.classList.add('hidden');
            });
    }

    function selectLocation(location) {
        const address = location.address;

        // Update coordinates
        document.getElementById('latitude').value = location.lat;
        document.getElementById('longitude').value = location.lon;

        // Update address fields
        document.getElementById('province').value = address.state || '';
        document.getElementById('city').value = address.city || address.town || address.municipality || '';
        document.getElementById('district').value = address.county || address.district || '';
        document.getElementById('subdistrict').value = address.suburb || address.neighbourhood || '';
        document.getElementById('postal_code').value = address.postcode || '';
        document.getElementById('address').value = location.display_name;
    }
</script>
