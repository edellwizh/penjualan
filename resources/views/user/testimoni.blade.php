<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Testimoni</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/user1.css') }}">
</head>
<body>
    @include('sidebar.user')
    <section class="hero-kontak">
        <h2><strong>Testimoni</strong></h2>
        <p>by Sandang Sehat Indonesia</p>
    </section>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p>Punya pengalaman atau saran tentang website ini? Ceritakan di sini, ya!</p>
                <div class="pembungkus-formulir">
                    <form action="{{ url('/user/testimoni/tambah') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <div class="rating d-flex flex-row-reverse justify-content-start">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" required>
                                    <label for="star{{ $i }}"><i class="bi bi-star-fill"></i></label>
                                @endfor
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="4" placeholder="Masukkan pesan..." required></textarea>
                        </div>

                        @include('sidebar.pesansukses')

                        <button type="submit" class="btn btn-primary tombol-primer-kustom">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row justify-content-center g-4">
            <div class="col-12 col-md-4">
                <a href="https://web.whatsapp.com/" class="text-decoration-none text-dark">
                    <div class="kartu-kontak">
                        <i class="bi bi-telephone-fill"></i>
                        <h6><strong>Sales</strong></h6>
                        <p>(+62)8557803xxxx</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-4">
                <a href="https://mail.google.com" class="text-decoration-none text-dark">
                    <div class="kartu-kontak">
                        <i class="bi bi-envelope-fill"></i>
                        <h6><strong>Email</strong></h6>
                        <p>sasexxx@gmail.com</p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-4">
                <a href="https://www.instagram.com/" class="text-decoration-none text-dark">
                    <div class="kartu-kontak">
                        <i class="bi bi-instagram"></i>
                        <h6><strong>Instagram</strong></h6>
                        <p>@sasendo</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    @include('sidebar.footer')