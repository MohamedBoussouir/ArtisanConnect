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
                            <p class="font-bold text-slate-700 text-sm italic">4.9/5</p>
                        </div>
                    </div>

                    <div class="mt-8 space-y-3">
                        <a href="tel:{{ $artisan->phone }}" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-blue-700 transition flex items-center justify-center gap-3">
                            <i class="fa-solid fa-phone"></i> Appeler
                        </a>
                        <a href="https://wa.me/{{ $artisan->phone }}" class="w-full py-4 bg-green-500 text-white rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-green-600 transition flex items-center justify-center gap-3">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                        </a>
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
            </div>

        </div>
    </main>

</body>
</html>