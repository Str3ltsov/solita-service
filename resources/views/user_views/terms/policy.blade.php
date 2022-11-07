@extends('layouts.app')

@section('content')
    <div class="page-navigation">
        <div class="container">
            <a href="{{ url('/') }}">
                {{ __('menu.home') }}
            </a>
            <i class="fa-solid fa-angle-right"></i>
            <span>
                {{ __('menu.policy') ?? '' }}
            </span>
        </div>
    </div>
    <div class="container">
        <div class="product-section p-4">
            @if($lang=="lt")

                <h4>Privatumo politika</h4>
                Privatumo politika (toliau – „Privatumo politika“) paaiškina, kaip UAB Aurintus (toliau – „Bendrovė“) renka ir tvarko svetainės www.aurintus.lt (toliau – „Svetainė“) lankytojų informaciją, nurodo kokias teises Svetainės lankytojai turi bei kaip jas gali įgyvendinti. Prieš registruojantis Svetainėje rekomenduojame atidžiai perskaityti šią Privatumo politiką.<br/>
                Bendrovė yra įsipareigojusi savo veikloje atsakingai ir saugiai tvarkyti Jūsų asmens duomenis. Vadovaudamiesi, šiais esminiais principais, mes visada sieksime užtikrinti pakankamą Jūsų duomenų apsaugos lygį bei Jūsų teisių apsaugą. Mes tvarkome Asmens duomenis, pagal šią Privatumo politiką, vadovaudamiesi taikomais teisės aktais, įskaitant Bendrąjį duomenų apsaugos reglamentą (2016/679) (toliau – „BDAR“) bei taikomus Lietuvos nacionalinius asmens duomenų apsaugos teisės aktus.<br/>
                Duomenų valdytojas<br/>
                UAB Aurintus<br/>
                Įmonės kodas yra: 304873930<br/>
                Adresas: Karaliaučiaus g. 3-17, LT-06281 Vilnius.<br/>
                Tel. Nr. +370 689 96899<br/>
                El. pašto adresas: uabaurintus@gmail.com<br/>
                Kokią informaciją renkame, naudojame ir saugojame apie Jus?<br/>
                Informacija, kurią pateikia pats Svetainės lankytojas, pildydamas registracijos formą mūsų Svetainėje:<br/>
                1.	Vardas<br/>
                2.	Adresas<br/>
                3.	El. paštas<br/>
                4.	Telefono numeris<br/>
                Informacija reikalinga paslaugos suteikimui (BDAR 6 straipsnio 1 dalies b punktas)<br/>
                Ar naudojame slapukus?<br/>
                Taip, mūsų Svetainėje yra naudojami slapukai.<br/>
                Kokią informaciją turėtumėte mums pateikti?<br/>
                Pildydami registracijos formą mūsų Svetainėje turėtumėte mums pateikti duomenis, prašomus registracijos formoje.<br/>
                Koks yra teisinis informacijos rinkimo pagrindas?<br/>
                Mes renkame informaciją apie Jus teisėtai, nes:<br/>
                1.	Jūsų informacija yra reikalinga sutarčiai su Jumis sudaryti ir vykdyti;<br/>
                2.	Mes turime teisėtą interesą stebėti Svetainės lankomumo statistiką.<br/>
                Ar teikiame jūsų informaciją kitiems subjektams (tvarkytojams)?<br/>
                Bendrovė tvarkomų Asmens duomenų neteikia tretiesiems asmenims be išankstinio asmens (duomenų subjekto) sutikimo, išskyrus teisės aktų nustatyta tvarka.<br/>
                Jūsų duomenų tvarkymo principai<br/>
                Mes siekiame, kad Asmens duomenys būtų tvarkomi tiksliai, sąžiningai ir teisėtai, kad jie būtų tvarkomi tik tokiais tikslais, kuriais renkami, laikantis teisės aktuose nustatytų aiškių ir skaidrių asmens duomenų tvarkymo principų ir reikalavimų.<br/>
                Kiek laiko saugome informaciją apie jus?<br/>
                Mes Jūsų informaciją apie registraciją Svetainėje saugome iki sutikimo atšaukimo. Informaciją apie Jūsų atliktus pirkimus saugome vadovaudamiesi Bendrųjų dokumentų saugojimo terminų rodykle.<br/>
                Kokios duomenų subjekto teisės?<br/>
                Jūs turite teisę susipažinti su savo asmens duomenimis ir kaip jie yra tvarkomi, reikalauti ištaisyti, papildyti ar sunaikinti pateiktus asmens duomenis, taip pat sustabdyti jų tvarkymo veiksmus (atšaukti savo sutikimą). Taip pat turite teisę reikalauti, kad asmens duomenų valdytojas apribotų asmens duomenų tvarkymą, teisę į duomenų perkėlimą, pateikti skundą Valstybinei duomenų apsaugos inspekcijai (kontaktiniai duomenys pateikti interneto svetainėje www.ada.lt) ir nesutikti su pateiktų asmens duomenų tvarkymu. Jei norite gauti išsamią informaciją apie šių teisių įgyvendinimo tvarką, pateikite užklausą Svetainėje nurodytu el. pašto adresu. Su išsamesne informacija apie asmens duomenų tvarkymą ir saugumą galite susipažinti atvykę pas mus.<br/>
                Mūsu atsakingo asmens kontaktai<br/>
                Mes esame įsipareigoję užtikrinti Jūsų asmens duomenų apsaugą ir suteikti visą būtiną informaciją. Jeigu turite klausimų ar pastebėjimų dėl Jūsų asmens duomenų tvarkymo, prašome susisiekti su mumis Svetainėje nurodytu el. p. adresu.<br/>
                Ši Privatumo politika galioja nuo jos paskelbimo Svetainėje dienos. Privatumo politika nėra laikoma Bendrovės ir Jūsų susitarimu dėl Asmens duomenų tvarkymo. Šia Privatumo politika Bendrovė Jus informuoja apie Jūsų asmens duomenų tvarkymo principus Bendrovėje. Mes galime bet kada pakeisti Privatumo politiką. Privatumo politikos pakeitimai ir (ar) papildymai įsigalioja po jų paskelbimo Svetainėje momento. Rekomenduojame reguliariai peržiūrėti mūsų Privatumo politiką.<br/>

            @elseif ($lang == "ru")

                <h4>Политика конфиденциальности</h4>
                Политика конфиденциальности (далее — «Политика конфиденциальности») объясняет, как UAB Aurintus (далее — «Компания») собирает и обрабатывает информацию о посетителях веб-сайта www.aurintus.lt (далее — «Сайт»), указывает, что права, которыми обладают посетители Сайта, и способы их реализации. Перед регистрацией на Сайте рекомендуем внимательно ознакомиться с настоящей Политикой конфиденциальности.<br/>
                Компания обязуется ответственно и безопасно обращаться с вашими личными данными в своей деятельности. Основываясь на этих основных принципах, мы всегда будем стремиться обеспечить достаточный уровень защиты ваших данных и защиту ваших прав. Мы обрабатываем Персональные данные в соответствии с настоящей Политикой конфиденциальности в соответствии с применимыми правовыми актами, в том числе Общим регламентом защиты данных (2016/679) (далее — «GDPR») и применимыми национальными законами Литвы о защите персональных данных.<br />
                Контроллер данных<br/>
                UAB «Aurintus»<br/>
                Код компании: 304873930<br/>
                Адрес: Karaliaučiaus g. 3-17, LT-06281 Vilnius.<br/>
                Тел. Нр. +370 689 96899<br/>
                Адрес электронной почты: uabaurintus@gmail.com<br/>
                Какую информацию о вас мы собираем, используем и храним? <br/>
                Информация, предоставленная самим посетителем Сайта при заполнении регистрационной формы на нашем Сайте:<br/>
                1. Имя<br/>
                2. Адрес<br/>
                3. Электронная почта почта<br/>
                4. Номер телефона<br/>
                Информация необходима для предоставления услуги (статья 6 GDPR, параграф 1, пункт b)<br/>
                Используем ли мы файлы cookie?<br/>
                Да, наш веб-сайт использует файлы cookie.<br/>
                Какую информацию вы должны нам предоставить?<br/>
                При заполнении регистрационной формы на нашем веб-сайте вы должны предоставить нам данные, запрашиваемые в регистрационной форме.<br/>
                Какова правовая основа для сбора информации?<br/>
                Мы собираем информацию о вас на законных основаниях, потому что:<br/>
                1. Ваша информация необходима для заключения и исполнения договора с вами;<br/>
                2. У нас есть законный интерес в отслеживании статистики посещаемости веб-сайта.<br/>
                Предоставляем ли мы вашу информацию другим организациям (контролерам)?<br/>
                Компания не предоставляет обрабатываемые персональные данные третьим лицам без предварительного согласия лица (субъекта данных), кроме как в порядке, установленном правовыми актами.<br/>
                Ваши принципы обработки данных<br/>
                Мы стремимся к тому, чтобы Персональные данные обрабатывались точно, справедливо и законно, чтобы они обрабатывались только для тех целей, для которых они собираются, с соблюдением четких и прозрачных принципов и требований к обработке персональных данных, изложенных в правовых актах.<br/ >
                Как долго мы храним информацию о вас?<br/>
                Мы храним вашу информацию о регистрации на Сайте до тех пор, пока вы не отзовете свое согласие. Мы храним информацию о ваших покупках в соответствии с Общими условиями хранения документов.<br/>
                Каковы права субъекта данных?<br/>
                Вы имеете право ознакомиться со своими персональными данными и способами их обработки, потребовать исправления, дополнения или уничтожения предоставленных персональных данных, а также прекратить их обработку (отозвать свое согласие). Вы также имеете право потребовать, чтобы контролер персональных данных ограничил обработку персональных данных, право на передачу данных, подать жалобу в Государственную инспекцию по защите данных (контактные данные доступны на веб-сайте www.ada.lt) и возражать против обработки предоставленных персональных данных. Если вы хотите получить подробную информацию о порядке реализации данных прав, отправьте запрос на электронную почту, указанную на Сайте. почтовый адрес. Вы можете получить более подробную информацию об обработке и безопасности персональных данных, посетив нас.<br/>
                Контакты нашего ответственного лица<br/>
                Мы стремимся обеспечить защиту ваших личных данных и предоставить всю необходимую информацию. Если у вас есть какие-либо вопросы или замечания относительно обработки ваших персональных данных, пожалуйста, свяжитесь с нами по адресу электронной почты, указанному на Сайте. Г-н. адрес.<br/>
                Настоящая Политика конфиденциальности действует с момента ее публикации на Сайте. Политика конфиденциальности не считается соглашением между Компанией и Вами в отношении обработки Персональных данных. Настоящей Политикой конфиденциальности Компания информирует вас о принципах обработки ваших персональных данных в Компании. Мы можем изменить Политику конфиденциальности в любое время. Изменения и/или дополнения Политики конфиденциальности вступают в силу после их публикации на Сайте. Мы рекомендуем вам регулярно просматривать нашу Политику конфиденциальности.<br/>

            @else

                <h4>Privacy Policy</h4>

                The Privacy Policy (hereinafter - the "Privacy Policy") explains how UAB Aurintus (hereinafter - the "Company") collects and processes the information of visitors to the website www.aurintus.lt (hereinafter - the "Site"), indicates what rights the visitors of the Site have and how to exercise them. can implement. Before registering on the Website, we recommend that you carefully read this Privacy Policy.<br/>
                The company is committed to handling your personal data responsibly and securely in its activities. Based on these essential principles, we will always strive to ensure a sufficient level of protection of your data and the protection of your rights. We process Personal Data, in accordance with this Privacy Policy, in accordance with the applicable legal acts, including the General Data Protection Regulation (2016/679) (hereinafter - "GDPR") and the applicable Lithuanian national personal data protection legislation.<br/>
                Data Controller<br/>
                UAB «Aurintus»<br/>
                The company code is: 304873930<br/>
                Address: Karaliaučiaus g. 3-17, LT-06281 Vilnius.<br/>
                Phone. No. +370 689 96899<br/>
                Email address: uabaurintus@gmail.com<br/>
                What information do we collect, use and store about you? <br/>
                Information provided by the Website visitor himself when filling out the registration form on our Website:<br/>
                1. Name<br/>
                2. Address<br/>
                3. Email mail<br/>
                4. Phone number<br/>
                The information is necessary for the provision of the service (GDPR Article 6, Paragraph 1, Clause b)<br/>
                Do we use cookies?<br/>
                Yes, our Website uses cookies.<br/>
                What information should you give us?<br/>
                When completing the registration form on our Website, you should provide us with the data requested in the registration form.<br/>
                What is the legal basis for collecting the information?<br/>
                We collect information about you legally because:<br/>
                1. Your information is necessary to conclude and execute a contract with you;<br/>
                2. We have a legitimate interest in monitoring website traffic statistics.<br/>
                Do we provide your information to other entities (controllers)?<br/>
                The company does not provide processed personal data to third parties without the prior consent of the person (data subject), except in accordance with the procedure established by legal acts.<br/>
                Your data processing principles<br/>
                We strive for Personal Data to be processed accurately, fairly and legally, to be processed only for the purposes for which it is collected, in compliance with the clear and transparent principles and requirements for personal data processing set forth in legal acts.<br/>
                How long do we keep information about you?<br/>
                We store your information about registration on the Website until you withdraw your consent. We store information about your purchases in accordance with the General Document Storage Terms Index.<br/>
                What are the rights of the data subject?<br/>
                You have the right to familiarize yourself with your personal data and how they are processed, to demand correction, addition or destruction of the provided personal data, as well as to stop their processing (withdraw your consent). You also have the right to demand that the controller of personal data restricts the processing of personal data, the right to transfer data, file a complaint with the State Data Protection Inspectorate (contact details are available on the website www.ada.lt) and object to the processing of submitted personal data. If you want to receive detailed information about the procedure for exercising these rights, send a request to the e-mail specified on the Website. postal address. You can get more detailed information about personal data processing and security by visiting us.<br/>
                Contacts of our responsible person<br/>
                We are committed to ensuring the protection of your personal data and providing all necessary information. If you have any questions or observations regarding the processing of your personal data, please contact us at the e-mail address specified on the Website. Mr. address.<br/>
                This Privacy Policy is valid from the date of its publication on the Website. The Privacy Policy is not considered an agreement between the Company and You regarding the processing of Personal Data. With this Privacy Policy, the Company informs you about the principles of processing your personal data in the Company. We may change the Privacy Policy at any time. Changes and/or additions to the Privacy Policy take effect after their publication on the Website. We recommend that you regularly review our Privacy Policy.<br/>

            @endif
        </div>
    </div>
@endsection
