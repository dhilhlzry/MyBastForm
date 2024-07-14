<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('tailwind/output.css') }}" media="all">
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }

            #body {
                margin: 0px 0px;
                background-color: white;
            }

            #wrap {
                background-color: white;
                border: none;
            }

            #header {
                margin-top: 20px;
                margin-left: 10px;
                margin-right: 10px;
                margin-bottom: 40px;
            }

            #table {
                margin-top: 20px;
                margin-left: 10px;
                margin-right: 10px;
            }

            #footer {
                display: none;
            }
        }

        .wrap {
            background-color: white;
            border: 1px solid slategray;
        }

        .pihak {
            border-collapse: collapse;
            width: auto;
            margin-top: 15px;
            width: 100%;

        }

        .pihak td {
            text-align: left;
            height: 18px;
            padding-left: 15px;
        }

        .detail {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px
        }

        .detail th {
            border: 1px solid black;
            text-align: left;
            padding: 18px;
            background-color: #b0ec4c;
        }

        .detail td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }
    </style>
    <title>MoM - Document</title>
</head>

<body id="body" class="bg-[#f9fbfd] my-20 mx-60">
    <div id="wrap" class="wrap">
        <section id="header"
            class="mt-[{{ $set->margin_y }}] mx-[{{ $set->margin_x }}] font-sans border-black border-[1px]">
            <div class="flex">
                <div class="w-1/3 h-30 text-wrap border-r">
                    <img class="mx-auto mt-3 w-20" src="{{ asset('img/smooets_logo.jpg') }}" alt="Image">
                    {{-- <h4 class="font-semibold text-sm text-center">PT. smooets_2 Teknologi <br> Outsourcing</h4> --}}
                </div>
                <div class="w-full gap-1">
                    <div class="h-20 text-wrap border-black border-[1px] border-r-0 border-t-0">
                        <h4 class="font-normal text-2xl text-center py-6">Smooets PHP Outsourcing Indonesia</h4>
                    </div>
                    <div>
                        <div class="w-full h-8 text-wrap border-black border-[1px] border-b-0 border-t-0 border-r-0">
                            <h4 class="text-sm font-bold text-center py-1">Minutes of Meeting (MoM) -
                                {{ $cetak->title }} Sprint 1
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="table" class="mt-[{{ $set->col1_mt }}] mx-[{{ $set->margin_x }}] font-sans">
            <table class="pihak">
                <tr>
                    <td class="w-1/3 bg-smooets_2 font-bold text-sm border-black border-[1px] border-r-0">Date of
                        Meeting
                    </td>
                    <td class="w-2/3 font-bold text-sm border-black border-[1px] border-l-0">
                        {{ \Carbon\Carbon::parse($cetak->date)->locale('id')->isoFormat('dddd, D MMMM Y') }}</td>
                </tr>
                <tr>
                    <td class="w-1/3 bg-smooets_2 font-bold text-sm border-black border-[1px] border-r-0">Time Of
                        Metting
                    </td>
                    <td class="w-2/3 font-bold text-sm border-black border-[1px] border-l-0"> {{ $waktu->selisih }}
                        Minutes</td>
                    {{-- <td class="w-2/3 border-black border-[1px] border-l-0"> {{$time}}</td> --}}
                </tr>
                <tr>
                    <td class="w-1/3 bg-smooets_2 font-bold text-sm border-black border-[1px] border-r-0">Location
                    </td>
                    <td class="w-2/3 font-semibold text-sm border-black border-[1px] border-l-0">
                        {{ $cetak->location }}.</td>
                </tr>
                <tr>
                    <td
                        class="w-1/3 bg-smooets_2 font-bold text-sm border-black border-[1px] border-r-0 place-content-start">
                        Attendance
                    </td>
                    <td class="w-2/3 text-sm border-black border-[1px] border-l-0">{!! $cetak->attendance !!}
                    </td>
                </tr>
            </table>
        </section>
        <section id="table" class="mt-[{{ $set->col2_mt }}] mx-[{{ $set->margin_x }}] font-sans">
            <table class="detail">
                <tr>
                    <th class="font-bold text-sm">Detailed Meeting Minutes</th>
                </tr>
                <tr>
                    <td class="font-semibold text-sm">
                        <div class="ml-16">{{ $cetak->time_awal }} - {{ $cetak->time_akhir }}</div>
                    </td>
                </tr>
            </table>
        </section>
        <section id="table" class="mt-[{{ $set->col3_mt }}] mx-[{{ $set->margin_x }}] font-sans">
            <table class="detail">
                <tr>
                    <th class="font-bold text-sm">Actions Plan</th>
                </tr>
                <tr>
                    <td class="text-sm"><span class="font-bold">General : </span>
                        <div class="ml-16 mb-3 max-w-lg max-h-fit">
                            {!! $cetak->plan !!}
                        </div>
                    </td>
                </tr>
            </table>
        </section>
        <section id="table" class="mt-[{{ $set->col4_mt }}] mx-[{{ $set->margin_x }}] font-sans">
            <p class="text-sm italic">*Notes : Apabila dalam 3 hari tidak ada feedback maka dokumen
                ini dinyatakan valid dan telah disetujui </p>
        </section>
        <footer class="mt-12 mb-[{{ $set->margin_y }}] mx-[{{ $set->margin_x }}] font-sans">
            <center>
                @if (@$from == 'project')
                    <a href="{{ route('bast.view', $p_selected) }}" id="footer"
                        class="text-base font-semibold text-white bg-green-700 py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">
                        Kembali</a>
                @elseif (@$from == 'bast')
                    <a href="{{ route('bast.detail', $b_selected) }}" id="footer"
                        class="text-base font-semibold text-white bg-green-700 py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">
                        Kembali</a>
                @elseif (@$from == 'settings')
                    <a href="{{ route('settings.index') }}" id="footer"
                        class="text-base font-semibold text-white bg-green-700 py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">
                        Kembali</a>
                @else
                    <a href="{{ route('mom.index') }}" id="footer"
                        class="text-base font-semibold text-white bg-green-700 py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">
                        Kembali</a>
                @endif

                {{-- <a href="" id="footer" onclick=" window.print()"
                    class="text-base font-semibold text-white bg-green-700 py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">
                    Print Document</a> --}}
            </center>
        </footer>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
