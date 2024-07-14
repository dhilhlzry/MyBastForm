<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('tailwind/output.css') }}">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature-pad.min.css">
    <style>
        .wrap {
            background-color: white;
            border: 1px solid slategray;
        }
    </style>
    <title>Share - Signature</title>
</head>

<body id="body" class="bg-[#f9fbfd] my-20 mx-48">
    <div id="wrap" class="wrap">
        <section id="header" class="mt-36 mx-20 font-sans border-black border-[1px]">
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
                                {{-- <h4 class="text-lg text-left pl-5 py-3">No : BAST/1-16/SMT/BDG/III/2023 - 02</h4> --}}
                                <h4 class="text-sm text-left py-2"><span class="pl-5 pr-20">No </span> : {{ $cetak->bast_no }}</h4>
                            </div>
                            <div class="w-1/3 h-9 text-wrap border border-black border-t-0 border-l-0 border-r-0">
                                <h4 class="text-sm text-left py-2"><span class="pl-5 pr-10">Revisi </span> : 0{{ $cetak->revision }}</h4>
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-2/3 h-9 text-wrap border border-black border-t-0 border-l-0 border-b-0">
                                <h4 class="text-sm text-left py-2"><span class="pl-5 pr-[51px]">Tanggal </span>
                                    : {{ \Carbon\Carbon::parse($cetak->bast_date)->locale('id')->isoFormat('D MMMM Y') }}
                                </h4>
                            </div>
                            <div class="w-1/3 h-9 text-wrap border border-black border-t-0 border-l-0 border-b-0 border-r-0">
                                <h4 class="text-sm text-left py-2"><span class="pl-5 pr-[21px]">Halaman </span> : 1 / 2</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="header" class="mt-12 mx-20 font-sans">
            <div>
                <div class="w-full h-32 bg-smoeets">
                    <div class="text-left py-7 px-3">
                        <h2 class="font-semibold text-white text-4xl">Berita Acara Serah Terima
                            Hasil
                            Pekerjaan</h2>
                        <h4 class="text-lg text-white mt-2">Fase : Sprint {{ $cetak->sprint }}</h4>
                    </div>
                </div>
            </div>
        </section>
        <section id="table" class="mt-12 mx-20 font-sans text-sm">
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
            <p class="mt-4 ml-6">Selanjutnya disebut <span style="font-weight: 900">"PIHAK PERTAMA"</span> selaku Pemberi
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
            <p class="mt-4 mb-12" id="next">Hasil Pekerjaan <span style="font-weight: 900">{{ $head->name }}</span> Sprint
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
                            @if ($list->paraf == null)
                            <button id="myBtn3" onclick="tmbhparaf3()"
                                class="text-xs font-semibold text-white bg-green-700 py-2 px-3 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">Tambah
                                Paraf</button>

                                <div id="myModal3" class="modal">
                                    <article class="modal-container">
                                        <header class="modal-container-header">
                                            <h1 class="modal-container-title">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                                    aria-hidden="true">
                                                    <path fill="none" d="M0 0h24v24H0z" />
                                                    <path fill="currentColor"
                                                        d="M14 9V4H5v16h6.056c.328.417.724.785 1.18 1.085l1.39.915H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.449 2 4.002 2h10.995L21 8v1h-7zm-2 2h9v5.949c0 .99-.501 1.916-1.336 2.465L16.5 21.498l-3.164-2.084A2.953 2.953 0 0 1 12 16.95V11zm2 5.949c0 .316.162.614.436.795l2.064 1.36 2.064-1.36a.954.954 0 0 0 .436-.795V13h-5v3.949z" />
                                                </svg>
                                                Paraf Persetujuan
                                            </h1>
                                            <button class="icon-button">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="close3" viewBox="0 0 24 24" width="24"
                                                    height="24">
                                                    <path fill="none" d="M0 0h24v24H0z" />
                                                    <path fill="currentColor"
                                                        d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z" />
                                                </svg>
                                            </button>
                                        </header>
                                        <section class="modal-container-body rtf">
                                            <form id="form3" action="/simpan_detail/{{ $list->id }}{{ $cetak->id }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="nama">
                                                    <label for="judul" class="nama3">Masukan Paraf Disini</label>
                                                    <div id="signature-pad" class="signature-pad">
                                                        <div class="signature-pad--body">
                                                            <canvas class="signature" id="canvas3"></canvas>
                                                        </div>
                                                        <div class="signature-pad--footer">
                                                            <a id="clear3" class="nama3"
                                                                style="color:#98cc3c; text-decoration: underline; cursor: pointer;">
                                                                Click Here To Clear</a>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="signature3" id="signature3" />
                                                </div>
                                                <div class="hargajual">
                                                    <label for="judul" class="hargajual3">Atau Upload Paraf</label>
                                                    <div class="" style="margin-top: 6px; margin-left: 10px">
                                                        <input type="file" name="foto" id="foto" placeholder="Masukan Password"
                                                            class="">
                                                    </div>
                                                </div>
                                                <div class="hargajual">
                                                    <label for="judul" class="hargajual2">Note : Upload Paraf Dengan Extensi File JPG</label>
                                                </div>
                                        </section>
                                        <footer class="modal-container-footer">
                                            <button class="button is-primary" type="submit" value="Simpan">Submit</button>
                                            </form>
                                        </footer>
                                    </article>
                                </div>

                            @else
                                <img src="{{ asset('storage/' . $list->paraf) }}" style="width: 80px;"
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
        <section id="table" class="mt-12 mx-20 font-sans">
            <div class="flex gap-5">
                <div class="w-1/2 h-72 text-wrap border border-black">
                    @if ($cetak->date_signature1 == null)
                        <h2 class="m-3 font-semibold mr-auto">Date :
                        </h2>
                    @else
                        <div class="flex">
                            <h2 class="m-3 font-semibold mr-auto">Date :
                                {{ \Carbon\Carbon::parse($cetak->date_signature1)->locale('id')->isoFormat('D MMMM Y') }}
                            </h2>
                            <form action="/delete_signature/{{ $cetak->id }}{{ 1 }}" method="post">
                                @csrf
                                <button type="submit" onclick="return confirm('Apakah Yakin Mau Menghapus Paraf ?')"
                                    class="text-base font-semibold text-white bg-red-700 rounded-full p-1 hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out mt-1 mr-1"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                        fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                    </svg></button>
                            </form>
                        </div>
                    @endif
                    @if ($cetak->signature1 == null)
                        <div class="text-center mt-16">
                            <button id="myBtn" onclick="tmbhparaf1()"
                                class="text-base font-semibold text-white bg-green-700 py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">Tambah
                                Paraf</button>
                        </div>
                        <h2 class="m-3 font-semibold mt-16">{{ $cetak->nama_pihak1 }}</h2>
                        <h2 class="m-3 font-semibold">{{ $cetak->perusahaan_pihak1 }}</h2>
                    @else
                        <img src="{{ asset('storage/' . $cetak->signature1) }}" style="width: 250px; margin-left: 50px"
                            alt="">
                        <h2 class="m-3 font-semibold mt-9">{{ $cetak->nama_pihak1 }}</h2>
                        <h2 class="m-3 font-semibold">{{ $cetak->perusahaan_pihak1 }}</h2>
                    @endif
                </div>
                <div class="w-1/2 h-72 text-wrap border border-black">
                    @if ($cetak->date_signature2 == null)
                        <h2 class="m-3 font-semibold mr-auto">Date :
                        </h2>
                    @else
                        <div class="flex">
                            <h2 class="m-3 font-semibold mr-auto">Date :
                                {{ \Carbon\Carbon::parse($cetak->date_signature2)->locale('id')->isoFormat('D MMMM Y') }}
                            </h2>
                            <form action="/delete_signature/{{ $cetak->id }}{{ 2 }}" method="post">
                                @csrf
                                <button type="submit" onclick="return confirm('Apakah Yakin Mau Menghapus Paraf ?')"
                                class="text-base font-semibold text-white bg-red-700 rounded-full p-1 hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out mt-1 mr-1"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                        fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                    </svg></button>
                            </form>
                        </div>
                    @endif
                    @if ($cetak->signature2 == null)
                        <div class="text-center mt-16">
                            <button id="myBtn2" onclick="tmbhparaf2()"
                                class="text-base font-semibold text-white bg-green-700 py-3 px-8 rounded-full hover:shadow-lg hover:opacity-80 transition duration-300 ease-in-out">Tambah
                                Paraf</button>
                        </div>
                        <h2 class="m-3 font-semibold mt-16">{{ $cetak->nama_pihak2 }}</h2>
                        <h2 class="m-3 font-semibold">{{ $cetak->perusahaan_pihak2 }}</h2>
                    @else
                        <img src="{{ asset('storage/' . $cetak->signature2) }}"
                            style="width: 250px; margin-left: 50px" alt="">
                        <h2 class="m-3 font-semibold mt-9">{{ $cetak->nama_pihak2 }}</h2>
                        <h2 class="m-3 font-semibold">{{ $cetak->perusahaan_pihak2 }}</h2>
                    @endif

                </div>
            </div>
        </section>
        <section id="table" class="mt-12 mx-20 font-sans">
            <p class="mt-3 italic font-semibold">*Notes : Apabila dalam 3 hari tidak ada feedback maka
                dokumen
                ini dinyatakan valid dan telah disetujui</p>
        </section>
        <footer class="mb-12">
        </footer>
    </div>

    <div id="myModal" class="modal">
        <article class="modal-container">
            <header class="modal-container-header">
                <h1 class="modal-container-title">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                        aria-hidden="true">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path fill="currentColor"
                            d="M14 9V4H5v16h6.056c.328.417.724.785 1.18 1.085l1.39.915H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.449 2 4.002 2h10.995L21 8v1h-7zm-2 2h9v5.949c0 .99-.501 1.916-1.336 2.465L16.5 21.498l-3.164-2.084A2.953 2.953 0 0 1 12 16.95V11zm2 5.949c0 .316.162.614.436.795l2.064 1.36 2.064-1.36a.954.954 0 0 0 .436-.795V13h-5v3.949z" />
                    </svg>
                    Upload Signature
                </h1>
                <button class="icon-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="close" viewBox="0 0 24 24" width="24"
                        height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path fill="currentColor"
                            d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z" />
                    </svg>
                </button>
            </header>
            <section class="modal-container-body rtf">
                <form action="/simpan_signature/{{ $cetak->id }}{{ 1 }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="nama">
                        <label for="judul" class="nama2">Masukan Paraf Disini</label>
                        <div id="signature-pad" class="signature-pad">
                            <div class="signature-pad--body">
                                <canvas class="signature" id="canvas1"></canvas>
                            </div>
                            <div class="signature-pad--footer">
                                <a id="clear" class="nama2"
                                    style="color:#98cc3c; text-decoration: underline; cursor: pointer;">
                                    Click Here To Clear</a>
                            </div>
                        </div>
                        <input type="hidden" name="signature1" id="signature1" />
                    </div>
                    <div class="hargajual">
                        <label for="judul" class="hargajual2">Atau Upload Paraf</label>
                        <div class="" style="margin-top: 6px; margin-left: 10px">
                            <input type="file" name="foto" id="foto" placeholder="Masukan Password"
                                class="">
                        </div>
                    </div>
                    <div class="hargajual">
                        <label for="judul" class="hargajual2">Note : Upload Paraf Dengan Extensi File JPG</label>
                    </div>
            </section>
            <footer class="modal-container-footer">
                <button class="button is-primary" type="submit" value="Simpan">Submit</button>
                </form>
            </footer>
        </article>
    </div>

    <div id="myModal2" class="modal">
        <article class="modal-container">
            <header class="modal-container-header">
                <h1 class="modal-container-title">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                        aria-hidden="true">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path fill="currentColor"
                            d="M14 9V4H5v16h6.056c.328.417.724.785 1.18 1.085l1.39.915H3.993A.993.993 0 0 1 3 21.008V2.992C3 2.455 3.449 2 4.002 2h10.995L21 8v1h-7zm-2 2h9v5.949c0 .99-.501 1.916-1.336 2.465L16.5 21.498l-3.164-2.084A2.953 2.953 0 0 1 12 16.95V11zm2 5.949c0 .316.162.614.436.795l2.064 1.36 2.064-1.36a.954.954 0 0 0 .436-.795V13h-5v3.949z" />
                    </svg>
                    Upload Signature
                </h1>
                <button class="icon-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="close2" viewBox="0 0 24 24" width="24"
                        height="24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path fill="currentColor"
                            d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z" />
                    </svg>
                </button>
            </header>
            <section class="modal-container-body rtf">
                <form id="form2" action="/simpan_signature/{{ $cetak->id }}{{ 2 }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="nama">
                        <label for="judul" class="nama2">Masukan Paraf Disini</label>
                        <div id="signature-pad" class="signature-pad">
                            <div class="signature-pad--body">
                                <canvas class="signature" id="canvas2"></canvas>
                            </div>
                            <div class="signature-pad--footer">
                                <a id="clear2" class="nama2"
                                    style="color:#98cc3c; text-decoration: underline; cursor: pointer;">
                                    Click Here To Clear</a>
                            </div>
                        </div>
                        <input type="hidden" name="signature2" id="signature2" />
                    </div>
                    <div class="hargajual">
                        <label for="judul" class="hargajual2">Atau Upload Paraf</label>
                        <div class="" style="margin-top: 6px; margin-left: 10px">
                            <input type="file" name="foto" id="foto" placeholder="Masukan Password"
                                class="">
                        </div>
                    </div>
                    <div class="hargajual">
                        <label for="judul" class="hargajual2">Note : Upload Paraf Dengan Extensi File JPG</label>
                    </div>
            </section>
            <footer class="modal-container-footer">
                <button class="button is-primary" type="submit" value="Simpan">Submit</button>
                </form>
            </footer>
        </article>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script src="{{ asset('js/signature1.js') }}"></script>
    <script src="{{ asset('js/signature2.js') }}"></script>
    <script src="{{ asset('js/signature3.js') }}"></script>
    <script src="{{ asset('js/slidemodal.js') }}"></script>
    <script>
        @if ($message = session('success'))
            Swal.fire(
                'Upload Paraf Berhasil !',
                'Hubungi admin untuk mendapatkan info lebih lanjut!',
                'success'
            );
        @endif
        @if ($message = session('delete'))
            Swal.fire(
                'Delete Paraf Berhasil !',
                'Hubungi admin untuk mendapatkan info lebih lanjut!',
                'success'
            );
        @endif
    </script>
</body>

</html>
