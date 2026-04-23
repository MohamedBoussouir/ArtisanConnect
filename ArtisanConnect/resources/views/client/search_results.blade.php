<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-mini-gradient {
            background: linear-gradient(rgba(30, 58, 138, 0.9), rgba(30, 58, 138, 0.9)),
                url('https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-black text-blue-700">
                        Artisan<span class="text-orange-500">Connect</span>
                    </a>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="/"
                        class="text-gray-600 hover:text-blue-700 font-bold text-sm uppercase tracking-widest transition">Accueil</a>
                    <a href="#categories"
                        class="text-gray-600 hover:text-blue-700 font-bold text-sm uppercase tracking-widest transition">Métiers</a>

                    @guest
                        <div class="h-6 w-px bg-gray-200 mx-2"></div>
                        <a href="/login"
                            class="text-gray-700 font-bold text-sm hover:text-blue-700 transition">Connexion</a>
                        <a href="/register"
                            class="bg-blue-700 text-white px-6 py-2.5 rounded-xl hover:bg-blue-800 transition shadow-lg shadow-blue-200 font-bold text-sm">S'inscrire</a>
                    @endguest

                    @auth
                        <div class="flex items-center gap-6 bg-slate-50 px-4 py-2 rounded-2xl border border-slate-100">
                            <div class="flex items-center gap-2 border-r pr-4 border-slate-200">
                                <button title="Mes Favoris"
                                    class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-orange-500 transition hover:bg-white rounded-lg">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                                <a href="/profile/settings" title="Paramètres"
                                    class="w-9 h-9 flex items-center justify-center text-slate-400 hover:text-blue-700 transition hover:bg-white rounded-lg">
                                    <i class="fa-solid fa-user-gear"></i>
                                </a>
                            </div>

                            <div class="flex items-center gap-3">
                                <div class="text-right">
                                    <p class="text-xs font-black text-slate-800 leading-none">{{ Auth::user()->name }}</p>
                                    <span class="text-[9px] text-orange-600 font-black uppercase tracking-tighter">Membre
                                        Particulier</span>
                                </div>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1E3A8A&color=fff"
                                    class="w-9 h-9 rounded-xl shadow-sm border-2 border-white">
                            </div>

                            <div class="border-l pl-4 border-slate-200">
                                <a href="{{ route('logout') }}" class="text-slate-400 hover:text-red-500 transition">
                                    <i class="fa-solid fa-power-off"></i>
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <header class="hero-mini-gradient py-12 text-center text-white">
        <h1 class="text-3xl md:text-5xl font-black tracking-tighter uppercase">Nos Artisans Partenaires</h1>
        <p class="text-blue-200 mt-2 font-bold tracking-widest text-sm uppercase">Trouvez l'expert qu'il vous faut</p>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">

            <aside class="w-full lg:w-1/4">
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 sticky top-24">
                    <h3
                        class="text-xl font-black text-slate-800 mb-6 flex items-center gap-2 uppercase tracking-tighter">
                        <i class="fa-solid fa-filter text-orange-500"></i> Filtrer
                    </h3>

                    <form action="{{ route('artisans.search') }}" method="GET" class="space-y-6">
                        <div>
                            <label
                                class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Métier</label>
                            <select name="category"
                                class="w-full bg-slate-50 border-none rounded-xl py-3 px-4 font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 cursor-pointer outline-none">
                                <option value="">Tous les métiers</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Ville</label>
                            <select name="city"
                                class="w-full bg-slate-50 border-none rounded-xl py-3 px-4 font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 cursor-pointer outline-none">
                                <option value="">Toutes les villes</option>


                                @foreach ($villes as $v)
                                    <option value="{{ $v->name }}"
                                        {{ request('city') == $v->name ? 'selected' : '' }}>
                                        {{ $v->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full py-4 bg-blue-700 text-white rounded-xl font-black uppercase tracking-widest text-[10px] hover:bg-slate-900 transition shadow-lg shadow-blue-100">
                            Appliquer
                        </button>

                        <a href="{{ route('artisans.search') }}"
                            class="block text-center text-[10px] font-bold text-slate-400 hover:text-orange-500 uppercase tracking-widest">
                            Réinitialiser
                        </a>
                    </form>
                </div>
            </aside>

            <div class="flex-1">
                <div class="flex justify-between items-center mb-8">
                    <p class="text-slate-400 font-bold text-sm">
                        <span class="text-slate-800 font-black">{{ $services->count() }}</span> artisans correspondent
                        à votre recherche
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($services as $service)
                        <div
                            class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-slate-100 hover:shadow-xl transition-all group relative overflow-hidden">

                            <span
                                class="absolute top-0 right-0 bg-orange-100 text-orange-600 text-[10px] font-black px-4 py-1.5 rounded-bl-2xl uppercase shadow-sm">
                                {{ $service->category->name ?? 'Service' }}
                            </span>

                            <div class="flex items-center gap-4 mb-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($service->artisan->name) }}&background=1E3A8A&color=fff"
                                    class="w-12 h-12 rounded-xl border-2 border-white shadow-sm">
                                <div>
                                    <h4 class="font-black text-slate-800 leading-tight">{{ $service->title }}</h4>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                                        Par {{ $service->artisan->name }}
                                    </p>
                                </div>
                            </div>

                            <p class="text-slate-500 text-xs mb-6 line-clamp-2 italic font-medium">
                                {{ $service->description }}
                            </p>

                            <div class="flex items-center justify-between bg-slate-50 p-4 rounded-2xl mb-6">
                                <div class="flex flex-col">
                                    <span class="text-[10px] text-slate-400 font-black uppercase">Prix Fixe</span>
                                    <span class="text-lg font-black text-slate-800">{{ $service->price }} DH</span>
                                </div>

                                <div class="text-right">
                                    <span class="text-[10px] text-slate-400 font-black uppercase block">Ville</span>
                                    <span class="text-xs font-bold text-slate-600 flex items-center justify-end gap-1">
                                        <i class="fa-solid fa-location-dot text-orange-500"></i>
                                        {{ $service->city->name ?? 'Maroc' }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2">

                                <a href="/artisan/profile/{{ $service->artisan->id }}"
                                    class="flex-1 py-3 bg-slate-100 text-slate-600 text-center rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-slate-200 transition">
                                    Profil
                                </a>
                                <a href="{{ route('services.show', $service->id) }}"
                                    class="flex-[2] py-3 bg-slate-900 text-white text-center rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-blue-600 transition shadow-lg flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-circle-info"></i>
                                    Voir Détails
                                </a>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-full py-20 text-center bg-white rounded-[2.5rem] border-4 border-dashed border-slate-50">
                            <i class="fa-solid fa-magnifying-glass text-5xl text-slate-200 mb-4"></i>
                            <p class="text-slate-400 font-bold italic">Aucun service trouvé pour ces critères.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>

    <footer class="bg-blue-900 text-gray-300 py-12 px-4 mt-20">
        <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-10 text-center md:text-left">
            <div>
                <span class="text-2xl font-bold text-white">Artisan<span class="text-orange-500">Connect</span></span>
                <p class="mt-4 text-sm leading-relaxed opacity-70 italic">Simplifier la rencontre entre le savoir-faire
                    artisanal et vos besoins domestiques partout au Maroc.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4 uppercase text-xs tracking-widest">Liens Rapides</h4>
                <ul class="space-y-2 text-sm font-bold">
                    <li><a href="#" class="hover:text-orange-500 transition">Devenir Artisan</a></li>
                    <li><a href="#" class="hover:text-orange-500 transition">Villes couvertes</a></li>
                    <li><a href="#" class="hover:text-orange-500 transition">Mentions Légales</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4 uppercase text-xs tracking-widest">Newsletter</h4>
                <div class="flex bg-blue-800 rounded-xl overflow-hidden p-1">
                    <input type="text" placeholder="Votre email"
                        class="bg-transparent border-none p-3 text-sm flex-1 focus:ring-0 text-white">
                    <button class="bg-orange-500 px-4 py-2 rounded-lg hover:bg-orange-600 transition">
                        <i class="fa-solid fa-paper-plane text-white"></i>
                    </button>
                </div>
            </div>
        </div>
        <div
            class="text-center mt-12 pt-8 border-t border-blue-800 text-[10px] font-bold uppercase tracking-widest opacity-50">
            © 2026 ArtisanConnect. Tous droits réservés.
        </div>
    </footer>

</body>

</html>
