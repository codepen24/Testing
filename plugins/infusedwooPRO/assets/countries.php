<?php
function iw_to_country( $code = ''){
    $country = '';
    if( $code == 'AF' ) $country = 'Afghanistan';
    if( $code == 'AX' ) $country = 'Åland Islands';
    if( $code == 'AL' ) $country = 'Albania';
    if( $code == 'DZ' ) $country = 'Algeria';
    if( $code == 'AS' ) $country = 'American Samoa';
    if( $code == 'AD' ) $country = 'Andorra';
    if( $code == 'AO' ) $country = 'Angola';
    if( $code == 'AI' ) $country = 'Anguilla';
    if( $code == 'AQ' ) $country = 'Antarctica';
    if( $code == 'AG' ) $country = 'Antigua and Barbuda';
    if( $code == 'AR' ) $country = 'Argentina';
    if( $code == 'AM' ) $country = 'Armenia';
    if( $code == 'AW' ) $country = 'Aruba';
    if( $code == 'AU' ) $country = 'Australia';
    if( $code == 'AT' ) $country = 'Austria';
    if( $code == 'AZ' ) $country = 'Azerbaijan';
    if( $code == 'BS' ) $country = 'Bahamas (the)';
    if( $code == 'BH' ) $country = 'Bahrain';
    if( $code == 'BD' ) $country = 'Bangladesh';
    if( $code == 'BB' ) $country = 'Barbados';
    if( $code == 'BY' ) $country = 'Belarus';
    if( $code == 'BE' ) $country = 'Belgium';
    if( $code == 'BZ' ) $country = 'Belize';
    if( $code == 'BJ' ) $country = 'Benin';
    if( $code == 'BM' ) $country = 'Bermuda';
    if( $code == 'BT' ) $country = 'Bhutan';
    if( $code == 'BO' ) $country = 'Bolivia (Plurinational State of)';
    if( $code == 'BQ' ) $country = 'Bonaire, Sint Eustatius and Saba';
    if( $code == 'BA' ) $country = 'Bosnia and Herzegovina';
    if( $code == 'BW' ) $country = 'Botswana';
    if( $code == 'BV' ) $country = 'Bouvet Island';
    if( $code == 'BR' ) $country = 'Brazil';
    if( $code == 'IO' ) $country = 'British Indian Ocean Territory (the)';
    if( $code == 'VG' ) $country = 'British Virgin Islands';
    if( $code == 'BN' ) $country = 'Brunei Darussalam';
    if( $code == 'BG' ) $country = 'Bulgaria';
    if( $code == 'BF' ) $country = 'Burkina Faso';
    if( $code == 'BI' ) $country = 'Burundi';
    if( $code == 'KH' ) $country = 'Cambodia';
    if( $code == 'CM' ) $country = 'Cameroon';
    if( $code == 'CA' ) $country = 'Canada';
    if( $code == 'CV' ) $country = 'Cape Verde';
    if( $code == 'KY' ) $country = 'Cayman Islands';
    if( $code == 'CF' ) $country = 'Central African Republic (the)';
    if( $code == 'TD' ) $country = 'Chad';
    if( $code == 'CL' ) $country = 'Chile';
    if( $code == 'CN' ) $country = 'China';
    if( $code == 'CX' ) $country = 'Christmas Island';
    if( $code == 'CC' ) $country = 'Cocos (Keeling) Islands (the)';
    if( $code == 'CO' ) $country = 'Colombia';
    if( $code == 'KM' ) $country = 'Comoros (the)';
    if( $code == 'CD' ) $country = 'Congo (the)';
    if( $code == 'CG' ) $country = 'Congo (the Democratic Republic of the)';
    if( $code == 'CK' ) $country = 'Cook Islands (the)';
    if( $code == 'CR' ) $country = 'Costa Rica';
    if( $code == 'CI' ) $country = 'Côte d\'Ivoire';
    if( $code == 'HR' ) $country = 'Croatia';
    if( $code == 'CU' ) $country = 'Cuba';
    if( $code == 'CY' ) $country = 'Cyprus';
    if( $code == 'CZ' ) $country = 'Czech Republic (the)';
    if( $code == 'DK' ) $country = 'Denmark';
    if( $code == 'DJ' ) $country = 'Djibouti';
    if( $code == 'DM' ) $country = 'Dominica';
    if( $code == 'DO' ) $country = 'Dominican Republic (the)';
    if( $code == 'EC' ) $country = 'Ecuador';
    if( $code == 'EG' ) $country = 'Egypt';
    if( $code == 'SV' ) $country = 'El Salvador';
    if( $code == 'GQ' ) $country = 'Equatorial Guinea';
    if( $code == 'ER' ) $country = 'Eritrea';
    if( $code == 'EE' ) $country = 'Estonia';
    if( $code == 'ET' ) $country = 'Ethiopia';
    if( $code == 'FO' ) $country = 'Faroe Islands (the)';
    if( $code == 'FK' ) $country = 'Falkland Islands (the) [Malvinas]';
    if( $code == 'FJ' ) $country = 'Fiji';
    if( $code == 'FI' ) $country = 'Finland';
    if( $code == 'FR' ) $country = 'France';
    if( $code == 'GF' ) $country = 'French Guiana';
    if( $code == 'PF' ) $country = 'French Polynesia';
    if( $code == 'TF' ) $country = 'French Southern Territories (the)';
    if( $code == 'GA' ) $country = 'Gabon';
    if( $code == 'GM' ) $country = 'Gambia (the)';
    if( $code == 'GE' ) $country = 'Georgia';
    if( $code == 'DE' ) $country = 'Germany';
    if( $code == 'GH' ) $country = 'Ghana';
    if( $code == 'GI' ) $country = 'Gibraltar';
    if( $code == 'GR' ) $country = 'Greece';
    if( $code == 'GL' ) $country = 'Greenland';
    if( $code == 'GD' ) $country = 'Grenada';
    if( $code == 'GP' ) $country = 'Guadeloupe';
    if( $code == 'GU' ) $country = 'Guam';
    if( $code == 'GT' ) $country = 'Guatemala';
    if( $code == 'GG' ) $country = 'Guernsey';
    if( $code == 'GN' ) $country = 'Guinea';
    if( $code == 'GW' ) $country = 'Guinea-Bissau';
    if( $code == 'GY' ) $country = 'Guyana';
    if( $code == 'HT' ) $country = 'Haiti';
    if( $code == 'HM' ) $country = 'Heard Island and McDonald Islands';
    if( $code == 'VA' ) $country = 'Holy See (the)';
    if( $code == 'HN' ) $country = 'Honduras';
    if( $code == 'HK' ) $country = 'Hong Kong';
    if( $code == 'HU' ) $country = 'Hungary';
    if( $code == 'IS' ) $country = 'Iceland';
    if( $code == 'IN' ) $country = 'India';
    if( $code == 'ID' ) $country = 'Indonesia';
    if( $code == 'IR' ) $country = 'Iran (Islamic Republic of)';
    if( $code == 'IQ' ) $country = 'Iraq';
    if( $code == 'IE' ) $country = 'Ireland';
    if( $code == 'IM' ) $country = 'Isle of Man';
    if( $code == 'IL' ) $country = 'Israel';
    if( $code == 'IT' ) $country = 'Italy';
    if( $code == 'JM' ) $country = 'Jamaica';
    if( $code == 'JP' ) $country = 'Japan';
    if( $code == 'JE' ) $country = 'Jersey';
    if( $code == 'JO' ) $country = 'Jordan';
    if( $code == 'KZ' ) $country = 'Kazakhstan';
    if( $code == 'KE' ) $country = 'Kenya';
    if( $code == 'KI' ) $country = 'Kiribati';
    if( $code == 'KP' ) $country = 'Korea (the Democratic People\'s Republic of)';
    if( $code == 'KR' ) $country = 'Korea (the Republic of)';
    if( $code == 'KW' ) $country = 'Kuwait';
    if( $code == 'KG' ) $country = 'Kyrgyzstan';
    if( $code == 'LA' ) $country = 'Lao People\'s Democratic Republic (the)';
    if( $code == 'LV' ) $country = 'Latvia';
    if( $code == 'LB' ) $country = 'Lebanon';
    if( $code == 'LS' ) $country = 'Lesotho';
    if( $code == 'LR' ) $country = 'Liberia';
    if( $code == 'LY' ) $country = 'Libya';
    if( $code == 'LI' ) $country = 'Liechtenstein';
    if( $code == 'LT' ) $country = 'Lithuania';
    if( $code == 'LU' ) $country = 'Luxembourg';
    if( $code == 'MO' ) $country = 'Macao';
    if( $code == 'MK' ) $country = 'Macedonia (the former Yugoslav Republic of)';
    if( $code == 'MG' ) $country = 'Madagascar';
    if( $code == 'MW' ) $country = 'Malawi';
    if( $code == 'MY' ) $country = 'Malaysia';
    if( $code == 'MV' ) $country = 'Maldives';
    if( $code == 'ML' ) $country = 'Mali';
    if( $code == 'MT' ) $country = 'Malta';
    if( $code == 'MH' ) $country = 'Marshall Islands (the)';
    if( $code == 'MQ' ) $country = 'Martinique';
    if( $code == 'MR' ) $country = 'Mauritania';
    if( $code == 'MU' ) $country = 'Mauritius';
    if( $code == 'YT' ) $country = 'Mayotte';
    if( $code == 'MX' ) $country = 'Mexico';
    if( $code == 'FM' ) $country = 'Micronesia (Federated States of)';
    if( $code == 'MD' ) $country = 'Moldova (the Republic of)';
    if( $code == 'MC' ) $country = 'Monaco';
    if( $code == 'MN' ) $country = 'Mongolia';
    if( $code == 'ME' ) $country = 'Montenegro';
    if( $code == 'MS' ) $country = 'Montserrat';
    if( $code == 'MA' ) $country = 'Morocco';
    if( $code == 'MZ' ) $country = 'Mozambique';
    if( $code == 'MM' ) $country = 'Myanmar';
    if( $code == 'NA' ) $country = 'Namibia';
    if( $code == 'NR' ) $country = 'Nauru';
    if( $code == 'NP' ) $country = 'Nepal';
    if( $code == 'AN' ) $country = 'Netherlands Antilles';
    if( $code == 'NL' ) $country = 'Netherlands (the)';
    if( $code == 'NC' ) $country = 'New Caledonia';
    if( $code == 'NZ' ) $country = 'New Zealand';
    if( $code == 'NI' ) $country = 'Nicaragua';
    if( $code == 'NE' ) $country = 'Niger';
    if( $code == 'NG' ) $country = 'Nigeria';
    if( $code == 'NU' ) $country = 'Niue';
    if( $code == 'NF' ) $country = 'Norfolk Island';
    if( $code == 'MP' ) $country = 'Northern Mariana Islands (the)';
    if( $code == 'NO' ) $country = 'Norway';
    if( $code == 'OM' ) $country = 'Oman';
    if( $code == 'PK' ) $country = 'Pakistan';
    if( $code == 'PW' ) $country = 'Palau';
    if( $code == 'PS' ) $country = 'Palestine, State of';
    if( $code == 'PA' ) $country = 'Panama';
    if( $code == 'PG' ) $country = 'Papua New Guinea';
    if( $code == 'PY' ) $country = 'Paraguay';
    if( $code == 'PE' ) $country = 'Peru';
    if( $code == 'PH' ) $country = 'Philippines (the)';
    if( $code == 'PN' ) $country = 'Pitcairn Islands';
    if( $code == 'PL' ) $country = 'Poland';
    if( $code == 'PT' ) $country = 'Portugal';
    if( $code == 'PR' ) $country = 'Puerto Rico';
    if( $code == 'QA' ) $country = 'Qatar';
    if( $code == 'RE' ) $country = 'Réunion';
    if( $code == 'RO' ) $country = 'Romania';
    if( $code == 'RU' ) $country = 'Russian Federation';
    if( $code == 'RW' ) $country = 'Rwanda';
    if( $code == 'BL' ) $country = 'Saint Barthélemy';
    if( $code == 'SH' ) $country = 'Saint Helena, Ascension and Tristan da Cunha';
    if( $code == 'KN' ) $country = 'Saint Kitts and Nevis';
    if( $code == 'LC' ) $country = 'Saint Lucia';
    if( $code == 'MF' ) $country = 'Saint Martin (French part)';
    if( $code == 'PM' ) $country = 'Saint Pierre and Miquelon';
    if( $code == 'VC' ) $country = 'Saint Vincent and the Grenadines';
    if( $code == 'WS' ) $country = 'Samoa';
    if( $code == 'SM' ) $country = 'San Marino';
    if( $code == 'ST' ) $country = 'Sao Tome and Principe';
    if( $code == 'SA' ) $country = 'Saudi Arabia';
    if( $code == 'SN' ) $country = 'Senegal';
    if( $code == 'RS' ) $country = 'Serbia';
    if( $code == 'SC' ) $country = 'Seychelles';
    if( $code == 'SL' ) $country = 'Sierra Leone';
    if( $code == 'SG' ) $country = 'Singapore';
    if( $code == 'SK' ) $country = 'Slovakia';
    if( $code == 'SI' ) $country = 'Slovenia';
    if( $code == 'SB' ) $country = 'Solomon Islands';
    if( $code == 'SO' ) $country = 'Somalia';
    if( $code == 'ZA' ) $country = 'South Africa';
    if( $code == 'GS' ) $country = 'South Georgia and the South Sandwich Islands';
    if( $code == 'ES' ) $country = 'Spain';
    if( $code == 'LK' ) $country = 'Sri Lanka';
    if( $code == 'SD' ) $country = 'Sudan (the)';
    if( $code == 'SR' ) $country = 'Suriname';
    if( $code == 'SJ' ) $country = 'Svalbard And Jan Mayen';
    if( $code == 'SZ' ) $country = 'Swaziland';
    if( $code == 'SE' ) $country = 'Sweden';
    if( $code == 'CH' ) $country = 'Switzerland';
    if( $code == 'SY' ) $country = 'Syrian Arab Republic';
    if( $code == 'TW' ) $country = 'Taiwan (Province of China)';
    if( $code == 'TJ' ) $country = 'Tajikistan';
    if( $code == 'TZ' ) $country = 'Tanzania, United Republic of';
    if( $code == 'TH' ) $country = 'Thailand';
    if( $code == 'TL' ) $country = 'Timor-Leste';
    if( $code == 'TG' ) $country = 'Togo';
    if( $code == 'TK' ) $country = 'Tokelau';
    if( $code == 'TO' ) $country = 'Tonga';
    if( $code == 'TT' ) $country = 'Trinidad and Tobago';
    if( $code == 'TN' ) $country = 'Tunisia';
    if( $code == 'TR' ) $country = 'Turkey';
    if( $code == 'TM' ) $country = 'Turkmenistan';
    if( $code == 'TC' ) $country = 'Turks and Caicos Islands (the)';
    if( $code == 'TV' ) $country = 'Tuvalu';
    if( $code == 'UG' ) $country = 'Uganda';
    if( $code == 'UA' ) $country = 'Ukraine';
    if( $code == 'AE' ) $country = 'United Arab Emirates (the)';
    if( $code == 'GB' ) $country = 'United Kingdom';
    if( $code == 'US' ) $country = 'United States';
    if( $code == 'UM' ) $country = 'United States Minor Outlying Islands (the)';
    if( $code == 'VI' ) $country = 'Virgin Islands (U.S.)';
    if( $code == 'UY' ) $country = 'Uruguay';
    if( $code == 'UZ' ) $country = 'Uzbekistan';
    if( $code == 'VU' ) $country = 'Vanuatu';
    if( $code == 'VE' ) $country = 'Venezuela';
    if( $code == 'VN' ) $country = 'Viet Nam';
    if( $code == 'WF' ) $country = 'Wallis and Futuna';
    if( $code == 'EH' ) $country = 'Western Sahara';
    if( $code == 'YE' ) $country = 'Yemen';
    if( $code == 'ZM' ) $country = 'Zambia';
    if( $code == 'ZW' ) $country = 'Zimbabwe';
    if( $country == '') $country = $code;
    return $country;
}


