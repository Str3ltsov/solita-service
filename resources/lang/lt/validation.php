<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute turi būti priimtas.',
    'accepted_if' => ':attribute turi būti priimtas, kai :other yra :value.',
    'active_url' => ':attribute nėra teisingas URL.',
    'after' => ':attribute turi būti data po :date.',
    'after_or_equal' => ':attribute data turi būti po arba lygi :date.',
    'alpha' => ':attribute turi būti sudarytas tik iš raidžių.',
    'alpha_dash' => ':attribute gali būti sudarytas iš raidžių, skaičių, briūkšnelių ir apatinių brukšnių.',
    'alpha_num' => ':attribute gali būti sudarytas tik iš raidžių ir skaičių.',
    'array' => ':attribute privalo būti masyvas.',
    'before' => ':attribute privalo būti data prieš :date.',
    'before_or_equal' => ':attribute privalo būti data prieš arba lygi :date.',
    'between' => [
        'numeric' => ':attribute privalo būti tarp :min ir :max.',
        'file' => ':attribute privalo būti tarp :min ir :max kilobaitų.',
        'string' => ':attribute privalo būti tarp :min ir :max simbolių.',
        'array' => ':attribute privalo būti tarp :min ir :max elementų.',
    ],
    'boolean' => ':attribute laukelis turi būti true arba false',
    'confirmed' => ':attribute patvirtinimas nesutampa.',
    'current_password' => 'Slaptažodis yra neteisingas.',
    'date' => ':attribute nėra tinkama data.',
    'date_equals' => ':attribute data turi būti lygi :date.',
    'date_format' => ':attribute neatitinka formato :format.',
    'declined' => ':attribute privalo būti atmestas.',
    'declined_if' => ':attribute privalo būti atmestas, kai :other yra :value.',
    'different' => ':attribute ir :other privalo būti skirtingi.',
    'digits' => ':attribute privalo būti :digits skaitmenys.',
    'digits_between' => ':attribute privalo būti tarp :min ir :max skaitmenų.',
    'dimensions' => ':attribute turi netinkamus paveikslėlio matmenis.',
    'distinct' => ':attribute laukelis turi pasikartojančią reikšmę.',
    'email' => ':attribute turi būti galiojantis el. pašto adresas.',
    'ends_with' => ':attribute turi baigtis su viena iš šių reikšmių: :values.',
    'enum' => 'Blogai pasirinkta reiškmė :attribute .',
    'exists' => 'Blogai pasirinkta reiškmė :attribute .',
    'file' => ':attribute privalo būti failas.',
    'filled' => ':attribute laukelis negali būti tuščias.',
    'gt' => [
        'numeric' => ':attribute privalo būti didesnis u- :value.',
        'file' => ':attribute privalo būti didesnis už :value kilobaitus.',
        'string' => ':attribute privalo būti ilgesnis nei :value simboliai.',
        'array' => ':attribute privalo tūrėti daugiau nei :value elementų.',
    ],
    'gte' => [
        'numeric' => ':attribute privalo būti didesnis nei arba lygus :value.',
        'file' => ':attribute privalo būti didesnis arba lygus :value kilobaitų.',
        'string' => ':attribute privalo būti didesnis arba lygus :value simbolių.',
        'array' => ':attribute privalo tūrėti :value elementų arba daugiau.',
    ],
    'image' => ':attribute privalo būti paveikslėlis.',
    'in' => 'Pasirinkta reiškmė :attribute yra neteisinga.',
    'in_array' => ':attribute laukelio :other nėra.',
    'integer' => ':attribute privalo būti sveikasis skaičius.',
    'ip' => ':attribute privalo būti tinkamas IP adresas.',
    'ipv4' => ':attribute privalo būti tinkamas IPv4 adresas.',
    'ipv6' => ':attribute privalo būti tinkamas IPv6 adresas.',
    'json' => ':attribute privalo būti tinkama JSON eilutė.',
    'lt' => [
        'numeric' => ':attribute privalo būti mažiau nei :value.',
        'file' => ':attribute privalo būti mažiau nei :value kilobaitų.',
        'string' => ':attribute privalo turėti mažiau nei :value simbolių.',
        'array' => ':attribute privalo turėti mažiau nei :value elementų.',
    ],
    'lte' => [
        'numeric' => ':attribute reikšmė privalo būti mažesnė arba lygi :value.',
        'file' => ':attribute turi užimti mažiau arba lygiai :value kilobaitų.',
        'string' => ':attribute privalo turėti mažiau arba :value simbolių.',
        'array' => ':attribute negali turėti nedaugiau nei :value elementų.',
    ],
    'mac_address' => ':attribute turi būti tinkamas MAC adresas.',
    'max' => [
        'numeric' => ':attribute negali būti didesnis už :max.',
        'file' => ':attribute negali užimti daugiau nei :max kilobaitų.',
        'string' => ':attribute negali turėti daugiau nei :max simbolių.',
        'array' => ':attribute negali turėti daugiau nei :max elementų.',
    ],
    'mimes' => ':attribute privalo būti :values tipo failas.',
    'mimetypes' => ':attribute privalo būti :values tipo failas.',
    'min' => [
        'numeric' => ':attribute privalo būti mažiausiai :min.',
        'file' => ':attribute privalo užimti mažiausiai :min kilobaitus.',
        'string' => ':attribute privalo būti mažiausiai :min simboliai.',
        'array' => ':attribute privalo turėti bent jau :min elementus.',
    ],
    'multiple_of' => ':attribute turi būti :value kartotinis.',
    'not_in' => 'Pasirinkta :attribute reikšmė yra neteisinga.',
    'not_regex' => 'Pasirinktas :attribute formatas yra neteisingas.',
    'numeric' => ':attribute privalo būti skaičius.',
    'password' => 'Slaptažodis yra neteisingas.',
    'present' => ':attribute laukelis negali būti tuščias.',
    'prohibited' => ':attribute laukelis yra draudžiamas.',
    'prohibited_if' => ':attribute laukelis yra draudžiamas, kai :other yra :value.',
    'prohibited_unless' => ':attribute laukelis yra draudžiamas, nebent :other priklauso :values.',
    'prohibits' => ':attribute laukelis draudžia naudoti :other.',
    'regex' => ':attribute formatas yra neteisingas.',
    'required' => ':attribute laukelis yra privalomas.',
    'required_array_keys' => 'Laukelyje :attribute privalo turėti reikšmes iš: :values.',
    'required_if' => ':attribute yra privalomas kai :other yra :value.',
    'required_unless' => ':attribute yra privalomas nebent :other yra :values reikšmėse.',
    'required_with' => ':attribute laukelis yra privalomas, kai šios :values reikšmės egzistuoja.',
    'required_with_all' => ':attribute laukelis yra privalomas, kai šios :values reikšmės egzistuoja.',
    'required_without' => ':attribute laukelis yra privalomas, kuomet šios :values reikšmės neegzistuoja.',
    'required_without_all' => ':attribute laukelis yra privalomas, kai nei viena iš šių :values reikšmių neegzistuoja.',
    'same' => ':attribute ir :other privalo sutapti.',
    'size' => [
        'numeric' => ':attribute privalo būti :size.',
        'file' => ':attribute privalo būti :size kilobaitai.',
        'string' => ':attribute privalo būti :size simbolių.',
        'array' => ':attribute privalo turėti :size elementų.',
    ],
    'starts_with' => ':attribute privalo prasidėti su vienu iš: :values.',
    'string' => ':attribute privalo būti string tipo.',
    'timezone' => ':attribute turi būti tinkama laiko juosta.',
    'unique' => ':attribute jau egzistuoja.',
    'uploaded' => ':attribute nepavyko įkelti.',
    'url' => ':attribute privalo būti tinkamas URL.',
    'uuid' => ':attribute privalo būti tinkamas UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
