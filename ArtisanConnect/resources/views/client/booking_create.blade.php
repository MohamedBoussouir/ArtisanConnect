<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver Service - ArtisanConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-slate-50 font-sans flex items-center justify-center min-h-screen p-6">

    <div class="max-w-2xl w-full bg-white rounded-[3rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-100">
        <div class="text-center mb-10">
            <div
                class="w-20 h-20 bg-orange-100 text-orange-600 rounded-3xl flex items-center justify-center mx-auto mb-4 text-3xl shadow-sm">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <h1 class="text-3xl font-black text-slate-800 uppercase tracking-tighter italic">Détails de la demande</h1>
            <p class="text-slate-400 font-bold text-xs mt-2 uppercase tracking-widest">Service: {{ $service->title }}
            </p>
        </div>

        <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <input type="hidden" name="artisan_id" value="{{ $service->artisan_id }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-2 tracking-widest">Date
                        d'intervention</label>
                    <div class="relative">
                        <input type="date" name="appointment_date" required min="{{ date('Y-m-d') }}"
                            value="{{ date('Y-m-d') }}"
                            class="w-full p-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-orange-500 font-bold text-slate-700 outline-none transition shadow-sm appearance-none">
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-300">
                            <i class="fa-solid fa-calendar-days text-sm"></i>
                        </div>
                    </div>
                </div>


                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-2 tracking-widest">Heure
                        de début</label>
                    <div class="relative">
                        <select name="appointment_time" required
                            class="w-full p-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-orange-500 font-bold text-slate-700 outline-none transition shadow-sm appearance-none cursor-pointer">
                            <option value="" disabled selected>Choisir l'heure...</option>
                            @for ($i = 8; $i <= 22; $i++)
                                @php $time = sprintf('%02d:00', $i); @endphp
                                <option value="{{ $time }}">{{ $time }}</option>
                            @endfor
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-300">
                            <i class="fa-solid fa-clock text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>


            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-2 tracking-widest">Décrivez
                    votre problème</label>
                <textarea name="issue_description" rows="5" required placeholder="Ex: Ma douche fuit "
                    class="w-full p-5 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-orange-500 font-bold text-slate-700 outline-none transition shadow-sm resize-none placeholder:text-slate-300"></textarea>
            </div>


            <div class="flex gap-4 pt-4">
                <a href="javascript:history.back()"
                    class="flex-1 py-4 bg-slate-100 text-slate-500 text-center rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-slate-200 transition active:scale-95">
                    Annuler
                </a>
                <button type="submit"
                    class="flex-[2] py-4 bg-slate-900 text-white rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-orange-600 transition shadow-lg shadow-orange-100 active:scale-95 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-check-circle"></i>
                    Confirmer la demande
                </button>
            </div>
        </form>
    </div>

</body>

</html>
