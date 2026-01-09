<!-- FOOTER -->
<footer class="bg-black text-white pt-5">
    <div class="container px-5">
        <div class="row">

            <!-- KIRI: ALAMAT KAMPUS -->
            <div class="col-md-8 mb-4">
                <h6 class="fw-bold text-uppercase mb-3">Alamat Kampus</h6>

                <p class="small text-white-50 mb-2">
                    <strong>Kampus Bangli</strong><br>
                    Jl. Nusantara, Kubu, Kec. Bangli, Kabupaten Bangli, Bali 80613<br>
                    Telp. (0366) 93788
                </p>

                <p class="small text-white-50 mb-2">
                    <strong>Kampus Denpasar</strong><br>
                    Jl. Ratna No.51, Tonja, Kec. Denpasar Utara, Kota Denpasar, Bali 80237<br>
                     Telp. (0361) 226656
                </p>

                <p class="small text-white-50 mb-2">
                    <strong>Pascasarjana</strong><br>
                    Jl. Kenyeri No.57, Sumerta Kaja, Kec. Denpasar Tim., Kota Denpasar, Bali 80236<br>
                    Telp. (0361) 232980
                </p>

                <p class="small text-white-50">
                    <strong>Fakultas Brahma Widya</strong><br>
                    Gg. Sekar Kemuda No.1, Tonja, Kec. Denpasar Tim., Kota Denpasar, Bali 80235<br>
                    Telp. (0361) 228665
                </p>
            </div>

            <!-- KANAN: MENU + FOLLOW US -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-bold text-uppercase">Menu</h6>
                <ul class="list-unstyled small mb-4">
                    <li><a href="{{ route('user.beranda') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
                    <li><a href="{{ route('user.tentang') }}" class="text-white-50 text-decoration-none">Tentang Kami</a></li>
                    <li><a href="{{ route('user.panduan') }}" class="text-white-50 text-decoration-none">Panduan</a></li>
                    <li><a href="{{ route('user.laporan.index') }}" class="text-white-50 text-decoration-none">Kelola Laporan</a></li>
                </ul>

                <h6 class="fw-bold text-uppercase">Follow Us</h6>
                <a href="https://www.instagram.com/uhnsugriwa_official/" class="text-white-50 me-3 fs-5 text-decoration-none">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://www.facebook.com/people/Uhnsugriwa_Official/100063982125621/" class="text-white-50 me-3 fs-5 text-decoration-none">
                    <i class="bi bi-facebook"></i>
                </a>
                <a href="https://www.youtube.com/@UhnsugriwaOfficial" class="text-white-50 me-3 fs-5 text-decoration-none">
                    <i class="bi bi-youtube"></i>
                </a>
            </div>

        </div>

      <!-- FOOTER BOTTOM -->
        <div class="text-center text-white-50 small pt-4 mt-5 border-top">
            <div class="mb-2">
                Email:
                <a href="mailto:info@uhnsugriwa.ac.id" class="text-white-50 text-decoration-none">
                    info@uhnsugriwa.ac.id
                </a>
            </div>

            <div class="pb-3">
                &copy; Repository Laporan Magang {{ date('Y') }}. All Rights Reserved.
            </div>
        </div>
    </div>
</footer>
