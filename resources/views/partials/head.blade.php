<!-- Meta Tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Page Title -->
<title>{{ $title ?? config('app.name') }}</title>

<!-- Favicon & App Icon -->
<link rel="icon" href="{{ asset('images/snhs.png') }}" type="image/png/jpg">
<link rel="apple-touch-icon" href="{{ asset('images/snhs.png') }}">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<!-- Font Awesome 6 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-pap8xTmsXci/..." crossorigin="anonymous" referrerpolicy="no-referrer" />


{{-- 
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>
<script
  src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script> --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Styles & JS -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- Flux Appearance -->
@fluxAppearance
