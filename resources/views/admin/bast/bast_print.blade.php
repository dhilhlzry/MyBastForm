<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('tailwind/output.css') }}">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }

            #body {
                margin: 0px 26px;
            }

            #wrap {
                background-color: white;
                border: none;
            }

            #header {
                margin-top: 70px;
                margin-left: 0px;
                margin-right: 0px;
            }

            #header1 {
                margin-top: 20px;
                margin-left: 0px;
                margin-right: 0px;
            }

            #table {
                margin-top: 40px;
                margin-left: 0px;
                margin-right: 0px;
            }

            #next {
                margin-bottom: 250px
            }

            #footer {
                display: none;
            }
        }

        .wrap {
            background-color: white;
            border: 1px solid slategray;
        }
    </style>
    <title>Bast - Document</title>
</head>

<body id="body" class="bg-[#f9fbfd] my-20 mx-48">
    <div id="wrap" class="wrap">
        <section id="header" class="mt-[{{ $set->margin_y }}] mx-[{{ $set->margin_x }}] font-sans border-black border-[1px]">
            <div class="flex">
                <div class="w-1/3 h-48 text-wrap border-black border-[1px] border-t-0 border-l-0 border-b-0">
                    <img class="mx-auto mt-5 mb-3 w-24" src="{{ asset('img/smooets_logo.jpg') }}" alt="Image">
                    <h4 class="font-semibold text-xs text-center">PT. Smoeets Teknologi <br> Outsourcing</h4>
                </div>
                <div class="w-full gap-1">
                    <div class="h-[120px] text-wrap border-black border-[1px] border-t-0 border-l-0 border-r-0">
                        <h4 class="font-semibold text-base text-center py-12">Formulir</h4>
                    </div>
                    <div>
                        <div class="flex">
                            <div class="w-2/3 h-9 text-wrap border-black border-[1px] border-t-0 border-l-0">
                                <h4 class="text-sm text-left py-2"><span class="pl-5 pr-14">No </span> :
                                    {{ $cetak->bast_no }}</h4>
                            </div>
                            <div class="w-1/3 h-9 text-wrap border border-black border-t-0 border-l-0 border-r-0">
                                <h4 class="text-sm text-left py-2"><span class="pl-5 pr-10">Revisi </span> :
                                    0{{ $cetak->revision }}</h4>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-2/3 h-9 text-wrap border border-black border-t-0 border-l-0 border-b-0">
                                <h4 class="text-sm text-left py-2"><span class="pl-5 pr-[28px]">Tanggal </span>
                                    :
                                    {{ \Carbon\Carbon::parse($cetak->bast_date)->locale('id')->isoFormat('D MMMM Y') }}
                                </h4>
                            </div>
                            <div
                                class="w-1/3 h-9 text-wrap border border-black border-t-0 border-l-0 border-b-0 border-r-0">
                                <h4 class="text-sm text-left py-2"><span class="pl-5 pr-[21px]">Halaman </span> : 1 / 2
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="header1" class="mt-[{{ $set->col1_mt }}] mx-[{{ $set->margin_x }}] font-sans">
            <div>
                <div class="w-full h-32 bg-smoeets">
                    <div class="text-left py-7 px-3">
                        <h2 class="font-semibold text-white text-3xl">Berita Acara Serah Terima
                            Hasil
                            Pekerjaan</h2>
                        <h4 class="text-lg text-white mt-2">Fase : Sprint {{ $cetak->sprint }}</h4>
                    </div>
                </div>
            </div>
        </section>
        <section id="table" class="mt-[{{ $set->col2_mt }}] mx-[{{ $set->margin_x }}] font-sans text-sm">
            <p>Pada hari ini, <span
                    style="font-weight: 900">{{ \Carbon\Carbon::parse($cetak->bast_date)->locale('id')->isoFormat('dddd') }}</span>
                tanggal <span
                    style="font-weight: 900">{{ \Carbon\Carbon::parse($cetak->bast_date)->locale('id')->isoFormat('D') }}</span>
                bulan <span
                    style="font-weight: 900">{{ \Carbon\Carbon::parse($cetak->bast_date)->locale('id')->isoFormat('MMMM') }}
                </span> tahun <span
                    style="font-weight: 900">{{ \Carbon\Carbon::parse($cetak->bast_date)->locale('id')->isoFormat('Y') }}</span>
                :</p>
            <table class="pihak">
                <tr>
                    <td>Nama</td>
                    <td>: {{ $cetak->nama_pihak1 }}</td>
                </tr>
                <tr>
                    <td>Nama Perusahaan</td>
                    <td>: {{ $cetak->perusahaan_pihak1 }}</td>
                </tr>
                <tr>
                    <td>Alamat Perusahaan</td>
                    <td>: {{ $cetak->alamat_pihak1 }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>: {{ $cetak->jabatan_pihak1 }}</td>
                </tr>
            </table>
            <p class="mt-4 ml-6">Selanjutnya disebut <span style="font-weight: 900">"PIHAK PERTAMA"</span> selaku
                Pemberi
                kerja
                telah menerima dengan baik dan lengkap dari :</p>
            <table class="pihak">
                <tr>
                    <td>Nama</td>
                    <td>: {{ $cetak->nama_pihak2 }}</td>
                </tr>
                <tr>
                    <td>Nama Perusahaan</td>
                    <td>: {{ $cetak->perusahaan_pihak2 }}</td>
                </tr>
                <tr>
                    <td>Alamat Perusahaan</td>
                    <td>: {{ $cetak->alamat_pihak2 }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>: {{ $cetak->jabatan_pihak2 }}</td>
                </tr>
            </table>
            <p class="mt-4">Selanjutnya disebut <span style="font-weight: 900">"PIHAK KEDUA"</span> selaku Pelaksana
                Kerja, dan Pihak Kedua telah menyerahkan dengan baik dan lengkap kepada Pihak Pertama, berupa :</p>
            <p class="mt-4 mb-12" id="next">Hasil Pekerjaan <span
                    style="font-weight: 900">{{ $head->name }}</span> Sprint
                <span style="font-weight: 900">4</span> berdasrkan Perjanjian Kerja sama Nomor <span
                    style="font-weight: 900">{{ $cetak->of_number }}</span> tanggal <span
                    style="font-weight: 900">{{ \Carbon\Carbon::parse($cetak->bast_date)->locale('id')->isoFormat('D MMMM Y') }}</span>,
                dengan spesifikasi pekerjaan sebagai berikut :
            </p>
            <table class="detail">
                <tr>
                    <th>No</th>
                    <th>Fitur</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Uji</th>
                    <th>Penguji</th>
                    <th>Paraf</th>
                </tr>
                <tr>
                    @csrf
                    <?php $no = 1; ?>
                    @foreach ($detail as $list)
                        <td>{{ $no++ }}</td>
                        <td>{{ $list->fitur }}</td>
                        <td>{{ $list->deskripsi }}</td>
                        <td>{{ \Carbon\Carbon::parse($list->tanggaluji)->locale('id')->isoFormat('D MMMM Y') }}</td>
                        <td>{{ $list->penguji }}</td>
                        <td>
                            @if ($cetak->signature1 == null)
                            @else
                                <img src="{{ asset('storage/' . $cetak->signature1) }}" style="width: 80px;"
                                    class="mx-auto my-auto" alt="Image">
                            @endif
                        </td>
                </tr>
                @endforeach
            </table>
            <p class="mt-8">Dengan telah dilakukannya serah terima hasil pekerjaan berdasarkan Berita Acara ini, maka
                dengan demikian kewajiban PIHAK KEDUA sebagai Pelaksana Kerja untuk menyerahkan hasil pekerjaan</p>
            <p class="mt-4">kepada PIHAK PERTAMA dan hak PIHAK PERTAMA sebagai Pemberi Kerja untuk menerima hasil
                pekerjaan tersebut dari PIHAK KEDUA berdasarkan Perjanjian telah di laksanakan.</p>
            <p class="mt-4">Berita Acara ini merupakan bagian dari pelaksanaan Perjanjian dan sekaligus sebagai Tanda
                Terima hasil pekerjaan di antara Para Pihak, sehingga oleh karenanya merupakan satu kesatuan dan bagian
                yang tidak terpisahkan dan Perjanjian dan OF.
            </p>
            <p class="mt-4">Dengan ditandatanganinya Formulir Review Service ini maka Para Pihak setuju bahwa project
                ini sudah selesai pada <span style="font-weight: 900">Phase I.</span>
            </p>
            <p class="mt-4">Demikian Berita Acara ini dibuat pada waktu sebagaimana telah disebutkan pada bagian awal
                Berita Acara ini.
            </p>
        </section>
        <section id="table" class="mt-[{{ $set->col3_mt }}] mx-[{{ $set->margin_x }}] font-sans text-sm">
            <div class="flex gap-5">
                <div class="w-1/2 h-72 text-wrap border border-black">
                    <h2 class="m-3 font-semibold">Date : @if ($cetak->date_signature1 == null)
                        @else
                            {{ \Carbon\Carbon::parse($cetak->date_signature1)->locale('id')->isoFormat('D MMMM Y') }}
                        @endif
                    </h2>

                    @if ($cetak->signature1 == null)
                        <h2 class="m-3 font-semibold mt-36">{{ $cetak->nama_pihak1 }}</h2>
                        <h2 class="m-3 font-semibold">{{ $cetak->perusahaan_pihak1 }}</h2>
                    @else
                        <img src="{{ asset('storage/' . $cetak->signature1) }}" style="width: 250px; margin-left: 50px"
                            alt="">
                        <h2 class="m-3 font-semibold mt-9">{{ $cetak->nama_pihak1 }}</h2>
                        <h2 class="m-3 font-semibold">{{ $cetak->perusahaan_pihak1 }}</h2>
                    @endif
                </div>
                <div class="w-1/2 h-72 text-wrap border border-black">
                    <h2 class="m-3 font-semibold">Date : @if ($cetak->date_signature2 == null)
                        @else
                            {{ \Carbon\Carbon::parse($cetak->date_signature2)->locale('id')->isoFormat('D MMMM Y') }}
                        @endif
                    </h2>
                    @if ($cetak->signature2 == null)
                        <h2 class="m-3 font-semibold mt-36">{{ $cetak->nama_pihak2 }}</h2>
                        <h2 class="m-3 font-semibold">{{ $cetak->perusahaan_pihak2 }}</h2>
                    @else
                        <img src="{{ asset('storage/' . $cetak->signature2) }}" style="width: 250px; margin-left: 50px"
                            alt="">
                        <h2 class="m-3 font-semibold mt-9">{{ $cetak->nama_pihak2 }}</h2>
                        <h2 class="m-3 font-semibold">{{ $cetak->perusahaan_pihak2 }}</h2>
                    @endif
                </div>
            </div>
        </section>
        <section id="table" class="mt-[{{ $set->col4_mt }}] mx-[{{ $set->margin_x }}] font-sans">
            <p class="mt-3 italic font-semibold">*Notes : Apabila dalam 3 hari tidak ada feedback maka dokumen
                ini dinyatakan valid dan telah disetujui</p>
        </section>
        <footer class="mt-16 mb-[{{ $set->margin_y }}] mx-[{{ $set->margin_x }}] font-sans">
            <center>
                <a href="{{ route('bast.view', $cetak->projectid) }}" id="footer"
                    class="text-base font-semibold text-white bg-green-700 py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">
                    Kembali</a>
                {{-- <a id="footer" onclick=" window.print()"
                    class="text-base font-semibold text-white bg-green-700 py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">
                    Print Document</a> --}}
            </center>
        </footer>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
