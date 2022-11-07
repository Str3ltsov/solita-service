@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.about') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        <div class="product-section p-4">

            @if($lang=="lt")

                <h4 class="mb-4">Apie Mus</h4>
                <h6 class="text-center">Prieinamumas 24/7</h6>
                Aurintus-buhalteriai neserga, neatostogauja ir yra pasiekiami 24/7 iš bet kurio mobiliojo prietaiso. Visą informaciją, susijusią su įmonės apskaita, galite lengvai pasiekti prisijungę prie savo paskyros.</br>
                Nebereikia klausti ir laukti, kol buhalteris bus geros nuotaikos, neužsiėmęs ir galės atsiųsti atostogų likučius, atlikti mokėjimą arba išrašyti sąskaitą faktūrą. Visa tai padarysite patys, spustelėję kelis mygtukus.</br>
                <div class="d-flex justify-content-center pt-2 pb-5">
                    <img src="{{ asset('images/about_us_1.jpg') }}" alt="about_us_1"/>
                </div>
                <h6 class="text-center">Aiški komunikacija</h6>
                Mėgstate struktūrą ir organizaciją? Mes taip pat – štai kodėl bendraujame taip, kad būtų aišku kada jūsų klausimas buvo gautas, atsakymai saugomi ir, jei reikia, nesunkiai rasite juos praėjus daugiau laiko.</br>
                Bendraukite su buhalteriu Aurintus platformoje, palikite komentarus, užduokite klausimus. Sekite užklausų ir užsakymų pateikimo, atmetimo ir priėmimo procesus. Būkite skubiai informuoti apie visas iškilusias problemas.</br>
                O jei reikia pagalbos ar patarimo, mes visada pasiruošę padėti. Tam sukūrėme „Aurintus“ pagalbos skyrių su visomis naudojimosi sistema instrukcijomis ir dažniausiai užduodamais klausimais, o jei reikia buhalterio patarimo, pagalbos skiltyje nesunkiai rasite jums asmeniškai priskirto buhalterio kontaktus.</br>
                <div class="d-flex justify-content-center pt-5 pb-5">
                    <img src="{{ asset('images/about_us_2.jpg') }}" alt="about_us_1"/>
                </div>
                <h6 class="text-center">Santrauka</h6>
                Pradėkime nuo dažniausiai užduodamų klausimų – kam patikėti apskaitą?</br>
                Pasamdyti buhalterį ar ieškoti buhalterines paslaugas teikiančios įmonės?</br>
                Kuri apskaitos forma yra daugiau patikima ir naudinga?</br>
                Manome, kad apskaitą galima tvarkyti dviem būdais.</br></br>
                Buhalterio samdymas:</br>
                •    Socialinio draudimo įmokos</br>
                •    Darbuotojų pasikeitimai, ligos, atostogos ir kt.</br>
                •    Išlaidos kvalifikacijos kėlimui</br></br>
                Buhalterinės apskaitos paslaugas teikiančios įmonės samdymas:</br>
                •    Galimybė pasiūlyti aukštos kvalifikacijos paslaugas. Įmonė paprastai turi sukaupusi nemažai patirties vadovaujant įvairių veiklos sričių įmonėms.</br>
                •    Jūs nepatirsite darbo vietos įkūrimo išlaidų (kompiuteris, buhalterinė programa, raštinės reikmenų išlaidos).</br>
                •    Išvengsite socialinio draudimo mokesčio.</br>
                •    Išvengsite kvalifikacijos kėlimo išlaidų (seminarai, mokymai).</br>
                •    Nebus problemų dėl darbuotojų kaitos, ligos ar atostogų.</br>
                •    Jums nereikės išgyventi buhalterio padarytų klaidų, nes įmonė prisiims visą atsakomybę.</br></br>
                Abi apskaitos formos turi privalumų ir trūkumų. Kiekvienas turi nuspręsti, kuris metodas jam priimtinesnis. Nuolatinės norminių aktų kaitos ir jų sudėtingumas daro apskaitos tvarkymą rizikingu ir reikalauja aukštos kvalifikacijos. Aukštas apskaitos lygis organizacijoje yra labai svarbi sėkmingo verslo sąlyga.</br></br>

            @elseif ($lang == "ru")

                <h4 class="mb-4">О Нас</h4>
                <h6 class="text-center">Круглосуточная доступность</h6>
                Aurintus-бухгалтеры не болеют, не берут отпуск и доступны 24/7 с любого мобильного устройства. Вы можете легко получить доступ ко всей информации, связанной с бухгалтерским учетом вашей компании, войдя в свою учетную запись.</br>
                Больше не нужно спрашивать и ждать, пока бухгалтер будет в хорошем настроении, не занят и сможет отправить остаток отпусков, внести платеж или выставить счет. Все это вы сделаете сами несколькими нажатиями кнопок.</br>
                <div class="d-flex justify-content-center pt-2 pb-5">
                    <img src="{{ asset('images/about_us_1.jpg') }}" alt="about_us_1"/>
                </div>
                <h6 class="text-center">Четкое общение</h6>
                Любите структуру и организацию? Мы тоже - поэтому и общаемся так, чтобы было понятно был ли получен ваш вопрос, не потерялись ли ответы и при необходимости вы смогли бы легко найти их после того, как прошло больше времени.</br>
                Общайтесь с бухгалтером на платформе Aurintus, оставляйте комментарии, задавайте вопросы. Следите за процессами отправки, отклонения и принятия запросов и заказов. Будьте быстро информирование о любых возникающих проблемах.</br>
                А если вам нужна помощь или совет, мы всегда готовы прийти на помощь. Для этого мы создали раздел в Aurintus со всеми инструкциями по использованию системы и часто задаваемыми вопросами, а если вам нужно слово бухгалтера, в разделе помощи вы легко найдете контакты назначенного вам лично бухгалтера.</br>
                <div class="d-flex justify-content-center pt-5 pb-5">
                    <img src="{{ asset('images/about_us_2.jpg') }}" alt="about_us_1"/>
                </div>
                <h6 class="text-center">Резюме</h6>
                Начнем с самых часто задаваемых вопросов - кому доверить бухгалтерию?</br>
                Нанять бухгалтера или искать компанию, предоставляющую бухгалтерские услуги?</br>
                Какая форма учета более надежна и полезна?</br>
                Мы считаем, что бухгалтерский учет можно вести двумя способами.</br></br>
                Прием на работу бухгалтера:</br>
                •    Взносы на социальное страхование</br>
                •    Кадровые перестановки, болезни, отпуска и т.д.</br>
                •    Расходы на повышение квалификации</br></br>
                Наем компании, которая оказывает бухгалтерские услуги:</br>
                •    Возможность предложить высококвалифицированный сервис. Компания обычно имеет большой опыт управления компаниями в различных сферах деятельности.</br>
                •    Вы не будете нести расходы на обустройство рабочего места (компьютер, бухгалтерское ПО, канцелярские расходы).</br>
                •    Вы избежите социального налога.</br>
                •    Вы избежите затрат на повышение квалификации (семинары, тренинги).</br>
                •    Не будет проблем с кадровой перестановкой, болезнью или отпуском бухгалтера.</br>
                •    Вам не придется переживать ошибки, допущенные бухгалтером, ведь управляющая компания возьмет на себя полную ответственность.</br></br>
                Обе формы бухгалтерского учета имеют свои преимущества и недостатки. Каждый должен решать индивидуально, какой метод для него более приемлем. Постоянная смена нормативных актов, их сложность и рассыпчатость обращения, делают ведение бухгалтерского учета рискованным и требуют высокой квалификации. Высокий уровень бухгалтерского учета и организованность – очень важное условие успешного бизнеса.</br></br>

            @else

                <h4 class="mb-4">About Us</h4>
                <h6 class="text-center">24/7 Availability</h6>
                Aurintus-accountant does not get sick, does not take vacations and is available 24/7 from any mobile
                device. You can easily access all information related to your company's accounting by logging into your
                account.</br>
                No more asking and waiting for the accountant to be in a good mood, not busy and able to send the
                holiday balance, make a payment or issue an invoice. You will do all this yourself with the click of a
                few buttons.</br>
                <div class="d-flex justify-content-center pt-2 pb-5">
                    <img src="{{ asset('images/about_us_1.jpg') }}" alt="about_us_1"/>
                </div>
                <h6 class="text-center">Clear communication</h6>
                Love structure and organization? So do we - this is why we communicate in such a way that it is clear
                whether your question has been received, the answers are not lost and, if necessary, you can easily find
                them after more time has passed.</br>
                Communicate with the accountant on the Aurintus platform, leave comments, ask questions in a specific
                document. Follow the processes of submitting, rejecting and accepting requests and orders. Be promptly
                informed by your accountant of any problems that arise.</br>
                And if you need help or advice, we are always ready to help. For this, we have created a Aurintus help
                section with all instructions for using the system and frequently asked questions, and if you need the
                word of an accountant, in the help section you will easily find the contacts of the accountant assigned
                to you personally.</br>
                <div class="d-flex justify-content-center pt-5 pb-5">
                    <img src="{{ asset('images/about_us_2.jpg') }}" alt="about_us_1"/>
                </div>
                <h6 class="text-center">Summary</h6>
                Let's start with the most frequently asked questions - to whom should I entrust the accounting?</br>
                Hire a chief accountant or look for a company providing accounting services?</br>
                Which form of accounting is more reliable and useful?</br>
                We believe that accounting can be done in two ways.</br></br>
                Hiring a chief accountant:</br>
                •    Social insurance contributions</br>
                •    Staff changes, illness, vacation, etc.</br>
                •    Expenses for qualification improvement</br></br>
                Hiring a company that provides accounting services:</br>
                •    Ability to offer highly qualified service. The company usually has accumulated considerable
                experience in managing companies in various fields of activity.</br>
                •    You will not incur the costs of establishing a workplace (computer, accounting software, stationery
                costs).</br>
                •    You will avoid social security tax.</br>
                •    You will avoid the costs of upgrading qualifications (seminars, trainings).</br>
                •    There will be no problems with staff change, illness or vacation of the chief accountant.</br>
                •    You will not have to live through the mistakes made by the accountant, because the company managing
                your accounting will take full responsibility.</br></br>
                Both forms of accounting have advantages and disadvantages. Everyone has to decide individually which
                method is more acceptable to them. The constant change of regulatory acts, their complexity and loose
                treatment make accounting management risky and require high qualification. A high level of accounting
                organization is a very important condition for a successful business.</br></br>

            @endif
        </div>
    </div>
@endsection
