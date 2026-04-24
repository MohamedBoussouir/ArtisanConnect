<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtisanConnect - Trouvez les meilleurs artisans au Maroc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-gradient {
            background: linear-gradient(rgba(30, 58, 138, 0.8), rgba(30, 58, 138, 0.8)),
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
                            class="bg-blue-700 text-white px-6 py-2.5 rounded-xl hover:bg-blue-800 transition shadow-lg shadow-blue-200 font-bold text-sm">
                            S'inscrire
                        </a>
                    @endguest

                    @auth
                        <div class="flex items-center gap-6 bg-slate-50 px-4 py-2 rounded-2xl border border-slate-100">

                            <div class="flex items-center gap-2 border-r pr-4 border-slate-200">
                                <a href="/user/dashboard" title="Tableau de bord"
                                    class="w-9 h-9 flex items-center justify-center text-blue-700 hover:bg-blue-700 hover:text-white transition bg-white rounded-lg shadow-sm border border-blue-100">
                                    <i class="fa-solid fa-gauge-high text-sm"></i>
                                </a>

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
                                    <span class="text-[9px] text-orange-600 font-black uppercase tracking-tighter">
                                        {{ Auth::user()->role === 'artisan' ? 'Artisan Partenaire' : 'Membre Particulier' }}
                                    </span>
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

                <div class="md:hidden flex items-center">
                    <button class="text-gray-600 focus:outline-none">
                        <i class="fa-solid fa-bars-staggered text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    @auth
        @if (auth()->user()->roles == 'user')
            <section class="max-w-7xl mx-auto px-4 -mt-12 relative z-10">
                <div
                    class="bg-white rounded-3xl shadow-2xl p-6 border border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6 transition-all hover:shadow-orange-500/5">
                    <div class="flex items-center gap-5">
                        <div
                            class="w-14 h-14 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center shadow-inner text-xl">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-800 text-lg">Ravi de vous revoir,
                                {{ explode(' ', auth()->user()->name)[0] }}!</h4>
                            <p class="text-sm text-slate-500 font-medium">Vous avez <span
                                    class="text-orange-600 font-bold">3</span> interventions terminées à évaluer.</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <a href="#history"
                            class="flex-1 md:flex-none text-center px-6 py-3.5 bg-slate-100 text-slate-700 rounded-2xl font-bold text-sm hover:bg-slate-200 transition">
                            <i class="fa-solid fa-clock-rotate-left mr-2"></i> Historique
                        </a>
                        <a href="#categories"
                            class="flex-1 md:flex-none text-center px-8 py-3.5 bg-blue-700 text-white rounded-2xl font-bold text-sm hover:bg-blue-800 transition shadow-lg shadow-blue-200 uppercase tracking-widest">
                            Trouver un artisan
                        </a>
                    </div>
                </div>
            </section>
        @endif
    @endauth

    <section class="hero-gradient py-28 px-4 text-center text-white relative">
        <div class="max-w-4xl mx-auto relative z-10">
            <h1 class="text-5xl md:text-7xl font-black mb-8 leading-tight tracking-tighter">
                Réalisez vos projets <br>
                <span class="text-orange-500">en un clic.</span>
            </h1>
            <p class="text-xl md:text-2xl mb-12 text-gray-200 font-medium max-w-2xl mx-auto leading-relaxed">
                Trouvez instantanément des artisans qualifiés au Maroc pour tous vos besoins domestiques.
            </p>



            <div class="mt-10">
                <a href="{{ route('artisans.search') }}"
                    class="inline-flex items-center gap-4 bg-orange-500 hover:bg-orange-600 text-white font-black py-5 px-12 rounded-[2.5rem] transition-all duration-300 shadow-2xl hover:scale-105 active:scale-95 border-4 border-white/20 uppercase tracking-widest text-lg shadow-orange-500/20">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Trouver un service
                </a>

                <p class="mt-6 text-blue-200 text-sm font-bold opacity-80 uppercase tracking-widest">
                    Plomberie, Électricité, Peinture et plus...
                </p>
            </div>

            <p class="mt-6 text-sm text-blue-200 font-bold flex items-center justify-center gap-2">
                <i class="fa-solid fa-shield-halved"></i>
                Plus de 1500 artisans vérifiés à votre service
            </p>
        </div>
    </section>

    <section id="categories" class="py-16 max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Nos Catégories Populaires</h2>
            <div class="h-1 w-20 bg-orange-500 mx-auto mt-2"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div
                class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition text-center border border-gray-100 group cursor-pointer">
                <div
                    class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-700 transition">
                    <i class="fa-solid fa-faucet-reverse text-2xl text-blue-700 group-hover:text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">Plomberie</h3>
            </div>

            <div
                class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition text-center border border-gray-100 group cursor-pointer">
                <div
                    class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-700 transition">
                    <i class="fa-solid fa-bolt text-2xl text-blue-700 group-hover:text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">Électricité</h3>
            </div>

            <div
                class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition text-center border border-gray-100 group cursor-pointer">
                <div
                    class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-700 transition">
                    <i class="fa-solid fa-paint-roller text-2xl text-blue-700 group-hover:text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">Peinture</h3>
            </div>

            <div
                class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition text-center border border-gray-100 group cursor-pointer">
                <div
                    class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-700 transition">
                    <i class="fa-solid fa-chair text-2xl text-blue-700 group-hover:text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">Menuiserie</h3>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-16 px-4">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Pourquoi choisir ArtisanConnect ?</h2>
                <ul class="space-y-4">
                    <li class="flex items-start gap-4">
                        <div class="bg-green-100 p-2 rounded-full text-green-600"><i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">Artisans Qualifiés</p>
                            <p class="text-gray-600 text-sm">Consultez leurs portfolios et photos de chantiers réels.
                            </p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="bg-green-100 p-2 rounded-full text-green-600"><i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">Transparence totale</p>
                            <p class="text-gray-600 text-sm">Système de notation par étoiles basé sur l'expérience
                                client.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="bg-green-100 p-2 rounded-full text-green-600"><i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800">Disponibilité en temps réel</p>
                            <p class="text-gray-600 text-sm">Sachez instantanément qui est libre pour intervenir.</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="md:w-1/2">
                <img src="https://images.unsplash.com/photo-1504148454959-5776b416631e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                    alt="Artisan" class="rounded-3xl shadow-2xl">
            </div>
        </div>
    </section>

    <footer class="bg-blue-900 text-gray-300 py-12 px-4">
        <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-10">
            <div>
                <span class="text-2xl font-bold text-white leading-loose">Artisan<span
                        class="text-orange-500">Connect</span></span>
                <p class="mt-4 text-sm leading-relaxed">Simplifier la rencontre entre le savoir-faire artisanal et vos
                    besoins domestiques partout au Maroc.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Lien Rapides</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-orange-500">Devenir Artisan</a></li>
                    <li><a href="#" class="hover:text-orange-500">Villes couvertes</a></li>
                    <li><a href="#" class="hover:text-orange-500">Mentions Légales</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4">Newsletter</h4>
                <div class="flex">
                    <input type="text" placeholder="Votre email"
                        class="bg-blue-800 border-none rounded-l-lg p-3 text-sm flex-1 focus:ring-0">
                    <button class="bg-orange-500 p-3 rounded-r-lg hover:bg-orange-600 transition">
                        <i class="fa-solid fa-paper-plane text-white"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="text-center mt-12 pt-8 border-t border-blue-800 text-xs">
            © 2024 ArtisanConnect. Tous droits réservés. Créé avec ❤️ pour l'artisanat marocain.
        </div>
    </footer>

</body>

</html>
