@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.euProjects') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        <div class="product-section p-4">
            <h4 class="mb-4">{{ __('menu.euProjects') }}</h4>
            <div class="d-flex pb-4">
                @if ($lang === 'lt')
                    <img src="{{ asset('images/es_projektai.jpeg') }}" alt="es_projektai" style="width: clamp(250px, 100%, 500px)" />
                @else
                    <img src="{{ asset('images/eu_projects.jpeg') }}" alt="eu_projects" style="width: clamp(250px, 100%, 480px)" class="my-5"/>
                @endif
            </div>
            <p>UAB „Solita“ įgyvendina ES struktūrinėmis lėšomis finansuojamą projektą Nr. 13.1.1-LVPA-K-310-01-0267 „Programinės įrangos kūrimo užsakymo proceso skaitmenizavimas“. Bendra projekto vertė – <b>90 200,00</b> Eur, iš kurių <b>43 296,00</b> Eur sudaro Europos regioninės plėtros fondo lėšos.</p>
            <p>Parama projekto įgyvendinimui suteikta pagal 2014–2020 metų Europos Sąjungos fondų investicijų veiksmų programos 13 prioriteto „Veiksmų, skirtų COVID-19 pandemijos sukeltai krizei įveikti, skatinimas ir pasirengimas aplinką tausojančiam, skaitmeniniam ir tvariam ekonomikos atsigavimui“ priemonę Nr. 13.1.1-LVPA-K-310 „Paskatos kultūros ir kūrybinių industrijų sektoriui kurti konkurencingus kultūros produktus“. Projektas yra finansuojamas Europos regioninės plėtros fondo lėšomis. Finansuojama kaip Europos Sąjungos atsako į COVID-19 pandemiją priemonė.</p>
            <p>Projekto tikslas – kurti naujus, aukštos pridėtinės vertės, konkurencingus kultūros ir kūrybinio turinio ir formos produktus, investuojant į naują konkurencingo skaitmeninio kultūros ir kūrybinio turinio ir formos produktą. Įmonė siekia skaitmenizuoti informacinių technologijų užsakymo paslaugas, t. y. perkelti paslaugas iš fizinės aplinkos į skaitmeninę platformą, kuri būtų patogi ir prieinama naudotojui interneto aplinkoje.</p>
            <p>Įgyvendinus projektą bus sukurta skaitmeninė platforma informacinių technologijų (toliau – IT) paslaugų užsakymo proceso valdymui ir įdiegimui įmonės infrastruktūroje. Įmonės IT paslaugų proceso teikimo skaitmenizavimas padidins IT paslaugų prieinamumą klientui bei atvers prieigą prie paslaugų atlikimo kontrolės. Platforma palengvins IT paslaugų užsakymą klientams, įneš daugiau aiškumo ir skaidrumo bei leis klientams ir programuotojams racionaliai planuoti savo laiką. Skaitmeninė platforma supaprastins paslaugos užsakymo būdą, suteiks tiesioginę prieigą prie specialistų komandos bei galimybę stebėti IT paslaugų atlikimo eigą, įvertinti suteiktą paslaugą, o paslaugos tiekėjui realiu laiku ir operatyviai reaguoti į klientų užklausas. Šis skaitmeninis sprendimas padės įmonei sklandžiai valdyti procesus, operatyviai aptarnauti klientus, taupyti resursus, priimti daugiau užsakymų ir padidinti pajamas.</p>
            <p>Projekto įgyvendinimo laikotarpis 2022 m. liepos – 2023 m. kovo mėn.</p>
        </div>
    </div>
@endsection
