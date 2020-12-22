@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
{{--@extends('layouts.main') --}}

@section('content')
    <link rel="stylesheet" href="{{ asset('css/kycpage.css') }}">
    <div class="container" style="border-radius: 10px;">

        @if (count($errors) > 0)

            <div class="alert alert-danger" role="alert">
                <strong>Errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

        @endif

        {!! Form::open(['action'=>'KYCController@validateKyc','enctype' => 'multipart/form-data','data-parsley-validate' => '']) !!}

        <div class="row">

            <div class='col-md-12'>
                <h1 class="topic" style="text-align:center">
                    Verify my Identity
                </h1>
                <br>
            </div>

            <div class="col-md-2"></div>
            <div class="col-md-8">Know Your Customer (KYC) ensures a trusted marketplace for all users by confirming
                their identity through the submission and verification of valid documentation.
                Users that verify their identity will receive the benefit of faster processing of their payments and
                faster resolution of account issues and disputes.
            </div>
            <div class="col-md-2"></div>
        </div>
        <br>
        <hr>
        {{--<div class="row kycheading kycrow ">--}}
        {{--<div class="col-md-2">--}}
        {{--Account ID--}}
        {{--</div>--}}
        {{--<div class='col-md-4' , style='color:gray; text-align:center'>--}}
        {{--{{ Form::text('account_id', null, ["class" => "kyctextbox ", 'required' => '' ,'data-parsley-type' => 'alphanum',--}}
        {{--'data-parsley-error-message' => "Please state your Account ID", 'data-parsley-error-message' => "Account ID--}}
        {{--may only contain letters and numbers", "placeholder" => " From Announced e-mail (Ex. CXA9999)"]) }}--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="row kycheading kycrow ">
            <div class="col-md-2">
                First Name
            </div>
            <div class='col-md-4' , style='color:gray; text-align:center'>

                {{ Form::text('firstname', null, ["class" => "kyctextbox ", 'required' => '' ,'data-parsley-pattern' => "^[A-Za-z]*$",
                'data-parsley-error-message' => "Please state your First Name", 'data-parsley-pattern-message' => "First Name
                may only contain english letters"]) }}
            </div>
        </div>

        <div class="row kycheading kycrow ">
            <div class="col-md-2">
                Last Name
            </div>
            <div class='col-md-4' , style='color:gray; text-align:center'>
                {{ Form::text('lastname', null, ["class" => "kyctextbox ", 'required' => '' ,'data-parsley-pattern' => "^[A-Za-z]*$",
                'data-parsley-error-message' => "Please state your Last Name", 'data-parsley-pattern-message' => "Last Name may
                only contain english letters"]) }}
            </div>
        </div>

        <div class="row kycheading kycrow ">
            <div class="col-md-2">
                Sex
            </div>
            <div class='col-md-1 kycradio1'>
                {{ Form::radio('sex', 'Male') }} Male
            </div>
            <div class='col-md-2 kycradio2'>
                {{ Form::radio('sex', 'Female') }} Female
            </div>
        </div>

        <div class="row kycheading kycrow ">
            <div class="col-md-2">
                Date of Birth
            </div>
            <div class='col-md-4' , style='color:gray; text-align:center'>
                {{ Form::date('birthday', null, ["class" => "kyctextbox ", 'required' => '',
                'data-parsley-error-message' => "Please state your Birthday"]) }}
            </div>
        </div>

        <div class="row  kycrow ">
            <div class="col-md-2 kycheading">
                Nationality
            </div>
            <div class='col-md-4' , style='color:gray; text-align:center'>
                {{Form::select('nationality', ["Afghan" => "Afghan", "Albanian" => "Albanian", "Algerian" => "Algerian", "American" => "American", "Andorran" => "Andorran",
                "Angolan" => "Angolan", "Antiguans" => "Antiguans", "Argentinean" => "Argentinean", "Armenian" => "Armenian", "Australian"
                => "Australian", "Austrian" => "Austrian", "Azerbaijani" => "Azerbaijani", "Bahamian" => "Bahamian", "Bahraini" => "Bahraini",
                "Bangladeshi" => "Bangladeshi", "Barbadian" => "Barbadian", "Barbudans" => "Barbudans", "Batswana" => "Batswana", "Belarusian"
                => "Belarusian", "Belgian" => "Belgian", "Belizean" => "Belizean", "Beninese" => "Beninese", "Bhutanese" => "Bhutanese",
                "Bolivian" => "Bolivian", "Bosnian" => "Bosnian", "Brazilian" => "Brazilian", "British" => "British", "Bruneian" => "Bruneian",
                "Bulgarian" => "Bulgarian", "Burkinabe" => "Burkinabe", "Burmese" => "Burmese", "Burundian" => "Burundian", "Cambodian" =>
                "Cambodian", "Cameroonian" => "Cameroonian", "Canadian" => "Canadian", "Cape Verdean" => "Cape Verdean", "Central African"
                => "Central African", "Chadian" => "Chadian", "Chilean" => "Chilean", "Chinese" => "Chinese", "Colombian" => "Colombian",
                "Comoran" => "Comoran", "Congolese" => "Congolese", "Costa Rican" => "Costa Rican", "Croatian" => "Croatian", "Cuban" =>
                "Cuban", "Cypriot" => "Cypriot", "Czech" => "Czech", "Danish" => "Danish", "Djibouti" => "Djibouti", "Dominican" => "Dominican",
                "Dutch" => "Dutch", "East Timorese" => "East Timorese", "Ecuadorean" => "Ecuadorean", "Egyptian" => "Egyptian", "Emirian"
                => "Emirian", "Equatorial Guinean" => "Equatorial Guinean", "Eritrean" => "Eritrean", "Estonian" => "Estonian", "Ethiopian"
                => "Ethiopian", "Fijian" => "Fijian", "Filipino" => "Filipino", "Finnish" => "Finnish", "French" => "French", "Gabonese"
                => "Gabonese", "Gambian" => "Gambian", "Georgian" => "Georgian", "German" => "German", "Ghanaian" => "Ghanaian", "Greek"
                => "Greek", "Grenadian" => "Grenadian", "Guatemalan" => "Guatemalan", "Guinea-Bissauan" => "Guinea-Bissauan", "Guinean" =>
                "Guinean", "Guyanese" => "Guyanese", "Haitian" => "Haitian", "Herzegovinian" => "Herzegovinian", "Honduran" => "Honduran",
                "Hungarian" => "Hungarian", "Icelander" => "Icelander", "Indian" => "Indian", "Indonesian" => "Indonesian", "Iranian" =>
                "Iranian", "Iraqi" => "Iraqi", "Irish" => "Irish", "Israeli" => "Israeli", "Italian" => "Italian", "Ivorian" => "Ivorian",
                "Jamaican" => "Jamaican", "Japanese" => "Japanese", "Jordanian" => "Jordanian", "Kazakhstani" => "Kazakhstani", "Kenyan"
                => "Kenyan", "Kittian and Nevisian" => "Kittian and Nevisian", "Kuwaiti" => "Kuwaiti", "Kyrgyz" => "Kyrgyz", "Laotian" =>
                "Laotian", "Latvian" => "Latvian", "Lebanese" => "Lebanese", "Liberian" => "Liberian", "Libyan" => "Libyan", "Liechtensteiner"
                => "Liechtensteiner", "Lithuanian" => "Lithuanian", "Luxembourger" => "Luxembourger", "Macedonian" => "Macedonian", "Malagasy"
                => "Malagasy", "Malawian" => "Malawian", "Malaysian" => "Malaysian", "Maldivan" => "Maldivan", "Malian" => "Malian", "Maltese"
                => "Maltese", "Marshallese" => "Marshallese", "Mauritanian" => "Mauritanian", "Mauritian" => "Mauritian", "Mexican" => "Mexican",
                "Micronesian" => "Micronesian", "Moldovan" => "Moldovan", "Monacan" => "Monacan", "Mongolian" => "Mongolian", "Moroccan"
                => "Moroccan", "Mosotho" => "Mosotho", "Motswana" => "Motswana", "Mozambican" => "Mozambican", "Namibian" => "Namibian",
                "Nauruan" => "Nauruan", "Nepalese" => "Nepalese", "New Zealander" => "New Zealander", "Ni-Vanuatu" => "Ni-Vanuatu", "Nicaraguan"
                => "Nicaraguan", "Nigerien" => "Nigerien", "North Korean" => "North Korean", "Northern Irish" => "Northern Irish", "Norwegian"
                => "Norwegian", "Omani" => "Omani", "Pakistani" => "Pakistani", "Palauan" => "Palauan", "Panamanian" => "Panamanian", "Papua
                New Guinean" => "Papua New Guinean", "Paraguayan" => "Paraguayan", "Peruvian" => "Peruvian", "Polish" => "Polish", "Portuguese"
                => "Portuguese", "Qatari" => "Qatari", "Romanian" => "Romanian", "Russian" => "Russian", "Rwandan" => "Rwandan", "Saint Lucian"
                => "Saint Lucian", "Salvadoran" => "Salvadoran", "Samoan" => "Samoan", "San Marinese" => "San Marinese", "Sao Tomean" =>
                "Sao Tomean", "Saudi" => "Saudi", "Scottish" => "Scottish", "Senegalese" => "Senegalese", "Serbian" => "Serbian", "Seychellois"
                => "Seychellois", "Sierra Leonean" => "Sierra Leonean", "Singaporean" => "Singaporean", "Slovakian" => "Slovakian", "Slovenian"
                => "Slovenian", "Solomon Islander" => "Solomon Islander", "Somali" => "Somali", "South African" => "South African", "South
                Korean" => "South Korean", "Spanish" => "Spanish", "Sri Lankan" => "Sri Lankan", "Sudanese" => "Sudanese", "Surinamer" =>
                "Surinamer", "Swazi" => "Swazi", "Swedish" => "Swedish", "Swiss" => "Swiss", "Syrian" => "Syrian", "Taiwanese" => "Taiwanese",
                "Tajik" => "Tajik", "Tanzanian" => "Tanzanian", "Thai" => "Thai", "Togolese" => "Togolese", "Tongan" => "Tongan", "Trinidadian
                or Tobagonian" => "Trinidadian or Tobagonian", "Tunisian" => "Tunisian", "Turkish" => "Turkish", "Tuvaluan" => "Tuvaluan",
                "Ugandan" => "Ugandan", "Ukrainian" => "Ukrainian", "Uruguayan" => "Uruguayan", "Uzbekistani" => "Uzbekistani", "Venezuelan"
                => "Venezuelan", "Vietnamese" => "Vietnamese", "Welsh" => "Welsh", "Yemenite" => "Yemenite", "Zambian" => "Zambian", "Zimbabwean"
                => "Zimbabwean"], null, ['class'
            => 'kycselect', 'placeholder' => 'Please enter keyword and select','required' => '', 'data-parsley-error-message'
            => "Please select your Nationality."])}}
            </div>
        </div>

        <div class="row  kycrow ">
            <div class="col-md-2 kycheading">
                Country of Residence
            </div>
            <div class='col-md-4' , style='color:gray; text-align:center'>
                {{Form::select('residence', ["Aland Islands" => "Aland Islands", "Albania" => "Albania", "Algeria" => "Algeria", "American
                Samoa" => "American Samoa", "Andorra" => "Andorra", "Angola" => "Angola", "Anguilla" => "Anguilla", "Antigua"
                => "Antigua", "Argentina" => "Argentina", "Armenia" => "Armenia", "Aruba" => "Aruba", "Australia" => "Australia",
                "Austria" => "Austria", "Azerbaijan" => "Azerbaijan", "Bahamas" => "Bahamas", "Bahrain" => "Bahrain", "Bangladesh"
                => "Bangladesh", "Barbados" => "Barbados", "Belarus" => "Belarus", "Belgium" => "Belgium", "Belize" => "Belize",
                "Benin" => "Benin", "Bermuda" => "Bermuda", "Bhutan" => "Bhutan", "Bolivia" => "Bolivia", "Bosnia" => "Bosnia",
                "Botswana" => "Botswana", "Bouvet Island" => "Bouvet Island", "Brazil" => "Brazil", "British Virgin Islands"
                => "British Virgin Islands", "Brunei" => "Brunei", "Bulgaria" => "Bulgaria", "Burkina Faso" => "Burkina Faso",
                "Burma" => "Burma", "Burundi" => "Burundi", "Caicos Islands" => "Caicos Islands", "Cambodia" => "Cambodia", "Cameroon"
                => "Cameroon", "Canada" => "Canada", "Cape Verde" => "Cape Verde", "Cayman Islands" => "Cayman Islands", "Central
                African Republic" => "Central African Republic", "Chad" => "Chad", "Chile" => "Chile", "China" => "China", "Christmas
                Island" => "Christmas Island", "Cocos Islands" => "Cocos Islands", "Colombia" => "Colombia", "Comoros" => "Comoros",
                "Congo Brazzaville" => "Congo Brazzaville", "Congo" => "Congo", "Cook Islands" => "Cook Islands", "Costa Rica"
                => "Costa Rica", "Cote Divoire" => "Cote Divoire", "Croatia" => "Croatia", "Cuba" => "Cuba", "Cyprus" => "Cyprus",
                "Czech Republic" => "Czech Republic", "Denmark" => "Denmark", "Djibouti" => "Djibouti", "Dominica" => "Dominica",
                "Dominican Republic" => "Dominican Republic", "Ecuador" => "Ecuador", "Egypt" => "Egypt", "El Salvador" => "El
                Salvador", "England" => "England", "Equatorial Guinea" => "Equatorial Guinea", "Eritrea" => "Eritrea", "Estonia"
                => "Estonia", "Ethiopia" => "Ethiopia", "European Union" => "European Union", "Falkland Islands" => "Falkland
                Islands", "Faroe Islands" => "Faroe Islands", "Fiji" => "Fiji", "Finland" => "Finland", "France" => "France",
                "French Guiana" => "French Guiana", "French Polynesia" => "French Polynesia", "French Territories" => "French
                Territories", "Gabon" => "Gabon", "Gambia" => "Gambia", "Georgia" => "Georgia", "Germany" => "Germany", "Ghana"
                => "Ghana", "Gibraltar" => "Gibraltar", "Greece" => "Greece", "Greenland" => "Greenland", "Grenada" => "Grenada",
                "Guadeloupe" => "Guadeloupe", "Guam" => "Guam", "Guatemala" => "Guatemala", "Guinea-Bissau" => "Guinea-Bissau",
                "Guinea" => "Guinea", "Guyana" => "Guyana", "Haiti" => "Haiti", "Heard Island" => "Heard Island", "Honduras"
                => "Honduras", "Hong Kong" => "Hong Kong", "Hungary" => "Hungary", "Iceland" => "Iceland", "India" => "India",
                "Indian Ocean Territory" => "Indian Ocean Territory", "Indonesia" => "Indonesia", "Iran" => "Iran", "Iraq" =>
                "Iraq", "Ireland" => "Ireland", "Israel" => "Israel", "Italy" => "Italy", "Jamaica" => "Jamaica", "Japan" =>
                "Japan", "Jordan" => "Jordan", "Kazakhstan" => "Kazakhstan", "Kenya" => "Kenya", "Kiribati" => "Kiribati", "Kuwait"
                => "Kuwait", "Kyrgyzstan" => "Kyrgyzstan", "Laos" => "Laos", "Latvia" => "Latvia", "Lebanon" => "Lebanon", "Lesotho"
                => "Lesotho", "Liberia" => "Liberia", "Libya" => "Libya", "Liechtenstein" => "Liechtenstein", "Lithuania" =>
                "Lithuania", "Luxembourg" => "Luxembourg", "Macau" => "Macau", "Macedonia" => "Macedonia", "Madagascar" => "Madagascar",
                "Malawi" => "Malawi", "Malaysia" => "Malaysia", "Maldives" => "Maldives", "Mali" => "Mali", "Malta" => "Malta",
                "Marshall Islands" => "Marshall Islands", "Martinique" => "Martinique", "Mauritania" => "Mauritania", "Mauritius"
                => "Mauritius", "Mayotte" => "Mayotte", "Mexico" => "Mexico", "Micronesia" => "Micronesia", "Moldova" => "Moldova",
                "Monaco" => "Monaco", "Mongolia" => "Mongolia", "Montenegro" => "Montenegro", "Montserrat" => "Montserrat", "Morocco"
                => "Morocco", "Mozambique" => "Mozambique", "Namibia" => "Namibia", "Nauru" => "Nauru", "Nepal" => "Nepal", "Netherlands
                Antilles" => "Netherlands Antilles", "Netherlands" => "Netherlands", "New Caledonia" => "New Caledonia", "New
                Guinea" => "New Guinea", "New Zealand" => "New Zealand", "Nicaragua" => "Nicaragua", "Niger" => "Niger", "Nigeria"
                => "Nigeria", "Niue" => "Niue", "Norfolk Island" => "Norfolk Island", "North Korea" => "North Korea", "Northern
                Mariana Islands" => "Northern Mariana Islands", "Norway" => "Norway", "Oman" => "Oman", "Pakistan" => "Pakistan",
                "Palau" => "Palau", "Palestine" => "Palestine", "Panama" => "Panama", "Paraguay" => "Paraguay", "Peru" => "Peru",
                "Philippines" => "Philippines", "Pitcairn Islands" => "Pitcairn Islands", "Poland" => "Poland", "Portugal" =>
                "Portugal", "Puerto Rico" => "Puerto Rico", "Qatar" => "Qatar", "Reunion" => "Reunion", "Romania" => "Romania",
                "Russia" => "Russia", "Rwanda" => "Rwanda", "Saint Helena" => "Saint Helena", "Saint Kitts and Nevis" => "Saint
                Kitts and Nevis", "Saint Lucia" => "Saint Lucia", "Saint Pierre" => "Saint Pierre", "Saint Vincent" => "Saint
                Vincent", "Samoa" => "Samoa", "San Marino" => "San Marino", "Sandwich Islands" => "Sandwich Islands", "Sao Tome"
                => "Sao Tome", "Saudi Arabia" => "Saudi Arabia", "Senegal" => "Senegal", "Serbia" => "Serbia", "Serbia" => "Serbia",
                "Seychelles" => "Seychelles", "Sierra Leone" => "Sierra Leone", "Singapore" => "Singapore", "Slovakia" => "Slovakia",
                "Slovenia" => "Slovenia", "Solomon Islands" => "Solomon Islands", "Somalia" => "Somalia", "South Africa" => "South
                Africa", "South Korea" => "South Korea", "Spain" => "Spain", "Sri Lanka" => "Sri Lanka", "Sudan" => "Sudan",
                "Suriname" => "Suriname", "Svalbard" => "Svalbard", "Swaziland" => "Swaziland", "Sweden" => "Sweden", "Switzerland"
                => "Switzerland", "Syria" => "Syria", "Taiwan" => "Taiwan", "Tajikistan" => "Tajikistan", "Tanzania" => "Tanzania",
                "Thailand" => "Thailand", "Timorleste" => "Timorleste", "Togo" => "Togo", "Tokelau" => "Tokelau", "Tonga" =>
                "Tonga", "Trinidad" => "Trinidad", "Tunisia" => "Tunisia", "Turkey" => "Turkey", "Turkmenistan" => "Turkmenistan",
                "Tuvalu" => "Tuvalu", "Uganda" => "Uganda", "Ukraine" => "Ukraine", "United Arab Emirates" => "United Arab Emirates",
                "United States" => "United States", "Uruguay" => "Uruguay", "Us Minor Islands" => "Us Minor Islands", "Us Virgin
                Islands" => "Us Virgin Islands", "Uzbekistan" => "Uzbekistan", "Vanuatu" => "Vanuatu", "Vatican City" => "Vatican
                City", "Venezuela" => "Venezuela", "Vietnam" => "Vietnam", "Wallis and Futuna" => "Wallis and Futuna", "Western
                Sahara" => "Western Sahara", "Yemen" => "Yemen", "Zambia" => "Zambia", "Zimbabw" => "Zimbabwe" ], null, ['class'
                => 'kycselect', 'placeholder' => 'Please enter keyword and select','required' => '', 'data-parsley-error-message'
                => "Please select your Country of Residence."])}}
            </div>
        </div>

        <div class="row kycrow">
            <div class="col-md-2 kycheading">
                Are you a U.S. citizen?
            </div>
            <div class='col-md-1 kycradio1'>
                {{ Form::radio('us_citizen', 'Yes') }} Yes
            </div>
            <div class='col-md-1 kycradio2'>
                {{ Form::radio('us_citizen', 'No') }} No
            </div>
        </div>

        <hr>

        <div class="row kycrow " style="margin-bottom:20px">
            <div class="col-md-2 kycheading">
                Passport or<br>National ID Card
            </div>
            <div class='col-md-4' , style='color:gray; text-align:center'>
                {{ Form::text('id_number', null, ["class" => "kyctextbox ", 'required' => '' ,'data-parsley-type' => 'alphanum',
                'data-parsley-error-message' => "Please state your Passport ID", 'data-parsley-error-message' => "Passport ID
                may only contain letters and numbers"]) }}
            </div>
        </div>


        <div class="row">
            <div class="col-md-2 kycheading">
                Passport data page
            </div>
            <div class='col-md-3'>
                {{Form::file('pic_passport', ['class' => 'image kyctextbox ', 'id' => 'profile-img2'])}}
            </div>
        </div>
        <div class="row" style="margin-bottom:20px">
            <div class="col-md-2"></div>

            <div class='col-md-10'>
                <p class="kycmargintext">Please upload the high quality photo of your Passport Personal Page OR National
                    ID card. (JPG, JPEG, PNG, GIF only)</p>
            </div>

            <div class="col-md-2"></div>
            <div class="col-md-5"><img src="{{ asset('images/kyc-frame.png') }}" id="profile-img-tag2"
                                       class="logo choosenpic"></div>
            <div class="col-md-5"><img src="{{ asset('images/passport.png') }}" class="logo"
                                       style="display:block; width:100%"></a></div>


        </div>


        <div class="row">
            <div class="col-md-2 kycheading">
                Self-portrait with
                <br> photo ID and note
            </div>
            <div class='col-md-3'>

                {{Form::file('pic_portrait', ['class' => 'image kyctextbox ', 'id' => 'profile-img'])}}
            </div>
        </div>
        <div class="row">

            <div class="col-md-2"></div>

            <div class='col-md-9'>
                <p class="kycmargintext">Please upload the high quality photo of you holding your Passport Personal Page
                    OR National ID Card along with the note containing 1) Reference to "Paytodev" 2) Date of registration 3)
                    Your signature. Make sure your face is clearly visible and all the documents are clearly readable.
                    (JPG, JPEG, PNG, GIF only)</p>
                <div class="row">
                    <div class="col-md-3" style="list-style-type:disc; color:green; margin-left:5px;">&#10003; Face
                        clearly visible
                    </div>
                    <div class="col-md-3" style="list-style-type:disc; color:green;">&#10003; Photo ID clearly visible
                    </div>
                    <div class="col-md-3" style="list-style-type:disc; color:green;">&#10003; Note with "Paytodev"
                    </div>
                    <div class="col-md-3" style="list-style-type:disc; color:green; margin-right:-5px">&#10003; Note
                        with today's date
                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
            <div class="col-md-5"><img src="{{ asset('images/kyc-frame.png') }}" id="profile-img-tag"
                                       class="logo choosenpic"></div>
            <div class="col-md-5"><img src="{{ asset('images/portrait.png') }}" class="logo portrait"
                                       style="display:block; width:100%"></a></div>


        </div>
        <hr>

        <div class="row">
            <div class="col-md-2 kycheading">Terms and Conditions</div>
            <div class="col-md-9 kycmargin">
                <p> Terms and Conditions : <a href="/page/terms-of-use"
                                              target="_blank">Link</a></p>

                <input type="checkbox" name="terms" id="terms"/>
                <span>I acknowledge that I have read the Terms & Conditions and agree to be bound by them.</span>
            </div>
        </div>

        <div class="row" style="margin-top:20px;">
            <div class='col-md-2'></div>
            <div class='col-md-2'>
                {{Form::submit('Submit', ['id' => 'submitbut', 'class' => 'kyctextbox btn btn-primary kyctransition', 'disabled'])}}
            </div>
        </div>

        <br>
        <br>

        {!! Form::close() !!}
    </div>
@endsection

@section('exam_admin_script')
    @include('KYC.scripts')
@endsection