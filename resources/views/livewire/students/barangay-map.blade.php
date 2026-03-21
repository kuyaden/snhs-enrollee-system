<div class="w-full">
    <!-- Main Layout -->
    <div x-data="{ showMap: false }"
        x-init="$nextTick(() => {
            Livewire.on('sidebar-map-visible', () => {
                showMap = true;
                setTimeout(() => initializeMap(), 300);
            });
            setTimeout(() => { if (!window.mapInitialized) initializeMap(); }, 400);
        })"
        class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        <!-- Map Section -->
        <div class="lg:col-span-3">
            <div
                class="w-full bg-white dark:bg-neutral-900 rounded-2xl shadow-xl p-6 space-y-6 border border-gray-100 dark:border-neutral-800 transition-all duration-300 hover:shadow-2xl">

                <!-- Header -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="bi bi-geo-alt-fill text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100">Student Distribution Map</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Barangay-based student mapping</p>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <label
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                            <i class="bi bi-search text-blue-500"></i> Search Barangay
                        </label>
                        <select id="barangay-select"
                            class="w-full p-3 border-2 border-gray-200 dark:border-neutral-700 rounded-xl bg-white dark:bg-neutral-800 text-gray-900 dark:text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-900 transition-all duration-200 shadow-sm">
                            <option value="">Select a Barangay...</option>
                            @foreach($barangays as $barangay)
                                <option value="{{ $barangay['lat'] }},{{ $barangay['lng'] }}"
                                    data-name="{{ $barangay['name'] }}" data-count="{{ $barangay['student_count'] }}">
                                    {{ $barangay['name'] }} • {{ $barangay['student_count'] }} students
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="sm:w-48">
                        <label
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                            <i class="bi bi-funnel text-orange-500"></i> Filter
                        </label>
                        <select id="count-filter"
                            class="w-full p-3 border-2 border-gray-200 dark:border-neutral-700 rounded-xl bg-white dark:bg-neutral-800 text-gray-900 dark:text-white focus:border-orange-500 focus:ring-2 focus:ring-orange-200 dark:focus:ring-orange-900 transition-all duration-200 shadow-sm">
                            <option value="all">All</option>
                            <option value="low">1–14</option>
                            <option value="medium">15–29</option>
                            <option value="high">30+</option>
                        </select>
                    </div>
                </div>

                <!-- Map -->
                <div class="relative">
                    <div id="map"
                        class="w-full h-[500px] rounded-xl border-2 border-gray-200 dark:border-neutral-700 shadow-inner overflow-hidden"></div>

                    <!-- Zoom Buttons -->
                    <div class="absolute top-4 right-4 flex flex-col gap-2 z-[1000]">
                        <button id="zoom-in"
                            class="w-10 h-10 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-600 rounded-lg shadow-lg flex items-center justify-center text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-neutral-700">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                        <button id="zoom-out"
                            class="w-10 h-10 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-neutral-600 rounded-lg shadow-lg flex items-center justify-center text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-neutral-700">
                            <i class="bi bi-dash-lg"></i>
                        </button>
                    </div>
                </div>

                <!-- Legend -->
                <div
                    class="bg-gradient-to-r from-gray-50 to-blue-50 dark:from-neutral-800 dark:to-blue-900/20 rounded-xl p-4 border border-gray-200 dark:border-neutral-700">
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
                        <i class="bi bi-legend text-purple-500"></i> Legend
                    </h4>
                    <div class="flex flex-wrap items-center gap-6">
                        <div class="flex items-center gap-3">
                            <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png" class="w-4 h-7" alt="">
                            <span class="text-sm text-gray-700 dark:text-gray-300">1–14 students</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-orange.png" class="w-4 h-7" alt="">
                            <span class="text-sm text-gray-700 dark:text-gray-300">15–29 students</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png" class="w-4 h-7" alt="">
                            <span class="text-sm text-gray-700 dark:text-gray-300">30+ students</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Panel -->
        <div class="lg:col-span-1">
            <div id="info-card"
                class="bg-gradient-to-b from-white to-blue-50 dark:from-neutral-900 dark:to-blue-900/10 rounded-2xl shadow-xl p-6 h-[500px] flex flex-col justify-between border-2 border-blue-100 dark:border-blue-900/30">
                <div>
                    <div class="text-center mb-6">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                            <i class="bi bi-info-circle text-white text-2xl"></i>
                        </div>
                        <h3 id="info-name" class="text-xl font-bold text-gray-800 dark:text-gray-100">Barangay Details</h3>
                        <p id="info-count" class="text-gray-500 dark:text-gray-400 mt-1">Select a barangay</p>
                    </div>

                    <div class="space-y-4">
                        <div
                            class="bg-white dark:bg-neutral-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-neutral-700">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Student Count</span>
                                <span id="info-level"
                                    class="text-xs font-semibold px-2 py-1 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">---</span>
                            </div>
                            <div id="student-count"
                                class="text-3xl font-bold text-gray-800 dark:text-gray-100 text-center">-</div>
                        </div>

                        <div
                            class="bg-white dark:bg-neutral-800 rounded-xl p-4 shadow-sm border border-gray-200 dark:border-neutral-700">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="font-medium text-gray-600 dark:text-gray-400">Enrollment Level</span>
                                <span id="info-percentage" class="text-gray-500 dark:text-gray-400">0%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 mb-2">
                                <div id="info-progress"
                                    class="h-3 rounded-full bg-gradient-to-r from-green-500 to-red-500 transition-all duration-1000 ease-out"
                                    style="width: 0%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                <span>Low</span><span>Medium</span><span>High</span>
                            </div>
                        </div>
                    </div>
                </div>

                <button id="reset-view"
                    class="w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-semibold flex items-center justify-center gap-2 hover:scale-[1.02] transition-all duration-300 shadow-lg">
                    <i class="bi bi-arrow-repeat"></i> Reset Map View
                </button>
            </div>
        </div>
    </div>

    <!-- Leaflet + Plugins -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

    <script>
    let leafletMap = null;
    let markers = null;
    let bounds = null;

    document.addEventListener('livewire:load', () => {
        initializeMap();
    });

    function updateInfo(name, count) {
        document.getElementById('info-name').textContent = name;
        document.getElementById('student-count').textContent = count;
        document.getElementById('info-count').textContent = `${count} students`;

        const level = count >= 30 ? 'High' : count >= 15 ? 'Medium' : 'Low';
        const badge = document.getElementById('info-level');
        badge.textContent = level;
        badge.className = `text-xs font-semibold px-2 py-1 rounded-full ${
            count >= 30
                ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300'
                : count >= 15
                ? 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300'
                : 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300'
        }`;

        const progress = document.getElementById('info-progress');
        const percent = Math.min((count / 40) * 100, 100);
        progress.style.width = `${percent}%`;
        document.getElementById('info-percentage').textContent = `${Math.round(percent)}%`;
    }

    function initializeMap() {
        const mapContainer = document.getElementById('map');
        if (!mapContainer) return;

        if (leafletMap) {
            leafletMap.remove();
            leafletMap = null;
        }

        const barangays = @json($barangays);
        bounds = L.latLngBounds([]);
        markers = L.layerGroup();

        const lightTiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        const darkTiles = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png');

        const isDark = document.documentElement.classList.contains('dark');
        leafletMap = L.map(mapContainer).setView([11.0868, 124.9932], 13);
        (isDark ? darkTiles : lightTiles).addTo(leafletMap);

        barangays.forEach(({ name, lat, lng, student_count }) => {
            const color = student_count >= 30 ? 'red' : student_count >= 15 ? 'orange' : 'green';
            const icon = new L.Icon({
                iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${color}.png`,
                shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
            });

            const marker = L.marker([lat, lng], { icon })
                .bindPopup(`<b>${name}</b><br>${student_count} students`)
                .on('click', () => updateInfo(name, student_count)); //  Added click event
            markers.addLayer(marker);
            bounds.extend([lat, lng]);
        });

        leafletMap.addLayer(markers);
        leafletMap.fitBounds(bounds);

        //  Filter Functionality
        const filterSelect = document.getElementById('count-filter');
        filterSelect.addEventListener('change', () => {
            const filterValue = filterSelect.value;
            markers.clearLayers();
            barangays.forEach(({ name, lat, lng, student_count }) => {
                let show = false;
                if (filterValue === 'all') show = true;
                else if (filterValue === 'low' && student_count <= 14) show = true;
                else if (filterValue === 'medium' && student_count >= 15 && student_count <= 29) show = true;
                else if (filterValue === 'high' && student_count >= 30) show = true;

                if (show) {
                    const color = student_count >= 30 ? 'red' : student_count >= 15 ? 'orange' : 'green';
                    const icon = new L.Icon({
                        iconUrl: `https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-${color}.png`,
                        shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                    });
                    const marker = L.marker([lat, lng], { icon })
                        .bindPopup(`<b>${name}</b><br>${student_count} students`)
                        .on('click', () => updateInfo(name, student_count)); //  Keep sidebar updates after filter
                    markers.addLayer(marker);
                }
            });
        });

        document.getElementById('zoom-in')?.addEventListener('click', () => leafletMap.zoomIn());
        document.getElementById('zoom-out')?.addEventListener('click', () => leafletMap.zoomOut());
        document.getElementById('reset-view')?.addEventListener('click', () => leafletMap.fitBounds(bounds));

        document.getElementById('barangay-select')?.addEventListener('change', (e) => {
            const option = e.target.selectedOptions[0];
            if (!option.value) return;
            const [lat, lng] = option.value.split(',');
            leafletMap.flyTo([+lat, +lng], 15);
            updateInfo(option.dataset.name, option.dataset.count); //  Added dropdown update
        });

        setTimeout(() => leafletMap.invalidateSize(), 600);
    }
    </script>
</div>
