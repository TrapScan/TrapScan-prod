<?php

use App\Models\QR;
use App\Models\Trap;
use Illuminate\Support\Facades\Auth;

if (!function_exists('getUniqueTrapId')) {
    function getUniqueTrapId() {
        $found = false;
        while(!$found) {
            $mouri_words = [
                'anuhe',
                'arero',
                'aroha',
                'arotau',
                'aruhe',
                'atawhai',
                'awa',
                'awatea',
                'hauora',
                'hihi',
                'hoiho',
                'huhu',
                'hui',
                'huia',
                'huru',
                'ihu',
                'inoi',
                'irahiko',
                'iti',
                'kaha',
                'kai',
                'kakaha',
                'karaka',
                'karapa',
                'karoro',
                'kata',
                'kauae',
                'kauri',
                'kawau',
                'kea',
                'kiwi',
                'koha',
                'koreke',
                'kuaka',
                'kura',
                'mahi',
                'mahuki',
                'mamaku',
                'mana',
                'manaaki',
                'manatu',
                'manawa',
                'manga',
                'marama',
                'matuku',
                'maunga',
                'mauri',
                'miro',
                'moa',
                'moana',
                'moeroa',
                'motu',
                'muritai',
                'muritai',
                'neinei',
                'ngaio',
                'ngaro',
                'niho',
                'nui',
                'ohi',
                'okioki',
                'oma',
                'onamata',
                'orihou',
                'oro',
                'pae',
                'papa',
                'pehe',
                'pepeke',
                'piopio',
                'poaka',
                'poho',
                'ponga',
                'poto',
                'puha',
                'puke',
                'puku',
                'rimu',
                'ringa',
                'roa',
                'ruru',
                'tai',
                'taniwha',
                'tau',
                'tawa',
                'toanga',
                'totoa',
                'tuhi',
                'tukuatu',
                'turi',
                'tutu',
                'upoko',
                'waewae',
                'wai',
                'waka',
                'weka',
                'whare',
                'whati',
                'wheko',
                'whio',
            ];
            $id = str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
            $word = $mouri_words[array_rand($mouri_words, 1)];
            $candidate = $word . '.' . $id;
            if(! QR::where('qr_code', $candidate)->exists()) {
                return $candidate;
            }
        }
    }
}
