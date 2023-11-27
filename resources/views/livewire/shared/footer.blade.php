<div>

    @if($reviews->count())
        <section class="flex overflow-x-hidden justify-center items-center py-20 bg-center bg-cover min-w-screen max-w-screen"
                 style="background-image: url({{ asset('design/3d-abstract-flow-background.jpg') }})"
        >
            <div>
                <div class="flex flex-col items-center mx-auto">
                    <p class="flex relative justify-center items-center w-full text-lg font-bold tracking-wider uppercase text-slate-200"
                    >Don't just take our word for it</p>


                    <h2 class="flex relative justify-center w-full max-w-3xl font-bold text-teal-400 lg:text-5xl">
                        See what others are saying
                    </h2>
                    <div class="block mt-6 w-full max-w-lg h-0.5 bg-teal-100 rounded-full"
                         data-primary="purple-600"
                    ></div>

                    <div class="overflow-x-scroll mt-12 mb-4 w-full no-scrollbar animate-ticker"

                    >
                        <div class="flex justify-center items-center space-x-6">
                            @foreach($reviews as $review)
                                @for($i = 0; $i < 30;$i++)
                                    <div class="flex flex-col justify-start items-start p-4 mb-12 h-auto rounded-lg lg:mb-0 min-w-[450px] max-w-[450px] bg-teal-900/60 backdrop-blur-2xl">
                                        <div class="flex justify-center items-center">
                                            <div class="flex overflow-hidden justify-center items-center mr-4 w-12 h-12 bg-black rounded-full ring ring-teal-200">
                                                <p class="text-yellow-300 uppercase">{{ $review->initials }}</p>
                                            </div>
                                            <div class="flex flex-col justify-center items-start">
                                                <h4 class="font-bold capitalize text-slate-300">{{ $review->name }}</h4>
                                                <div class="flex space-x-1">

                                                    @for($count = 0;$count < $review->rating;$count++)
                                                        <p class="text-yellow-300">&star;</p>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <blockquote class="mt-8 text-lg text-gray-300">
                                            {!! $review->body !!}
                                        </blockquote>
                                    </div>
                                @endfor
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <div
        class="grid grid-cols-1 py-2 bg-black lg:grid-cols-3 lg:px-16"
        id="logo-grid"
    >
        <div class="flex justify-center items-center py-2 px-6 w-full lg:py-1">
            <img src="{{ asset('design/yoco.svg') }}"
                 alt="Yoco"
                 class="h-8 lg:w-full drop-shadow dark:mix-blend-screen"
            >
        </div>

        <div class="flex justify-center items-center py-2 px-6 w-full lg:py-1">
            <img src="{{ asset('design/Ozow-Logo-Colour_OnBlack.png') }}"
                 alt="ozow gateway logo"
                 class="h-8 drop-shadow"
            >
        </div>

        <div class="flex justify-center items-center py-2 w-full lg:py-1 lg:px-6 lg:rounded-r-full">
            <img src="{{ asset('design/courier-guy.svg') }}"
                 alt="Yoco"
                 class="h-10 lg:w-full drop-shadow dark:mix-blend-screen"
            >
        </div>
    </div>

    <div class="px-4 w-full bg-black lg:py-10">
        <div class="grid grid-cols-1 lg:grid-cols-4">
            <div class="pb-2 lg:col-span-2">
                <div class="lg:px-4">
                    <x-application-logo
                        class="w-32 lg:w-72"
                        dark="true"
                    />
                </div>
                <div class="flex-col mt-4 space-y-3">
                    <div class="lg:px-4">
                        <a href="https://instagram.com/puffdaddy_distro?igshid=YmMyMTA2M2Y=">
                            <div class="flex justify-between items-center p-1 rounded border border-teal-400 hover:bg-teal-600 max-w-[280px]">
                                <div>
                                    <p class="font-semibold text-white">Follow us on Instagram</p>
                                </div>
                                <div>
                                    <img
                                        src="{{ asset('design/instagram.svg') }}"
                                        alt=""
                                        class="p-0.5 h-8 bg-black rounded"
                                    >
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="lg:px-4">
                        <a href="https://www.tiktok.com/@puffdaddy_distro">
                            <div class="flex justify-between items-center p-1 rounded border border-teal-400 hover:bg-teal-600 max-w-[280px]">
                                <div>
                                    <p class="font-semibold text-white">Find us on TikTok</p>
                                </div>
                                <div>
                                    <img
                                        src="{{ asset('design/tiktok.png') }}"
                                        alt=""
                                        class="p-0.5 h-8 bg-black rounded"
                                    >
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="lg:px-4">
                        <a href="https://wa.me/+2765444843">
                            <div class="flex justify-between items-center p-1 rounded border border-teal-400 hover:bg-teal-600 max-w-[280px]">
                                <div>
                                    <p class="font-semibold text-white">Chat on whatsapp</p>
                                </div>
                                <div>
                                    <img
                                        src="{{ asset('design/whatsapp.svg') }}"
                                        alt=""
                                        class="p-0.5 h-8 bg-black rounded"
                                    >
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="lg:px-4">
                <h2 class="font-semibold text-white">Featured Brands</h2>
                <div class="py-2">
                    <ul>
                        @foreach($brands as $brand)
                            <li>
                                <a href="{{ route('preview',$brand->page->id) }}"
                                   wire:navigate
                                   class="text-teal-500 hover:text-teal-600"
                                >{{ $brand->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="flex-col space-y-3 lg:px-4">
                <h2 class="font-semibold text-white">Our Company</h2>
                <div>
                    <a
                        href="{{ route('about') }}"
                        class="text-teal-500 hover:text-teal-600"
                        wire:navigate
                    >About us</a>
                </div>
                <div>
                    <a
                        href="{{ route('contact') }}"
                        class="text-teal-500 hover:text-teal-600"
                        wire:navigate
                    >Contact us</a>
                </div>
                <div>
                    <a
                        href="{{ route('returns') }}"
                        class="text-teal-500 hover:text-teal-600"
                        wire:navigate
                    >Returns</a>
                </div>
                <div>
                    <a
                        href="{{ route('privacy') }}"
                        class="text-teal-500 hover:text-teal-600"
                        wire:navigate
                    >Privacy Policy</a>
                </div>
                <div>
                    <a
                        href="{{ route('terms') }}"
                        class="text-teal-500 hover:text-teal-600"
                        wire:navigate
                    >Terms & Conditions</a>
                </div>
            </div>
        </div>
    </div>


    <div class="flex justify-between items-center p-2 w-screen bg-black">
        <div class="pl-4 text-center lg:text-left">
            <p class="text-sm font-bold text-white uppercase whitespace-nowrap">
                &copy; {{ date('Y') }} {{ config('app.name') }}
            </p>
        </div>
        <div>
            <a
                href="https://www.dezinehq.com"
                target="blank"
                title="Dezine HQ"
                class="text-sm text-white fill-white"
                id="developer_link_on_footer"
            >

                <svg
                    class="hidden h-4 dark:block"
                    width="100%"
                    height="100%"
                    viewBox="0 0 2146 267"
                    xmlns="http://www.w3.org/2000/svg"
                    xml:space="preserve"
                    style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;"
                >
    <g transform="matrix(1.33333,0,0,1.33333,-201.604,-1600.34)">
        <g transform="matrix(1,0,0,1,0,751.555)">
            <g transform="matrix(0.680322,0,0,0.680322,-46.6572,-225.482)">
                <g transform="matrix(1,0,0,1,-208.671,-165.819)">
                    <path
                        d="M499.504,1360.36L507.874,1360.18L509.873,1360.12C509.873,1360.12 747.853,1359.89 747.92,1359.89C747.95,1359.89 747.979,1359.89 748.009,1359.89C749.031,1359.94 758.595,1360.02 758.676,1346.44C758.762,1332.09 758.762,1331.95 758.762,1331.95L758.848,1235.03C758.848,1235.03 757.269,1222 745.678,1222.16C734.087,1222.32 499.504,1221.31 499.504,1221.31L499.504,1182.38C499.505,1175.44 504.251,1169.4 510.996,1167.75C510.996,1167.75 510.996,1167.75 510.996,1167.75C519.553,1165.66 755.357,1167.46 755.357,1167.46C755.357,1167.46 816.744,1169.65 816.69,1241.57C816.635,1313.49 816.229,1351.61 816.229,1351.61C816.229,1351.61 820.118,1413.34 754.347,1413.43C700.271,1413.5 564.016,1413.66 517.275,1413.71L517.291,1413.73L499.504,1413.73L499.504,1360.36Z"
                        style="fill:white;"
                    />
                </g>
                <g transform="matrix(1,0,0,1,-208.671,-165.819)">
                    <g id="E1">
                        <path
                            d="M840.494,1407.58C840.369,1401.52 840.47,1378.8 840.499,1372.99C840.506,1371.04 841.018,1369.13 841.984,1367.44C843.354,1365.09 845.905,1362.62 850.621,1362.64C859.271,1362.67 1092.77,1362.43 1110.49,1362.42C1111.67,1362.41 1112.85,1362.6 1113.98,1362.96C1116.9,1363.9 1121.43,1366.36 1121.47,1372.58C1121.52,1380.44 1121.42,1399.18 1121.39,1404.45C1121.38,1406.38 1120.93,1408.28 1120.07,1410C1118.94,1412.22 1116.93,1414.51 1113.43,1414.53C1106.62,1414.55 850.58,1414.59 850.507,1414.59C850.507,1414.59 850.506,1414.59 850.506,1414.59C850.358,1414.59 840.637,1414.49 840.494,1407.58ZM840.494,1310.17C840.367,1304.02 840.473,1280.69 840.5,1275.33C840.506,1274.14 840.722,1272.97 841.137,1271.86C842.142,1269.19 844.641,1265.21 850.621,1265.23C859.271,1265.26 1092.77,1265.03 1110.49,1265.01C1111.67,1265.01 1112.85,1265.19 1113.98,1265.55C1116.9,1266.5 1121.43,1268.95 1121.47,1275.18C1121.52,1283.11 1121.42,1302.12 1121.39,1307.19C1121.38,1308.51 1121.15,1309.82 1120.71,1311.07C1119.79,1313.61 1117.76,1317.1 1113.43,1317.12C1106.62,1317.14 850.58,1317.18 850.507,1317.18C850.507,1317.18 850.506,1317.18 850.506,1317.18C850.358,1317.18 840.637,1317.08 840.494,1310.17ZM840.494,1212.76C840.369,1206.7 840.47,1183.99 840.499,1178.17C840.506,1176.23 841.018,1174.32 841.984,1172.63C843.354,1170.28 845.905,1167.8 850.621,1167.82C859.271,1167.85 1092.77,1167.62 1110.49,1167.6C1111.67,1167.6 1112.85,1167.78 1113.98,1168.14C1116.9,1169.09 1121.43,1171.55 1121.47,1177.77C1121.52,1185.62 1121.42,1204.37 1121.39,1209.64C1121.38,1211.57 1120.93,1213.46 1120.07,1215.18C1118.94,1217.4 1116.93,1219.7 1113.43,1219.71C1106.62,1219.73 850.58,1219.78 850.507,1219.78C850.507,1219.78 850.506,1219.78 850.506,1219.78C850.358,1219.77 840.637,1219.67 840.494,1212.76Z"
                            style="fill:white;"
                        />
                    </g>
                </g>
                <g
                    id="I"
                    transform="matrix(5.3811e-17,0.878801,-1,6.12323e-17,1953.97,440.71)"
                >
                    <path
                        d="M638.512,705.587C638.384,699.421 638.492,675.998 638.518,670.704C638.524,669.552 638.735,668.408 639.142,667.313C640.137,664.642 642.633,660.624 648.639,660.646C657.265,660.679 889.499,660.444 908.354,660.425C909.693,660.424 911.021,660.64 912.271,661.063C915.194,662.069 919.45,664.565 919.49,670.593C919.542,678.538 919.435,697.611 919.405,702.637C919.396,703.944 919.169,705.244 918.731,706.493C917.807,709.036 915.769,712.521 911.446,712.534C904.634,712.554 648.597,712.599 648.525,712.599C648.524,712.599 648.524,712.599 648.523,712.599C648.355,712.598 638.655,712.491 638.512,705.587Z"
                        style="fill:white;"
                    />
                </g>
                <g transform="matrix(1,0,0,1,-208.671,-165.819)">
                    <g id="Z">
                        <path
                            d="M1151.88,1361.74C1152.38,1361.19 1152.95,1360.64 1153.62,1360.12C1159.05,1355.85 1263.73,1272.7 1330.4,1219.74C1253.94,1219.76 1155.35,1219.78 1155.3,1219.78C1155.3,1219.78 1155.3,1219.78 1155.3,1219.78C1155.15,1219.77 1145.43,1219.67 1145.29,1212.76C1145.16,1206.7 1145.27,1183.99 1145.3,1178.17C1145.3,1176.23 1145.81,1174.32 1146.78,1172.63C1148.15,1170.28 1150.7,1167.8 1155.42,1167.82C1164.07,1167.85 1397.57,1167.62 1415.28,1167.6C1416.47,1167.6 1417.64,1167.78 1418.77,1168.14C1421.69,1169.09 1426.23,1171.55 1426.27,1177.77C1426.32,1185.62 1426.21,1204.37 1426.18,1209.64C1426.18,1210.06 1426.16,1210.47 1426.12,1210.88C1426.11,1211.32 1426.08,1211.82 1426.04,1212.32C1425.95,1213.38 1425.81,1214.49 1425.71,1215.24C1425.69,1215.5 1425.65,1215.76 1425.6,1216.02C1425.59,1216.1 1425.59,1216.14 1425.59,1216.14C1425.59,1216.14 1425.59,1216.14 1425.58,1216.13C1425.26,1217.75 1424.43,1219.35 1422.77,1220.67C1418.65,1223.96 1311.48,1308.95 1243.87,1362.58C1314.95,1362.52 1404.57,1362.43 1415.28,1362.42C1416.47,1362.41 1417.64,1362.6 1418.77,1362.96C1421.69,1363.9 1426.23,1366.36 1426.27,1372.58C1426.32,1380.44 1426.21,1399.18 1426.18,1404.45C1426.18,1406.38 1425.72,1408.28 1424.86,1410C1423.73,1412.22 1421.73,1414.51 1418.22,1414.53C1411.41,1414.55 1155.38,1414.59 1155.3,1414.59C1155.3,1414.59 1155.3,1414.59 1155.3,1414.59C1155.15,1414.59 1145.43,1414.49 1145.29,1407.58C1145.16,1401.52 1145.27,1378.8 1145.3,1372.99C1145.3,1371.04 1145.81,1369.13 1146.78,1367.44C1147.12,1366.85 1147.54,1366.25 1148.05,1365.69C1148.22,1365.41 1148.92,1364.72 1148.99,1364.65C1149.95,1363.68 1150.92,1362.71 1151.88,1361.74Z"
                            style="fill:white;"
                        />
                    </g>
                </g>
                <g transform="matrix(1,0,0,1,-208.671,-165.819)">
                    <g id="N">
                        <path
                            d="M1583.05,1248.72L1588.4,1253.65C1588.48,1314.74 1588.58,1391.49 1588.6,1402.86C1588.6,1405.15 1587.77,1407.36 1586.26,1409.08C1584.53,1411.07 1581.54,1412.93 1576.45,1412.96C1567.01,1413 1544.39,1412.91 1538.26,1412.88C1536.16,1412.88 1534.09,1412.53 1532.1,1411.85C1529.34,1410.9 1526.36,1409.13 1526.35,1405.93C1526.32,1399.98 1526.27,1176.38 1526.27,1176.3C1526.27,1176.3 1526.27,1176.3 1526.27,1176.3C1526.27,1176.12 1526.41,1167.68 1534.65,1167.55C1542.27,1167.44 1571.96,1167.54 1576.9,1167.56C1577.63,1167.56 1578.36,1167.63 1579.08,1167.77C1579.83,1167.93 1580.8,1168.17 1581.82,1168.55L1581.81,1168.54L1582.86,1168.94C1582.86,1168.94 1583.02,1169.03 1583.29,1169.17C1583.82,1169.43 1584.34,1169.72 1584.83,1170.06C1585.37,1170.39 1585.97,1170.77 1586.57,1171.19C1587.63,1171.92 1588.86,1172.84 1589.72,1173.5C1590.25,1173.88 1590.77,1174.29 1591.28,1174.77C1598.48,1181.46 1794.69,1362.02 1808.4,1374.64L1759.05,1329.23C1759.03,1262.46 1759.01,1176.35 1759.01,1176.3C1759.01,1176.3 1759.01,1176.3 1759.01,1176.3C1759.01,1176.12 1759.16,1167.68 1767.39,1167.55C1775.01,1167.44 1804.7,1167.54 1809.64,1167.56C1810.38,1167.56 1811.11,1167.63 1811.83,1167.77C1814.78,1168.39 1821.11,1170.37 1821.08,1176.4C1821.04,1183.88 1821.32,1383.94 1821.34,1402.86C1821.35,1405.15 1820.52,1407.36 1819.01,1409.08C1817.27,1411.07 1814.29,1412.93 1809.2,1412.96C1805.68,1412.98 1800.34,1412.97 1794.71,1412.96L1794.74,1412.97L1770.2,1412.97C1770.2,1412.97 1760.34,1412.18 1756.45,1408.52C1756.38,1408.47 1756.32,1408.41 1756.26,1408.35C1752.26,1404.69 1646.21,1306.94 1583.05,1248.72L1536.88,1206.15C1536.9,1206.17 1556.06,1223.83 1583.05,1248.72Z"
                            style="fill:white;"
                        />
                    </g>
                </g>
                <g transform="matrix(1,0,0,1,-208.671,-165.819)">
                    <g id="E2">
                        <path
                            d="M1845.15,1407.58C1845.02,1401.52 1845.12,1378.8 1845.15,1372.99C1845.16,1371.04 1845.67,1369.13 1846.64,1367.44C1848.01,1365.09 1850.56,1362.62 1855.27,1362.64C1863.92,1362.67 2097.43,1362.43 2115.14,1362.42C2116.32,1362.41 2117.5,1362.6 2118.63,1362.96C2121.55,1363.9 2126.09,1366.36 2126.13,1372.58C2126.18,1380.44 2126.07,1399.18 2126.04,1404.45C2126.03,1406.38 2125.58,1408.28 2124.72,1410C2123.59,1412.22 2121.59,1414.51 2118.08,1414.53C2111.27,1414.55 1855.23,1414.59 1855.16,1414.59C1855.16,1414.59 1855.16,1414.59 1855.16,1414.59C1855.01,1414.59 1845.29,1414.49 1845.15,1407.58ZM1845.15,1310.17C1845.02,1304.11 1845.12,1281.4 1845.15,1275.58C1845.16,1273.64 1845.67,1271.73 1846.64,1270.04C1848.01,1267.68 1850.56,1265.21 1855.27,1265.23C1863.92,1265.26 2097.43,1265.03 2115.14,1265.01C2116.32,1265.01 2117.5,1265.19 2118.63,1265.55C2121.55,1266.5 2126.09,1268.95 2126.13,1275.18C2126.18,1283.03 2126.07,1301.77 2126.04,1307.05C2126.03,1308.97 2125.58,1310.87 2124.72,1312.59C2123.59,1314.81 2121.59,1317.11 2118.08,1317.12C2111.27,1317.14 1855.23,1317.18 1855.16,1317.18C1855.16,1317.18 1855.16,1317.18 1855.16,1317.18C1855.01,1317.18 1845.29,1317.08 1845.15,1310.17ZM1845.15,1212.76C1845.02,1206.7 1845.12,1183.99 1845.15,1178.17C1845.16,1176.23 1845.67,1174.32 1846.64,1172.63C1848.01,1170.28 1850.56,1167.8 1855.27,1167.82C1863.92,1167.85 2097.43,1167.62 2115.14,1167.6C2116.32,1167.6 2117.5,1167.78 2118.63,1168.14C2121.55,1169.09 2126.09,1171.55 2126.13,1177.77C2126.18,1185.62 2126.07,1204.37 2126.04,1209.64C2126.03,1211.57 2125.58,1213.46 2124.72,1215.18C2123.59,1217.4 2121.59,1219.7 2118.08,1219.71C2111.27,1219.73 1855.23,1219.78 1855.16,1219.78C1855.16,1219.78 1855.16,1219.78 1855.16,1219.78C1855.01,1219.77 1845.29,1219.67 1845.15,1212.76Z"
                            style="fill:white;"
                        />
                    </g>
                </g>
                <g
                    id="H"
                    transform="matrix(1,0,0,0.956888,-197.079,374.701)"
                >
                    <path
                        d="M2197.47,894.962C2197.54,880.14 2197.44,670.76 2197.44,670.76C2197.44,670.76 2201.44,654.58 2212.7,654.393C2223.96,654.205 2252.13,654.096 2252.13,654.096C2252.13,654.096 2267.34,657.399 2267.5,670.43C2267.67,683.461 2267.59,749.679 2267.59,749.679C2267.59,749.679 2267.46,750.659 2268.55,750.667C2269.64,750.676 2436.52,750.758 2436.52,750.758L2437.65,750.744L2437.61,671.679C2437.61,671.679 2440.33,653.782 2456.58,653.817C2472.83,653.852 2489.39,653.641 2489.39,653.641C2489.39,653.641 2508.86,654.632 2508.51,671.71C2508.16,688.789 2508.58,895.599 2508.58,895.599C2508.58,895.599 2506.64,911.829 2493.44,911.71C2480.23,911.592 2480.21,911.592 2480.21,911.592L2453.55,911.759C2453.55,911.759 2437.58,911.775 2437.62,895.679C2437.67,879.582 2437.5,815.642 2437.5,815.642L2267.45,815.488L2267.63,896.586C2267.63,896.586 2266.7,911.524 2253.43,911.656C2240.16,911.788 2212.6,911.623 2212.6,911.623C2212.6,911.623 2197.4,909.784 2197.47,894.962Z"
                        style="fill:white;stroke:white;stroke-width:19px;"
                    />
                </g>
                <g
                    id="Q"
                    transform="matrix(1,0,0,1,-203.742,335.628)"
                >
                    <path
                        d="M2808.36,940.177L2759.44,940.177L2742.79,901.814L2600.87,900.634C2600.87,900.634 2551.21,895.655 2550.91,851.864C2550.6,808.073 2551.24,714.266 2551.24,714.266C2551.24,714.266 2552,664.203 2607.17,664.602C2662.35,665.001 2795.6,664.542 2795.6,664.542C2795.6,664.542 2849.26,662.685 2849.76,718.262C2850.26,773.838 2850.42,849.732 2850.42,849.732C2850.42,849.732 2847.78,871.807 2839.46,880.14C2831.14,888.474 2834.4,886.158 2831.14,888.474C2827.89,890.79 2822.11,894.409 2822.11,894.409L2802.77,848.912L2803.66,724.26C2803.66,724.26 2799.24,706.451 2781.58,706.448C2763.92,706.444 2617.68,706.714 2617.68,706.714C2617.68,706.714 2597.6,706.632 2597.55,722.844C2597.51,739.056 2597.6,842.703 2597.6,842.703C2597.6,842.703 2596.88,859.869 2616.71,859.753C2636.53,859.638 2719.72,859.59 2719.72,859.59C2719.72,859.59 2727.68,860.72 2724.33,851.514C2720.98,842.307 2718.52,836.573 2718.52,836.573L2768.3,836.651L2808.36,940.177Z"
                        style="fill:white;stroke:white;stroke-width:18px;"
                    />
                </g>
            </g>
        </g>
    </g>
</svg>

                <svg
                    class="block h-4 dark:hidden"
                    width="100%"
                    height="100%"
                    viewBox="0 0 2146 267"
                    xmlns="http://www.w3.org/2000/svg"
                    xml:space="preserve"
                    style="fill-rule:evenodd;clip-rule:evenodd;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:1.5;"
                >
    <g transform="matrix(1.33333,0,0,1.33333,-201.604,-598.268)">
        <g transform="matrix(0.680322,0,0,0.680322,-46.6572,-225.482)">
            <g transform="matrix(1,0,0,1,-208.671,-165.819)">
                <path
                    d="M499.504,1360.36L507.874,1360.18L509.873,1360.12C509.873,1360.12 747.853,1359.89 747.92,1359.89C747.95,1359.89 747.979,1359.89 748.009,1359.89C749.031,1359.94 758.595,1360.02 758.676,1346.44C758.762,1332.09 758.762,1331.95 758.762,1331.95L758.848,1235.03C758.848,1235.03 757.269,1222 745.678,1222.16C734.087,1222.32 499.504,1221.31 499.504,1221.31L499.504,1182.38C499.505,1175.44 504.251,1169.4 510.996,1167.75C510.996,1167.75 510.996,1167.75 510.996,1167.75C519.553,1165.66 755.357,1167.46 755.357,1167.46C755.357,1167.46 816.744,1169.65 816.69,1241.57C816.635,1313.49 816.229,1351.61 816.229,1351.61C816.229,1351.61 820.118,1413.34 754.347,1413.43C700.271,1413.5 564.016,1413.66 517.275,1413.71L517.291,1413.73L499.504,1413.73L499.504,1360.36Z"
                    style="fill:white;"
                />
            </g>
            <g transform="matrix(1,0,0,1,-208.671,-165.819)">
                <g id="E1">
                    <path
                        d="M840.494,1407.58C840.369,1401.52 840.47,1378.8 840.499,1372.99C840.506,1371.04 841.018,1369.13 841.984,1367.44C843.354,1365.09 845.905,1362.62 850.621,1362.64C859.271,1362.67 1092.77,1362.43 1110.49,1362.42C1111.67,1362.41 1112.85,1362.6 1113.98,1362.96C1116.9,1363.9 1121.43,1366.36 1121.47,1372.58C1121.52,1380.44 1121.42,1399.18 1121.39,1404.45C1121.38,1406.38 1120.93,1408.28 1120.07,1410C1118.94,1412.22 1116.93,1414.51 1113.43,1414.53C1106.62,1414.55 850.58,1414.59 850.507,1414.59C850.507,1414.59 850.506,1414.59 850.506,1414.59C850.358,1414.59 840.637,1414.49 840.494,1407.58ZM840.494,1310.17C840.367,1304.02 840.473,1280.69 840.5,1275.33C840.506,1274.14 840.722,1272.97 841.137,1271.86C842.142,1269.19 844.641,1265.21 850.621,1265.23C859.271,1265.26 1092.77,1265.03 1110.49,1265.01C1111.67,1265.01 1112.85,1265.19 1113.98,1265.55C1116.9,1266.5 1121.43,1268.95 1121.47,1275.18C1121.52,1283.11 1121.42,1302.12 1121.39,1307.19C1121.38,1308.51 1121.15,1309.82 1120.71,1311.07C1119.79,1313.61 1117.76,1317.1 1113.43,1317.12C1106.62,1317.14 850.58,1317.18 850.507,1317.18C850.507,1317.18 850.506,1317.18 850.506,1317.18C850.358,1317.18 840.637,1317.08 840.494,1310.17ZM840.494,1212.76C840.369,1206.7 840.47,1183.99 840.499,1178.17C840.506,1176.23 841.018,1174.32 841.984,1172.63C843.354,1170.28 845.905,1167.8 850.621,1167.82C859.271,1167.85 1092.77,1167.62 1110.49,1167.6C1111.67,1167.6 1112.85,1167.78 1113.98,1168.14C1116.9,1169.09 1121.43,1171.55 1121.47,1177.77C1121.52,1185.62 1121.42,1204.37 1121.39,1209.64C1121.38,1211.57 1120.93,1213.46 1120.07,1215.18C1118.94,1217.4 1116.93,1219.7 1113.43,1219.71C1106.62,1219.73 850.58,1219.78 850.507,1219.78C850.507,1219.78 850.506,1219.78 850.506,1219.78C850.358,1219.77 840.637,1219.67 840.494,1212.76Z"
                        style="fill:white;"
                    />
                </g>
            </g>
            <g
                id="I"
                transform="matrix(5.3811e-17,0.878801,-1,6.12323e-17,1953.97,440.71)"
            >
                <path
                    d="M638.512,705.587C638.384,699.421 638.492,675.998 638.518,670.704C638.524,669.552 638.735,668.408 639.142,667.313C640.137,664.642 642.633,660.624 648.639,660.646C657.265,660.679 889.499,660.444 908.354,660.425C909.693,660.424 911.021,660.64 912.271,661.063C915.194,662.069 919.45,664.565 919.49,670.593C919.542,678.538 919.435,697.611 919.405,702.637C919.396,703.944 919.169,705.244 918.731,706.493C917.807,709.036 915.769,712.521 911.446,712.534C904.634,712.554 648.597,712.599 648.525,712.599C648.524,712.599 648.524,712.599 648.523,712.599C648.355,712.598 638.655,712.491 638.512,705.587Z"
                    style="fill:white;"
                />
            </g>
            <g transform="matrix(1,0,0,1,-208.671,-165.819)">
                <g id="Z">
                    <path
                        d="M1151.88,1361.74C1152.38,1361.19 1152.95,1360.64 1153.62,1360.12C1159.05,1355.85 1263.73,1272.7 1330.4,1219.74C1253.94,1219.76 1155.35,1219.78 1155.3,1219.78C1155.3,1219.78 1155.3,1219.78 1155.3,1219.78C1155.15,1219.77 1145.43,1219.67 1145.29,1212.76C1145.16,1206.7 1145.27,1183.99 1145.3,1178.17C1145.3,1176.23 1145.81,1174.32 1146.78,1172.63C1148.15,1170.28 1150.7,1167.8 1155.42,1167.82C1164.07,1167.85 1397.57,1167.62 1415.28,1167.6C1416.47,1167.6 1417.64,1167.78 1418.77,1168.14C1421.69,1169.09 1426.23,1171.55 1426.27,1177.77C1426.32,1185.62 1426.21,1204.37 1426.18,1209.64C1426.18,1210.06 1426.16,1210.47 1426.12,1210.88C1426.11,1211.32 1426.08,1211.82 1426.04,1212.32C1425.95,1213.38 1425.81,1214.49 1425.71,1215.24C1425.69,1215.5 1425.65,1215.76 1425.6,1216.02C1425.59,1216.1 1425.59,1216.14 1425.59,1216.14C1425.59,1216.14 1425.59,1216.14 1425.58,1216.13C1425.26,1217.75 1424.43,1219.35 1422.77,1220.67C1418.65,1223.96 1311.48,1308.95 1243.87,1362.58C1314.95,1362.52 1404.57,1362.43 1415.28,1362.42C1416.47,1362.41 1417.64,1362.6 1418.77,1362.96C1421.69,1363.9 1426.23,1366.36 1426.27,1372.58C1426.32,1380.44 1426.21,1399.18 1426.18,1404.45C1426.18,1406.38 1425.72,1408.28 1424.86,1410C1423.73,1412.22 1421.73,1414.51 1418.22,1414.53C1411.41,1414.55 1155.38,1414.59 1155.3,1414.59C1155.3,1414.59 1155.3,1414.59 1155.3,1414.59C1155.15,1414.59 1145.43,1414.49 1145.29,1407.58C1145.16,1401.52 1145.27,1378.8 1145.3,1372.99C1145.3,1371.04 1145.81,1369.13 1146.78,1367.44C1147.12,1366.85 1147.54,1366.25 1148.05,1365.69C1148.22,1365.41 1148.92,1364.72 1148.99,1364.65C1149.95,1363.68 1150.92,1362.71 1151.88,1361.74Z"
                        style="fill:white;"
                    />
                </g>
            </g>
            <g transform="matrix(1,0,0,1,-208.671,-165.819)">
                <g id="N">
                    <path
                        d="M1583.05,1248.72L1588.4,1253.65C1588.48,1314.74 1588.58,1391.49 1588.6,1402.86C1588.6,1405.15 1587.77,1407.36 1586.26,1409.08C1584.53,1411.07 1581.54,1412.93 1576.45,1412.96C1567.01,1413 1544.39,1412.91 1538.26,1412.88C1536.16,1412.88 1534.09,1412.53 1532.1,1411.85C1529.34,1410.9 1526.36,1409.13 1526.35,1405.93C1526.32,1399.98 1526.27,1176.38 1526.27,1176.3C1526.27,1176.3 1526.27,1176.3 1526.27,1176.3C1526.27,1176.12 1526.41,1167.68 1534.65,1167.55C1542.27,1167.44 1571.96,1167.54 1576.9,1167.56C1577.63,1167.56 1578.36,1167.63 1579.08,1167.77C1579.83,1167.93 1580.8,1168.17 1581.82,1168.55L1581.81,1168.54L1582.86,1168.94C1582.86,1168.94 1583.02,1169.03 1583.29,1169.17C1583.82,1169.43 1584.34,1169.72 1584.83,1170.06C1585.37,1170.39 1585.97,1170.77 1586.57,1171.19C1587.63,1171.92 1588.86,1172.84 1589.72,1173.5C1590.25,1173.88 1590.77,1174.29 1591.28,1174.77C1598.48,1181.46 1794.69,1362.02 1808.4,1374.64L1759.05,1329.23C1759.03,1262.46 1759.01,1176.35 1759.01,1176.3C1759.01,1176.3 1759.01,1176.3 1759.01,1176.3C1759.01,1176.12 1759.16,1167.68 1767.39,1167.55C1775.01,1167.44 1804.7,1167.54 1809.64,1167.56C1810.38,1167.56 1811.11,1167.63 1811.83,1167.77C1814.78,1168.39 1821.11,1170.37 1821.08,1176.4C1821.04,1183.88 1821.32,1383.94 1821.34,1402.86C1821.35,1405.15 1820.52,1407.36 1819.01,1409.08C1817.27,1411.07 1814.29,1412.93 1809.2,1412.96C1805.68,1412.98 1800.34,1412.97 1794.71,1412.96L1794.74,1412.97L1770.2,1412.97C1770.2,1412.97 1760.34,1412.18 1756.45,1408.52C1756.38,1408.47 1756.32,1408.41 1756.26,1408.35C1752.26,1404.69 1646.21,1306.94 1583.05,1248.72L1536.88,1206.15C1536.9,1206.17 1556.06,1223.83 1583.05,1248.72Z"
                        style="fill:white;"
                    />
                </g>
            </g>
            <g transform="matrix(1,0,0,1,-208.671,-165.819)">
                <g id="E2">
                    <path
                        d="M1845.15,1407.58C1845.02,1401.52 1845.12,1378.8 1845.15,1372.99C1845.16,1371.04 1845.67,1369.13 1846.64,1367.44C1848.01,1365.09 1850.56,1362.62 1855.27,1362.64C1863.92,1362.67 2097.43,1362.43 2115.14,1362.42C2116.32,1362.41 2117.5,1362.6 2118.63,1362.96C2121.55,1363.9 2126.09,1366.36 2126.13,1372.58C2126.18,1380.44 2126.07,1399.18 2126.04,1404.45C2126.03,1406.38 2125.58,1408.28 2124.72,1410C2123.59,1412.22 2121.59,1414.51 2118.08,1414.53C2111.27,1414.55 1855.23,1414.59 1855.16,1414.59C1855.16,1414.59 1855.16,1414.59 1855.16,1414.59C1855.01,1414.59 1845.29,1414.49 1845.15,1407.58ZM1845.15,1310.17C1845.02,1304.11 1845.12,1281.4 1845.15,1275.58C1845.16,1273.64 1845.67,1271.73 1846.64,1270.04C1848.01,1267.68 1850.56,1265.21 1855.27,1265.23C1863.92,1265.26 2097.43,1265.03 2115.14,1265.01C2116.32,1265.01 2117.5,1265.19 2118.63,1265.55C2121.55,1266.5 2126.09,1268.95 2126.13,1275.18C2126.18,1283.03 2126.07,1301.77 2126.04,1307.05C2126.03,1308.97 2125.58,1310.87 2124.72,1312.59C2123.59,1314.81 2121.59,1317.11 2118.08,1317.12C2111.27,1317.14 1855.23,1317.18 1855.16,1317.18C1855.16,1317.18 1855.16,1317.18 1855.16,1317.18C1855.01,1317.18 1845.29,1317.08 1845.15,1310.17ZM1845.15,1212.76C1845.02,1206.7 1845.12,1183.99 1845.15,1178.17C1845.16,1176.23 1845.67,1174.32 1846.64,1172.63C1848.01,1170.28 1850.56,1167.8 1855.27,1167.82C1863.92,1167.85 2097.43,1167.62 2115.14,1167.6C2116.32,1167.6 2117.5,1167.78 2118.63,1168.14C2121.55,1169.09 2126.09,1171.55 2126.13,1177.77C2126.18,1185.62 2126.07,1204.37 2126.04,1209.64C2126.03,1211.57 2125.58,1213.46 2124.72,1215.18C2123.59,1217.4 2121.59,1219.7 2118.08,1219.71C2111.27,1219.73 1855.23,1219.78 1855.16,1219.78C1855.16,1219.78 1855.16,1219.78 1855.16,1219.78C1855.01,1219.77 1845.29,1219.67 1845.15,1212.76Z"
                        style="fill:white;"
                    />
                </g>
            </g>
            <g
                id="H"
                transform="matrix(1,0,0,0.956888,-197.079,374.701)"
            >
                <path
                    d="M2197.47,894.962C2197.54,880.14 2197.44,670.76 2197.44,670.76C2197.44,670.76 2201.44,654.58 2212.7,654.393C2223.96,654.205 2252.13,654.096 2252.13,654.096C2252.13,654.096 2267.34,657.399 2267.5,670.43C2267.67,683.461 2267.59,749.679 2267.59,749.679C2267.59,749.679 2267.46,750.659 2268.55,750.667C2269.64,750.676 2436.52,750.758 2436.52,750.758L2437.65,750.744L2437.61,671.679C2437.61,671.679 2440.33,653.782 2456.58,653.817C2472.83,653.852 2489.39,653.641 2489.39,653.641C2489.39,653.641 2508.86,654.632 2508.51,671.71C2508.16,688.789 2508.58,895.599 2508.58,895.599C2508.58,895.599 2506.64,911.829 2493.44,911.71C2480.23,911.592 2480.21,911.592 2480.21,911.592L2453.55,911.759C2453.55,911.759 2437.58,911.775 2437.62,895.679C2437.67,879.582 2437.5,815.642 2437.5,815.642L2267.45,815.488L2267.63,896.586C2267.63,896.586 2266.7,911.524 2253.43,911.656C2240.16,911.788 2212.6,911.623 2212.6,911.623C2212.6,911.623 2197.4,909.784 2197.47,894.962Z"
                    style="fill:white;stroke:rgb(15,23,42);stroke-width:19px;"
                />
            </g>
            <g
                id="Q"
                transform="matrix(1,0,0,1,-203.742,335.628)"
            >
                <path
                    d="M2808.36,940.177L2759.44,940.177L2742.79,901.814L2600.87,900.634C2600.87,900.634 2551.21,895.655 2550.91,851.864C2550.6,808.073 2551.24,714.266 2551.24,714.266C2551.24,714.266 2552,664.203 2607.17,664.602C2662.35,665.001 2795.6,664.542 2795.6,664.542C2795.6,664.542 2849.26,662.685 2849.76,718.262C2850.26,773.838 2850.42,849.732 2850.42,849.732C2850.42,849.732 2847.78,871.807 2839.46,880.14C2831.14,888.474 2834.4,886.158 2831.14,888.474C2827.89,890.79 2822.11,894.409 2822.11,894.409L2802.77,848.912L2803.66,724.26C2803.66,724.26 2799.24,706.451 2781.58,706.448C2763.92,706.444 2617.68,706.714 2617.68,706.714C2617.68,706.714 2597.6,706.632 2597.55,722.844C2597.51,739.056 2597.6,842.703 2597.6,842.703C2597.6,842.703 2596.88,859.869 2616.71,859.753C2636.53,859.638 2719.72,859.59 2719.72,859.59C2719.72,859.59 2727.68,860.72 2724.33,851.514C2720.98,842.307 2718.52,836.573 2718.52,836.573L2768.3,836.651L2808.36,940.177Z"
                    style="fill:white;stroke:rgb(15,23,42);stroke-width:18px;"
                />
            </g>
        </g>
    </g>
</svg>


            </a>
        </div>
    </div>

    <div class="py-4 mx-auto w-screen text-center bg-black">
        <p class="font-light tracking-wider text-slate-300 text-[11px]">
            Warning: Our products may contain nicotine. Nicotine is an addictive chemical. Not for sale to under 18's
        </p>
    </div>
</div>
