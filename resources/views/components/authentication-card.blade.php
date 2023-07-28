<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 {{-- bg-gray-800 --}} bg-gray-900 bg-opacity-75">
    <style>
        body{
            background: url("https://static.vecteezy.com/system/resources/previews/013/614/661/non_2x/abstract-computer-technology-background-with-circuit-board-and-circle-tech-illustration-vector.jpg");
            background-repeat: no-repeat;
            background-size: 100vw 100vh;
            z-index: -3;
            background-attachment: fixed;
        }
    </style>
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-900 bg-opacity-40 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
