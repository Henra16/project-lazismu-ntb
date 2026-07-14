{{-- ============================================
    FOOTER - Lazismu NTB
============================================= --}}
<footer class="footer-lazismu" id="footer-main">
    <div class="container">
        <div class="row">

            {{-- Logo & Brand --}}
            <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                <div class="footer-logo">
                    <img src="{{ asset('images/lazismu-logo.png') }}" alt="Lazismu NTB" class="img-fluid" />
                </div>
            </div>

            {{-- Alamat --}}
            <div class="col-lg-4 col-md-4 mb-4 mb-md-0">
                <h5>Alamat</h5>
                <ul class="footer-info">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Kantor Layanan Lazismu NTB, Gedung Dakwah Muhammadiyah NTB Jl. Dr. Soedjono No. 9, Jempong Baru, Mataram – NTB</span>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:lazismuntb@gmail.com" style="color: var(--text-gray);">lazismuntb@gmail.com</a>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <span>+6285798******</span>
                    </li>
                </ul>
            </div>

            {{-- Sosial Media --}}
            <div class="col-lg-4 col-md-4">
                <h5>Sosial Media</h5>
                <div class="social-icons">
                    <a href="https://instagram.com/lazismuntb" target="_blank" class="social-icon instagram" id="social-instagram" aria-label="Instagram Lazismu NTB">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://facebook.com/lazismuntb" target="_blank" class="social-icon facebook" id="social-facebook" aria-label="Facebook Lazismu NTB">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            </div>

        </div>

        {{-- Footer Bottom --}}
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Lazismu Nusa Tenggara Barat. All rights reserved.</p>
        </div>
    </div>
</footer>