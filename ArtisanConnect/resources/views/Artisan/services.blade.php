<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Services - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50 font-sans flex">
<aside class="w-72 bg-slate-900 text-white hidden lg:block shadow-xl min-h-screen">
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
            class="flex items-center py-3 px-4 rounded-xl {{ request()->routeIs('artisan.services.*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/20' : 'hover:bg-slate-800 text-slate-400 hover:text-white' }} transition">
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
            <a href="/logout"
                class="flex items-center py-3 px-4 rounded-xl text-red-400 hover:bg-red-500/10 transition">
                <i class="fa-solid fa-right-from-bracket mr-3"></i> Déconnexion
            </a>
        </div>
    </nav>
</aside>

    <main class="flex-1">
        <header class="bg-white border-b p-4 flex justify-between items-center px-8">
            <h2 class="text-xl font-black text-slate-800 uppercase tracking-wide">Gestion des Services</h2>
            <div class="flex items-center space-x-6">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800">{{ $user->name }}</p>
                    <p class="text-xs text-orange-600 font-semibold">{{ $user->city }}</p>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=f97316&color=fff"
                    class="w-12 h-12 rounded-2xl border-2 border-orange-100 shadow-sm">
            </div>
        </header>

        <div class="p-8 space-y-8">

            <div class="bg-white rounded-3xl shadow-sm p-8 border border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
                    <span
                        class="w-8 h-8 bg-orange-500 text-white rounded-lg flex items-center justify-center mr-3 shadow-md">
                        <i class="fa-solid fa-plus text-xs"></i>
                    </span>
                    Nouveau Service
                </h3>

                <form action="{{ route('artisan.services.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="md:col-span-1">
                            <label class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1">Ville</label>
                            <select name="city_id" required
                                class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none font-bold text-slate-700 cursor-pointer shadow-sm">
                                <option value="" disabled selected>Choisir la ville...</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-1">
                            <label class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1">Catégorie</label>
                            <select name="category_id" required
                                class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none font-bold text-slate-700 cursor-pointer shadow-sm">
                                <option value="" disabled selected>Choisir métier...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1">Nom du
                                service</label>
                            <input type="text" name="title" required placeholder="Ex: Installation Chauffe-eau"
                                class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none font-bold text-slate-700 shadow-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-slate-700 font-bold">
                        <div class="md:col-span-1">
                            <label class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1">Prix (DH)</label>
                            <input type="number" name="price" required placeholder="Ex: 150"
                                class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none font-bold text-slate-700 shadow-sm">
                        </div>

                        <div class="md:col-span-1">
                            <label class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1">Durée
                                (Optionnel)</label>
                            <input type="text" name="duration" placeholder="Ex: 2 heures"
                                class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none font-bold shadow-sm">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1">Description
                                courte</label>
                            <textarea name="description" rows="1" required placeholder="Décrivez brièvement le service..."
                                class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none font-bold shadow-sm"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-10 py-4 bg-slate-900 text-white font-black rounded-2xl hover:bg-orange-600 transition shadow-lg uppercase text-xs tracking-widest hover:-translate-y-1 duration-300">
                            Ajouter le service
                        </button>
                    </div>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    @forelse($services as $service)
                        <div class="relative bg-white p-6 rounded-3xl border border-slate-100 shadow-sm group">
                            <div class="absolute top-4 right-4 flex flex-col items-end gap-2">
                                <span
                                    class="bg-blue-50 text-blue-600 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
                                    {{ $service->category->name }}
                                </span>
                                <span
                                    class="bg-orange-50 text-orange-600 text-[9px] font-black px-2 py-0.5 rounded-md uppercase flex items-center gap-1">
                                    <i class="fa-solid fa-location-dot"></i>
                                    {{ $service->city->name ?? 'Maroc' }}
                                </span>
                            </div>

                            <div class="flex items-center gap-4 mb-4">
                                <div
                                    class="p-3 bg-slate-50 rounded-2xl text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition">
                                    <i class="fa-solid fa-screwdriver-wrench text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-slate-800">{{ $service->title }}</h4>
                                    <p class="text-xs text-slate-400 font-bold uppercase">
                                        {{ $service->duration ?? 'Temps flexible' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                <span class="text-xl font-black text-slate-800">{{ $service->price }} DH</span>

                                <form action="{{ route('artisan.services.destroy', $service->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition"
                                        onclick="return confirm('Supprimer ce service ?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div
                            class="md:col-span-2 text-center py-20 bg-white rounded-3xl border-2 border-dashed border-slate-100">
                            <i class="fa-solid fa-briefcase text-4xl text-slate-200 mb-4"></i>
                            <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Aucune offre de
                                service active.</p>
                        </div>
                    @endforelse
                </div>

            </div>
    </main>
</body>

</html>
