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

    'accepted' => 'Field :attribute harus diterima.',
    'accepted_if' => 'Field :attribute harus diterima ketika :other adalah :value.',
    'active_url' => 'Field :attribute bukan URL yang valid.',
    'after' => 'Field :attribute harus berisi tanggal setelah :date.',
    'after_or_equal' => 'Field :attribute harus berisi tanggal setelah atau sama dengan :date.',
    'alpha' => 'Field :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Field :attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
    'alpha_num' => 'Field :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Field :attribute harus berisi array.',
    'ascii' => 'Field :attribute harus berisi karakter ASCII saja.',
    'before' => 'Field :attribute harus berisi tanggal sebelum :date.',
    'before_or_equal' => 'Field :attribute harus berisi tanggal sebelum atau sama dengan :date.',
    'between' => [
        'array' => 'Field :attribute harus memiliki :min sampai :max item.',
        'file' => 'Field :attribute harus berukuran :min sampai :max kilobita.',
        'numeric' => 'Field :attribute harus bernilai :min sampai :max.',
        'string' => 'Field :attribute harus berisi :min sampai :max karakter.',
    ],
    'boolean' => 'Field :attribute harus berisi true atau false.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'current_password' => 'Kata sandi salah.',
    'date' => 'Field :attribute bukan tanggal yang valid.',
    'date_equals' => 'Field :attribute harus berisi tanggal yang sama dengan :date.',
    'date_format' => 'Field :attribute tidak cocok dengan format :format.',
    'decimal' => 'Field :attribute harus memiliki :decimal digit desimal.',
    'declined' => 'Field :attribute harus ditolak.',
    'declined_if' => 'Field :attribute harus ditolak ketika :other adalah :value.',
    'different' => 'Field :attribute dan :other harus berbeda.',
    'digits' => 'Field :attribute harus berisi :digits digit.',
    'digits_between' => 'Field :attribute harus berisi antara :min dan :max digit.',
    'dimensions' => 'Field :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Field :attribute memiliki nilai yang duplikat.',
    'doesnt_end_with' => ':attribute tidak boleh diakhiri dengan salah satu dari: :values.',
    'doesnt_start_with' => ':attribute tidak boleh diawali dengan salah satu dari: :values.',
    'email' => 'Field :attribute harus berisi alamat email yang valid.',
    'ends_with' => 'Field :attribute harus diakhiri dengan salah satu dari: :values.',
    'enum' => 'Field :attribute yang dipilih tidak valid.',
    'exists' => 'Field :attribute yang dipilih tidak valid.',
    'file' => 'Field :attribute harus berisi file.',
    'filled' => 'Field :attribute harus memiliki nilai.',
    'gt' => [
        'array' => 'Field :attribute harus memiliki lebih dari :value item.',
        'file' => 'Field :attribute harus berukuran lebih dari :value kilobita.',
        'numeric' => 'Field :attribute harus bernilai lebih dari :value.',
        'string' => 'Field :attribute harus berisi lebih dari :value karakter.',
    ],
    'gte' => [
        'array' => 'Field :attribute harus memiliki :value item atau lebih.',
        'file' => 'Field :attribute harus berukuran :value kilobita atau lebih.',
        'numeric' => 'Field :attribute harus bernilai :value atau lebih.',
        'string' => 'Field :attribute harus berisi :value karakter atau lebih.',
    ],
    'image' => 'Field :attribute harus berisi gambar.',
    'in' => 'Field :attribute yang dipilih tidak valid.',
    'in_array' => 'Field :attribute tidak ada dalam :other.',
    'integer' => 'Field :attribute harus berisi bilangan bulat.',
    'ip' => 'Field :attribute harus berisi alamat IP yang valid.',
    'ipv4' => 'Field :attribute harus berisi alamat IPv4 yang valid.',
    'ipv6' => 'Field :attribute harus berisi alamat IPv6 yang valid.',
    'json' => 'Field :attribute harus berisi string JSON yang valid.',
    'list' => 'Field :attribute harus berisi sebuah list.',
    'lowercase' => 'Field :attribute harus berisi huruf kecil.',
    'lt' => [
        'array' => 'Field :attribute harus memiliki kurang dari :value item.',
        'file' => 'Field :attribute harus berukuran kurang dari :value kilobita.',
        'numeric' => 'Field :attribute harus bernilai kurang dari :value.',
        'string' => 'Field :attribute harus berisi kurang dari :value karakter.',
    ],
    'lte' => [
        'array' => 'Field :attribute harus tidak lebih dari :value item.',
        'file' => 'Field :attribute harus berukuran tidak lebih dari :value kilobita.',
        'numeric' => 'Field :attribute harus bernilai tidak lebih dari :value.',
        'string' => 'Field :attribute harus berisi tidak lebih dari :value karakter.',
    ],
    'mac_address' => 'Field :attribute harus berisi alamat MAC yang valid.',
    'max' => [
        'array' => 'Field :attribute tidak boleh memiliki lebih dari :max item.',
        'file' => 'Field :attribute tidak boleh berukuran lebih dari :max kilobita.',
        'numeric' => 'Field :attribute tidak boleh bernilai lebih dari :max.',
        'string' => 'Field :attribute tidak boleh berisi lebih dari :max karakter.',
    ],
    'max_digits' => 'Field :attribute tidak boleh memiliki lebih dari :max digit.',
    'mimes' => 'Field :attribute harus berisi file dengan tipe: :values.',
    'mimetypes' => 'Field :attribute harus berisi file dengan tipe: :values.',
    'min' => [
        'array' => 'Field :attribute harus memiliki minimal :min item.',
        'file' => 'Field :attribute harus berukuran minimal :min kilobita.',
        'numeric' => 'Field :attribute harus bernilai minimal :min.',
        'string' => 'Field :attribute harus berisi minimal :min karakter.',
    ],
    'min_digits' => 'Field :attribute harus memiliki minimal :min digit.',
    'missing' => 'Field :attribute harus hilang.',
    'missing_if' => 'Field :attribute harus hilang ketika :other adalah :value.',
    'missing_unless' => 'Field :attribute harus hilang kecuali :other adalah :value.',
    'missing_with' => 'Field :attribute harus hilang ketika :values ada.',
    'missing_with_all' => 'Field :attribute harus hilang ketika :values ada.',
    'multiple_of' => 'Field :attribute harus berisi kelipatan dari :value.',
    'not_in' => 'Field :attribute yang dipilih tidak valid.',
    'not_regex' => 'Format :attribute tidak valid.',
    'numeric' => 'Field :attribute harus berisi angka.',
    'password' => 'Kata sandi salah.',
    'present' => 'Field :attribute harus ada.',
    'present_if' => 'Field :attribute harus ada ketika :other adalah :value.',
    'present_unless' => 'Field :attribute harus ada kecuali :other adalah :value.',
    'present_with' => 'Field :attribute harus ada ketika :values ada.',
    'present_with_all' => 'Field :attribute harus ada ketika :values ada.',
    'prohibited' => 'Field :attribute dilarang.',
    'prohibited_if' => 'Field :attribute dilarang ketika :other adalah :value.',
    'prohibited_unless' => 'Field :attribute dilarang kecuali :other ada dalam :values.',
    'prohibits' => 'Field :attribute melarang :other untuk hadir.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => 'Field :attribute wajib diisi.',
    'required_array_keys' => 'Field :attribute harus berisi kunci: :values.',
    'required_if' => 'Field :attribute wajib diisi ketika :other adalah :value.',
    'required_if_accepted' => 'Field :attribute wajib diisi ketika :other diterima.',
    'required_unless' => 'Field :attribute wajib diisi kecuali :other ada dalam :values.',
    'required_with' => 'Field :attribute wajib diisi ketika :values ada.',
    'required_with_all' => 'Field :attribute wajib diisi ketika :values ada.',
    'required_without' => 'Field :attribute wajib diisi ketika :values tidak ada.',
    'required_without_all' => 'Field :attribute wajib diisi ketika tidak ada dari :values yang ada.',
    'same' => 'Field :attribute dan :other harus cocok.',
    'size' => [
        'array' => 'Field :attribute harus berisi :size item.',
        'file' => 'Field :attribute harus berukuran :size kilobita.',
        'numeric' => 'Field :attribute harus bernilai :size.',
        'string' => 'Field :attribute harus berisi :size karakter.',
    ],
    'starts_with' => 'Field :attribute harus diawali dengan salah satu dari: :values.',
    'string' => 'Field :attribute harus berisi string.',
    'timezone' => 'Field :attribute harus berisi zona waktu yang valid.',
    'unique' => ':attribute sudah digunakan.',
    'uploaded' => 'Gagal mengunggah :attribute.',
    'uppercase' => 'Field :attribute harus berisi huruf kapital.',
    'url' => 'Field :attribute harus berisi URL yang valid.',
    'ulid' => 'Field :attribute harus berisi ULID yang valid.',
    'uuid' => 'Field :attribute harus berisi UUID yang valid.',

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

    'attributes' => [
        'name' => 'nama',
        'email' => 'email',
        'password' => 'kata sandi',
        'password_confirmation' => 'konfirmasi kata sandi',
        'title' => 'judul',
        'content' => 'konten',
        'description' => 'deskripsi',
        'notes' => 'catatan',
        'attachments' => 'lampiran',
        'quantity' => 'jumlah',
        'unit_id' => 'satuan',
        'category_id' => 'kategori',
        'item_id' => 'barang',
        'movement_date' => 'tanggal transaksi',
        'purchase_date' => 'tanggal perolehan',
        'condition' => 'kondisi',
    ],
];
