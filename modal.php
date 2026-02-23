 <div class="modal fade" id="modalLogin" tabindex="-1" aria-hidden="true" style="z-index: 9999;">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <!-- Close -->
      <button type="button"
              class="btn-close ms-auto m-3"
              data-bs-dismiss="modal"
              aria-label="Close"></button>

      <!-- Tabs -->
      <ul class="nav nav-tabs px-4" id="loginRegisterTabs" role="tablist">
        <li class="nav-item w-50 text-center" role="presentation">
          <button class="nav-link active w-100"
                  id="login-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#login-tab-content"
                  type="button"
                  role="tab">
            Login
          </button>
        </li>
        <li class="nav-item w-50 text-center" role="presentation">
          <button class="nav-link w-100"
                  id="register-tab"
                  data-bs-toggle="tab"
                  data-bs-target="#register-tab-content"
                  type="button"
                  role="tab">
            Register
          </button>
        </li>
      </ul>

      <!-- Tab Content -->
      <div class="tab-content p-4">

        <!-- LOGIN -->
        <div class="tab-pane fade show active" id="login-tab-content" role="tabpanel">
          <h4 class="mb-3">Returning Anggota</h4>

          <form action="login_handler.php" method="POST">
            <div class="mb-3">
              <label>Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
              <label>Password</label>
              <input type="password" class="form-control" name="password" required>
              <div class="text-end mt-2">
                <a href="#" id="btn-show-forgot">Lupa Password?</a>
              </div>
            </div>

            <button class="btn btn-primary w-100 mb-3">Login</button>

            <a href="google_login.php" class="btn btn-google w-100">
              <i class="fab fa-google"></i> Login dengan Google
            </a>
          </form>
        </div>

        <!-- REGISTER -->
        <div class="tab-pane fade" id="register-tab-content" role="tabpanel">
          <h4 class="mb-3">New Anggota</h4>

          <form action="register_handler.php" method="POST">
            <div class="mb-3">
              <label>Full Name</label>
              <input type="text" class="form-control" name="username" required>
            </div>

            <div class="mb-3">
              <label>Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
              </div>
              <div class="col-md-6 mb-3">
                <label>Repeat Password</label>
                <input type="password" class="form-control" name="repeat_password" required>
              </div>
            </div>

            <button class="btn btn-primary w-100">Register</button>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>


 
<style>


/* ### CSS Tambahan (Wajib) */

/* Untuk merapikan tab di dalam modal, **tambahkan** CSS ini ke file CSS utama Anda (atau di dalam tag `<style>` di halaman itu).

```css */
/* --- CSS untuk Merapikan Tab di Modal --- */

/* Beri padding di dalam konten tab, tapi TIDAK di header/footer modal */
.modal-content .tab-content {
    padding: 1.5rem;
}

/* Atur tombol tab */
.modal-content .nav-tabs {
    /* Hapus border bawah default */
    border-bottom: none;
    /* Tambah padding di sekitar tombol tab */
    padding: 1rem 1.5rem 0 1.5rem;
}

.modal-content .nav-tabs .nav-item {
    width: 50%; /* Bikin tombolnya 50/50 */
    text-align: center;
}

.modal-content .nav-tabs .nav-link {
    border: none;
    border-bottom: 3px solid transparent;
    color: #888;
    width: 100%;
}

.modal-content .nav-tabs .nav-link.active {
    /* Ganti warna ini (btn--primary) agar sesuai tema Anda */
    /* Bisa pakai class Anda: var(--primary-color) */
    border-bottom: 3px solid #007bff; 
    color: #333;
    font-weight: bold;
}

/* Tombol Google (dari chat sebelumnya) */
.btn-google {
    background-color: #db4437;
    color: white;
    text-decoration: none; /* Pastikan <a> terlihat seperti tombol */
    display: inline-block; /* Pastikan <a> terlihat seperti tombol */
    line-height: 1.5; /* Sesuaikan agar sebaris */
    padding: .375rem .75rem; /* Samakan dengan padding button */
    text-align: center;
}
.btn-google:hover {
    background-color: #c23321;
    color: white;
}
.btn-google .fab {
    margin-right: 0.5rem;
}




</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    
    // ... (kode modal PDF Anda) ...
    
    // ... (kode AJAX register-form Anda) ...
    
    // === KODE BARU UNTUK LOGIN AJAX ===
    
    const loginForm = $('#login-form');
    const loginErrorMessage = $('#login-error-message');
    
    loginForm.on('submit', function(event) {
        event.preventDefault(); // Hentikan form submit biasa
        
        const loginButton = loginForm.find('button[type="submit"]');
        const originalButtonText = loginButton.html();
        
        // Sembunyikan error lama & tampilkan loading
        loginErrorMessage.hide();
        loginButton.html('Memproses...');
        loginButton.prop('disabled', true);
        
        // Ambil data dari form
        const formData = $(this).serialize();

        // Kirim ke handler
        $.ajax({
            type: 'POST',
            url: 'login_handler.php', // <-- PASTIKAN PATH INI BENAR
            data: formData,
            dataType: 'json', // Kita mengharapkan balasan JSON
            
            success: function(response) {
                // Server bilang sukses
                if (response.success) {
                    // Redirect ke halaman yang disuruh PHP
                    localStorage.setItem("toastMessage", response.message || "Login Berhasil!");
                    // alert(response.message); // Opsional
                    window.location.href = response.redirect_url;
                } else {
                    // Ini tidak seharusnya terjadi, tapi untuk jaga-jaga
                    loginErrorMessage.text(response.message).show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Server bilang GAGAL (HTTP 401 atau 500)
                let errorMessage = "Terjadi kesalahan. Silakan coba lagi.";
                if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
                    errorMessage = jqXHR.responseJSON.message;
                }
                // Tampilkan pesan error di div
                loginErrorMessage.text(errorMessage).show();
            },
            complete: function() {
                // Kembalikan tombol ke normal
                loginButton.html(originalButtonText);
                loginButton.prop('disabled', false);
            }
        });
    });

});
// --- toast hapus session ---
window.addEventListener('DOMContentLoaded', () => {
    const message = localStorage.getItem("toastMessage");
    if (message) {
        Toastify({
            text: message,
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: "#198754",
            close: true,
        }).showToast();

        // Hapus supaya nggak tampil dua kali
        localStorage.removeItem("toastMessage");
    }
});

// === LOGIKA LUPA PASSWORD ===
    
    // Ganti tampilan Login <-> Lupa Password
    $('#btn-show-forgot').on('click', function(e) {
        e.preventDefault();
        $('#login-view').hide();
        $('#forgot-password-view').fadeIn();
    });

    $('#btn-back-to-login').on('click', function(e) {
        e.preventDefault();
        $('#forgot-password-view').hide();
        $('#login-view').fadeIn();
    });

    // Handle Submit Form Lupa Password (AJAX)
    $('#forgot-password-form').on('submit', function(e) {
        e.preventDefault();
        const btn = $(this).find('button[type="submit"]');
        const originalText = btn.text();
        
        btn.text('Mengirim...').prop('disabled', true);
        
        $.ajax({
            type: 'POST',
            url: 'content/forgot_password_handler.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                alert(response.message);
                if (response.success) {
                    // Kembali ke login
                    $('#forgot-password-view').hide();
                    $('#login-view').show();
                }
            },
            error: function() {
                alert("Terjadi kesalahan koneksi.");
            },
            complete: function() {
                btn.text(originalText).prop('disabled', false);
            }
        });
    });
</script>