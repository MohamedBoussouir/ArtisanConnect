<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil Pro - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans">

    <div class="flex min-h-screen">
        <aside class="w-72 bg-slate-900 text-white hidden lg:block shadow-xl">
            <div class="p-8 text-2xl font-bold border-b border-slate-800 tracking-tight">
                Artisan<span class="text-orange-500">Connect</span>
            </div>
            <nav class="mt-8 p-4 space-y-3">
                <a href="/artisan/dashboard"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-chart-line mr-3"></i> Vue d'ensemble
                </a>
                <a href="{{ route('artisan.bookings') }}"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition {{ request()->routeIs('artisan.bookings') ? 'bg-slate-800 text-white' : '' }}">
                    <i class="fa-solid fa-calendar-check mr-3"></i> Mes Réservations
                </a>
                <a href="{{ route('artisan.profile.edit') }}"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-user-gear mr-3"></i> Modifier Profil
                </a>
                <a href="{{ route('artisan.services.index') }}"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-briefcase mr-3"></i> Mes Services
                </a>
                <a href="{{ route('artisan.Mon_Portfolio') }}"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-images mr-3"></i> Mon Portfolio
                </a>
                <a href="#"
                    class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-star mr-3"></i> Avis Clients
                </a>
                <div class="pt-10">
                    <a href="{{ route('artisan.profile') }}"
                        class="flex items-center py-3 px-4 rounded-xl bg-orange-500 text-white transition shadow-lg shadow-orange-500/20">
                        <i class="fa-solid fa-user-gear mr-3"></i>
                        Mon Profil
                    </a>
                    <a href="/logout"
                        class="flex items-center py-3 px-4 rounded-xl text-red-400 hover:bg-red-500/10 transition">
                        <i class="fa-solid fa-right-from-bracket mr-3"></i> Déconnexion
                    </a>
                </div>
            </nav>
        </aside>

        <main class="flex-1">
            <header class="bg-white border-b p-6 flex justify-between items-center px-10">
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter italic">Paramètres du
                        Compte</h2>
                    <p class="text-sm text-slate-500 italic">Gérez vos informations de contact et de sécurité</p>
                </div>
                <div class="flex items-center gap-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f97316&color=fff"
                        class="w-12 h-12 rounded-2xl border-2 border-orange-100 shadow-sm">
                </div>
            </header>

            <div class="p-10 max-w-5xl mx-auto">
                {{-- تنبيه النجاح --}}
                @if (session('success'))
                    <div
                        class="mb-8 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-xl font-bold text-sm">
                        <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('artisan.profile.update') }}" method="POST" class="space-y-8">
    @csrf
    @method('PUT')

    <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100 relative overflow-hidden">
        <h3 class="text-lg font-black text-slate-800 uppercase tracking-widest mb-10 flex items-center">
            <span class="w-8 h-8 bg-orange-500 text-white rounded-lg flex items-center justify-center mr-4 shadow-lg shadow-orange-200">
                <i class="fa-solid fa-id-badge text-xs"></i>
            </span>
            Informations de Contact & Métier
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-3">
                <label class="text-[11px] font-black uppercase text-slate-400 ml-2 tracking-widest">Nom complet</label>
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-sm"></i>
                    <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl p-4 pl-12 text-slate-800 font-bold transition-all outline-none">
                </div>
            </div>

            <div class="space-y-3">
                <label class="text-[11px] font-black uppercase text-slate-400 ml-2 tracking-widest">Email professionnel</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-sm"></i>
                    <input type="email" name="email" value="{{ $user->email }}" class="w-full bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl p-4 pl-12 text-slate-800 font-bold transition-all outline-none">
                </div>
            </div>

            <div class="space-y-3">
                <label class="text-[11px] font-black uppercase text-slate-400 ml-2 tracking-widest">Numéro de Téléphone</label>
                <div class="relative">
                    <i class="fa-solid fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-sm"></i>
                    <input type="text" name="phone" value="{{ $user->phone }}" placeholder="+212 ..." class="w-full bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl p-4 pl-12 text-slate-800 font-bold transition-all outline-none">
                </div>
            </div>

            <div class="space-y-3">
                <label class="text-[11px] font-black uppercase text-slate-400 ml-2 tracking-widest">Ville</label>
                <div class="relative">
                    <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-sm"></i>
                    <select name="city" class="w-full bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl p-4 pl-12 text-slate-800 font-bold transition-all outline-none appearance-none cursor-pointer">
                        @foreach (['Casablanca', 'Marrakech', 'Youssoufia', 'Rabat', 'Tanger', 'Agadir'] as $city)
                            <option value="{{ $city }}" {{ $user->city == $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="space-y-3 md:col-span-2">
                <label class="text-[11px] font-black uppercase text-slate-400 ml-2 tracking-widest">Votre Spécialité (Catégorie)</label>
                <div class="relative">
                    <i class="fa-solid fa-briefcase absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-sm"></i>
                    <select name="category_id" class="w-full bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl p-4 pl-12 text-slate-800 font-bold transition-all outline-none appearance-none cursor-pointer">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ ($user->artisanProfile->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="space-y-3 md:col-span-2">
                <label class="text-[11px] font-black uppercase text-slate-400 ml-2 tracking-widest">Description professionnelle (Bio)</label>
                <textarea name="bio" rows="4" placeholder="Décrivez vos services..." 
                    class="w-full bg-slate-50 border-2 border-transparent focus:border-orange-500 focus:bg-white rounded-2xl p-4 text-slate-800 font-bold transition-all outline-none shadow-inner">{{ $user->artisanProfile->bio ?? '' }}</textarea>
            </div>
        </div>
    </div>

    <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-slate-100">
        </div>

    <div class="flex items-center justify-end gap-6 pt-6">
        <button type="button" onclick="window.history.back()" class="text-slate-400 font-black uppercase text-xs tracking-widest hover:text-slate-600 transition">Annuler</button>
        <button type="submit" class="bg-orange-500 text-white px-12 py-5 rounded-2xl font-black uppercase text-xs tracking-[0.2em] hover:bg-orange-600 transition-all shadow-xl shadow-orange-200 active:scale-95">
            Mettre à jour le profil
        </button>
    </div>
</form>
            </div>
        </main>
    </div>

</body>

</html>
