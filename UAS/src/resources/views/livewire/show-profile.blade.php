@php
    $user = Auth::user();
@endphp
<main class="bg-gradient-to-b from-purple-100 to-white min-h-screen py-12 px-4">
    <div class="max-w-2xl w-full bg-white rounded-2xl shadow-xl p-8 mx-auto">
        <!-- Profile Header -->
        <div class="flex flex-col items-center mb-8">
            @if($user && $user->avatar_url && file_exists(public_path('front/images/' . $user->avatar_url)))
                <img src="{{ asset('front/images/' . $user->avatar_url) }}" alt="Foto Profil" class="w-32 h-32 rounded-full shadow mb-4">
            @else
                <img src="{{ asset('/front/images/foto profile.png') }}" alt="Defaut" class="w-32 h-32 rounded-full shadow mb-4">
            @endif

            <h2 class="text-2xl font-bold text-purple-700 mb-1">{{ $user->name ?? 'Skincare Kecantikan' }}</h2>
            <p class="text-gray-500 mb-1">Pecinta Skincare</p>
            <p class="text-gray-400 mb-4">Jakarta, Indonesia</p>
            <div class="flex gap-2">
                <span class="inline-flex items-center px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-semibold">Member Sejak 2024</span>
            </div>
        </div>
        <!-- About Me -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-purple-700 mb-2">Tentang Saya</h3>
            <p class="text-gray-600">Saya adalah penggemar skincare yang suka mencoba produk baru dan berbagi pengalaman seputar perawatan kulit. Percaya bahwa kulit sehat adalah investasi jangka panjang.</p>
        </div>
        <!-- Social Media -->
        <div>
            <h3 class="text-lg font-semibold text-purple-700 mb-2">Kontak Kami</h3>
            <ul class="space-y-1">
                <li>Email: <a href="mailto:your@email.com" class="text-purple-600 hover:underline">your@email.com</a></li>
                <li>WhatsApp: <a href="https://wa.me/6281234567890" target="_blank" class="text-purple-600 hover:underline">+62 812-3456-7890</a></li>
                <li>Alamat: Jl. Contoh No. 123, Jakarta</li>
            </ul>
        </div>
    </div>
</main>
