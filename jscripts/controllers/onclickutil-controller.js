/**
 *  DiceTechPro - Angular Module
 *  Filters:
 *      toTrustedHTML: returns a strict contextual escaping ($sce) of html for html binding
 *  Factories:
 *      CaptchaFactory: returns a factory object with a method that returns a new CAPTCHA object
 *  Directives:
 *      diceBlurTracker: directive that tracks whether or not a form element's blur event has been triggered
 *      diceValidAndUniqueEmail: directive for email (text, if no email support) input. Validates when input is a valid email that doesn't already exist in Dice's system
 *      dicePasswordMatch: directive for ensuring a form element's value matches another value
 *      diceCaptcha: wrap around diceCaptchaInput input - adds a template containing a CAPTCHA
 *      diceCaptchaInput: place within diceCaptcha directive - communicates inputs values and events with parent diceCaptcha directive controller for form validation
 */

(function diceTechProModule() {
    'use strict';

    var diceTechPro = angular.module('diceTechPro', ['diceTechPro.locationServices', 'diceTechPro.util']),
        diceLocationServices = angular.module('diceTechPro.locationServices', ['diceTechPro.util']),
        diceUtil = angular.module('diceTechPro.util', []);

    diceUtil.constant('httpRequestEvents', {
        'requestStart': 'requestStart',
        'requestError': 'requestError',
        'requestComplete': 'requestComplete'
    });

    diceUtil.service('fileReader', ['$q', function ($q) {
        function onLoad(reader, deferred, scope) {
            return function () {
                scope.$apply(function () {
                    deferred.resolve(reader.result);
                });
            };
        }
        function onError(reader, deferred, scope) {
            return function () {
                scope.$apply(function () {
                    deferred.reject(reader.result);
                });
            };
        }
        function onProgress(reader, scope) {
            return function (event) {
                scope.$broadcast('fileProgress',
                    {
                        total: event.total,
                        loaded: event.loaded
                    });
            };
        }
        function getReader(deferred, scope) {
            var reader = new FileReader();
            reader.onload = onLoad(reader, deferred, scope);
            reader.onerror = onError(reader, deferred, scope);
            reader.onprogress = onProgress(reader, scope);
            return reader;
        }
        function readAsDataURL(file, scope) {
            var deferred = $q.defer(),
                reader = getReader(deferred, scope);
            reader.readAsDataURL(file);

            return deferred.promise;
        }
        function isSupported() {
            return !!FileReader;
        }
        return {
            readAsDataURL: readAsDataURL,
            isSupported: isSupported()
        };
    }]);

    diceUtil.constant('diceRegex', {
        onlyNumbers: /^\d+$/,
        dateExp: /^(?:0([1-9])|(1[0-2]))\/?([0-9]{4}|[0-9]{2})$/,
        supportedFileExtensions: /\.(?:docx?|pdf|txt|rtf)$/i,
        supportedImageExtensions: /\.(?:jpg?|jpeg|png|gif)$/i,
        jobUploadFileExtensions: /\.(?:xls?|xlsx|csv)$/i,
        email: /^[a-z0-9!#$%&'*+\/=?^_`{|}~.-]+@[a-z0-9]([a-z0-9-]*[a-z0-9])?(\.[a-z0-9]([a-z0-9-]*[a-z0-9])?)*$/i,
        password: /^.*(?:\d.*[A-Za-z]|[A-Za-z].*\d).*$/,
        unformattedPhone: /\d{10}/,
        unformattedMobile: /^\+?[0-9]{2,5}\-[0-9]{10,12}$/,
        m:/((\+?)((0[ -]+)*|(91 )*)(\d{12}|\d{10}))|\d{5}([- ]*)\d{6}/,
        mobileNo:/^([0|\+[0-9]{1,5})?([7-9][0-9]{9})$/,
        ph:/^([0|\+[0-9]{1,5})?-([0-9]{2,4})-([0-9]{5,10})$/,
        cityState: /^([^,]+)\s*,\s*([A-Z]{2})$/,
        municipalityRegion: /^([^,]+)\s*(?:,\s*([^,]+))?$/,
        postalCode: /^[A-Za-z0-9](?:[-\s](?=[A-Za-z0-9])|[A-Za-z0-9])+?[A-Za-z0-9]$/,
        indiaPostCode:/^([0-9]{6}|[0-9]{3}\s[0-9]{3})$/,
        zipCode: /^\d{5}(?:-\d{4})?$/,
        profileId: /^[a-z0-9]{32}$/,
        length:/.{0}|.{5,}/
    });

    diceTechPro.constant('TECHPRO_CONSTANTS', {
        'functions':[],
        'industries':[],
        'roles':[],
        'locations':[],
        'states':[],
        'countrys':[],
        'empTypes':[],
        'eduTypes':[],
        'travelTypes':[],
        'empRepoTypes':[
            { id:1, code:1, name: "Private Repository", group:"", groupName: ""},
            { id:2, code:2, name: "Public Repository", group:"", groupName: ""},
            { id:3, code:3, name: "All Repositories", group:"", groupName: ""}
        ],
        'empSearchTypes':[
            {id:1,  code:1, name:'Resume Title',  group:"", groupName: ""}, 
            {id:2,  code:2, name:'Skill Set',     group:"", groupName: ""}, 
            {id:3,  code:3, name:'Entire Resume', group:"", groupName: ""},
            {id:4,  code:4, name:'Email Address', group:"", groupName: ""}, 
            {id:5,  code:5, name:'Employers Name', group:"", groupName: ""}
        ],
        'countries': {
            'us': 'United States',
            'ca': 'Canada',
            'in': 'India',
            'af': 'Afghanistan',
            'al': 'Albania',
            'dz': 'Algeria',
            'as': 'American Samoa',
            'ad': 'Andorra',
            'ao': 'Angola',
            'ai': 'Anguilla',
            'aq': 'Antarctica',
            'ag': 'Antigua and Barbuda',
            'ar': 'Argentina',
            'am': 'Armenia',
            'aw': 'Aruba',
            'au': 'Australia',
            'at': 'Austria',
            'az': 'Azerbaijan',
            'bs': 'Bahamas',
            'bh': 'Bahrain',
            'bd': 'Bangladesh',
            'bb': 'Barbados',
            'by': 'Belarus',
            'be': 'Belgium',
            'bz': 'Belize',
            'bj': 'Benin',
            'bm': 'Bermuda',
            'bt': 'Bhutan',
            'bo': 'Bolivia',
            'ba': 'Bosnia and Herzegovina',
            'bw': 'Botswana',
            'bv': 'Bouvet Island',
            'br': 'Brazil',
            'io': 'British Indian Ocean Territory',
            'bn': 'Brunei Darussalam',
            'bg': 'Bulgaria',
            'bf': 'Burkina Faso',
            'bi': 'Burundi',
            'kh': 'Cambodia',
            'cm': 'Cameroon',
            'cv': 'Cape Verde',
            'ky': 'Cayman Islands',
            'cf': 'Central African Republic',
            'td': 'Chad',
            'cl': 'Chile',
            'cn': 'China',
            'cx': 'Christmas Island',
            'cc': 'Cocos (Keeling) Islands',
            'co': 'Colombia',
            'km': 'Comoros',
            'cg': 'Congo',
            'cd': 'Congo, The Democratic Republic of the',
            'ck': 'Cook Islands',
            'cr': 'Costa Rica',
            'ci': 'Cote D\'Ivoire',
            'hr': 'Croatia',
            'cu': 'Cuba- Guantanamo Bay',
            'cy': 'Cyprus',
            'cz': 'Czech Republic',
            'dk': 'Denmark',
            'dj': 'Djibouti',
            'dm': 'Dominica',
            'do': 'Dominican Republic',
            'tl': 'East Timor',
            'ec': 'Ecuador',
            'eg': 'Egypt',
            'sv': 'El Salvador',
            'gq': 'Equatorial Guinea',
            'er': 'Eritrea',
            'ee': 'Estonia',
            'et': 'Ethiopia',
            'fk': 'Falkland Islands(Malvinas)',
            'fo': 'Faroe Islands',
            'fj': 'Fiji',
            'fi': 'Finland',
            'fr': 'France',
            'gf': 'French Guiana',
            'pf': 'French Polynesia',
            'tf': 'French Southern Territories',
            'ga': 'Gabon',
            'gm': 'Gambia',
            'ps': 'Gaza Strip, West Bank',
            'ge': 'Georgia',
            'de': 'Germany',
            'gh': 'Ghana',
            'gi': 'Gibraltar',
            'gr': 'Greece',
            'gl': 'Greenland',
            'gd': 'Grenada',
            'gp': 'Guadeloupe',
            'gu': 'Guam',
            'gt': 'Guatemala',
            'gn': 'Guinea',
            'gw': 'Guinea-Bissau',
            'gy': 'Guyana',
            'ht': 'Haiti',
            'hm': 'Heard and McDonald Islands',
            'va': 'Holy See (Vatican City State)',
            'hn': 'Honduras',
            'hk': 'Hong Kong',
            'hu': 'Hungary',
            'is': 'Iceland',
            'id': 'Indonesia',
            'iq': 'Iraq',
            'ie': 'Ireland',
            'il': 'Israel',
            'it': 'Italy',
            'jm': 'Jamaica',
            'jp': 'Japan',
            'jo': 'Jordan',
            'kz': 'Kazakhstan',
            'ke': 'Kenya',
            'ki': 'Kiribati',
            'kp': 'Korea, Democratic People\'s Rep of',
            'kr': 'Korea, Republic of',
            'kw': 'Kuwait',
            'kg': 'Kyrgyzstan',
            'la': 'Lao People\'s Democratic Republic',
            'lv': 'Latvia',
            'lb': 'Lebanon',
            'ls': 'Lesotho',
            'lr': 'Liberia',
            'ly': 'Libyan Arab Jamahiriya',
            'li': 'Liechtenstein',
            'lt': 'Lithuania',
            'lu': 'Luxembourg',
            'mo': 'Macao',
            'mk': 'Macedonia, The Frmr Yugoslav Rep of',
            'mg': 'Madagascar',
            'mw': 'Malawi',
            'my': 'Malaysia',
            'mv': 'Maldives',
            'ml': 'Mali',
            'mt': 'Malta',
            'mh': 'Marshall Islands',
            'mq': 'Martinique',
            'mr': 'Mauritania',
            'mu': 'Mauritius',
            'yt': 'Mayotte',
            'mx': 'Mexico',
            'fm': 'Micronesia, Federated States of',
            'md': 'Moldova, Republic of',
            'mc': 'Monaco',
            'mn': 'Mongolia',
            'ms': 'Montserrat',
            'ma': 'Morocco',
            'mz': 'Mozambique',
            'mm': 'Myanmar',
            'na': 'Namibia',
            'nr': 'Nauru',
            'np': 'Nepal',
            'nl': 'Netherlands',
            'an': 'Netherlands Antilles',
            'nc': 'New Caledonia',
            'nz': 'New Zealand',
            'ni': 'Nicaragua',
            'ne': 'Niger',
            'ng': 'Nigeria',
            'nu': 'Niue',
            'nf': 'Norfolk Island',
            'mp': 'Northern Mariana Islands',
            'no': 'Norway',
            'om': 'Oman',
            'pk': 'Pakistan',
            'pw': 'Palau',
            'pa': 'Panama',
            'pg': 'Papua New Guinea',
            'py': 'Paraguay',
            'pe': 'Peru',
            'ph': 'Philippines',
            'pn': 'Pitcairn',
            'pl': 'Poland',
            'pt': 'Portugal',
            'pr': 'Puerto Rico',
            'qa': 'Qatar',
            're': 'Reunion',
            'ro': 'Romania',
            'ru': 'Russian Federation',
            'rw': 'Rwanda',
            'gs': 'S. Georgia and S. Sandwich Isles.',
            'sh': 'Saint Helena',
            'kn': 'Saint Kitts and Nevis Anguilla',
            'lc': 'Saint Lucia',
            'pm': 'Saint Pierre and Miquelon',
            'vc': 'Saint Vincent and Grenadines',
            'ws': 'Samoa',
            'sm': 'San Marino',
            'st': 'Sao Tome and Principe',
            'sa': 'Saudi Arabia',
            'sn': 'Senegal',
            'sc': 'Seychelles',
            'sl': 'Sierra Leone',
            'sg': 'Singapore',
            'sk': 'Slovakia',
            'si': 'Slovenia',
            'sb': 'Solomon Islands',
            'so': 'Somalia',
            'za': 'South Africa',
            'es': 'Spain',
            'lk': 'Sri Lanka',
            'sr': 'Suriname',
            'sj': 'Svalbard and Jan Mayen',
            'sz': 'Swaziland',
            'se': 'Sweden',
            'ch': 'Switzerland',
            'tw': 'Taiwan, Province of China',
            'tj': 'Tajikistan',
            'tz': 'Tanzania, United Republic of',
            'th': 'Thailand',
            'tg': 'Togo',
            'tk': 'Tokelau',
            'to': 'Tonga',
            'tt': 'Trinidad and Tobago',
            'tn': 'Tunisia',
            'tr': 'Turkey',
            'tm': 'Turkmenistan',
            'tc': 'Turks and Caicos Islands',
            'tv': 'Tuvalu',
            'ug': 'Uganda',
            'ua': 'Ukraine',
            'ae': 'United Arab Emirates',
            'gb': 'United Kingdom',
            'um': 'United States Minor Outlying Isl',
            'uy': 'Uruguay',
            'uz': 'Uzbekistan',
            'vu': 'Vanuatu',
            've': 'Venezuela',
            'vn': 'Viet Nam',
            'vg': 'Virgin Islands, British',
            'vi': 'Virgin Islands, U.S.',
            'wf': 'Wallis and Futuna Islands',
            'eh': 'Western Sahara',
            'ye': 'Yemen',
            'yu': 'Yugoslavia',
            'zm': 'Zambia',
            'zw': 'Zimbabwe'
        },
        'educationTypes': {
            'SS' : 'School',
            'HS' : 'High School',
            'BA' : 'Graduation',
            'PG' : 'Post Graduation',
            'PHD': 'Doctorate',
            'MBA': 'MBA',
            'OTH': 'Others'
        },
        'employmentTypes': {
            1: 'Full-Time',
            2: 'Part-Time',
            3: 'Contract',
            4: 'Temporary',
            5: 'Others'
        },
        'ethnicityTypes': [
            'Decline to Designate',
            'White',
            'Black / African American',
            'Asian / Pacific Islander',
            'American Indian / Alaska Native',
            'Hispanic'
        ],
        'maritalStatus': [
            'Decline to Designate',
            'Singel',
            'Married',
            'Divorsed',
            'Widow'
        ],
        'physicalStatus': [
            'Decline to Designate',
            'Yes',
            'No'
        ],
        'castCategory': [
            'Decline to Designate',
            'General',
            'OBC- Creamy',
            'ST',
            'SC',
            'Others'
        ],
        'genderTypes': [
            'Decline to Designate',
            'Male',
            'Female'
        ],
        'maxEducationLimit': 2,
        'maxProfileLimit': 5,
        'minSkillsSearchableProfile': 5,
        'minWorkExpSearchableProfile': 1,
        'profileStatuses': {
            'searchable': 'Y',
            'notSearchable': 'N'
        },
        'veteranStatuses': [
            'Decline to Designate',
            'I am not a Veteran',
            'Special Disabled Veteran',
            'Vietnam Era Veteran',
            'Recently Separated Veteran',
            'Other Protected Veteran'
        ],
        'workAuthTypes': [
            'US Citizen',
            'Canadian Citizen',
            'Green Card Holder',
            'Need H1 Visa',
            'Have H1 Visa',
            'Employment Auth. Document',
            'TN Permit Holder'
        ]
    });
    
    diceTechPro.factory('staticDataService', ['TECHPRO_CONSTANTS', function (TECHPRO_CONSTANTS) {
        
        function getCheckList(selector,checkAll) {
            var checkValue = !!checkAll;
            var checkList = [];
            var key;
            var items = TECHPRO_CONSTANTS[selector];
            angular.forEach(items, function(value, key) {
              this.push({key:value.id , value:value.name, checked:checkValue });
            }, checkList);
            return checkList;
        }
        
        function getRadioList(selector) {
            var radioList = [];
            var key;
            var items = TECHPRO_CONSTANTS[selector];
            angular.forEach(items, function(value, key) {
              this.push({key:value.id , value:value.name, checked:false });
            }, radioList);
            return radioList;
        }
        
        function getOptionList(selector) {
            var list = [];
            var items = TECHPRO_CONSTANTS[selector];
            angular.forEach(items, function(value, key) {
              this.push(value);
            }, list);
            return list;
        }

        function getSimpleList(selector) {
            var simpleList = [],key;
            for (key in TECHPRO_CONSTANTS[selector]) {
                simpleList.push(TECHPRO_CONSTANTS[selector][key]);
            };
            return simpleList;
        }

        return {
            getCheckList: getCheckList,
            getOptionList:getOptionList,
            getSimpleList: getSimpleList,
            getRadioList: getRadioList
        };
    }]);

    diceTechPro.factory('countriesService', ['$filter', 'TECHPRO_CONSTANTS', function ($filter, TECHPRO_CONSTANTS) {
        
        function getCountryNameList() {
            var countryName = [],key;
            for (key in TECHPRO_CONSTANTS.countries) {
                countryName.push(TECHPRO_CONSTANTS.countries[key]);
            }
            return countryName;
        }
        
        function getCountryList() {
            var countryName = [],key;
            for (key in TECHPRO_CONSTANTS.countries) {
                countryName.push({'key':key, 'name':TECHPRO_CONSTANTS.countries[key]});
            }
            return countryName;
        }
        
        function getReversedCountryMapping() {
            return $filter('reverseMapping')(TECHPRO_CONSTANTS.countries);
        }

        function isRegionRequiredForCountry(countryCode) {
            if (!countryCode){
                return true;
            }else{
                var cc = countryCode.toLowerCase();
                return cc === 'in' || cc === 'ca';
            }
        }

        return {
            getCountryNameList: getCountryNameList,
            getCountryList:getCountryList,
            getReversedCountryMapping: getReversedCountryMapping,
            isRegionRequiredForCountry: isRegionRequiredForCountry
        };
    }]);

    diceUtil.factory('cookieFactory', ['$filter', function ($filter) {
        return {
            getCookie: function (sKey) {
                return decodeURIComponent(document.cookie.replace(new RegExp('(?:(?:^|.*;)\\s*' + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, '\\$&') + '\\s*\\=\\s*([^;]*).*$)|^.*$'), '$1')) || null;
            },
            setCookie: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {
                if (!sKey || /^(?:expires|max\-age|path|domain|secure)$/i.test(sKey)) { return false; }
                var sExpires = '';
                if (vEnd) {
                    switch (vEnd.constructor) {
                        case Number:
                            sExpires = vEnd === Infinity ? '; expires=Fri, 31 Dec 9999 23:59:59 GMT' : '; max-age=' + vEnd;
                            break;
                        case String:
                            sExpires = '; expires=' + vEnd;
                            break;
                        case Date:
                            sExpires = '; expires=' + vEnd.toUTCString();
                            break;
                    }
                }
                document.cookie = encodeURIComponent(sKey) + '=' + encodeURIComponent(sValue) + sExpires + (sDomain ? '; domain=' + sDomain : '') + (sPath ? '; path=' + sPath : '') + (bSecure ? '; secure' : '');
                return true;
            },
            removeCookie: function (sKey, sPath, sDomain) {
                if (!sKey || !this.hasCookie(sKey)) { return false; }
                document.cookie = encodeURIComponent(sKey) + '=; expires=Thu, 01 Jan 1970 00:00:00 GMT' + ( sDomain ? '; domain=' + sDomain : '') + ( sPath ? '; path=' + sPath : '');
                return true;
            },
            hasCookie: function (sKey) {
                return (new RegExp('(?:^|;\\s*)' + encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, '\\$&') + '\\s*\\=')).test(document.cookie);
            },
            /* optional method: you can safely remove it! */
            keys: function () {
                var aKeys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, '').split(/\s*(?:\=[^;]*)?;\s*/);
                for (var nIdx = 0; nIdx < aKeys.length; nIdx++) { aKeys[nIdx] = decodeURIComponent(aKeys[nIdx]); }
                return aKeys;
            }
        };
    }]);

    diceUtil.service('setTheoryService', [function () {
        this.isEmptyObject = function isEmptyObject(o, deep) {
            var key;
            if (typeof o !== 'object') {
                return false;
            }
            if (o === null || Object.keys(o).length === 0) {
                return true;
            }
            if (!deep) {
                return false;
            }
            if (!(o instanceof Array)) {
                for (key in o) {
                    if (!this.isEmptyObject(o[key], true)) {
                        return false;
                    }
                }
            } else {
                for (key = 0; key < o.length; key++) {
                    if (!this.isEmptyObject(o[key], true)) {
                        return false;
                    }
                }
            }
            return true;
        };

        this.diff = function getSetDifference(set1, set2, depth) {
            var diff,
                depth,
                prop,
                i;

            if (typeof set1 !== typeof set2 || typeof set1 !== 'object' || set1 === null && set2 === null) {
                return (set1 === set2) ? {} : angular.copy(set1);
            } else if (set1 === set2) {
                return {};
            }

            depth = (typeof depth !== 'number' || depth < 0) ? 0 : depth; // for full recursion, set depth to Infinity

            if (!depth) {
                if (angular.equals(set1, set2)) {
                    return {};
                }
                return angular.copy(set1);
            }

            if (!(set1 instanceof Array)) {
                diff = {};
                for (prop in set1) {
                    if (prop in set2) {
                        diff[prop] = angular.copy(this.diff(set1[prop], set2[prop], depth - 1));
                        if (typeof diff[prop] === 'object' && !(diff[prop] instanceof Array) && this.isEmptyObject(diff[prop])) {
                            delete diff[prop];
                        }
                    } else {
                        diff[prop] = angular.copy(set1[prop]);
                    }
                }
            } else {
                diff = [];
                for (i = 0; i < set1.length; i++) {
                    if (i < set2.length) {
                        diff.push(angular.copy(this.diff(set1[i], set2[i], depth - 1)));
                    } else {
                        diff.concat(set1.slice(i));
                        break;
                    }
                }
                if (this.isEmptyObject(diff, true)) {
                    return [];
                }
            }

            return diff;
        };
    }]);

    diceUtil.filter('trim', [function () {
        return function (string) {
            if (typeof string !== 'string') return string;

            if (!String.prototype.trim) return string.replace(/^\s+|\s+$/g, '');

            return string.trim();
        };
    }]);

    diceLocationServices.service('googleLocationService', ['$q', '$window', '$http', function ($q, $window, $http) {
        
        var autoCompleteService = new $window.google.maps.places.AutocompleteService();
        var geocoderService = new $window.google.maps.Geocoder();
        var mapsUrl = 'https://maps.googleapis.com/maps/api/geocode/json';
        this.getLocationPredictions = getLocationPredictions;
        this.getPostalCode = getPostalCode;
        this.getLocationByCoords = getLocationByCoords;
        this.getLocationsByAddress = getLocationsByAddress;
        this.getAddressInfoByZip = getAddressInfoByZip;
        this.getAddressInfoByCoords = getAddressInfoByCoords;
        
        function getAddressInfoByZip(zip){
            if (zip.length >= 5 && typeof google != 'undefined'){
                var addr = {};
                var request = { 'address': zip , componentRestrictions: {}};
                request.componentRestrictions.country = 'IN';
                geocoderService.geocode(request,function(results, status){
                    if (status == google.maps.GeocoderStatus.OK){
                        if (results.length >= 1) {
                            console.log(results);    
                            for (var ii = 0; ii < results[0].address_components.length; ii++){
                                var street_number,route,street,city,state,zipcode,country, formatted_address = '';
                                var types = results[0].address_components[ii].types.join(",");
                                if (types == "street_number"){
                                        addr.street_number = results[0].address_components[ii].long_name;
                                }
                                if (types == "route" || types == "point_of_interest,establishment"){
                                        addr.route = results[0].address_components[ii].long_name;
                                }
                                if (types == "sublocality,political" || types == "locality,political" || types == "neighborhood,political" || types == "administrative_area_level_3,political"){
                                        addr.city = (city == '' || types == "locality,political") ? results[0].address_components[ii].long_name : city;
                                }
                                if (types == "administrative_area_level_1,political"){
                                        addr.state = results[0].address_components[ii].short_name;
                                }
                                if (types == "postal_code" || types == "postal_code_prefix,postal_code"){
                                        addr.zipcode = results[0].address_components[ii].long_name;
                                }
                                if (types == "country,political"){
                                        addr.country = results[0].address_components[ii].long_name;
                                }
                            }
                            addr.success = true;
                            for (name in addr){
                                console.log('### google maps api ### ' + name + ': ' + addr[name]);
                            }
                            console.log(addr);    
                            //response(addr);
                        } else {
                            console.log('success:false');    
                            //response({success:false});
                        }
                    } else {
                        console.log('success:false');
                        //response({success:false});
                    }
                });
            } else {
                console.log('success:false');
                //response({success:false});
            }
        }
        
        function getLocationPredictions(request, limit) {
            var deferred = $q.defer();
            try {
                autoCompleteService.getPlacePredictions(request, callback);
            } catch (e) {
                deferred.reject();
            }
            function callback(predictions, status) {
                var locations = [];
                if (status === $window.google.maps.places.PlacesServiceStatus.OK) {
                    console.log(predictions);
                    angular.forEach(predictions, function (prediction) {
                        var terms = prediction.terms,location = terms[0].value || '';
                        if (terms[1] && terms[1].value.length === 2) {
                            location += ', ' + terms[1].value;
                        } else {
                            return;
                        }
                        locations.push(location);
                    });
                }
                deferred.resolve(locations.slice(0, (limit || location.length)));
            }
            return deferred.promise;
        }
        
        function getPostalCode(latitude, longitude) {
            return getLocationByCoords(latitude, longitude).then(function (results) {
                var resultsLength,addrComp,addrCompLength,i,j;
                if (angular.isArray(results)) {
                    resultsLength = results.length;
                    for (i = 0; i < resultsLength; i++) {
                        if (angular.isArray(results[i].address_components)) {
                            addrComp = results[i].address_components;
                            addrCompLength = addrComp.length;
                            // postal_code component is usually last entry, start from end of array
                            for (j = addrCompLength - 1; j >= 0; j--) {
                                if (addrComp[j].types.indexOf('postal_code') !== -1) {
                                    return addrComp[j].short_name;
                                }
                            }
                        }
                    }
                }
                return null;
            }, function () {
                return null;
            });
        }
        
        function getAddressInfoByCoords(latitude, longitude) {
            var locs = [];
            var latlng = new google.maps.LatLng(latitude, longitude);
            geocoderService.geocode({'location': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results.length >= 1) {
                        for(var l = 0; l < results.length; l++){
                            var result = results[l];
                            var addr = {};
                            addr.formatted_address = result.formatted_address;
                            addr.place_id=result.place_id;
                            for (var ii = 0; ii < result.address_components.length; ii++){
                                //var street_number,route,street,city,state,zipcode,country, formatted_address = '';
                                var types = result.address_components[ii].types.join(",");
                                if (types == "street_number"){
                                    addr.street_number = result.address_components[ii].long_name;
                                }
                                if (types == "route"){
                                    addr.route = result.address_components[ii].long_name;
                                }
                                if (types == "sublocality_level_2,sublocality,political"){
                                    addr.sector = result.address_components[ii].long_name;
                                }
                                if (types == "sublocality_level_1,sublocality,political"){
                                    addr.sublocality = result.address_components[ii].long_name;
                                }
                                if (types == "locality,political"){
                                    addr.city = result.address_components[ii].long_name;
                                }

                                if (types == "administrative_area_level_3,political"){
                                    addr.munciplity = result.address_components[ii].long_name;
                                }
                                if (types == "administrative_area_level_2,political"){
                                    addr.district = result.address_components[ii].long_name;
                                }
                                if (types == "administrative_area_level_1,political"){
                                    addr.state = result.address_components[ii].long_name;
                                    addr.stateCode = result.address_components[ii].short_name;
                                }
                                if (types == "country,political"){
                                    addr.country = result.address_components[ii].long_name;
                                    addr.countryCode = result.address_components[ii].short_name;
                                }
                                if (types == "postal_code" || types == "postal_code_prefix,postal_code"){
                                    addr.zipcode = result.address_components[ii].long_name;
                                }
                                //
                                if (types == "point_of_interest,establishment"){
                                    addr.point_of_interest = result.address_components[ii].long_name;
                                }
                                if (types == "neighborhood,political"){
                                    addr.neighborhood = result.address_components[ii].long_name;
                                }
                                if (types == "sublocality,political"){
                                    addr.sublocality = result.address_components[ii].long_name;
                                    addr.municipality = result.address_components[ii].long_name;
                                }
                            }
                            locs.push(addr);
                        }
                    }
                }
                return locs;
            });
        }
        
        function getLocationByCoords(latitude, longitude) {
            return getLocations({ latlng: latitude + ',' + longitude});
        }
        
        function getLocationsByAddress(address) {
            return getLocations({address: address});
        }
        
        function getLocations(params) {
            return $http({
                method: 'GET',
                url: mapsUrl,
                params: params,
                cache: true,
                headers: {
                    'Access-Control-Allow-Headers':'origin, content-type, accept',
                    'Access-Control-Allow-Origin':'*',
                    'Access-Control-Allow-Credentials':'true',
                    'If-Modified-Since':0
                }
            }).then(function (response) {
                return response.data.results;
            });
        }
        
    }]);

    diceLocationServices.service('diceLocationService', ['$q', 'geoLocationService', 'googleLocationService', 'countriesService', function ($q, geoLocationService, googleLocationService, countriesService) {
        
        var countryNameToCountryCodeMap = countriesService.getReversedCountryMapping();
        this.getLocationPredictions = getLocationPredictions;
        this.getPostalCode = getPostalCode;
        this.getLocationByCoords = getLocationByCoords;
        this.getLocationsByAddress = getLocationsByAddress;
        
        function getLocationPredictions(query, limit, options) {
            var request = {
                input: query, 
                types: ['(cities)'], 
                componentRestrictions: {}
            };
            var dgl;
            var countryCode;
            if (options) {
                angular.extend(request, options);
            }
            geoLocationService.getGeoLocation().then(function (data) {
                dgl = data;
            });
            if (!request.componentRestrictions.country && dgl && dgl.country) {
                countryCode = countryNameToCountryCodeMap[dgl.country];
                request.componentRestrictions.country = countryCode.toUpperCase() || 'IN';
            }
            return googleLocationService.getLocationPredictions(request, limit);
        }

        function getPostalCode() {
            var deferred = $q.defer();
            geoLocationService.getGeoLocation().then(function (data) {
                if (data.zip_code) {
                    deferred.resolve(data.zip_code);
                } else if (data.latitude && data.longitude) {
                    googleLocationService.getPostalCode(data.latitude, data.longitude).then(function (postalcode) {
                        deferred.resolve(postalcode);
                    });
                } else {
                    deferred.reject();
                }
            }, function () {
                deferred.reject();
            });
            return deferred.promise;
        }

        function getLocationByCoords(latitude, longitude) {
            return googleLocationService.getLocationByCoords(latitude, longitude);
        }

        function getLocationsByAddress(address) {
            return googleLocationService.getLocationByCoords(address);
        }
    }]);

    /**
     * @optional: $rootScope.ipAddress: get user's ip address from backend and populate in root scope with ngInit
     */
    diceLocationServices.service('geoLocationService', ['$rootScope', '$http', '$q', '$filter', 'DiceApiClient', 'cookieFactory', 'googleLocationService', function ($rootScope, $http, $q, $filter, DiceApiClient, cookieFactory, googleLocationService) {
        
        this.setGeoLocation = function (geoLocUpdates) {
            var dgl,prop;
            if (!geoLocUpdates) {
                return;
            }
            dgl = angular.fromJson(cookieFactory.getCookie('DGL') || '{}');
            if (typeof dgl === 'string') {
                try {
                    dgl = angular.fromJson(cookieFactory.getCookie('DGL') || '{}');
                } catch (e) {
                    dgl = {};
                }
            }
            for (prop in geoLocUpdates) {
                var cv = dgl[prop];
                var uv = $filter('trim')(geoLocUpdates[prop]);
                if(uv && uv !='') {
                    dgl[prop] = $filter('trim')(geoLocUpdates[prop]);
                }
            }
            cookieFactory.setCookie('DGL', angular.toJson(dgl), 7 * 24 * 60 * 60 * 1000, '/');
        };
        
        this.getAddressInfoByZip = function(zip){
            googleLocationService.getAddressInfoByZip(zip);
        };
        
        this.getUserLocation = function() {
            var dgl = angular.fromJson(cookieFactory.getCookie('DGL') || '{}');
            if (typeof dgl === 'string') {
                try {
                    dgl = angular.fromJson(cookieFactory.getCookie('DGL') || '{}');
                } catch (e) {
                    dgl = {};
                }
            }
            if (dgl.latitude && dgl.longitude) {
                return googleLocationService.getAddressInfoByCoords(dgl.latitude, dgl.longitude);
            }else{
                return null;
            }
        }
        
        this.getGeoDetails = function () {
            var dgl = angular.fromJson(cookieFactory.getCookie('_ogl') || '{}');
            if (typeof dgl === 'string') {
                try {
                    dgl = angular.fromJson(cookieFactory.getCookie('_ogl') || '{}');
                } catch (e) {
                    dgl = {};
                }
            }
            return dgl 
        }
        /*
        * 
        */
        this.getGeoLocation = function () {
            var deferred = $q.defer(),dgl = angular.fromJson(cookieFactory.getCookie('DGL') || '{}');
            if (typeof dgl === 'string') {
                try {
                    dgl = angular.fromJson(cookieFactory.getCookie('DGL') || '{}');
                } catch (e) {
                    dgl = {};
                }
            }
            function processGeoLocation(dgl) {
                if (!dgl.zipCode && dgl.latitude && dgl.longitude) {
                    googleLocationService.getPostalCode(dgl.latitude, dgl.longitude).then(function (postalcode) {
                        dgl.zipCode = postalcode;
                        cookieFactory.setCookie('DGL', angular.toJson(dgl), 7 * 24 * 60 * 60 * 1000, '/');
                        deferred.resolve(dgl);
                    }, function () {
                        cookieFactory.setCookie('DGL', angular.toJson(dgl), 7 * 24 * 60 * 60 * 1000, '/');
                        deferred.resolve(dgl);
                    });
                } else {
                    deferred.resolve(dgl);
                }
            }
            if (dgl) {
                processGeoLocation(dgl);
            } else if (!/bot|googlebot|crawler|spider|robot|crawling|Yahoo!|Preview|Slurp/i.test(navigator.userAgent)) {
                if ($rootScope.ipAddress) {
                    DiceApiClient({
                        method: 'GET',
                        router:'onclickLocationRouter',
                        path: '/locations/searches?ipAddress='+encodeURIComponent($rootScope.ipAddress),
                        cache: true
                    }).then(function (response) {
                        var dgl;
                        if (response.data && response.data.items && response.data.items.length > 0) {
                            dgl = response.data.items[0];
                            cookieFactory.setCookie('DGL', angular.toJson(dgl), 7 * 24 * 60 * 60 * 1000, '/');
                            processGeoLocation(dgl);
                        }
                    });
                }
            }
            return deferred.promise;
        };
        this.getLocationByCoords = function(latitude, longitude) {
            return googleLocationService.getLocationByCoords(latitude, longitude);
        };
    }]);

    /**
     * @attribute: diceGeoLocation: target geo location property to retrieve for input value; default to formatted location (eg. City, ST)
     * @attribute: diceGeoLocationUpdateOnBlur: if present (and not set to false), will update the target property of the geo location cookie with input value
     * @attribute: diceGeoLocationTriggerInitialViewChange: when true, trigger view change event if it is autofilled
     */
    diceLocationServices.directive('diceGeoLocation', ['$parse', '$timeout', 'geoLocationService', 'diceRegex', function ($parse, $timeout, geoLocationService, diceRegex) {
        return {
            restrict: 'A',
            require: '?ngModel',
            link: function (scope, element, attributes, ngModel) {
                var targetProperty = attributes.diceGeoLocation;
                var triggerOnInitialChange = attributes.diceGeoLocationTriggerInitialViewChange;
                geoLocationService.getGeoLocation().then(function (data) {
                    var location;
                    var inputValue = ngModel.$modelValue;
                    var _eval = element.val();
                    if (ngModel ? inputValue === "" : !_eval) {
                        switch (targetProperty){
                            case 'latitude':
                                location = data.latitude;
                                break;
                            case 'longitude':
                                location = data.longitude;
                                break;
                            case 'zipcode':
                                var result =  diceRegex.postalCode.test(inputValue);
                                location = data.zipcode;
                                break;
                            case 'location':
                                location = data.location;
                                var parts = data.location ? data.location.split(',') : [];
                                if (parts.length > 0) {
                                    location.city = parts[0];
                                } else {
                                    location.city = '';
                                }
                                if (parts.length > 1 && parts[1].length === 2) {
                                    location.stateCode = parts[1].toUpperCase();
                                } else {
                                    location.stateCode = '';
                                }
                                break;    
                            case 'country':
                                location = data.country;
                                break;
                            default :
                                location = data[targetProperty];
                                break;
                        }
                    }else{
                        location = inputValue;
                    }
                    
                    if (ngModel) {
                        if (angular.isDefined(triggerOnInitialChange) && scope.$eval(triggerOnInitialChange) !== false) {
                            ngModel.$setViewValue(location);
                            ngModel.$render();
                        } else {
                            $parse(attributes.ngModel).assign(scope, location);
                        }
                    } else {
                        $timeout(function () {
                            element.val(location);
                        }, 0);
                    }
                });

                // update the geo location on blur if diceGeoLocationUpdateOnBlur is defined and not set to false
                if (angular.isDefined(attributes.diceGeoLocationUpdateOnBlur) && scope.$eval(attributes.diceGeoLocationUpdateOnBlur) !== false) {
                    element.on('blur', updateGeoLocation);
                }

                // update the geo location on form submit, unless diceGeoLocationUpdateOnFormSubmit is set to false
                if (scope.$eval(attributes.diceGeoLocationUpdateOnFormSubmit) !== false) {
                    angular.element(element[0].form).on('submit', updateGeoLocation);
                    scope.$on('$destroy', function () {
                        angular.element(element[0].form).off('submit', updateGeoLocation);
                    });
                }

                function updateGeoLocation() {
                    var value = ngModel ? ngModel.$modelValue : element.val(),newGeoLoc = {},parts;
                    parts = value ? value.split(',') : [];
                    if(parts.length != 0){
                        newGeoLoc[targetProperty] = value;
                        if(parts.length > 1){
                            if(targetProperty === 'location'){
                                newGeoLoc.city = parts[0];
                                newGeoLoc.stateCode = parts[1].toUpperCase();
                            }else{
                                newGeoLoc.city = '';
                                newGeoLoc.stateCode = '';
                            }
                        }
                        geoLocationService.setGeoLocation(newGeoLoc);
                    }
                }
            }
        };
    }]);

    diceLocationServices.controller('locationTypeAheadController',['$scope', 'diceLocationService', function ($scope, diceLocationService) {
        $scope.getLocations = diceLocationService.getLocationPredictions;
    }]);

    diceTechPro.filter('toTrustedHTML', ['$sce', function ($sce) {
        return function toTrustedHTML(text) {
            return $sce.trustAsHtml(text);
        };
    }]);
    
    diceTechPro.constant('onclickRouters',{
        accountSettingRouter:{
            service:'settings', 
            router:'/onclickresume/rest/account-setting-router.php'
        },
        commonServiceRouter:{
            service:'settings', 
            router:'/onclickresume/rest/common-service-router.php'
        },
        documentServiceRouter:{
            service:'document', 
            router:'/onclickresume/rest/document-service-router.php'
        },
        onclickProfileRouter:{
            service:'profile', 
            router:'/onclickresume/rest/profile-service-router.php'
        },
        onclickSeekerRouter:{
            service:'seeker',  
            router:'/onclickresume/rest/seeker-service-router.php'
        },
        employerProfileRouter:{
            service:'employer', 
            router:'/onclickresume/rest/employerprofile-router.php'
        },
        employerActionRouter:{
            service:'employer', 
            router:'/onclickresume/rest/employeraction-router.php'
        },
        employerDetailRouter:{
            service:'employer', 
            router:'/onclickresume/rest/employerdetails-router.php'
        },
        employerSearchRouter:{
            service:'employer', 
            router:'/onclickresume/rest/employersearch-router.php'
        },
        onclickAccountRouter:{
            service:'account',  
            router:'/onclickresume/rest/account-service-router.php'
        },
        onclickLocationRouter:{
            service:'locations',  
            router:'/onclickresume/rest/location-service-router.php'
        },
        onclickReportRouter:{
            service:'report',  
            router:'/onclickresume/rest/reports-service-router.php'
        },
        onclickTimeoutRouter:{
            service:'timeout', 
            router:'/config/dice/api/timeout.json'
        },
    });
    //diceTechPro.constant('onclickProfileRouter', '/onclickresume/rest/profile-service-router.php');
    diceTechPro.constant('onclickSeekerRouter', '/onclickresume/rest/profile-service-router.php');
    diceTechPro.constant('diceApiTimeoutClientPath', '/config/dice/api/timeout.json?path=');
    
    diceTechPro.factory('DiceApiClient', ['$http', 'onclickRouters', 'diceApiTimeoutClientPath', function ($http, onclickRouters, diceApiTimeoutClientPath) {
        var DiceApiClient = function (config, timeout) {
            var queryStringPairs = [],keys,value,i;
            /*
            if (angular.isObject(config.params)) {
                keys = Object.keys(config.params);
                if (keys.length > 0) {
                    for (i = 0; i < keys.length; i++) {
                        value = config.params[keys[i]];
                        queryStringPairs.push(encodeURIComponent(keys[0]) + '=' + encodeURIComponent(typeof value === 'string' ? value : angular.toJson()));
                    }
                    config.path += config.path.indexOf('?') === -1 ? '?' : '&';
                    config.path += queryStringPairs.join('&');
                }
            }
            */
            if (timeout) {
                config.path += (config.path.indexOf('?') === -1 ? '?' : '&') + 'timeout=' + encodeURIComponent(timeout);
            }
            //config.url = onclickProfileRouter + encodeURIComponent(config.path);
            var serviceRouter = onclickRouters[config.router];
            config.url = serviceRouter['router'] + config.path;
            delete config.path;
            return $http(config);
        };
        return DiceApiClient;
    }]);
    
    diceTechPro.factory('OnclickReportClient', ['DiceApiClient', function (DiceApiClient) {
        var OnclickReportClient = {};
        OnclickReportClient.getReport = function (name,userid,params) {
            return DiceApiClient({
                method: 'GET',
                router:'onclickReportRouter',
                path:'/reports/'+name+'/'+userid,
                params:params,
                cache:false
            });
        };
        return OnclickReportClient;
    }]);

    diceTechPro.factory('ProfilesApiClient', ['DiceApiClient', function (DiceApiClient) {
        var ProfilesApiClient = {};
        var profilesPath = '/profiles';
        var seekerPath = '/seeker';
        
        ProfilesApiClient.getEmployerProfile = function (peopleId,params) {
            return DiceApiClient({
                method: 'GET',
                router:'employerProfileRouter',
                path: '/employer/profile/'+peopleId,
                params:params,
                cache:false
            });
        };
        
        ProfilesApiClient.getAssociates = function (peopleId,params) {
            return DiceApiClient({
                method: 'GET',
                router:'employerProfileRouter',
                path: '/employer/associates?sTgt=site',
                params:params,
                cache:false
            });
        };
        
        ProfilesApiClient.getProfile = function (peopleId,profileId, params) {
            return DiceApiClient({
                method: 'GET',
                router:'onclickProfileRouter',
                path: profilesPath +'/'+profileId,
                //path: '/seeker/fulldetail/'+peopleId,
                params:params,
                cache:false
            });
        };
        
        ProfilesApiClient.getProfiles = function (peopleId, params) {
            return DiceApiClient({
                method: 'GET',
                router:'onclickProfileRouter',
                path: profilesPath + '?peopleId='+peopleId,
                params: params,
                cache: false
            });
        };
        
        ProfilesApiClient.post = function (profileData, timeout) {
            return DiceApiClient({
                method: 'POST',
                router:'onclickProfileRouter',
                path: profilesPath,
                cache: false,
                data: profileData,
                headers: {
                    'Content-Type': 'application/json'
                }
            }, timeout);
        };
        
        ProfilesApiClient.put = function (profileId, profileData, timeout) {
            return DiceApiClient({
                method: 'PUT',
                router:'onclickProfileRouter',
                path: profilesPath + '/' + profileId,
                cache: false,
                data: profileData,
                headers: {
                    'Content-Type': 'application/json'
                }
            }, timeout);
        };
        ProfilesApiClient.delete = function (profileId, peopleId) {
            return DiceApiClient({
                method: 'DELETE',
                router:'onclickProfileRouter',
                path: profilesPath + '/' + profileId + '?peopleId=' + peopleId,
                cache: false
            });
        };
        return ProfilesApiClient;
    }]);

    diceTechPro.factory('PeopleApiClient', ['DiceApiClient', function (DiceApiClient) {
        var PeopleApiClient = {},
            peoplePath = '/account',
            settingPath = '/seeker/{seekerId}/settings',
            coverLettersPath = '/seeker/{seekerId}/coverLetters',
            savedJobsPath = '/seeker/{seekerId}/savedJobs',
            appliedJobsPath = '/seeker/{seekerId}/applications',
            jobAlertsPath = '/seeker/{seekerId}/jobAlerts';

        // People API
        PeopleApiClient.getSeeker = function (seekerId) {
            return DiceApiClient({
                method: 'GET',
                router:'onclickSeekerRouter',
                path: settingPath.replace('{seekerId}', seekerId),
                cache: false
            });
        };

        PeopleApiClient.saveSeeker = function (seekerData, seekerId) {
            return DiceApiClient({
                method: seekerId ? 'PUT' : 'POST',
                router:'onclickSeekerRouter',
                path: '/seeker'+(seekerId ? '/' + seekerId : ''),
                cache: false,
                data: seekerData,
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        };

        // Cover Letters API
        PeopleApiClient.getCoverLetters = function (seekerId, coverLetterId) {
            return DiceApiClient({
                method: 'GET',
                router:'onclickProfileRouter',
                path: coverLettersPath.replace('{seekerId}', seekerId),
                cache: false
            });
        };

        PeopleApiClient.getCoverLetter = function (seekerId, coverLetterId) {
            return DiceApiClient({
                method: 'GET',
                router:'onclickProfileRouter',
                path: coverLettersPath.replace('{seekerId}', seekerId) + (coverLetterId ? '/' + coverLetterId : ''),
                cache: false
            });
        };

        PeopleApiClient.putCoverLetter = function (seekerId, coverLetterId, coverLetterData) {
            return DiceApiClient({
                method: 'PUT',
                router:'onclickProfileRouter',
                path: coverLettersPath.replace('{seekerId}', seekerId) + '/' + coverLetterId,
                cache: false,
                data: coverLetterData,
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        };

        PeopleApiClient.postCoverLetter = function (seekerId, coverLetterData) {
            return DiceApiClient({
                method: 'POST',
                router:'onclickProfileRouter',
                path: coverLettersPath.replace('{seekerId}', seekerId) + '/' + coverLetterId,
                cache: false,
                data: coverLetterData,
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        };

        // Saved Jobs API
        PeopleApiClient.getSavedJob = function (seekerId, jobId) {
            return DiceApiClient({
                method: 'GET',
                router:'onclickSeekerRouter',
                path: savedJobsPath.replace('{seekerId}', seekerId) + '/' + jobId,
                cache: false
            });
        };

        PeopleApiClient.getSavedJobs = function (seekerId, includeExpiredJobs) {
            return DiceApiClient({
                method: 'GET',
                router:'onclickSeekerRouter',
                path: savedJobsPath.replace('{seekerId}', seekerId) + (includeExpiredJobs ? '?includeExpired=true' : ''),
                cache: false
            });
        };

        PeopleApiClient.postSavedJobs = function (seekerId, jobData, isMultipleJobs) {
            return DiceApiClient({
                method: 'POST',
                router:'onclickSeekerRouter',
                path: savedJobsPath.replace('{seekerId}', seekerId) + (isMultipleJobs ? '?multipleJobs=true' : ''),
                cache: false,
                data: jobData,
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        };

        PeopleApiClient.deleteSavedJobs = function (seekerId, jobIdList) {
            return DiceApiClient({
                method: 'DELETE',
                router:'onclickSeekerRouter',
                path: savedJobsPath.replace('{seekerId}', seekerId) + '?jobIdList=' + (angular.isArray(jobIdList) ? jobIdList.join(',') : jobIdList),
                cache: false
            });
        };

        // Applications - Applied Jobs API
        PeopleApiClient.getAppliedJobs = function (seekerId, includeExpiredJobs) {
            return DiceApiClient({
                method: 'GET',
                router:'onclickSeekerRouter',
                path: appliedJobsPath.replace('{seekerId}', seekerId) + (includeExpiredJobs ? '?includeExpired=true' : ''),
                cache: false
            });
        };

        // Job Alerts API
        PeopleApiClient.getJobAlerts = function (seekerId, alertId) {
            return DiceApiClient({
                method: 'GET',
                router:'onclickSeekerRouter',
                path: jobAlertsPath.replace('{seekerId}', seekerId) + (alertId ? '/' + alertId : ''),
                cache: false
            });
        };

        PeopleApiClient.postJobAlert = function (alertData, seekerId) {
            return DiceApiClient({
                method: 'POST',
                router:'onclickSeekerRouter',
                path: jobAlertsPath.replace('/{seekerId}', (seekerId ? '/' + seekerId : '')),
                cache: false,
                data: alertData,
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        };

        PeopleApiClient.putJobAlert = function (seekerId, alertId, alertData) {
            return DiceApiClient({
                method: 'PUT',
                router:'onclickSeekerRouter',
                path: jobAlertsPath.replace('{seekerId}', seekerId) + '/' + alertId,
                cache: false,
                data: alertData,
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        };

        PeopleApiClient.deleteJobAlert = function (seekerId, alertId) {
            return DiceApiClient({
                method: 'DELETE',
                router:'onclickSeekerRouter',
                path: jobAlertsPath.replace('{seekerId}', seekerId) + '/' + alertId,
                cache: false
            });
        };

        PeopleApiClient.sendJobAlert = function (seekerId, alertId) {
            return DiceApiClient({
                method: 'GET',
                router:'onclickSeekerRouter',
                path: jobAlertsPath.replace('{seekerId}', seekerId) + '/' + alertId + '/results?send=email',
                cache: false
            });
        };

        return PeopleApiClient;
    }]);

    diceTechPro.factory('CaptchaFactory', ['$q', 'DiceApiClient', function ($q, DiceApiClient) {
        function regexEscape(s) {
            return s.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
        }
        return {
            getCaptchaPromise: function () {
                var deferred = $q.defer();
                DiceApiClient({
                    method: 'GET',
                    router:'onclickProfileRouter',
                    path: '/captchas',
                    cache: false
                }).success(function (data, status, headers, config) {
                        var captcha,answer;
                        try {
                            answer = data.answers.map(function (currentValue) {
                                return regexEscape(currentValue);
                            }).join('|');
                            captcha = {
                                isTurnedOn: true,
                                value1: data.value1,
                                value2: data.value2,
                                answer: new RegExp('^' + answer + '$')
                            };
                        } catch (e) {
                            captcha = {
                                isTurnedOn: false,
                                value1: '',
                                value2: '',
                                answer: new RegExp('^' + regexEscape('') + '$')
                            };
                        }
                        deferred.resolve(captcha);
                    }).error(function (data, status, headers, config) {
                        var captcha = {
                            isTurnedOn: false,
                            comment: '',
                            value1: '',
                            value2: '',
                            answer: new RegExp('^' + regexEscape('') + '$')
                        };
                        deferred.resolve(captcha);
                    });
                return deferred.promise;
            }
        };
    }]);

    diceTechPro.directive('diceBlurTracker', [function () {
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function (scope, element, attributes, controller) {
                controller.diceBlurred = false;
                element.on('blur', function () {
                    scope.$apply(function () {
                        controller.diceBlurred = true;
                    });
                });

            }
        };
    }]);

    diceTechPro.directive('diceValidAndUniqueEmail', ['$compile', '$q', '$timeout', 'DiceApiClient', function ($compile, $q, $timeout, DiceApiClient) {
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function (scope, element, attributes, controller) {
                var APIRequestPromise, wasEmpty, hasBlurred, hasSubmitted;

                function isInputTypeEmailSupport() {
                    var i = document.createElement('input');
                    i.setAttribute('type', 'email');
                    return i.type !== 'text';
                }

                function isUniqueEmailCheckRequest(email) {
                    var deferred = $q.defer();

                    DiceApiClient({
                        method: 'GET',
                        path: '/people/id?username=' + encodeURIComponent(email),
                        cache: true
                    }).success(function (data, status, headers, config) {
                            deferred.resolve(false);
                    }).error(function (data, status, headers, config) {
                            deferred.resolve(true);
                    });

                    return deferred.promise;
                }

                function isValidEmailCheckRequest(email) {
                    var deferred = $q.defer();

                    DiceApiClient({
                        method: 'GET',
                        path: '/validations/email/' + email,
                        cache: true
                    })
                        .success(function (data, status, headers, config) {
                            var isValid = false;
                            try {
                                isValid = data.messages[0].code === '200000';
                            } catch (ignore) {}

                            deferred.resolve(isValid);
                        })
                        .error(function (data, status, headers, config) {
                            deferred.resolve(false);
                        });

                    return deferred.promise;
                }

                if (!isInputTypeEmailSupport() && !('ngPattern' in attributes)) {
                    (function addNgPatternForPassword() {
                        var clone, compiled;
                        clone = element.clone();
                        clone.attr('data-ng-pattern', /^[^@]+@[^.@]+(?:\.[^.@])*\.[^.@]{2,6}$/);
                        compiled = $compile(clone);
                        element.replaceWith(clone);
                        compiled(scope);
                    }());
                }

                wasEmpty = controller.$isEmpty(scope.$eval(attributes.ngModel));
                hasBlurred = false;
                hasSubmitted = false;
                controller.diceValidityChecked = false;

                element.on('focus', function () {
                    controller.diceValidityChecked = true;
                });

                element.on('blur', function () {
                    hasBlurred = true;
                });

                angular.element(element[0].form).on('submit', function () {
                    hasSubmitted = true;
                });

                scope.$on('$destroy', function () {
                    angular.element(element[0].form).off('submit', function () {
                        hasSubmitted = true;
                    });
                });

                scope.$watch(function () {
                    var email = scope.$eval(attributes.ngModel);
                    return email;

                }, function (email, oldEmail) {
                    var isEmpty = controller.$isEmpty(email);

                    if (APIRequestPromise) {
                        $timeout.cancel(APIRequestPromise);
                        APIRequestPromise = null;
                    }

                    if (!(hasBlurred || hasSubmitted)) {
                        controller.diceValidityChecked = false;
                    }

                    if (isEmpty) {
                        wasEmpty = true;
                        controller.$setValidity('diceValidEmail', true);
                        controller.$setValidity('diceUniqueEmail', true);

                    } else if (wasEmpty) {
                        wasEmpty = false;
                        controller.$setValidity('diceValidEmail', false);
                        controller.$setValidity('diceUniqueEmail', false);
                    }

                    APIRequestPromise = $timeout(function () {

                        if (isEmpty) {
                            if (controller.$dirty) {
                                controller.diceValidityChecked = true;
                            }
                            return;
                        }

                        $q.all([
                            isValidEmailCheckRequest(email),
                            isUniqueEmailCheckRequest(email)
                        ]).then(function (data) {
                            controller.$setValidity('diceValidEmail', data[0]);
                            controller.$setValidity('diceUniqueEmail', data[1]);
                            controller.diceValidityChecked = true;
                        });
                    }, 1000);
                });
            }
        };
    }]);

    /**
     *  @required: dicePasswordMatch (attribute) - ngModel/scope variable against which to match input
     */
    diceTechPro.directive('dicePasswordMatch', [function () {
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function (scope, element, attributes, controller) {
                function passwordsToMatch() {
                    return {
                        thisPassword: scope.$eval(attributes.ngModel),
                        passwordToMatch: scope.$eval(attributes.dicePasswordMatch)
                    };
                }
                scope.$watch(passwordsToMatch, function (passwords) {
                    controller.$setValidity('dicePasswordMatch', controller.$isEmpty(scope.$eval(attributes.ngModel)) || passwords.thisPassword === passwords.passwordToMatch);
                }, true);
            }
        };
    }]);

    /**
     *  @optional: diceIsCaptchaTurnedOn (attribute) - name of variable to pass to parent scope. This variable indicates if CAPTCHA has errored-out or is turned on.
     */
    diceTechPro.directive('diceCaptcha', ['CaptchaFactory', function (CaptchaFactory) {
        return {
            restrict: 'E',
            transclude: true,
            replace: true,
            template: '<span>' +
                          '<span class="captcha-message">' +
                              '<img data-ng-src="data:image/gif;base64,{{ captcha.value1 }}" alt="">' +
                              '+' +
                              '<img data-ng-src="data:image/gif;base64,{{ captcha.value2 }}" alt="">' +
                              '=' +
                          '</span>' +
                          '<span data-ng-transclude></span>' +
                      '</span>',
            scope: true,
            controller: ['$scope', function ($scope) {
                return {
                    updateCaptcha: function () {
                        return CaptchaFactory.getCaptchaPromise().then(function (captcha) {
                            $scope.captcha = captcha;
                        });
                    },
                    getCaptcha: function () {
                        if (!$scope.captcha) {
                            return {
                                isTurnedOn: false,
                                value1: '',
                                value2: '',
                                answer: /^$/
                            };
                        } else {
                            return $scope.captcha;
                        }
                    }
                };
            }],
            controllerAs: 'captchaController',
            link: function (scope, element, attributes, controller) {
                scope.captcha = {
                    isTurnedOn: false,
                    value1: '',
                    value2: '',
                    answer: /^$/
                };
                if (attributes.diceIsCaptchaTurnedOn) {
                    scope.$watch(function () {
                        return scope.captcha.isTurnedOn;
                    }, function (isCaptchaTurnedOn) {
                        scope.$parent[attributes.diceIsCaptchaTurnedOn] = isCaptchaTurnedOn;
                    });
                }
                controller.updateCaptcha();
            }
        };
    }]);

    diceTechPro.directive('diceCaptchaInput', [function () {
        return {
            restrict: 'A',
            require: [ 'ngModel', '^diceCaptcha' ],
            link: function (scope, element, attributes, controllers) {
                var wasEmpty = controllers[0].$isEmpty(scope.$eval(attributes.ngModel));

                function getGuess() {
                    return scope.$eval(attributes.ngModel);
                }

                function captchaGuardAction(guess) {
                    var answer = controllers[1].getCaptcha().answer,
                        isEmpty = controllers[0].$isEmpty(guess),
                        isCorrectAnswer = answer.test(guess),
                        wasAlreadyCorrect = !controllers[0].$error.diceCaptcha,
                        isValid = isEmpty || (isCorrectAnswer && wasAlreadyCorrect && !wasEmpty);

                    scope.$parent[attributes.ngModel] = guess;
                    controllers[0].$setValidity('diceCaptcha', isValid);
                }

                function checkCaptchaAnswer() {
                    var guess = scope.$eval(attributes.ngModel),
                        answer = controllers[1].getCaptcha().answer,
                        isEmpty = controllers[0].$isEmpty(guess),
                        isCorrectAnswer = answer.test(guess),
                        isValid = isEmpty || isCorrectAnswer;

                    if (!isValid) {
                        controllers[1].updateCaptcha();
                    }

                    controllers[0].$setValidity('diceCaptcha', isValid);
                }

                scope.$watch(getGuess, captchaGuardAction);
                element.on('blur', function () {
                    scope.$apply(checkCaptchaAnswer);
                });
                angular.element(element[0].form).on('submit', function () {
                    scope.$apply(checkCaptchaAnswer);
                });

                scope.$on('$destroy', function () {
                    angular.element(element[0].form).off('submit', function () {
                        scope.$apply(checkCaptchaAnswer);
                    });
                });
            }
        };
    }]);

    diceTechPro.service('validContactLocationService', validContactLocationService);
    validContactLocationService.$inject = ['$rootScope', 'httpRequestEvents'];
    function validContactLocationService($rootScope, httpRequestEvents) {
        var deregisterProfileSaveSuccessListener,
            deregisterProfileSaveFailListener,
            isValidLoc;

        function isProfileSaveRequest(config) {
            return (/PUT|POST/i.test(config.method) &&
                        /\/profiles/i.test(decodeURIComponent(config.url)));
        }

        function handleSuccess(e, response) {
            if (isProfileSaveRequest(response.config)) {
                isValidLoc = true;
                $rootScope.$emit('ContactLocationPassedValidation');
            }
        }

        function handleError(e, response) {
            var errorMessages,
                i;
            if (isProfileSaveRequest(response.config) && response.status === 400) {
                errorMessages = response.data.messages || response.data.message.messages;
                for (i = 0; i < errorMessages.length; i++) {
                    if (errorMessages[i].code === '400189') {
                        isValidLoc = false;
                        $rootScope.$emit('ContactLocationFailedValidation');
                        break;
                    }
                }
            }
        }

        function isValidLocation() {
            return isValidLoc;
        }

        deregisterProfileSaveSuccessListener = $rootScope.$on(httpRequestEvents.requestComplete, handleSuccess);
        deregisterProfileSaveFailListener = $rootScope.$on(httpRequestEvents.requestError, handleError);

        isValidLoc = true;

        this.isValidLocation = isValidLocation;
    }

    diceTechPro.directive('diceLocationValidator', diceLocationValidator);
    diceLocationValidator.$inject = ['$rootScope', 'validContactLocationService'];
    function diceLocationValidator($rootScope, validContactLocationService) {
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function (scope, elem, attrs, ctrl) {
                var deregisterProfileSaveSuccessListener,deregisterProfileSaveFailListener;
                function handleSuccess(e, response) {
                    ctrl.$setValidity('diceValidLocation', true);
                }
                function handleError(e, response) {
                    ctrl.$setValidity('diceValidLocation', false);
                }
                deregisterProfileSaveSuccessListener = $rootScope.$on('ContactLocationPassedValidation', handleSuccess);
                deregisterProfileSaveFailListener = $rootScope.$on('ContactLocationFailedValidation', handleError);
                ctrl.$setValidity('diceValidLocation', validContactLocationService.isValidLocation());
                scope.$on('$destroy', function () {
                    deregisterProfileSaveSuccessListener();
                    deregisterProfileSaveFailListener();
                });
            }
        };
    }

    diceUtil.filter('reverseMapping', [function () {
        return function (input) {
            var output = {},key,i;
            try {
                for (key in input) {
                    if (input.hasOwnProperty(key)) {
                        output[input[key]] = key;
                    }
                }
                return output;
            } catch (e) {
                return input;
            }
        };
    }]);

    diceUtil.filter('toArray', [function () {
        return function (input, keyLabel, valueLabel) {
            var output = [],item,key;
            keyLabel = keyLabel || 'key';
            valueLabel = valueLabel || 'value';
            try {
                for (key in input) {
                    item = {};
                    item[keyLabel] = key;
                    item[valueLabel] = input[key];
                    output.push(item);
                }
            } catch (e) {
                return input;
            }
            return output;
        };
    }]);

    diceUtil.filter('extractDigits', [function () {
        return function (input) {
            input = input ? input.replace(/\D/g, '') : '';
            return input;
        };
    }]);

    diceUtil.filter('formattedPhoneNumber', ['$filter', function ($filter) {
        return function (input) {
            /*
            var output = $filter('extractDigits')(input);
            if (output.length === 10) {
                return '(' + output.slice(0, 3) + ') ' + output.slice(3, 6) + '-' + output.slice(6, 10);
            }
            */
            return input;
        }
    }]);

    diceUtil.filter('formattedLocation', [function () {
        return function (location) {
            var output = '';
            if (!location) return output;
            if (location.municipality || location.city) {
                output += location.municipality || location.city;
            }
            if (location.region) {
                if (output) output += ', ';
                output += location.region;
            }
            return output;
        }
    }]);

    diceUtil.directive('dicePhoneInput', [function () {
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function (scope, element, attributes, controller) {
                controller.$parsers.push(function (input) {
                    var transformedInput, numDigits;
                    if (!input) { 
                        return input; 
                    }
                    /*
                    if (/^\d*$/.test(input)) {
                        transformedInput = input.slice(0, 14);
                    }
                    */
                    if (/((\+?)((0[ -]+)*|(91 )*)(\d{12}|\d{10}))|\d{5}([- ]*)\d{6}/.test(input)) {
                        transformedInput = input;
                    } else {
                        transformedInput = input.replace(/[^\d ()-.]/g, '');
                        numDigits = transformedInput.replace(/\D/g, '').length;
                        if (numDigits >= 10) {
                            transformedInput = transformedInput.slice(0, transformedInput.search(/\d\D*$/) + (numDigits === 10 ? 1 : 0));
                        }
                    }
                    if (transformedInput !== input) {
                        controller.$setViewValue(transformedInput);
                        controller.$render();
                    }
                    return transformedInput;
                });
            }
        };
    }]);

    diceUtil.directive('dicePostalCodeInput', [function () {
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function (scope, element, attributes, controller) {
                controller.$parsers.push(function (input) {
                    var transformedInput,
                        numDigits;

                    if (!input) { return input; }

                    transformedInput = input.replace(/^[-\s]|[^ A-Za-z0-9-]/g, '').
                                             replace(/\s[\s-]+/g, ' ').
                                             replace(/-[-\s]+/g, '-').
                                             toUpperCase();

                    if (transformedInput !== input) {
                        controller.$setViewValue(transformedInput);
                        controller.$render();
                    }

                    return transformedInput;
                });
            }
        };
    }]);
    
    diceTechPro.directive('ngMatch', ['$parse', function ($parse) {

        var directive = {
            link: link,
            restrict: 'A',
            require: '?ngModel'
        };
        
        return directive;
        function link(scope, elem, attrs, ctrl) {
            // if ngModel is not defined, we don't need to do anything
            if (!ctrl) return;
            if (!attrs['ngMatch']) return;
            var firstPassword = $parse(attrs['ngMatch']);
            var validator = function (value) {
                var temp = firstPassword(scope),v = value === temp;
                ctrl.$setValidity('match', v);
                return value;
            }

            ctrl.$parsers.unshift(validator);
            ctrl.$formatters.push(validator);
            attrs.$observe('ngMatch', function () {
                validator(ctrl.$viewValue);
            });
        }
    }]);

    diceTechPro.directive('onclickFileReader', ['$parse', '$filter', 'fileReader', function ($parse, $filter, fileReader) {
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function (scope, element, attributes, controller) {
                var fileModelAssign = $parse(attributes.fileModel).assign,
                    maxFileUploadSize = parseFloat(attributes.maxFileUploadSize, 10) || 512000,
                    fileRegexp = attributes.supportedFileExtensionPattern,
                    fileReadCallback = $parse(attributes.fileReadCallback),
                    regex,
                    matches;

                function uploadFile() {
                    var file;
                    if (fileReader.isSupported) {
                        file = element[0].files[0];
                        if (file) {
                            if (fileRegexp && !fileRegexp.test(file.name)) {
                                //$scope.errorMessage = $scope.unsupportedFileFormatErrorMessage;
                                controller.$setValidity('diceFileFormat', false);
                            } else if (file.size > maxFileUploadSize) {
                                //$scope.errorMessage = $scope.maxFileUploadSizeExceededErrorMessage;
                                controller.$setValidity('diceMaxFileUploadSize', false);
                            } else {
                                fileReader.readAsDataURL(file, scope).then(function (dataUrl) {
                                    file.data = dataUrl.match(/,(.*)$/)[1];
                                    fileModelAssign(scope, file);
                                    fileReadCallback(scope);
                                });
                            }
                        }
                    }
                }

                try {
                    regex = scope.$eval(fileRegexp);
                } catch (ignore) {}

                if (regex instanceof RegExp) {
                    fileRegexp = regex;
                } else if (angular.isString(fileRegexp) && fileRegexp.length > 0) {
                    matches = fileRegexp.match(/^\/(.*)\/([gimy]*)$/);
                    if (matches) {
                        fileRegexp = new RegExp(matches[1] || '', matches[2] || '');
                    } else {
                        fileRegexp = new RegExp(fileRegexp);
                    }
                }

                if (fileRegexp && !fileRegexp.test) {
                    throw angular.$$minErr('diceFileUpload')('noregeexp',
                        'Expected {0} to be a RegExp but was {1}. Element: {2}',
                        attributes.supportedFileExtPattern,
                        fileRegexp, $filter('startingTag')(element));
                }

                element.on('change', uploadFile);
            }
        };
    }]);

    diceTechPro.directive('diceModel', ['$filter', '$parse', function ($filter, $parse) {
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function (scope, element, attributes, controller) {
                var filter = attributes.diceModelFilter,
                    regexp = attributes.diceModelPattern,
                    diceModelAssign = $parse(attributes.diceModel).assign,
                    regex,
                    matches;

                try {
                    regex = scope.$eval(regexp);
                } catch (ignore) {}

                if (regex instanceof RegExp) {
                    regexp = regex;
                } else if (angular.isString(regexp) && regexp.length > 0) {
                    matches = regexp.match(/^\/(.*)\/([gimy]*)$/);
                    if (matches) {
                        regexp = new RegExp(matches[1] || '', matches[2] || '');
                    } else {
                        regexp = new RegExp(regexp);
                    }
                }

                if (regexp && !regexp.test) {
                    throw angular.$$minErr('diceModel')('noregeexp',
                        'Expected {0} to be a RegExp but was {1}. Element: {2}',
                        attributes.diceModelPattern,
                        regexp, $filter('startingTag')(element));
                }

                scope.$watch(attributes.ngModel, function (value) {
                    if (!value) {
                        diceModelAssign(scope, '');
                    } else {
                        if (filter) value = $filter(filter)(value);
                        if (!regexp || regexp.test(value)) {
                            diceModelAssign(scope, value);
                        }
                    }
                });
            }
        };
    }]);
    
    diceTechPro.directive('stringToNumber',[function() {
        return {
            require: 'ngModel',
            link: function(scope, element, attrs, ngModel) {
                ngModel.$parsers.push(function(value) {
                return '' + value;
            });
            ngModel.$formatters.push(function(value) {
                return parseFloat(value,10);
            });
          }
        }
    }]);
    /**
     * @returns {string} Returns the string representation of the element.
     */
    diceUtil.filter('startingTag', [function () {
        return function (element) {
            element = angular.element(element).clone();
            try {
                // turns out IE does not let you set .html() on elements which
                // are not allowed to have children. So we just ignore it.
                element.html('');
            } catch (ignore) {}
            // As Per DOM Standards
            var TEXT_NODE = 3,
                elemHtml = angular.element('<div>').append(element).html();
            try {
                return element[0].nodeType === TEXT_NODE ? elemHtml.toLowerCase() :
                    elemHtml.
                        match(/^(<[^>]+>)/)[1].
                        replace(/^<([\w\-]+)/, function(match, nodeName) { return '<' + nodeName.toLowerCase(); });
            } catch (e) {
                return elemHtml.toLowerCase();
            }
        };
    }]);

    diceTechPro.directive('floatLabel', [function(){
        return {
            restrict: 'A',
            link: function(scope, element, attrs){
                var input = element.next();

                if (!element.html()) { element.html(input.attr('placeholder')); }

                scope.$watch(function () { return input[0].value; }, function () {
                    if (input[0].defaultValue === input.val() || input.attr('placeholder') === input.val()) {
                        element.removeClass('float-label-on');
                        input.removeClass('float-label');
                    } else {
                        element.addClass('float-label-on');
                        input.addClass('float-label');
                    }
                });
                input.on('focus', focusHandler)
                    .on('blur', blurHandler);

                scope.$on('$destroy', function () {
                    input.off('focus', focusHandler)
                        .off('blur', blurHandler);
                });

                function focusHandler() {
                    if (input[0].defaultValue === input.val()) {
                        element.addClass('float-label-on');
                        input.addClass('float-label');
                    }
                }

                function blurHandler() {
                    if (input[0].defaultValue === input.val() || input.attr('placeholder') === input.val()) {
                        element.removeClass('float-label-on');
                        input.removeClass('float-label');
                    }
                }
            }
        };
    }]);

    diceTechPro.directive('diceNgCompareDates', ['$filter', function ($filter) {
        return {
            require: 'ngModel',
            link: function(scope, element, attributes, controller) {
                var rawDate = $filter('date')(new Date(), 'M/dd/yyyy');
                var currentDateArray = rawDate.split('/');
                var currentDay = currentDateArray.splice(1, 1);
                var currentDate = currentDateArray[0] + '/' + currentDateArray[1];
                if (attributes.name === 'currentEmployment') {
                    controller.value = currentDate;
                }
                function datesToCompare() {
                    var dates =  {
                        startDate: scope.$eval(attributes.diceNgCompareDates) || '',
                        endDate: scope.$eval(attributes.ngModel) || ''
                    };
                    return dates;
                }
                scope.$watch(datesToCompare, function(dates) {
                    function dateComparison(dates) {
                        var realStartDate, realEndDate;
                        var rawStartDate = dates.startDate.split('/');
                        var rawEnddDate = dates.endDate.split('/');
                        if (rawStartDate.length === 2 && rawEnddDate.length === 2){
                            realStartDate = Date.UTC(rawStartDate[1], rawStartDate[0]);
                            realEndDate = Date.UTC(rawEnddDate[1], rawEnddDate[0]);
                        }
                        if(realStartDate && realEndDate){
                            return realStartDate < realEndDate;
                        }
                        return false;
                    };
                    controller.$setValidity('datesToCompare', controller.$isEmpty(scope.$eval(attributes.ngModel)) || dateComparison(dates));
                }, true);
            }
        };
    }]);

    function parseConstantExpr($parse, context, name, expression, fallback) {
        var parseFn;
        if (angular.isDefined(expression)) {
            parseFn = $parse(expression);
            if (!parseFn.constant) {
                throw angular.$$minErr('ngModel')('constexpr', 'Expected constant expression for `{0}`, but saw ' +
                                       '`{1}`.', name, expression);
            }
            return parseFn(context);
        }
        return fallback;
    }

    diceUtil.constant('diceButtonConfig', {
        activeClass: 'on',
        toggleEvent: 'click tap'
    });

    diceUtil.controller('DiceSwitchController', ['diceButtonConfig', function (diceButtonConfig) {
        this.activeClass = diceButtonConfig.activeClass || 'on';
        this.toggleEvent = diceButtonConfig.toggleEvent || 'click tap';
    }]);

    diceUtil.directive('diceSwitch', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            require: ['diceSwitch', 'ngModel'],
            scope: {
                diceSwitchOnText: '@',
                diceSwitchOffText: '@',
                diceSwitchAnimated: '@',
                ngModel: '='
            },
            template: '<div class="toggle-switch"' +
                          'data-ng-class="{\'toggle-switch-animated\': diceSwitchAnimated !== undefined && diceSwitchAnimated !== \'false\',' +
                                          '{{switchCtrl.activeClass}}: ngModel === getTrueValue()}">' +
                          '<div class="toggle-switch-track">' +
                              '<div class="toggle-switch-label-on" data-ng-bind="diceSwitchOnText"></div>' +
                              '<div class="toggle-switch-label-off" data-ng-bind="diceSwitchOffText"></div>' +
                          '</div>' +
                          '<div tabindex="0" data-dice-switch-handle class="toggle-switch-handle"></div>' +
                      '</div>',
            replace: true,
            controller: 'DiceSwitchController',
            controllerAs: 'switchCtrl',
            link: {
                pre: function (scope, element, attributes, controllers) {
                    var switchCtrl = controllers[0],
                        ngModelCtrl = controllers[1],
                        handle = element.children()[1];

                    if (angular.isDefined(attributes.diceSwitchDraggable)) {
                        scope.diceSwitchDraggable = attributes.diceSwitchDraggable;
                    }

                    scope.getTrueValue = function () {
                        return getCheckboxValue('diceTrueValue', attributes.diceTrueValue, true);
                    }

                    scope.getFalseValue = function () {
                        return getCheckboxValue('diceFalseValue', attributes.diceFalseValue, false);
                    };

                    function getCheckboxValue(attributeName, attributeValue, defaultValue) {
                        return parseConstantExpr($parse, scope, attributeName, attributeValue, defaultValue)
                        //var val = scope.$eval(attributeValue);
                        //return angular.isDefined(val) ? val : defaultValue;
                    }

                    switchCtrl.toggleValue = function (value) {
                        var newViewValue;
                        if (typeof value === 'boolean') {
                            newViewValue = value ? scope.getTrueValue() : scope.getFalseValue();
                        } else {
                            newViewValue = element.hasClass(switchCtrl.activeClass) ? scope.getFalseValue() : scope.getTrueValue();
                        }
                        scope.$apply(function () {
                            ngModelCtrl.$setViewValue(newViewValue);
                            //ngModelCtrl.$render();
                        });
                    };

                    //model -> UI
                    ngModelCtrl.$render = function () {
                        //element.toggleClass(switchCtrl.activeClass, angular.equals(ngModelCtrl.$modelValue, scope.getTrueValue()));
                    };

                    //ui -> model
                    element.on(switchCtrl.toggleEvent, function () {
                        //console.log(switchCtrl.toggleEvent + ' events fired for switch');
                        switchCtrl.toggleValue();
                        handle.focus();
                    });
                }
            }
        };
    }]);

    diceUtil.directive('diceSwitchHandle', ['$document', function ($document) {
        return {
            restrict: 'A',
            require: '^diceSwitch',
            link: {
                post: function (scope, element, attributes, switchCtrl) {
                    var wasDragged = false,
                        isDragging = false;

                    function makeDraggable() {
                        var boundingContainer = element[0].parentNode,
                            startingCoords = {
                                x: null,
                                y: null
                            },
                            startingDX = 0,
                            startingDY = 0,
                            transformRegex = /matrix\(-?\d+(?:\.\d+)?, -?\d+(?:\.\d+)?, -?\d+(?:\.\d+)?, -?\d+(?:\.\d+)?, (-?\d+(?:\.\d+)?), (-?\d+(?:\.\d+)?)\)/;

                        function getMinXBound() {
                            return 0;
                        }

                        function getMaxXBound() {
                            return boundingContainer.clientWidth - element[0].offsetWidth;
                        }

                        function getMinYBound() {
                            return 0;
                        }

                        function getMaxYBound() {
                            return boundingContainer.clientHeight - element[0].offsetHeight;
                        }

                        function getXMidPoint() {
                            return (getMaxXBound() + getMinXBound()) / 2;
                        }

                        function toggleDragListeners(onOrOff) {
                            if (!onOrOff) { return; }
                            $document[onOrOff]('mousemove', dragged);
                            $document[onOrOff]('mouseup', dragEnd);
                            $document[onOrOff]('mouseleave', dragCancel);
                            element[onOrOff]('focusout', dragCancel);
                        }

                        function dragEnd(e) {
                            var endingDX = 0,
                                endingDY = 0,
                                newValue = false,
                                matches;
                            //console.log('dragEnd:', e);
                            toggleDragListeners('off');
                            isDragging = false;
                            if (wasDragged) {
                                matches = element.css('transform').match(transformRegex);
                                if (matches) {
                                    endingDX = matches[1];
                                }
                                if (endingDX > getXMidPoint()) {
                                    newValue = true;
                                }
                                switchCtrl.toggleValue(newValue);
                            }
                            element.css({'transition': '', 'transform': ''});
                        }

                        function dragCancel(e) {
                            //console.log('dragCancel:', e);
                            toggleDragListeners('off');
                            isDragging = false;
                            element.css({'transition': '', 'transform': ''});
                        }

                        function dragged(e) {
                            var translateX = Math.min(Math.max(startingDX + (e.clientX - startingCoords.x), getMinXBound()), getMaxXBound()),
                                translateY = Math.min(Math.max(startingDY + (e.clientY - startingCoords.y), getMinYBound()), getMaxYBound());

                            //console.log('dragged:', e);
                            //console.log('startingDX/DY:', startingDX, startingDY);
                            //console.log('startingCoords:', startingCoords);
                            //console.log('currentCoords:', e.clientX, e.clientY);

                            element.css({'transition': 'none',
                                         'transform': 'translate(' + (translateX ? translateX + 'px' : 0) + ', ' +
                                                                      (translateY ? translateY + 'px' : 0) + ')'});
                            //console.log('transform css:', element.css('transform'));

                            wasDragged = true;

                            // prevent text selection
                            e.preventDefault();
                            return false;
                        }

                        function dragStart(e) {
                            var matches = element.css('transform').match(transformRegex);
                            //console.log('dragStart:', e);
                            //console.log('transform css:', element.css('transform'));
                            startingCoords.x = e.clientX;
                            startingCoords.y = e.clientY;
                            //console.log('matches:', matches);
                            if (matches) {
                                startingDX = parseFloat(matches[1], 10);
                                startingDY = parseFloat(matches[2], 10);
                            } else {
                                startingDX = 0;
                                startingDY = 0;
                            }
                            toggleDragListeners('on');
                            isDragging = true;
                            wasDragged = false;
                        }

                        element.on('mousedown', dragStart);
                        element.on(switchCtrl.toggleEvent, function (e) {
                            //console.log('handle ' + switchCtrl.toggleEvent.split(' ').join('\'d or ') + '\'d');
                            if (wasDragged) {
                                //console.log('was dragged, preventing bubbling');
                                e.stopPropagation();
                                wasDragged = false;
                            }
                        });

                        scope.$on('$destroy', function () {
                            toggleDragListeners('off');
                        });
                    }

                    element.on('keydown', function (e) {
                        //console.log('keydown:', e);
                        //console.log('isDragging:', isDragging);
                        if (element[0].getAttribute('disabled') || element[0].parentNode.getAttribute('disabled')) {
                            return;
                        }
                        if (!isDragging) {
                            switch (e.which) {

                                // Enter key
                                case 13:
                                    //console.log('enter key');
                                    switchCtrl.toggleValue();
                                    break;

                                // Space key
                                case 32:
                                    //console.log('space key');
                                    switchCtrl.toggleValue();
                                    break;

                                // Left arrow
                                case 37:
                                    //console.log('left arrow key');
                                    switchCtrl.toggleValue(false);
                                    break;

                                // Right arrow
                                case 39:
                                    //console.log('right arrow key');
                                    switchCtrl.toggleValue(true);
                                    break;
                            }
                        }
                    });

                    if (angular.isDefined(scope.diceSwitchDraggable) && scope.$eval(scope.diceSwitchDraggable) !== false) {
                        makeDraggable();
                    }
                }
            }
        };
    }]);
}());
