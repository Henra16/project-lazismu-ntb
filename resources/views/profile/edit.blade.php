@extends('frontend.layouts.app')

@section('title', 'Edit Profile')

@push('styles')
    <style>
        :root { --orange:#F7941D; --orange-dark:#E5820A; --orange-light:#FFF8E6; --bg:#F0F2F5; }
        * { box-sizing:border-box; margin:0; padding:0; }
        body { font-family:'Poppins',sans-serif; background:var(--bg); color:#333; }

        .page-wrapper { padding: 40px 0 60px; margin-top: 30px; }

        /* card */
        .pcard {
            background:#fff; border-radius:16px; padding:28px;
            margin-bottom:20px; box-shadow:0 4px 20px rgba(0,0,0,0.07);
        }

        /* section heading */
        .sec-head { display:flex; align-items:center; gap:12px; margin-bottom:22px; }
        .sec-head .ico {
            width:40px; height:40px; border-radius:10px; background:var(--orange);
            display:flex; align-items:center; justify-content:center; color:#fff; font-size:1rem; flex-shrink:0;
        }
        .sec-head h5 { font-weight:700; font-size:1rem; margin:0; color:#222; }
        .sec-head p  { font-size:0.77rem; color:#999; margin:0; }

        /* avatar */
        .avatar-wrap { position:relative; width:110px; height:110px; margin:0 auto 14px; }
        .avatar-wrap img, .avatar-init {
            width:110px; height:110px; border-radius:50%; object-fit:cover; border:3px solid var(--orange);
        }
        .avatar-init {
            background:var(--orange-light); display:flex; align-items:center;
            justify-content:center; font-size:2.5rem; color:var(--orange); font-weight:700;
        }
        .cam-btn {
            position:absolute; bottom:2px; right:2px; width:30px; height:30px;
            border-radius:50%; background:var(--orange); border:2px solid #fff;
            display:flex; align-items:center; justify-content:center;
            color:#fff; font-size:0.7rem; cursor:pointer; transition:background .2s;
        }
        .cam-btn:hover { background:var(--orange-dark); }

        /* info sidebar */
        .info-row { display:flex; align-items:flex-start; gap:10px; padding:10px 0; border-bottom:1px solid #f3f4f6; }
        .info-row:last-child { border-bottom:none; }
        .info-ico { width:34px; height:34px; border-radius:8px; background:var(--orange-light); color:var(--orange); display:flex; align-items:center; justify-content:center; font-size:0.85rem; flex-shrink:0; }
        .info-lbl { font-size:0.7rem; color:#aaa; margin-bottom:1px; }
        .info-val { font-size:0.85rem; font-weight:600; color:#333; word-break:break-all; }

        /* form */
        .flbl { font-size:0.83rem; font-weight:600; color:#444; margin-bottom:5px; }
        .finput {
            width:100%; border:1.5px solid #e5e7eb; border-radius:10px;
            padding:10px 14px; font-family:'Poppins',sans-serif; font-size:0.875rem;
            color:#333; background:#fafafa; outline:none; transition:border-color .2s, box-shadow .2s;
        }
        .finput:focus { border-color:var(--orange); box-shadow:0 0 0 3px rgba(247,148,29,.13); background:#fff; }
        .finput:disabled, .finput[readonly] { background:#f3f4f6; color:#888; cursor:not-allowed; }
        .finput.is-invalid { border-color:#dc3545; }
        .has-eye { position:relative; }
        .has-eye .finput { padding-right:42px; }
        .eye-btn { position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#bbb; font-size:0.88rem; transition:color .2s; }
        .eye-btn:hover { color:var(--orange); }
        .err-msg { color:#dc3545; font-size:0.77rem; margin-top:3px; }

        /* buttons */
        .btn-primary-custom {
            background:var(--orange); color:#fff; border:none; border-radius:10px;
            padding:10px 24px; font-family:'Poppins',sans-serif; font-weight:600;
            font-size:0.88rem; cursor:pointer; transition:background .2s, transform .15s;
            display:inline-flex; align-items:center; gap:8px;
        }
        .btn-primary-custom:hover:not(:disabled) { background:var(--orange-dark); transform:translateY(-1px); }
        .btn-primary-custom:disabled { background:#e5c89a; cursor:not-allowed; transform:none; }

        .btn-danger-outline {
            background:transparent; color:#dc3545; border:1.5px solid #dc3545;
            border-radius:10px; padding:10px 22px; font-family:'Poppins',sans-serif;
            font-weight:600; font-size:0.88rem; cursor:pointer; transition:all .2s;
            display:inline-flex; align-items:center; gap:8px;
        }
        .btn-danger-outline:hover { background:#dc3545; color:#fff; }

        .btn-sm-del {
            background:#fff0f0; color:#dc3545; border:1.5px solid #fcc;
            border-radius:8px; padding:5px 13px; font-size:0.78rem; font-weight:600;
            cursor:pointer; transition:all .2s; font-family:'Poppins',sans-serif;
        }
        .btn-sm-del:hover { background:#dc3545; color:#fff; }

        /* strength bar */
        .sbar { height:4px; border-radius:4px; background:#e5e7eb; margin-top:6px; overflow:hidden; }
        .sfill { height:100%; border-radius:4px; width:0; transition:width .3s, background .3s; }

        /* alerts */
        .alert-ok, .alert-err {
            border-radius:10px; padding:11px 15px; font-size:0.84rem;
            display:flex; align-items:center; gap:8px; margin-bottom:18px;
            animation:slideIn .35s ease;
        }
        .alert-ok { background:#f0fdf4; border:1.5px solid #86efac; color:#166534; }
        .alert-err { background:#fff0f0; border:1.5px solid #fca5a5; color:#991b1b; }
        @keyframes slideIn { from{opacity:0;transform:translateY(-8px)} to{opacity:1;transform:translateY(0)} }

        /* danger zone */
        .danger-zone { background:#fff5f5; border:1.5px solid #fca5a5; border-radius:16px; padding:24px; }

        @media(max-width:767px){ .pcard{padding:16px;} .page-wrapper{margin-top:120px;} }
    </style>
@endpush

@section('content')

<div class="page-wrapper">
<div class="container">
<div class="row g-4">

{{-- ═══ SIDEBAR ═══ --}}
<div class="col-lg-3 col-md-4">
    <div class="pcard text-center">
        <div class="avatar-wrap mx-auto">
            @if(auth()->user()->avatar)
                <img id="av-img" src="{{ Storage::url(auth()->user()->avatar) }}" alt="Avatar">
            @else
                <div class="avatar-init" id="av-init">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endif
            <label for="avatar-input" class="cam-btn" title="Ganti Foto">
                <i class="fas fa-camera"></i>
            </label>
        </div>

        <div style="font-weight:700;font-size:1rem;margin-bottom:4px" id="sidebar-name">{{ auth()->user()->name }}</div>
        <span style="font-size:0.77rem;background:var(--orange-light);color:var(--orange);border-radius:20px;padding:2px 12px;font-weight:600;display:inline-block">
            {{ auth()->user()->role === 'admin' ? 'Admin' : 'Donatur' }}
        </span>

        @if(auth()->user()->avatar)
            <form method="POST" action="{{ route('profile.avatar.delete') }}" class="mt-3">
                @csrf @method('DELETE')
                <button type="submit" class="btn-sm-del" onclick="return confirm('Hapus foto profil?')">
                    <i class="fas fa-trash-alt"></i> Hapus Foto
                </button>
            </form>
        @endif

        <hr class="my-3">

        <div class="text-start">
            <div class="info-row">
                <div class="info-ico"><i class="fas fa-envelope"></i></div>
                <div>
                    <div class="info-lbl">Email</div>
                    <div class="info-val">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <div class="info-row">
                <div class="info-ico"><i class="fas fa-phone"></i></div>
                <div>
                    <div class="info-lbl">Telepon</div>
                    <div class="info-val">{{ auth()->user()->phone ?? '-' }}</div>
                </div>
            </div>
            <div class="info-row">
                <div class="info-ico"><i class="fas fa-calendar-alt"></i></div>
                <div>
                    <div class="info-lbl">Bergabung</div>
                    <div class="info-val">{{ auth()->user()->created_at->format('d M Y') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══ MAIN ═══ --}}
<div class="col-lg-9 col-md-8">

    @if(session('status') === 'profile-updated')
        <div class="alert-ok" id="flash-alert"><i class="fas fa-check-circle"></i> Profil berhasil diperbarui!</div>
    @elseif(session('status') === 'avatar-deleted')
        <div class="alert-ok" id="flash-alert"><i class="fas fa-check-circle"></i> Foto profil berhasil dihapus.</div>
    @elseif(session('status') === 'password-updated')
        <div class="alert-ok" id="flash-alert"><i class="fas fa-check-circle"></i> Password berhasil diubah!</div>
    @endif

    {{-- ── EDIT PROFIL ── --}}
    <div class="pcard">
        <div class="sec-head">
            <div class="ico"><i class="fas fa-user-edit"></i></div>
            <div>
                <h5>Edit Profil</h5>
                <p>Ubah nama dan foto profil Anda</p>
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profile-form">
            @csrf @method('PATCH')
            <input type="file" id="avatar-input" name="avatar" accept="image/*" class="d-none">

            @if($errors->has('avatar'))
                <div class="alert-err"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('avatar') }}</div>
            @endif

            <div class="row g-3">
                {{-- Nama --}}
                <div class="col-md-6">
                    <label class="flbl">Nama Lengkap <span style="color:#e00">*</span></label>
                    <input type="text" name="name" id="field-name"
                           class="finput {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           value="{{ old('name', $user->name) }}"
                           placeholder="Nama lengkap" required>
                    @error('name')<div class="err-msg">{{ $message }}</div>@enderror
                </div>

                {{-- Email (read-only) --}}
                <div class="col-md-6">
                    <label class="flbl">Email</label>
                    <input type="email" class="finput" value="{{ $user->email }}" readonly disabled>
                    <div style="font-size:0.72rem;color:#aaa;margin-top:3px">
                        <i class="fas fa-lock" style="font-size:0.65rem"></i> Email tidak dapat diubah
                    </div>
                </div>

                {{-- Tombol simpan --}}
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" id="btn-save-profile" class="btn-primary-custom" disabled>
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- ── UBAH PASSWORD ── --}}
    <div class="pcard">
        <div class="sec-head">
            <div class="ico"><i class="fas fa-lock"></i></div>
            <div>
                <h5>Ubah Password</h5>
                <p>Isi semua kolom untuk mengaktifkan tombol ubah</p>
            </div>
        </div>

        @if($errors->updatePassword->any())
            <div class="alert-err">
                <ul class="mb-0 ps-3">
                    @foreach($errors->updatePassword->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" id="pw-form">
            @csrf @method('PUT')

            <div class="row g-3">
                {{-- Password saat ini --}}
                <div class="col-12">
                    <label class="flbl">Password Saat Ini <span style="color:#e00">*</span></label>
                    <div class="has-eye">
                        <input type="password" name="current_password" id="pw-current"
                               class="finput {{ $errors->updatePassword->has('current_password') ? 'is-invalid' : '' }}"
                               placeholder="Masukkan password saat ini" autocomplete="current-password">
                        <button type="button" class="eye-btn" onclick="toggleEye('pw-current',this)"><i class="fas fa-eye"></i></button>
                    </div>
                </div>

                {{-- Password baru --}}
                <div class="col-md-6">
                    <label class="flbl">Password Baru <span style="color:#e00">*</span></label>
                    <div class="has-eye">
                        <input type="password" name="password" id="pw-new"
                               class="finput {{ $errors->updatePassword->has('password') ? 'is-invalid' : '' }}"
                               placeholder="Minimal 8 karakter" autocomplete="new-password"
                               oninput="checkStrength(this.value); checkPwForm()">
                        <button type="button" class="eye-btn" onclick="toggleEye('pw-new',this)"><i class="fas fa-eye"></i></button>
                    </div>
                    <div class="sbar"><div class="sfill" id="sfill"></div></div>
                    <div id="slbl" style="font-size:0.72rem;margin-top:2px"></div>
                </div>

                {{-- Konfirmasi --}}
                <div class="col-md-6">
                    <label class="flbl">Konfirmasi Password Baru <span style="color:#e00">*</span></label>
                    <div class="has-eye">
                        <input type="password" name="password_confirmation" id="pw-confirm"
                               class="finput" placeholder="Ulangi password baru" autocomplete="new-password"
                               oninput="checkPwForm()">
                        <button type="button" class="eye-btn" onclick="toggleEye('pw-confirm',this)"><i class="fas fa-eye"></i></button>
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" id="btn-change-pw" class="btn-primary-custom" disabled>
                        <i class="fas fa-key"></i> Ubah Password
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- ── HAPUS AKUN ── --}}
    <div class="danger-zone">
        <div class="sec-head mb-2">
            <div class="ico" style="background:#dc3545"><i class="fas fa-user-times"></i></div>
            <div>
                <h5 style="color:#dc3545">Hapus Akun</h5>
                <p>Tindakan ini tidak dapat dibatalkan</p>
            </div>
        </div>
        <p style="font-size:0.83rem;color:#888;margin-bottom:16px">
            Setelah akun dihapus, semua data Anda akan dihapus secara permanen.
        </p>
        <button type="button" class="btn-danger-outline" data-bs-toggle="modal" data-bs-target="#deleteModal">
            <i class="fas fa-trash-alt"></i> Hapus Akun Saya
        </button>
    </div>

</div>{{-- end col main --}}
</div>
</div>
</div>

{{-- Modal Hapus Akun --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;box-shadow:0 20px 60px rgba(0,0,0,0.15)">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" style="color:#dc3545">
                    <i class="fas fa-exclamation-triangle me-2"></i>Hapus Akun
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p style="font-size:0.87rem;color:#666;margin-bottom:18px">
                    Masukkan password Anda untuk konfirmasi. Semua data akan hilang permanen.
                </p>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf @method('DELETE')
                    <label class="flbl">Konfirmasi Password</label>
                    <div class="has-eye">
                        <input type="password" name="password" id="del-pw"
                               class="finput {{ $errors->userDeletion->has('password') ? 'is-invalid' : '' }}"
                               placeholder="Masukkan password Anda">
                        <button type="button" class="eye-btn" onclick="toggleEye('del-pw',this)"><i class="fas fa-eye"></i></button>
                    </div>
                    @error('password','userDeletion')
                        <div class="err-msg">{{ $message }}</div>
                    @enderror
                    <div class="d-flex gap-2 mt-4">
                        <button type="button" class="btn-primary-custom flex-fill" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-danger-outline flex-fill">Hapus Akun</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// ── Auto-dismiss flash alert ──
document.addEventListener('DOMContentLoaded', function () {
    const fa = document.getElementById('flash-alert');
    if (fa) setTimeout(() => { fa.style.transition='opacity .5s'; fa.style.opacity=0; setTimeout(()=>fa.remove(),500); }, 4000);

    // Open delete modal on error
    @if($errors->userDeletion->isNotEmpty())
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    @endif
});

// ── Nama field → enable save button only when changed & not empty ──
const nameInput = document.getElementById('field-name');
const btnSave   = document.getElementById('btn-save-profile');
// Simpan nilai awal langsung dari DOM (tidak bergantung pada PHP)
const ORIGINAL_NAME = nameInput.value;

function checkProfileForm() {
    const val = nameInput.value.trim();
    // Aktif jika: tidak kosong DAN berbeda dari nama awal
    btnSave.disabled = !(val.length > 0 && val !== ORIGINAL_NAME.trim());
}
nameInput.addEventListener('input', checkProfileForm);
checkProfileForm();

// ── Password form → enable button only when all 3 fields filled ──
const btnPw = document.getElementById('btn-change-pw');
function checkPwForm() {
    const c = document.getElementById('pw-current').value;
    const n = document.getElementById('pw-new').value;
    const k = document.getElementById('pw-confirm').value;
    btnPw.disabled = !(c.length > 0 && n.length >= 8 && k.length > 0);
}
document.getElementById('pw-current').addEventListener('input', checkPwForm);

// ── Avatar preview & auto-submit ──
document.getElementById('avatar-input').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function (ev) {
        const wrap = document.querySelector('.avatar-wrap');
        const init = document.getElementById('av-init');
        if (init) init.remove();
        let img = document.getElementById('av-img');
        if (!img) {
            img = document.createElement('img');
            img.id = 'av-img'; img.alt = 'Avatar';
            wrap.insertBefore(img, wrap.querySelector('.cam-btn'));
        }
        img.src = ev.target.result;
        // Submit setelah preview tampil
        setTimeout(() => document.getElementById('profile-form').submit(), 150);
    };
    reader.readAsDataURL(file);
});

// ── Toggle password visibility ──
function toggleEye(id, btn) {
    const inp = document.getElementById(id);
    const ico = btn.querySelector('i');
    if (inp.type === 'password') {
        inp.type = 'text';
        ico.classList.replace('fa-eye','fa-eye-slash');
        btn.style.color = 'var(--orange)';
    } else {
        inp.type = 'password';
        ico.classList.replace('fa-eye-slash','fa-eye');
        btn.style.color = '';
    }
}

// ── Password strength ──
function checkStrength(v) {
    const fill = document.getElementById('sfill');
    const lbl  = document.getElementById('slbl');
    let s = 0;
    if (v.length >= 8) s++;
    if (/[A-Z]/.test(v)) s++;
    if (/[0-9]/.test(v)) s++;
    if (/[^A-Za-z0-9]/.test(v)) s++;
    const cfg = [
        {p:'0%',  bg:'#e5e7eb',text:''},
        {p:'25%', bg:'#dc3545',text:'Lemah'},
        {p:'50%', bg:'#fd7e14',text:'Cukup'},
        {p:'75%', bg:'#ffc107',text:'Baik'},
        {p:'100%',bg:'#28a745',text:'Kuat'},
    ];
    fill.style.width = cfg[s].p;
    fill.style.background = cfg[s].bg;
    lbl.textContent = cfg[s].text;
    lbl.style.color = cfg[s].bg;
}
</script>
@endpush
