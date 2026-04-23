<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service->title }} - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-slate-50 font-sans">

    <nav class="bg-white border-b border-slate-100 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-6 h-20 flex justify-between items-center">
            <a href="{{ route('artisans.search') }}"
                class="text-slate-400 hover:text-blue-700 transition flex items-center gap-2 font-bold text-sm uppercase tracking-widest">
                <i class="fa-solid fa-arrow-left"></i> Retour aux résultats
            </a>
            <a href="/" class="text-xl font-black text-blue-700">Artisan<span
                    class="text-orange-500">Connect</span></a>
        </div>
    </nav>
    @if (session('success'))
        <div class="max-w-5xl mx-auto px-6 mt-6">
            <div
                class="bg-green-500 text-white p-6 rounded-[2rem] shadow-xl shadow-green-100 flex items-center justify-between animate-in fade-in slide-in-from-top duration-500">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <h4 class="font-black uppercase text-xs tracking-widest">Félicitations !</h4>
                        <p class="font-bold text-sm opacity-90">{{ session('success') }}</p>
                    </div>
                </div>
                <button onclick="this.parentElement.parentElement.remove()"
                    class="text-white/50 hover:text-white transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
        </div>
    @endif

    <main class="max-w-5xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <div class="lg:col-span-2 space-y-8">
                <div class="flex items-center gap-3">
                    <span
                        class="bg-orange-100 text-orange-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">
                        {{ $service->category->name }}
                    </span>
                    <span class="text-slate-300 font-bold text-xs italic">Publié le
                        {{ $service->created_at->format('d M, Y') }}</span>
                </div>

                <h1 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight italic">
                    {{ $service->title }}
                </h1>

                <div class="flex flex-wrap gap-6 items-center py-6 border-y border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Localisation</p>
                            <p class="font-bold text-slate-700">{{ $service->city->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center text-green-600">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tarif Service</p>
                            <p class="font-bold text-slate-700">{{ number_format($service->price, 2) }} DH</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter italic">Description du
                        Service</h3>
                    <p class="text-slate-600 leading-relaxed text-lg font-medium">
                        {{ $service->description }}
                    </p>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div
                    class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 sticky top-32 text-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($service->artisan->name) }}&background=1E3A8A&color=fff&size=128"
                        class="w-24 h-24 rounded-[2rem] mx-auto mb-6 border-4 border-white shadow-md">

                    <h3 class="text-2xl font-black text-slate-800">{{ $service->artisan->name }}</h3>
                    <p class="text-orange-500 font-bold text-xs uppercase tracking-[0.2em] mb-6">Artisan Partenaire</p>

                    <div class="space-y-3 mb-8">
                        <div class="flex items-center justify-center gap-2 text-slate-500 font-bold text-sm">
                            <i class="fa-solid fa-star text-yellow-400"></i> 4.9 (24 avis)
                        </div>
                        <div class="flex items-center justify-center gap-2 text-slate-500 font-bold text-sm">
                            <i class="fa-solid fa-check-double text-green-500"></i> Identité Vérifiée
                        </div>
                    </div>

                    <div class="space-y-3">

                        <a href="{{ route('bookings.create', $service->id) }}"
                            class="w-full flex items-center justify-center gap-3 py-4 bg-orange-500 text-white rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-orange-100">
                            <i class="fa-solid fa-calendar-check text-sm"></i>
                            Réserver maintenant
                        </a>

                        <div class="flex items-center gap-2 py-2">
                            <div class="flex-1 h-px bg-slate-100"></div>
                            <span class="text-[8px] font-black text-slate-300 uppercase">Ou contacter</span>
                            <div class="flex-1 h-px bg-slate-100"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <a href="tel:{{ $service->artisan->phone ?? '#' }}"
                                class="flex items-center justify-center gap-2 py-3 bg-slate-900 text-white rounded-xl font-black uppercase text-[9px] tracking-widest hover:bg-blue-700 transition-all">
                                <i class="fa-solid fa-phone"></i> Appeler
                            </a>
                            <a href="https://wa.me/{{ $service->artisan->phone ?? '' }}"
                                class="flex items-center justify-center gap-2 py-3 bg-green-500 text-white rounded-xl font-black uppercase text-[9px] tracking-widest hover:bg-green-600 transition-all">
                                <i class="fa-brands fa-whatsapp text-sm"></i> WhatsApp
                            </a>
                        </div>
                    </div>

                    <a href="/artisan/profile/{{ $service->artisan->id }}"
                        class="block mt-6 text-[10px] font-black text-slate-400 hover:text-orange-500 uppercase tracking-widest transition">
                        Voir le profil complet
                    </a>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-12 text-center text-slate-300 text-[10px] font-black uppercase tracking-[0.3em]">
        ArtisanConnect © 2026 · Confidentialité & Sécurité
    </footer>


</body>

</html>
