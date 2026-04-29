<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de {{ $artisan->name }} - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <div class="h-48 bg-slate-900 relative">
        <a href="javascript:history.back()" class="absolute top-6 left-6 bg-white/10 hover:bg-white/20 text-white p-3 rounded-xl transition backdrop-blur-md">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>

    <main class="max-w-5xl mx-auto px-6 -mt-20 relative z-10 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 text-center sticky top-24">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($artisan->name) }}&background=1E3A8A&color=fff&size=150" 
                         class="w-32 h-32 rounded-[2.5rem] mx-auto mb-6 border-8 border-white shadow-lg -mt-24">
                    
                    <h2 class="text-2xl font-black text-slate-800">{{ $artisan->name }}</h2>
                    <span class="bg-blue-50 text-blue-600 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest mt-2 inline-block">
                        {{ $artisan->artisanProfile->category->name ?? 'Artisan' }}
                    </span>

                    <div class="flex items-center justify-center gap-4 mt-6 py-6 border-y border-slate-50">
                        <div class="text-center">
                            <p class="text-xs font-black text-slate-400 uppercase">Ville</p>
                            <p class="font-bold text-slate-700 text-sm italic">{{ $artisan->city }}</p>
                        </div>
                        <div class="w-px h-8 bg-slate-100"></div>
                        <div class="text-center">
                            <p class="text-xs font-black text-slate-400 uppercase">Avis</p>
                            <p class="font-bold text-slate-700 text-sm italic">{{ $artisan->averageRating() }}/5</p>
                        </div>
                    </div>

                    <div class="mt-8 space-y-3">
                        <a href="tel:{{ $artisan->phone }}" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-blue-700 transition flex items-center justify-center gap-3">
                            <i class="fa-solid fa-phone"></i> Appeler
                        </a>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <a href="https://wa.me/{{ $artisan->phone }}" class="py-4 bg-green-500 text-white rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-green-600 transition flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp"></i> WhatsApp
                            </a>
                            <button onclick="document.getElementById('reviews-section').scrollIntoView({behavior: 'smooth'})" 
                                    class="py-4 bg-blue-50 text-blue-600 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-blue-100 transition flex items-center justify-center gap-2 border border-blue-100">
                                <i class="fa-solid fa-star"></i> Avis
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-8 mt-8 lg:mt-0">
                
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter italic mb-4">À propos</h3>
                    <p class="text-slate-500 leading-relaxed font-medium">
                        {{ $artisan->artisanProfile->bio ?? "Cet artisan n'a pas encore ajouté de description à son profil." }}
                    </p>
                </div>

                <div>
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter italic mb-6">Mon Portfolio ({{ $artisan->portfolios->count() }})</h3>
                    @if($artisan->portfolios->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($artisan->portfolios as $portfolio)
                                <div class="group relative bg-white rounded-[2rem] overflow-hidden shadow-sm border border-slate-100 aspect-video">
                                    <img src="{{ asset('storage/' . $portfolio->image_path) }}" 
                                         alt="{{ $portfolio->title }}" 
                                         class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                        <p class="text-white font-bold text-sm">{{ $portfolio->title }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] p-10 text-center">
                            <p class="text-slate-400 text-sm italic">Aucune réalisation ajoutée au portfolio.</p>
                        </div>
                    @endif
                </div>

                <div>
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter italic mb-6">Mes Services ({{ $artisan->services->count() }})</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($artisan->services as $service)
                            <a href="{{ route('services.show', $service->id) }}" class="bg-white p-5 rounded-3xl border border-slate-100 hover:shadow-lg transition-all group flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition">
                                        <i class="fa-solid fa-wrench text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">{{ $service->title }}</p>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $service->price }} DH</p>
                                    </div>
                                </div>
                                <i class="fa-solid fa-chevron-right text-slate-200 group-hover:text-blue-500 transition"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div id="reviews-section" class="pt-8">
                    <h3 class="text-xl font-black text-slate-800 uppercase tracking-tighter italic mb-6">Avis Clients</h3>
                    
                    @auth
                        @if(auth()->id() !== $artisan->id)
                        <div class="bg-white p-8 rounded-[2.5rem] border border-blue-50 shadow-sm mb-8">
                            <form action="{{ route('reviews.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="artisan_id" value="{{ $artisan->id }}">
                                <div class="mb-4">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-2">Note</label>
                                    <select name="rating" class="w-full p-4 bg-slate-50 rounded-2xl border-none outline-none font-bold text-orange-500">
                                        <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                        <option value="4">⭐⭐⭐⭐ Très bien</option>
                                        <option value="3">⭐⭐⭐ Bien</option>
                                        <option value="2">⭐⭐ Moyen</option>
                                        <option value="1">⭐ Mauvais</option>
                                    </select>
                                </div>
                                <textarea name="comment" rows="3" required placeholder="Décrivez votre expérience..."
                                    class="w-full p-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-medium text-slate-600 outline-none transition resize-none mb-4"></textarea>
                                <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-blue-700 transition shadow-lg">
                                    Publier mon avis
                                </button>
                            </form>
                        </div>
                        @endif
                    @endauth

                    <div class="space-y-4">
                        @forelse($artisan->reviews as $review)
                            <div class="bg-white p-6 rounded-[2rem] border border-slate-50 shadow-sm flex gap-4">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex-shrink-0 flex items-center justify-center text-slate-400 font-bold text-xs uppercase">
                                    {{ substr($review->client->name, 0, 2) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-bold text-slate-800 text-sm">{{ $review->client->name }}</h4>
                                        <div class="flex text-[8px] text-orange-400">
                                            @for($i=1; $i<=5; $i++)
                                                <i class="fa-solid fa-star {{ $i <= $review->rating ? '' : 'opacity-20' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p class="text-slate-500 text-xs italic">"{{ $review->comment }}"</p>
                                    <span class="text-[9px] text-slate-300 block mt-3 font-bold uppercase tracking-tighter italic">
                                        {{ $review->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 bg-white rounded-[2.5rem] border-2 border-dashed border-slate-50">
                                <i class="fa-regular fa-comment-dots text-4xl text-slate-200 mb-3 block"></i>
                                <p class="text-slate-400 text-xs italic">Aucun avis pour le moment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>