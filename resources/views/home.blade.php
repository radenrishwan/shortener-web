<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/283b0fc457.js" crossorigin="anonymous"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <title>Document</title>
</head>

<body>
    <section id="sidenav" class="sidenav">
        <div class="p-5 flex flex-col">
            <div class="flex flex-row justify-end">
                <button class="text-black" onclick="closeNav()">✖️</button>
            </div>
            <div class="flex flex-col p-5">
                <h1 class="text-lg font-semibold">Recent URLs</h1>
                <hr class="my-5">
                <ul class="flex flex-col gap-5 justify-center">
                    @if(isset($urls))
                    @foreach ($urls as $recentUrl)
                    <li>
                        <div class="flex flex-row justify-between border-2 rounded-lg p-3 bg-green-300">
                            <div>
                                <h5 class="text-lg font-semibold text-ellipsis overflow-hidden">
                                    {{ $recentUrl->alias }}
                                </h5>
                                <p class="text-sm font-light">{{ $recentUrl->destination }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @endif
                </ul>
                @if (isset($urls))
                @if (!(sizeof($urls) < 1))
                <a href="/url/clear" class="justify-center flex flex-row mt-5">
                    <h5 class="text-lg font-semibold text-ellipsis overflow-hidden">
                        Clear Recent URLs
                    </h5>
                </a>
                @endif
                @endif
            </div>
        </div>
    </section>

    <div class="flex justify-between flex-col h-[100vh] bg-violet-300 w-full">
        <section id="navbar" class="container mx-auto px-4 my-4">
            <div class="flex flex-row content-center place-items-center justify-between">
                <a href="/">
                    <p class="text-3xl font-bold cursor-pointer">Seior Shortener.</p>
                </a>
                <div class="flex gap-5">
                    <a href="https://github.com/radenrishwan/shortener-web">
                        <p class="font-semibold cursor-pointer font-lg">Github</p>
                    </a>
                    <p onclick="openNav()" class="font-semibold cursor-pointer font-lg">Recent URLs</p>
                </div>
            </div>
            @if (isset($error))
            <div class="w-full h-[2rem] bg-red-300 rounded-lg flex justify-between p-5 border-2 mt-2 items-center"
                id="error-alert">
                <h1 class="text-md font-semibold">{{ ucfirst($error) }}</h1>
                <button class="mr-2 text-md" id="error-button">✖️</button>
            </div>
            @endif
            @if (isset($success))
            <div class="w-full h-[2rem] bg-green-300 rounded-lg flex justify-between p-5 border-2 mt-2 items-center"
                id="error-alert">
                <h1 class="text-md font-semibold">{{ ucfirst($success) }}</h1>
                <button class="mr-2 text-md" id="error-button">✖️</button>
            </div>
            @endif

        </section>

        <section id="content" class="container mx-auto px-4 my-4">
            <div class="flex flex-row">
                <div class="flex flex-col">
                    <div class="flex flex-row">
                        <div class="w-[450px] p-10 bg-green-300 rounded-lg border-2">
                            <p class="text-xl font-bold">Create new link</p>
                            <form method="post" action="/">
                                @csrf
                                <input type="text" name="destination" id="destination" maxlength="255" minlength="1"
                                    class="border-none outline-none mt-5 rounded-lg h-10 w-full p-5"
                                    placeholder="Enter destination link">
                                <div id="destination-input-alert" class="px-4 py-2"></div>

                                <input type="text" name="alias" id="alias" maxlength="30" minlength="1"
                                    class="border-none outline-none mt-5 rounded-lg h-10 w-full p-5"
                                    placeholder="Enter Alias">

                                <div class="flex flex-row justify-between mt-5 place-items-start content-center">
                                    <div id="alias-input-alert" class="px-4 py-2"></div>
                                    <button type="submit" id="create-button"
                                        class="rounded-lg bg-violet-300 px-4 py-2 pointer-events-none">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="flex flex-ro mt-5">
                        <div class="w-[450px] p-10 bg-green-300 rounded-lg border-2">
                            <p class="text-xl font-bold">Result Here</p>
                            <div id="result"
                                class="mt-5 flex flex-row justify-between place-items-start content-center">
                                @if (isset($url))
                                <input type="text" name="output" id="output" maxlength="31"
                                    class="border-none outline-none rounded-lg h-10 w-full p-5" placeholder="" disabled
                                    value="{{ $url['alias'] }}">
                                @else
                                <input type="text" name="output" id="output" maxlength="31"
                                    class="border-none outline-none rounded-lg h-10 w-full p-5" placeholder="" disabled
                                    value="empty">
                                @endif
                                <button class="px-3 text-2xl" id="copy-url">📋</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ml-5 mt-10 flex flex-col justify-between">
                    <div class="ml-[4.5rem]">
                        <h1>Hi, Visitors 👋</h1>
                        <h1 class="text-4xl font-semibold">Make your url look better</h1>
                        <p>Feel free to use and shared to your friend</p>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="542.16979" height="268.85227"
                        viewBox="0 0 842.16979 568.85227" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path d="M716.621,734.1684v-72.34S744.81264,713.11437,716.621,734.1684Z"
                            transform="translate(-178.45119 -165.31613)" fill="#f1f1f1" />
                        <path d="M718.36244,734.15568l-53.28962-48.92125S721.918,699.15,718.36244,734.15568Z"
                            transform="translate(-178.45119 -165.31613)" fill="#f1f1f1" />
                        <rect id="f54375ad-557d-4249-95e2-413e25c77bd8" data-name="Rectangle 62" x="0.35895" y="23.0788"
                            width="841.81084" height="399.45384" fill="#e5e5e5" />
                        <rect id="eb84611c-d49d-4ce2-b538-4fee0a7e188d" data-name="Rectangle 75" x="24.43081"
                            y="57.33267" width="793.66829" height="333.27683" fill="#fff" />
                        <rect id="a33b5263-04c3-449f-a8ad-1420252c1e48" data-name="Rectangle 80" width="841.81084"
                            height="35.76263" fill="#86efac" />
                        <circle id="a01a8c4b-bf8b-4728-9381-d6cbaed15ee5" data-name="Ellipse 90" cx="26.57607"
                            cy="17.81511" r="6.62847" fill="#fff" />
                        <circle id="a70f271b-ee75-4447-9507-72af025f0784" data-name="Ellipse 91" cx="51.73556"
                            cy="17.81511" r="6.62847" fill="#fff" />
                        <circle id="b6ae4294-4107-4abd-ba05-1d458fcbc8d7" data-name="Ellipse 92" cx="76.89622"
                            cy="17.81511" r="6.62847" fill="#fff" />
                        <path id="a98f5d70-28fc-4129-b4f3-463d07786f2f-91" data-name="Path 680"
                            d="M332.91148,298.51922a3.268,3.268,0,0,0,0,6.536h89.293a3.268,3.268,0,1,0,0-6.536Z"
                            transform="translate(-178.45119 -165.31613)" fill="#3f3d56" />
                        <path id="a5717240-4d8d-4c71-83bc-6deeb889f166-92" data-name="Path 680"
                            d="M282.41148,343.51922a3.268,3.268,0,0,0,0,6.536h190.293a3.268,3.268,0,1,0,0-6.536Z"
                            transform="translate(-178.45119 -165.31613)" fill="#ccc" />
                        <path id="f9c6f13d-6e3a-4758-9844-a0f5d5c969ce-93" data-name="Path 680"
                            d="M282.41148,369.51922a3.268,3.268,0,0,0,0,6.536h190.293a3.268,3.268,0,1,0,0-6.536Z"
                            transform="translate(-178.45119 -165.31613)" fill="#ccc" />
                        <path id="bf808dfd-2bb2-4793-b7c6-d8671bf7e9b4-94" data-name="Path 680"
                            d="M282.41148,395.51922a3.268,3.268,0,0,0,0,6.536h190.293a3.268,3.268,0,1,0,0-6.536Z"
                            transform="translate(-178.45119 -165.31613)" fill="#ccc" />
                        <path id="e27373f7-fd0b-426a-8828-0829b084b689-95" data-name="Path 680"
                            d="M282.41148,421.51922a3.268,3.268,0,0,0,0,6.536h190.293a3.268,3.268,0,1,0,0-6.536Z"
                            transform="translate(-178.45119 -165.31613)" fill="#ccc" />
                        <path id="b4c6c7b3-e22e-4fba-a4f6-80d19d07dbd3-96" data-name="Path 680"
                            d="M282.41148,447.51922a3.268,3.268,0,0,0,0,6.536h190.293a3.268,3.268,0,1,0,0-6.536Z"
                            transform="translate(-178.45119 -165.31613)" fill="#ccc" />
                        <path id="ebf0dc46-a6ad-47cb-a3de-ddb71e9e94e3-97" data-name="Path 680"
                            d="M282.41148,473.51922a3.268,3.268,0,0,0,0,6.536h190.293a3.268,3.268,0,1,0,0-6.536Z"
                            transform="translate(-178.45119 -165.31613)" fill="#ccc" />
                        <path
                            d="M910.16054,481.4543H622.05779a7.271,7.271,0,0,1-7.2631-7.26309V304.719a7.271,7.271,0,0,1,7.2631-7.26309H910.16054a7.271,7.271,0,0,1,7.2631,7.26309V474.19121A7.271,7.271,0,0,1,910.16054,481.4543Z"
                            transform="translate(-178.45119 -165.31613)" fill="#f1f1f1" />
                        <path
                            d="M948.06072,520.21623H659.958a7.271,7.271,0,0,1-7.26309-7.2631V343.48092a7.271,7.271,0,0,1,7.26309-7.26309H948.06072a7.271,7.271,0,0,1,7.26309,7.26309V512.95313A7.271,7.271,0,0,1,948.06072,520.21623Z"
                            transform="translate(-178.45119 -165.31613)" fill="#fff" />
                        <path
                            d="M948.0605,522.68784H659.958a9.74579,9.74579,0,0,1-9.73465-9.73485V343.4813a9.7458,9.7458,0,0,1,9.73465-9.73486H948.0605a9.74585,9.74585,0,0,1,9.73486,9.73486V512.953A9.74584,9.74584,0,0,1,948.0605,522.68784ZM659.958,338.6895a4.79721,4.79721,0,0,0-4.7916,4.7918V512.953a4.79721,4.79721,0,0,0,4.7916,4.7918H948.0605a4.79738,4.79738,0,0,0,4.7918-4.7918V343.4813a4.79738,4.79738,0,0,0-4.7918-4.7918Z"
                            transform="translate(-178.45119 -165.31613)" fill="#3f3d56" />
                        <circle cx="625.16979" cy="285.43031" r="25" fill="#ff6583" />
                        <path
                            d="M851.849,426.695a16.09868,16.09868,0,0,0-23.02463-.41135l-81.07973,81.08013c-10.386,10.43459-21.22811-5.52482-28.15628-11.9606-16.66045-16.47735-34.65555,14.419-45.85423,23.26678H934.2846v-3.3168Z"
                            transform="translate(-178.45119 -165.31613)" fill="#86efac" />
                        <path
                            d="M530.68063,524.9767l-4.38425-60.75355,7.8739-56.93181-22.3624-1.50994-4.41411,62.88884L519.869,527.80992a8.79767,8.79767,0,1,0,10.81159-2.83322Z"
                            transform="translate(-178.45119 -165.31613)" fill="#9f616a" />
                        <path
                            d="M508.95477,413.96379l5.251-22.72576a17.49724,17.49724,0,0,1,34.43542,5.897l-2.8917,25.67924Z"
                            transform="translate(-178.45119 -165.31613)" fill="#cbcbcb" />
                        <polygon points="371.903 557.597 382.445 557.597 387.46 516.933 371.901 516.934 371.903 557.597"
                            fill="#9f616a" />
                        <path
                            d="M547.66455,719.47144l20.7617-.00084h.00084a13.23168,13.23168,0,0,1,13.231,13.23076v.43l-33.99289.00126Z"
                            transform="translate(-178.45119 -165.31613)" fill="#2f2e41" />
                        <polygon
                            points="424.424 557.252 434.559 554.349 428.184 513.876 413.226 518.161 424.424 557.252"
                            fill="#9f616a" />
                        <path
                            d="M599.34235,719.99967l19.95893-5.71742.00081-.00024a13.2317,13.2317,0,0,1,16.36256,9.07627l.11839.41333-32.67857,9.361Z"
                            transform="translate(-178.45119 -165.31613)" fill="#2f2e41" />
                        <path
                            d="M544.65572,708.15422l4.90409-123.1785-12.73593-55.74418c-17.13859-28.7351,1.35092-74.57013,1.53985-75.02995l.06876-.16759.17972-.02456,44.832-6.074.62973,1.44515a214.69124,214.69124,0,0,1,13.94748,127.51609l-4.66605,23.86585,23.06132,93.11029-21.82566,10.91291-16.74555-43.4245L566.52636,705.79Z"
                            transform="translate(-178.45119 -165.31613)" fill="#2f2e41" />
                        <path
                            d="M532.459,465.6262l-14.62586-42.85509c-9.09235-16.01207-3.3251-30.22752,3.11438-39.33307,6.95394-9.83243,7.3714-15.34659,7.46364-15.40768l.07444-.04911,19.21593-.58229,17.78443,18.07143c1.1187-.4371,10.568,22.84952,9.767,24.02026l12.421,40.152Z"
                            transform="translate(-178.45119 -165.31613)" fill="#cbcbcb" />
                        <path
                            d="M650.88561,473.03769l-48.17993-37.26808L565.551,391.92034,549.50639,407.5705,593.40674,452.817l52.376,30.1644a8.79767,8.79767,0,1,0,5.1029-9.94375Z"
                            transform="translate(-178.45119 -165.31613)" fill="#9f616a" />
                        <path
                            d="M544.94672,423.42644l-13.42486-19.07371a17.49724,17.49724,0,0,1,27.36746-21.71625l17.199,19.28682Z"
                            transform="translate(-178.45119 -165.31613)" fill="#cbcbcb" />
                        <circle cx="357.38226" cy="174.00948" r="22.81899" fill="#9f616a" />
                        <path
                            d="M559.03585,327.74915H522.802V311.95491c7.95292-3.15955,15.73526-5.84657,20.4396,0a15.79433,15.79433,0,0,1,15.79424,15.79423Z"
                            transform="translate(-178.45119 -165.31613)" fill="#2f2e41" />
                        <path
                            d="M527.796,308.16769c-33.19817-.90658-26.9117,53.78567-26.9117,53.78567s6.26341.82834,9.12141,1.315l3.45152-1.94369,3.71386,2.43573c1.70527.00851,3.49673-.0245,5.354-.059l1.70255-3.50569,3.79659,3.4428c6.91068.01028,25.66641.20072,25.66641.20072S564.99338,309.18349,527.796,308.16769Z"
                            transform="translate(-178.45119 -165.31613)" fill="#2f2e41" />
                        <path d="M796.63279,733.74644h-381a1,1,0,0,1,0-2h381a1,1,0,0,1,0,2Z"
                            transform="translate(-178.45119 -165.31613)" fill="#cbcbcb" />
                    </svg>
                </div>
            </div>

        </section>

        <section id="bootom-nav" class="bg-green-300 rounded-lg border-2 m-5 flex flex-row justify-center">
            <div
                class="h-[80px] container mx-px px-4 my-4 flex flex-col justify-center content-center place-items-center">
                <h1 class="text-lg font-semibold">Copyright © 2022 Raden Mohamad Rishwan.</h1>
                <ul class="flex justify-center gap-5 mt-5">
                    <li><i class="fa-brands fa-2xl fa-facebook-square"></i></li>
                    <li><i class="fa-brands fa-2xl fa-github"></i></li>
                    <li><i class="fa-brands fa-2xl fa-linkedin"></i></li>
                    <li><i class="fa-brands fa-2xl fa-instagram-square"></i></li>
                </ul>
            </div>
        </section>
    </div>

    <script src="{{ URL::asset('js/home.js') }}"></script>
</body>

</html>