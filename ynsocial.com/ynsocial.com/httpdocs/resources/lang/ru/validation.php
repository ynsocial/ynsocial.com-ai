<?php

return [

    /*
    |---------------------------------------------------------------------------
    | Doğrulama Dil Satırları
    |---------------------------------------------------------------------------
    |
    | Aşağıdaki dil satırları, doğrulayıcı sınıf tarafından kullanılan varsayılan hata mesajlarını içerir.
    | Bu kuralların bazıları, boyut kuralları gibi birden fazla sürüme sahiptir. Bu mesajları burada
    | ihtiyacınıza göre özelleştirebilirsiniz.
    |
    */

    'accepted' => ':attribute kabul edilmelidir.',
    'accepted_if' => ':attribute, :other :value olduğunda kabul edilmelidir.',
    'active_url' => ':attribute geçerli bir URL değil.',
    'after' => ':attribute, :date tarihinden sonra bir tarih olmalıdır.',
    'after_or_equal' => ':attribute, :date tarihinden sonra veya ona eşit bir tarih olmalıdır.',
    'alpha' => ':attribute yalnızca harf içermelidir.',
    'alpha_dash' => ':attribute yalnızca harfler, rakamlar, tireler ve alt çizgiler içermelidir.',
    'alpha_num' => ':attribute yalnızca harfler ve rakamlar içermelidir.',
    'array' => ':attribute bir dizi olmalıdır.',
    'ascii' => ':attribute yalnızca tek baytlık alfasayısal karakterler ve semboller içermelidir.',
    'before' => ':attribute, :date tarihinden önce bir tarih olmalıdır.',
    'before_or_equal' => ':attribute, :date tarihinden önce veya ona eşit bir tarih olmalıdır.',
    'between' => [
        'array' => ':attribute, :min ile :max arasında öğe içermelidir.',
        'file' => ':attribute, :min ile :max kilobayt arasında olmalıdır.',
        'numeric' => ':attribute, :min ile :max arasında olmalıdır.',
        'string' => ':attribute, :min ile :max karakter arasında olmalıdır.',
    ],
    'boolean' => ':attribute alanı doğru veya yanlış olmalıdır.',
    'confirmed' => ':attribute onayı eşleşmiyor.',
    'current_password' => 'Şifre yanlış.',
    'date' => ':attribute geçerli bir tarih değil.',
    'date_equals' => ':attribute, :date tarihine eşit bir tarih olmalıdır.',
    'date_format' => ':attribute, :format formatı ile eşleşmiyor.',
    'decimal' => ':attribute, :decimal ondalıklı basamağa sahip olmalıdır.',
    'declined' => ':attribute reddedilmelidir.',
    'declined_if' => ':attribute, :other :value olduğunda reddedilmelidir.',
    'different' => ':attribute ve :other farklı olmalıdır.',
    'digits' => ':attribute, :digits basamağa sahip olmalıdır.',
    'digits_between' => ':attribute, :min ile :max basamak arasında olmalıdır.',
    'dimensions' => ':attribute geçersiz resim boyutlarına sahip.',
    'distinct' => ':attribute alanında yinelenen bir değer var.',
    'doesnt_end_with' => ':attribute şu değerlerden biri ile bitmemelidir: :values.',
    'doesnt_start_with' => ':attribute şu değerlerden biri ile başlamamalıdır: :values.',
    'email' => ':attribute geçerli bir e-posta adresi olmalıdır.',
    'ends_with' => ':attribute şu değerlerden biri ile bitmelidir: :values.',
    'enum' => 'Seçilen :attribute geçersiz.',
    'exists' => 'Seçilen :attribute geçersiz.',
    'file' => ':attribute bir dosya olmalıdır.',
    'filled' => ':attribute alanının bir değeri olmalıdır.',
    'gt' => [
        'array' => ':attribute, :value’dan fazla öğe içermelidir.',
        'file' => ':attribute, :value kilobayttan büyük olmalıdır.',
        'numeric' => ':attribute, :value’dan büyük olmalıdır.',
        'string' => ':attribute, :value karakterden fazla olmalıdır.',
    ],
    'gte' => [
        'array' => ':attribute, :value veya daha fazla öğe içermelidir.',
        'file' => ':attribute, :value kilobayttan büyük veya ona eşit olmalıdır.',
        'numeric' => ':attribute, :value’dan büyük veya ona eşit olmalıdır.',
        'string' => ':attribute, :value karakterden büyük veya ona eşit olmalıdır.',
    ],
    'image' => ':attribute bir resim olmalıdır.',
    'in' => 'Seçilen :attribute geçersiz.',
    'in_array' => ':attribute alanı :other içinde mevcut değil.',
    'integer' => ':attribute bir tam sayı olmalıdır.',
    'ip' => ':attribute geçerli bir IP adresi olmalıdır.',
    'ipv4' => ':attribute geçerli bir IPv4 adresi olmalıdır.',
    'ipv6' => ':attribute geçerli bir IPv6 adresi olmalıdır.',
    'json' => ':attribute geçerli bir JSON dizesi olmalıdır.',
    'lowercase' => ':attribute küçük harf olmalıdır.',
    'lt' => [
        'array' => ':attribute, :value’dan az öğe içermelidir.',
        'file' => ':attribute, :value kilobayttan küçük olmalıdır.',
        'numeric' => ':attribute, :value’dan küçük olmalıdır.',
        'string' => ':attribute, :value karakterden küçük olmalıdır.',
    ],
    'lte' => [
        'array' => ':attribute, :value’dan fazla öğe içermemelidir.',
        'file' => ':attribute, :value kilobayttan küçük veya ona eşit olmalıdır.',
        'numeric' => ':attribute, :value’dan küçük veya ona eşit olmalıdır.',
        'string' => ':attribute, :value karakterden küçük veya ona eşit olmalıdır.',
    ],
    'mac_address' => ':attribute geçerli bir MAC adresi olmalıdır.',
    'max' => [
        'array' => ':attribute, :max’tan fazla öğe içermemelidir.',
        'file' => ':attribute, :max kilobayttan büyük olmamalıdır.',
        'numeric' => ':attribute, :max’tan büyük olmamalıdır.',
        'string' => ':attribute, :max karakterden fazla olmamalıdır.',
    ],
    'max_digits' => ':attribute, :max’tan fazla basamağa sahip olmamalıdır.',
    'mimes' => ':attribute şu tür dosya olmalıdır: :values.',
    'mimetypes' => ':attribute şu tür dosya olmalıdır: :values.',
    'min' => [
        'array' => ':attribute, en az :min öğe içermelidir.',
        'file' => ':attribute, en az :min kilobayt olmalıdır.',
        'numeric' => ':attribute, en az :min olmalıdır.',
        'string' => ':attribute, en az :min karakter olmalıdır.',
    ],
    'min_digits' => ':attribute, en az :min basamağa sahip olmalıdır.',
    'missing' => ':attribute alanı eksik olmalıdır.',
    'missing_if' => ':attribute alanı, :other :value olduğunda eksik olmalıdır.',
    'missing_unless' => ':attribute alanı, :other :value olmadığı sürece eksik olmalıdır.',
    'missing_with' => ':attribute alanı, :values mevcut olduğunda eksik olmalıdır.',
    'missing_with_all' => ':attribute alanı, :values mevcut olduğunda eksik olmalıdır.',
    'multiple_of' => ':attribute, :value’nın katı olmalıdır.',
    'not_in' => 'Seçilen :attribute geçersiz.',
    'not_regex' => ':attribute formatı geçersiz.',
    'numeric' => ':attribute bir sayı olmalıdır.',
    'password' => [
        'letters' => ':attribute en az bir harf içermelidir.',
        'mixed' => ':attribute en az bir büyük harf ve bir küçük harf içermelidir.',
        'numbers' => ':attribute en az bir rakam içermelidir.',
        'symbols' => ':attribute en az bir sembol içermelidir.',
        'uncompromised' => 'Verilen :attribute, bir veri sızıntısında göründü. Lütfen farklı bir :attribute seçin.',
    ],
    'present' => ':attribute alanı mevcut olmalıdır.',
    'prohibited' => ':attribute alanı yasaktır.',
    'prohibited_if' => ':attribute alanı, :other :value olduğunda yasaktır.',
    'prohibited_unless' => ':attribute alanı, :other :values içinde olmadıkça yasaktır.',
    'prohibits' => ':attribute alanı :other’ın mevcut olmasını yasaklar.',
    'regex' => ':attribute formatı geçersiz.',
    'required' => ':attribute alanı gereklidir.',
    'required_array_keys' => ':attribute alanı şunlar için girişler içermelidir: :values.',
    'required_if' => ':attribute alanı, :other :value olduğunda gereklidir.',
    'required_if_accepted' => ':attribute alanı, :other kabul edildiğinde gereklidir.',
    'required_unless' => ':attribute alanı, :other :values içinde olmadıkça gereklidir.',
    'required_with' => ':attribute alanı, :values mevcut olduğunda gereklidir.',
    'required_with_all' => ':attribute alanı, :values mevcut olduğunda gereklidir.',
    'required_without' => ':attribute alanı, :values mevcut olmadığında gereklidir.',
    'required_without_all' => ':attribute alanı, :values’in hiçbiri mevcut olmadığında gereklidir.',
    'same' => ':attribute ve :other eşleşmelidir.',
    'size' => [
        'array' => ':attribute, :size öğe içermelidir.',
        'file' => ':attribute, :size kilobayt olmalıdır.',
        'numeric' => ':attribute, :size olmalıdır.',
        'string' => ':attribute, :size karakter olmalıdır.',
    ],
    'starts_with' => ':attribute şu değerlerden biri ile başlamalıdır: :values.',
    'string' => ':attribute bir dize olmalıdır.',
    'timezone' => ':attribute geçerli bir saat dilimi olmalıdır.',
    'unique' => ':attribute zaten alınmış.',
    'uploaded' => ':attribute yüklenemedi.',
    'uppercase' => ':attribute büyük harf olmalıdır.',
    'url' => ':attribute geçerli bir URL olmalıdır.',
    'ulid' => ':attribute geçerli bir ULID olmalıdır.',
    'uuid' => ':attribute geçerli bir UUID olmalıdır.',

    /*
    |---------------------------------------------------------------------------
    | Özel Doğrulama Dil Satırları
    |---------------------------------------------------------------------------
    |
    | Burada, belirli bir doğrulama kuralı için özel bir dil satırı belirtmek için
    | "attribute.rule" kuralını kullanarak özel doğrulama mesajlarını belirleyebilirsiniz.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'özel-mesaj',
        ],
    ],

    /*
    |---------------------------------------------------------------------------
    | Özel Doğrulama Özellikleri
    |---------------------------------------------------------------------------
    |
    | Aşağıdaki dil satırları, özellik yer tutucumuzu "E-Posta Adresi" gibi daha okunabilir
    | bir şeyle değiştirmek için kullanılır. Bu, mesajlarımızı daha anlaşılır hale getirmeye yardımcı olur.
    |
    */

    'attributes' => [],

];