function iw_to_country_code( $country = ''){
    $code = '';
    if($country == 'Afghanistan') $code = 'AF';
    if($country == 'Åland Islands') $code = 'AX';
    if($country == 'Albania') $code = 'AL';
    if($country == 'Algeria') $code = 'DZ';
    if($country == 'American Samoa') $code = 'AS';
    if($country == 'Andorra') $code = 'AD';
    if($country == 'Angola') $code = 'AO';
    if($country == 'Anguilla') $code = 'AI';
    if($country == 'Antarctica') $code = 'AQ';
    if($country == 'Antigua and Barbuda') $code = 'AG';
    if($country == 'Argentina') $code = 'AR';
    if($country == 'Armenia') $code = 'AM';
    if($country == 'Aruba') $code = 'AW';
    if($country == 'Australia') $code = 'AU';
    if($country == 'Austria') $code = 'AT';
    if($country == 'Azerbaijan') $code = 'AZ';
    if($country == 'Bahamas (the)') $code = 'BS';
    if($country == 'Bahrain') $code = 'BH';
    if($country == 'Bangladesh') $code = 'BD';
    if($country == 'Barbados') $code = 'BB';
    if($country == 'Belarus') $code = 'BY';
    if($country == 'Belgium') $code = 'BE';
    if($country == 'Belize') $code = 'BZ';
    if($country == 'Benin') $code = 'BJ';
    if($country == 'Bermuda') $code = 'BM';
    if($country == 'Bhutan') $code = 'BT';
    if($country == 'Bolivia (Plurinational State of)') $code = 'BO';
    if($country == 'Bonaire, Sint Eustatius and Saba') $code = 'BQ';
    if($country == 'Bosnia and Herzegovina') $code = 'BA';
    if($country == 'Botswana') $code = 'BW';
    if($country == 'Bouvet Island') $code = 'BV';
    if($country == 'Brazil') $code = 'BR';
    if($country == 'British Indian Ocean Territory (the)') $code = 'IO';
    if($country == 'British Virgin Islands') $code = 'VG';
    if($country == 'Brunei Darussalam') $code = 'BN';
    if($country == 'Bulgaria') $code = 'BG';
    if($country == 'Burkina Faso') $code = 'BF';
    if($country == 'Burundi') $code = 'BI';
    if($country == 'Cambodia') $code = 'KH';
    if($country == 'Cameroon') $code = 'CM';
    if($country == 'Canada') $code = 'CA';
    if($country == 'Cape Verde') $code = 'CV';
    if($country == 'Cayman Islands') $code = 'KY';
    if($country == 'Central African Republic (the)') $code = 'CF';
    if($country == 'Chad') $code = 'TD';
    if($country == 'Chile') $code = 'CL';
    if($country == 'China') $code = 'CN';
    if($country == 'Christmas Island') $code = 'CX';
    if($country == 'Cocos (Keeling) Islands (the)') $code = 'CC';
    if($country == 'Colombia') $code = 'CO';
    if($country == 'Comoros (the)') $code = 'KM';
    if($country == 'Congo (the)') $code = 'CD';
    if($country == 'Congo (the Democratic Republic of the)') $code = 'CG';
    if($country == 'Cook Islands (the)') $code = 'CK';
    if($country == 'Costa Rica') $code = 'CR';
    if($country == 'Côte d\'Ivoire') $code = 'CI';
    if($country == 'Croatia') $code = 'HR';
    if($country == 'Cuba') $code = 'CU';
    if($country == 'Cyprus') $code = 'CY';
    if($country == 'Czech Republic (the)') $code = 'CZ';
    if($country == 'Denmark') $code = 'DK';
    if($country == 'Djibouti') $code = 'DJ';
    if($country == 'Dominica') $code = 'DM';
    if($country == 'Dominican Republic (the)') $code = 'DO';
    if($country == 'Ecuador') $code = 'EC';
    if($country == 'Egypt') $code = 'EG';
    if($country == 'El Salvador') $code = 'SV';
    if($country == 'Equatorial Guinea') $code = 'GQ';
    if($country == 'Eritrea') $code = 'ER';
    if($country == 'Estonia') $code = 'EE';
    if($country == 'Ethiopia') $code = 'ET';
    if($country == 'Faroe Islands (the)') $code = 'FO';
    if($country == 'Falkland Islands (the) [Malvinas]') $code = 'FK';
    if($country == 'Fiji') $code = 'FJ';
    if($country == 'Finland') $code = 'FI';
    if($country == 'France') $code = 'FR';
    if($country == 'French Guiana') $code = 'GF';
    if($country == 'French Polynesia') $code = 'PF';
    if($country == 'French Southern Territories (the)') $code = 'TF';
    if($country == 'Gabon') $code = 'GA';
    if($country == 'Gambia (the)') $code = 'GM';
    if($country == 'Georgia') $code = 'GE';
    if($country == 'Germany') $code = 'DE';
    if($country == 'Ghana') $code = 'GH';
    if($country == 'Gibraltar') $code = 'GI';
    if($country == 'Greece') $code = 'GR';
    if($country == 'Greenland') $code = 'GL';
    if($country == 'Grenada') $code = 'GD';
    if($country == 'Guadeloupe') $code = 'GP';
    if($country == 'Guam') $code = 'GU';
    if($country == 'Guatemala') $code = 'GT';
    if($country == 'Guernsey') $code = 'GG';
    if($country == 'Guinea') $code = 'GN';
    if($country == 'Guinea-Bissau') $code = 'GW';
    if($country == 'Guyana') $code = 'GY';
    if($country == 'Haiti') $code = 'HT';
    if($country == 'Heard Island and McDonald Islands') $code = 'HM';
    if($country == 'Holy See (the)') $code = 'VA';
    if($country == 'Honduras') $code = 'HN';
    if($country == 'Hong Kong') $code = 'HK';
    if($country == 'Hungary') $code = 'HU';
    if($country == 'Iceland') $code = 'IS';
    if($country == 'India') $code = 'IN';
    if($country == 'Indonesia') $code = 'ID';
    if($country == 'Iran (Islamic Republic of)') $code = 'IR';
    if($country == 'Iraq') $code = 'IQ';
    if($country == 'Ireland') $code = 'IE';
    if($country == 'Isle of Man') $code = 'IM';
    if($country == 'Israel') $code = 'IL';
    if($country == 'Italy') $code = 'IT';
    if($country == 'Jamaica') $code = 'JM';
    if($country == 'Japan') $code = 'JP';
    if($country == 'Jersey') $code = 'JE';
    if($country == 'Jordan') $code = 'JO';
    if($country == 'Kazakhstan') $code = 'KZ';
    if($country == 'Kenya') $code = 'KE';
    if($country == 'Kiribati') $code = 'KI';
    if($country == 'Korea (the Democratic People\'s Republic of)') $code = 'KP';
    if($country == 'Korea (the Republic of)') $code = 'KR';
    if($country == 'Kuwait') $code = 'KW';
    if($country == 'Kyrgyzstan') $code = 'KG';
    if($country == 'Lao People\'s Democratic Republic (the)') $code = 'LA';
    if($country == 'Latvia') $code = 'LV';
    if($country == 'Lebanon') $code = 'LB';
    if($country == 'Lesotho') $code = 'LS';
    if($country == 'Liberia') $code = 'LR';
    if($country == 'Libya') $code = 'LY';
    if($country == 'Liechtenstein') $code = 'LI';
    if($country == 'Lithuania') $code = 'LT';
    if($country == 'Luxembourg') $code = 'LU';
    if($country == 'Macao') $code = 'MO';
    if($country == 'Macedonia (the former Yugoslav Republic of)') $code = 'MK';
    if($country == 'Madagascar') $code = 'MG';
    if($country == 'Malawi') $code = 'MW';
    if($country == 'Malaysia') $code = 'MY';
    if($country == 'Maldives') $code = 'MV';
    if($country == 'Mali') $code = 'ML';
    if($country == 'Malta') $code = 'MT';
    if($country == 'Marshall Islands (the)') $code = 'MH';
    if($country == 'Martinique') $code = 'MQ';
    if($country == 'Mauritania') $code = 'MR';
    if($country == 'Mauritius') $code = 'MU';
    if($country == 'Mayotte') $code = 'YT';
    if($country == 'Mexico') $code = 'MX';
    if($country == 'Micronesia (Federated States of)') $code = 'FM';
    if($country == 'Moldova (the Republic of)') $code = 'MD';
    if($country == 'Monaco') $code = 'MC';
    if($country == 'Mongolia') $code = 'MN';
    if($country == 'Montenegro') $code = 'ME';
    if($country == 'Montserrat') $code = 'MS';
    if($country == 'Morocco') $code = 'MA';
    if($country == 'Mozambique') $code = 'MZ';
    if($country == 'Myanmar') $code = 'MM';
    if($country == 'Namibia') $code = 'NA';
    if($country == 'Nauru') $code = 'NR';
    if($country == 'Nepal') $code = 'NP';
    if($country == 'Netherlands Antilles') $code = 'AN';
    if($country == 'Netherlands (the)') $code = 'NL';
    if($country == 'New Caledonia') $code = 'NC';
    if($country == 'New Zealand') $code = 'NZ';
    if($country == 'Nicaragua') $code = 'NI';
    if($country == 'Niger') $code = 'NE';
    if($country == 'Nigeria') $code = 'NG';
    if($country == 'Niue') $code = 'NU';
    if($country == 'Norfolk Island') $code = 'NF';
    if($country == 'Northern Mariana Islands (the)') $code = 'MP';
    if($country == 'Norway') $code = 'NO';
    if($country == 'Oman') $code = 'OM';
    if($country == 'Pakistan') $code = 'PK';
    if($country == 'Palau') $code = 'PW';
    if($country == 'Palestine, State of') $code = 'PS';
    if($country == 'Panama') $code = 'PA';
    if($country == 'Papua New Guinea') $code = 'PG';
    if($country == 'Paraguay') $code = 'PY';
    if($country == 'Peru') $code = 'PE';
    if($country == 'Philippines (the)') $code = 'PH';
    if($country == 'Pitcairn Islands') $code = 'PN';
    if($country == 'Poland') $code = 'PL';
    if($country == 'Portugal') $code = 'PT';
    if($country == 'Puerto Rico') $code = 'PR';
    if($country == 'Qatar') $code = 'QA';
    if($country == 'Réunion') $code = 'RE';
    if($country == 'Romania') $code = 'RO';
    if($country == 'Russian Federation') $code = 'RU';
    if($country == 'Rwanda') $code = 'RW';
    if($country == 'Saint Barthélemy') $code = 'BL';
    if($country == 'Saint Helena, Ascension and Tristan da Cunha') $code = 'SH';
    if($country == 'Saint Kitts and Nevis') $code = 'KN';
    if($country == 'Saint Lucia') $code = 'LC';
    if($country == 'Saint Martin (French part)') $code = 'MF';
    if($country == 'Saint Pierre and Miquelon') $code = 'PM';
    if($country == 'Saint Vincent and the Grenadines') $code = 'VC';
    if($country == 'Samoa') $code = 'WS';
    if($country == 'San Marino') $code = 'SM';
    if($country == 'Sao Tome and Principe') $code = 'ST';
    if($country == 'Saudi Arabia') $code = 'SA';
    if($country == 'Senegal') $code = 'SN';
    if($country == 'Serbia') $code = 'RS';
    if($country == 'Seychelles') $code = 'SC';
    if($country == 'Sierra Leone') $code = 'SL';
    if($country == 'Singapore') $code = 'SG';
    if($country == 'Slovakia') $code = 'SK';
    if($country == 'Slovenia') $code = 'SI';
    if($country == 'Solomon Islands') $code = 'SB';
    if($country == 'Somalia') $code = 'SO';
    if($country == 'South Africa') $code = 'ZA';
    if($country == 'South Georgia and the South Sandwich Islands') $code = 'GS';
    if($country == 'Spain') $code = 'ES';
    if($country == 'Sri Lanka') $code = 'LK';
    if($country == 'Sudan (the)') $code = 'SD';
    if($country == 'Suriname') $code = 'SR';
    if($country == 'Svalbard And Jan Mayen') $code = 'SJ';
    if($country == 'Swaziland') $code = 'SZ';
    if($country == 'Sweden') $code = 'SE';
    if($country == 'Switzerland') $code = 'CH';
    if($country == 'Syrian Arab Republic') $code = 'SY';
    if($country == 'Taiwan (Province of China)') $code = 'TW';
    if($country == 'Tajikistan') $code = 'TJ';
    if($country == 'Tanzania, United Republic of') $code = 'TZ';
    if($country == 'Thailand') $code = 'TH';
    if($country == 'Timor-Leste') $code = 'TL';
    if($country == 'Togo') $code = 'TG';
    if($country == 'Tokelau') $code = 'TK';
    if($country == 'Tonga') $code = 'TO';
    if($country == 'Trinidad and Tobago') $code = 'TT';
    if($country == 'Tunisia') $code = 'TN';
    if($country == 'Turkey') $code = 'TR';
    if($country == 'Turkmenistan') $code = 'TM';
    if($country == 'Turks and Caicos Islands (the)') $code = 'TC';
    if($country == 'Tuvalu') $code = 'TV';
    if($country == 'Uganda') $code = 'UG';
    if($country == 'Ukraine') $code = 'UA';
    if($country == 'United Arab Emirates (the)') $code = 'AE';
    if($country == 'United Kingdom') $code = 'GB';
    if($country == 'United States') $code = 'US';
    if($country == 'United States Minor Outlying Islands (the)') $code = 'UM';
    if($country == 'Virgin Islands (U.S.)') $code = 'VI';
    if($country == 'Uruguay') $code = 'UY';
    if($country == 'Uzbekistan') $code = 'UZ';
    if($country == 'Vanuatu') $code = 'VU';
    if($country == 'Venezuela') $code = 'VE';
    if($country == 'Viet Nam') $code = 'VN';
    if($country == 'Wallis and Futuna') $code = 'WF';
    if($country == 'Western Sahara') $code = 'EH';
    if($country == 'Yemen') $code = 'YE';
    if($country == 'Zambia') $code = 'ZM';
    if($country == 'Zimbabwe') $code = 'ZW';
    if($code == '') $code = $country;
    return $code;
}
