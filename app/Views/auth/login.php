<?= view('layout/header') ?>

<style>
    /* Hapus Navbar bawaan agar fokus ke login */
    nav.navbar { display: none !important; }

    /* RESET CONTAINER: Memastikan background full screen */
    body {
        background-color: #0f172a; /* Warna gelap modern (Slate 900) */
        color: #e2e8f0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Override container default */
    .container.mt-2 { margin-top: 0 !important; }

    /* CARD DESIGN */
    .card-login {
        background: #1e293b; /* Slate 800 */
        border: 1px solid #334155;
        border-radius: 16px;
        box-shadow: 0 0 40px rgba(0, 0, 0, 0.5); /* Shadow gelap */
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    /* Aksen garis neon di atas kartu */
    .card-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6); /* Gradient Biru-Ungu */
    }

    /* TYPOGRAPHY */
    .brand-title {
        font-weight: 700;
        color: #ffffff;
        letter-spacing: 1px;
    }
    .text-muted-light {
        color: #94a3b8 !important; /* Warna teks abu terang */
    }

    /* FORM INPUTS (Dark Mode) */
    .form-control {
        background-color: #0f172a;
        border: 1px solid #334155;
        color: #f8fafc;
        padding: 12px 15px;
        border-radius: 8px;
    }
    .form-control:focus {
        background-color: #0f172a;
        color: #ffffff;
        border-color: #3b82f6; /* Fokus biru */
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }
    .form-label {
        color: #cbd5e1;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    /* BUTTON */
    .btn-primary {
        background: linear-gradient(90deg, #2563eb, #4f46e5);
        border: none;
        padding: 12px;
        font-weight: 600;
        border-radius: 8px;
        width: 100%;
        margin-top: 1rem;
        transition: opacity 0.3s;
    }
    .btn-primary:hover {
        opacity: 0.9;
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.4);
    }

    /* ALERTS */
    .alert {
        background: #0f172a;
        border: 1px solid;
        color: white;
        font-size: 0.85rem;
    }
    .alert-danger { border-color: #ef4444; color: #fca5a5; }
    .alert-success { border-color: #22c55e; color: #86efac; }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">

            <div class="text-center mb-4">
                <i class="bi bi-hdd-rack-fill text-primary" style="font-size: 3rem;"></i>
                <h3 class="brand-title mt-2">ITools</h3>
                <p class="text-muted-light small">Please sign in to continue</p>
            </div>

            <div class="card card-login">
                
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger p-2 mb-3 text-center rounded">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success p-2 mb-3 text-center rounded">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('auth/login') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary text-secondary">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required value="<?= old('username') ?>">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-dark border-secondary text-secondary">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        LOGIN ACCESS
                    </button>
                </form>

            </div>
            
            <div class="text-center mt-4">
                <small class="text-muted-light">&copy; <?= date('Y') ?> IT Support Tools</small>
            </div>

        </div>
    </div>
</div>

<?= view('layout/footer') ?>