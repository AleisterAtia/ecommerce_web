<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Responsive watches website - Bedimcode</title>
</head>

<body>

    @include('partials.header')

    @include('partials.cart')


    <main class="main">
        @yield('container') {{-- Tempat untuk konten dinamis dari halaman lain --}}
    </main>

    @include('partials.footer')

    <a href="#" class="scrollup" id="scroll-up">
        <i class='bx bx-up-arrow-alt scrollup__icon'></i>
    </a>

    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('js/main.js?v=' . filemtime(public_path('js/main.js'))) }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- <div class="toast-container position-fixed top-0 end-0 p-3">
    </div> --}}
    {{-- Letakkan ini di layouts/main.blade.php sebelum </body> --}}

    {{-- @if (session('success'))
        <script>
            // Membuat elemen toast baru secara dinamis
            const toastContainer = document.querySelector('.toast-container');
            const toastEl = document.createElement('div');
            toastEl.classList.add('toast', 'align-items-center', 'text-bg-success', 'border-0');
            toastEl.setAttribute('role', 'alert');
            toastEl.setAttribute('aria-live', 'assertive');
            toastEl.setAttribute('aria-atomic', 'true');

            toastEl.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <i class="bx bxs-check-circle me-2"></i>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;

            // Menambahkan toast ke dalam container
            toastContainer.appendChild(toastEl);

            // Membuat instance Bootstrap Toast dan menampilkannya
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        </script>
    @endif --}}
    {{-- Letakkan ini di layouts/main.blade.php sebelum </body> --}}

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 2000, // Pop-up akan hilang setelah 2 detik
                showConfirmButton: false, // Menghilangkan tombol "OK"
                toast: true, // Membuatnya sedikit lebih kecil seperti toast
                position: 'top-end' // Posisi di pojok kanan atas
            });
        </script>
    @endif
</body>


</html>
