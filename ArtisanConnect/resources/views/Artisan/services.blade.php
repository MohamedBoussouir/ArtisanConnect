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
            <a href="/artisan/dashboard" class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                <i class="fa-solid fa-chart-line mr-3"></i> Vue d'ensemble
            </a>
            <a href="/artisan/services" class="flex items-center py-3 px-4 rounded-xl bg-orange-500 text-white transition shadow-lg shadow-orange-500/20">
                <i class="fa-solid fa-briefcase mr-3"></i> Mes Services
            </a>
            <a href="{{ route('artisan.Mon_Portfolio') }}" class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                <i class="fa-solid fa-images mr-3"></i> Mon Portfolio
            </a>
            </nav>
    </aside>

    <main class="flex-1">
        <header class="bg-white border-b p-4 flex justify-between items-center px-8">
            <h2 class="text-xl font-black text-slate-800 uppercase tracking-wide">Gestion des Services</h2>
            <div class="flex items-center gap-3">
                <span class="text-sm font-bold text-slate-600 tracking-tight">{{ Auth::user()->name }}</span>
                <div class="w-10 h-10 rounded-full bg-orange-100 border-2 border-orange-500 flex items-center justify-center font-bold text-orange-600">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <div class="p-8 space-y-8">
            
            <div class="bg-white rounded-3xl shadow-sm p-8 border border-slate-100">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
                    <span class="w-8 h-8 bg-orange-500 text-white rounded-lg flex items-center justify-center mr-3 shadow-md">
                        <i class="fa-solid fa-plus text-xs"></i>
                    </span>
                    Nouveau Service
                </h3>
                
                <form action="{{ route('artisan.services.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @csrf
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1">Nom du service</label>
                        <input type="text" name="title" required placeholder="Ex: Réparation plomberie d'urgence" 
                               class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1">Prix (DH)</label>
                        <input type="number" name="price" placeholder="Ex: 150" 
                               class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1">Durée (Optionnel)</label>
                        <input type="text" name="duration" placeholder="Ex: 2 heures" 
                               class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none">
                    </div>
                    <div class="md:col-span-4">
                        <label class="block text-xs font-black text-slate-400 uppercase mb-2 ml-1">Description courte</label>
                        <textarea name="description" rows="2" placeholder="Décrivez brièvement ce que comprend ce service..." 
                                  class="w-full p-4 bg-slate-50 rounded-2xl border-none focus:ring-2 focus:ring-orange-500 transition outline-none"></textarea>
                    </div>
                    <div class="md:col-span-4 flex justify-end">
                        <button type="submit" class="px-8 py-4 bg-slate-900 text-white font-black rounded-2xl hover:bg-orange-600 transition shadow-lg uppercase text-xs tracking-widest">
                            Ajouter le service
                        </button>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($services as $service)
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition group">
                    <div class="flex justify-between items-start mb-4">
                        <div class="bg-slate-50 p-3 rounded-2xl text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition">
                            <i class="fa-solid fa-hand-holding-heart text-xl"></i>
                        </div>
                        <span class="text-xl font-black text-slate-800">{{ $service->price ? $service->price . ' DH' : 'Sur devis' }}</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-800 mb-2">{{ $service->title }}</h4>
                    <p class="text-slate-500 text-sm mb-4 line-clamp-2 leading-relaxed">{{ $service->description ?? 'Aucune description fournie.' }}</p>
                    
                    <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                        <span class="text-xs font-bold text-slate-400 flex items-center uppercase tracking-tighter">
                            <i class="fa-solid fa-clock mr-2 text-orange-400"></i> {{ $service->duration ?? 'Non précisée' }}
                        </span>
                        
                        <form action="{{ route('artisan.services.destroy', $service->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Supprimer ce service ?')" 
                                    class="text-red-400 hover:text-red-600 text-sm font-bold transition flex items-center">
                                <i class="fa-solid fa-trash-can mr-2"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="md:col-span-2 text-center py-16 bg-white rounded-3xl border-2 border-dashed border-slate-200">
                    <p class="text-slate-400 font-bold">Vous n'avez pas encore défini de services.</p>
                </div>
                @endforelse
            </div>

        </div>
    </main>
</body>
</html>