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
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-blue-700">Artisan<span
                            class="text-orange-500">Connect</span></span>
                </div>
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#" class="text-gray-600 hover:text-blue-700 transition">Accueil</a>
                    <a href="#categories" class="text-gray-600 hover:text-blue-700 transition">Métiers</a>
                    <a href="#" class="text-gray-600 hover:text-blue-700 transition">Comment ça marche</a>
                    @if (Auth()->user() == null)
                        <a href="/login" class="text-gray-700 font-medium">Connexion</a>
                        <a href="/register"
                            class="bg-blue-700 text-white px-5 py-2 rounded-lg hover:bg-blue-800 transition shadow-md">S'inscrire</a>
                    @else
                        <a href="/logout"
                            class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition shadow-md font-medium text-sm">
                            <i class="fa-solid fa-right-from-bracket mr-2"></i>Se déconnecter
                        </a>
                    @endif
                </div>
                <div class="md:hidden flex items-center">
                    <button class="text-gray-600 focus:outline-none">
                        <i class="fa-solid fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-gradient py-20 px-4 text-center text-white">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">
                Trouvez l'artisan de confiance pour vos travaux
            </h1>
            <p class="text-xl md:text-2xl mb-10 text-gray-200">
                La première plateforme de mise en relation avec les artisans qualifiés au Maroc.
            </p>

            <form action="/search" method="GET"
                class="bg-white p-3 rounded-2xl shadow-2xl flex flex-col md:flex-row gap-3 max-w-3xl mx-auto">
                <div class="flex-1 relative">
                    <i class="fa-solid fa-hammer absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <select name="category"
                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border-none rounded-xl text-gray-700 focus:ring-2 focus:ring-blue-500 appearance-none">
                        <option value="">Quel métier ?</option>
                        <option value="plombier">Plombier</option>
                        <option value="electricien">Électricien</option>
                        <option value="peintre">Peintre</option>
                        <option value="menuisier">Menuisier</option>
                    </select>
                </div>
                <div class="flex-1 relative">
                    <i class="fa-solid fa-location-dot absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <select name="city"
                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border-none rounded-xl text-gray-700 focus:ring-2 focus:ring-blue-500 appearance-none">
                        <option value="">Dans quelle ville ?</option>
                        <option value="casablanca">Casablanca</option>
                        <option value="rabat">Rabat</option>
                        <option value="marrakech">Marrakech</option>
                        <option value="tanger">Tanger</option>
                    </select>
                </div>
                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-xl transition duration-300 shadow-lg">
                    Rechercher
                </button>
            </form>
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
