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



            <a href="{{ route('artisan.services.index') }}"
                class="flex items-center py-3 px-4 rounded-xl {{ request()->routeIs('artisan.services.*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-500/20' : 'hover:bg-slate-800 text-slate-400 hover:text-white' }} transition">
                <i class="fa-solid fa-briefcase mr-3"></i> Mes Services
            </a>

            <a href="{{ route('artisan.Mon_Portfolio') }}"
                class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                <i class="fa-solid fa-images mr-3"></i> Mon Portfolio
            </a>

            <a href="{{ route('artisan.reviews') }}"
                class="flex items-center py-3 px-4 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition group {{ request()->routeIs('artisan.reviews') ? 'bg-slate-800 text-white' : '' }}">
                <i class="fa-solid fa-star mr-3 text-orange-400"></i>
                Avis Clients
            </a>

            <div class="pt-10 border-t border-slate-50">
                <a href="{{ route('artisan.profile') }}"
                    class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium">
                    <i class="fa-solid fa-user-gear mr-3"></i>
                    Mon Profil
                </a>
                <a href="/"
                    class="flex items-center py-3 px-4 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-blue-700 transition font-medium mb-2">
                    <i class="fa-solid fa-house mr-3 text-sm"></i>
                    Retour au site
                </a>
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

                <form action="{{ route('artisan.services.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-8">
                    @csrf


                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- المدينة --}}
                        <div class="md:col-span-1">
                            <label
                                class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1 tracking-widest">Ville</label>
                            <div class="relative">
                                <select name="city_id" required
                                    class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none font-bold text-slate-700 cursor-pointer shadow-sm appearance-none">
                                    <option value="" disabled selected>Choisir la ville...</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>
                        </div>


                        <div class="md:col-span-1">
                            <label
                                class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1 tracking-widest">Catégorie</label>
                            <div class="relative">
                                <select name="category_id" required
                                    class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none font-bold text-slate-700 cursor-pointer shadow-sm appearance-none">
                                    <option value="" disabled selected>Choisir métier...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>
                        </div>


                        <div class="md:col-span-2">
                            <label
                                class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1 tracking-widest">Nom
                                du service</label>
                            <input type="text" name="title" required placeholder="Ex: Installation Chauffe-eau"
                                class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none font-bold text-slate-700 shadow-sm placeholder:text-slate-300">
                        </div>
                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-slate-700 font-bold">

                        <div class="md:col-span-1">
                            <label
                                class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1 tracking-widest">Prix
                                (DH)</label>
                            <input type="number" name="price" required placeholder="Ex: 150"
                                class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none font-bold text-slate-700 shadow-sm placeholder:text-slate-300">
                        </div>


                        <div class="md:col-span-1">
                            <label
                                class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1 tracking-widest">Durée
                                estimée</label>
                            <div class="relative">
                                <select name="duration" required
                                    class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none font-bold text-slate-700 cursor-pointer shadow-sm appearance-none">
                                    <option value="1">1 Heure</option>
                                    <option value="2">2 Heures</option>
                                    <option value="3">3 Heures</option>
                                    <option value="4">4 Heures</option>
                                    <option value="6">6 Heures</option>
                                    <option value="8">8 Heures</option>
                                </select>
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-clock text-[10px]"></i>
                                </div>
                            </div>
                        </div>


                        <div class="md:col-span-2">
                            <label
                                class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1 tracking-widest">Description
                                courte</label>
                            <textarea name="description" rows="1" required placeholder="Décrivez brièvement le service..."
                                class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none font-bold text-slate-700 shadow-sm placeholder:text-slate-300 h-[56px] resize-none py-[14px]"></textarea>
                        </div>
                    </div>


                    <div class="space-y-3">
                        <label class="block text-xs font-black text-slate-400 uppercase ml-1 tracking-widest">Image de
                            la prestation</label>
                        <div class="relative group">
                            <input type="file" name="image" accept="image/*" required
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div
                                class="w-full p-8 bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200 flex flex-col items-center justify-center group-hover:border-orange-500 group-hover:bg-orange-50 transition-all duration-300">
                                <div
                                    class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center text-slate-400 group-hover:text-orange-500 transition-colors mb-4">
                                    <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                                </div>
                                <p
                                    class="text-sm font-bold text-slate-600 group-hover:text-orange-600 transition-colors">
                                    Cliquez ou glissez une photo ici
                                </p>
                                <p class="text-[10px] text-slate-400 mt-1 uppercase font-black tracking-tighter">PNG,
                                    JPG ou WEBP (Max. 2Mo)</p>
                            </div>
                        </div>
                    </div>


                    <div class="flex justify-end items-center gap-6 pt-4">
                        <button type="button"
                            class="text-xs font-black text-slate-400 uppercase tracking-widest hover:text-slate-600 transition">Annuler</button>
                        <button type="submit"
                            class="px-12 py-5 bg-slate-900 text-white font-black rounded-2xl hover:bg-orange-500 transition-all shadow-xl shadow-slate-200 uppercase text-[11px] tracking-[0.2em] hover:-translate-y-1 duration-300 active:scale-95">
                            Publier le service
                        </button>
                    </div>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    @forelse($services as $service)
                        <div
                            class="relative bg-white rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 group overflow-hidden">

                            <div class="relative h-48 w-full bg-slate-200 overflow-hidden">
                                @if ($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                @else
                                    <div
                                        class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-300">
                                        <i class="fa-solid fa-image text-5xl"></i>
                                    </div>
                                @endif

                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-white/90 backdrop-blur-sm text-blue-600 text-[10px] font-black px-3 py-1.5 rounded-xl uppercase tracking-widest shadow-sm">
                                        {{ $service->category->name }}
                                    </span>
                                </div>

                                <div class="absolute top-4 right-4">
                                    <form action="{{ route('artisan.services.destroy', $service->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Voulez-vous vraiment supprimer ce service ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-white/90 backdrop-blur-sm w-8 h-8 rounded-xl text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm flex items-center justify-center">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="p-6 space-y-4">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-orange-500 text-[10px]">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </span>
                                        <span class="text-slate-400 text-[10px] font-black uppercase tracking-tighter">
                                            {{ $service->city->name ?? 'Maroc' }}
                                        </span>
                                    </div>
                                    <h4
                                        class="text-lg font-bold text-slate-800 leading-tight group-hover:text-blue-600 transition-colors">
                                        {{ $service->title }}
                                    </h4>
                                </div>

                                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-[9px] text-slate-400 font-black uppercase tracking-widest">Durée</span>
                                        <span class="text-sm font-bold text-slate-700 flex items-center gap-1">
                                            <i class="fa-regular fa-clock text-orange-500"></i>
                                            {{ $service->duration }} h
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <span
                                            class="text-[9px] text-slate-400 font-black uppercase tracking-widest">Prix
                                            Fixe</span>
                                        <div class="text-lg font-black text-slate-800">
                                            {{ number_format($service->price, 2) }} <span class="text-xs">DH</span>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-xs text-slate-500 line-clamp-2 italic leading-relaxed">
                                    "{{ $service->description }}"
                                </p>
                            </div>
                        </div>
                    @empty
                        <div
                            class="md:col-span-2 text-center py-20 bg-white rounded-[2.5rem] border-2 border-dashed border-slate-100">
                            <div
                                class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-200">
                                <i class="fa-solid fa-briefcase text-3xl"></i>
                            </div>
                            <p class="text-slate-400 font-black uppercase tracking-[0.2em] text-[10px]">Aucune offre de
                                service active.</p>
                            <p class="text-slate-300 text-xs mt-2">Commencez par ajouter votre première prestation.</p>
                        </div>
                    @endforelse
                </div>

            </div>
    </main>
</body>

</html>
