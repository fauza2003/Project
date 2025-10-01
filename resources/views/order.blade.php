<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket - GoCinema</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link Tailwind CSS untuk styling modern -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary-dark': '#1a1a1a',
                        'secondary-red': '#e50914',
                        'accent-gold': '#ffc107',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f4f4;
        }
        .order-card {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* --- SEAT MAP STYLING --- */
        .seating-section {
            background-color: #f8f8f8;
            padding: 2rem;
            border-radius: 0.75rem;
        }

        .screen {
            background-color: #1a1a1a;
            height: 8px;
            border-radius: 5px;
            margin-bottom: 2rem;
            position: relative;
        }
        .screen-label {
            position: absolute;
            top: -2rem;
            left: 50%;
            transform: translateX(-50%);
            color: #1a1a1a;
            font-weight: bold;
            font-size: 1.1rem;
        }

        /* CSS Grid untuk Tata Letak Kursi */
        .seats-grid {
            display: grid;
            grid-template-columns: 20px repeat(12, 1fr) 20px; /* Baris + 12 Kursi + Baris */
            gap: 5px;
            justify-content: center;
        }

        /* Seat Input/Label Styling */
        .seat-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .seat-label {
            color: #888;
            font-size: 0.75rem;
            margin-top: 2px;
        }
        
        /* Kursi (Custom Checkbox) */
        .seat-input {
            display: none;
        }
        .seat-visual {
            width: 28px;
            height: 25px;
            background-color: #ccc;
            border-radius: 5px 5px 2px 2px;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            color: #1a1a1a;
        }
        .seat-visual:hover {
            transform: scale(1.1);
        }

        /* State: Dipilih */
        .seat-input:checked + .seat-visual {
            background-color: #e50914; /* secondary-red */
            color: white;
        }

        /* State: Tersedia/Bukan Checkbox */
        .row-label {
            font-weight: bold;
            color: #1a1a1a;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .seats-grid {
                grid-template-columns: 15px repeat(10, 1fr) 15px; /* Kurangi kolom saat mobile */
                gap: 3px;
            }
            .seat-visual {
                width: 25px;
                height: 22px;
            }
        }

        /* Styling Summary */
        .order-summary {
            background-color: #1a1a1a;
            color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
        }
    </style>
</head>

<body>
    @include('layout.header')

    <!-- Order Form Section -->
    <div class="container py-8 md:py-12">
        <div class="order-card p-6 md:p-8">
            <h2 class="text-3xl font-bold text-primary-dark mb-4">Pesan Tiket: {{ $movieTitle }}</h2>
            
            <div class="row">
                <div class="col-md-7">
                    <!-- SEAT SELECTION FORM -->
                    <form action="{{ route('submitOrder') }}" method="POST" id="order-form">
                        @csrf
                        <input type="hidden" name="movie_title" value="{{ $movieTitle }}">
                        <input type="hidden" id="selected_seats_input" name="seats" value="">

                        <!-- Input Nama dan Email -->
                        <h3 class="text-xl font-semibold text-primary-dark mb-3">Informasi Pemesan</h3>
                        <div class="mb-3">
                            <label for="name" class="form-label font-semibold">Nama Anda</label>
                            <input type="text" id="name" name="name" class="form-control p-3 rounded-lg border-gray-300" required>
                        </div>

                        <div class="mb-5">
                            <label for="email" class="form-label font-semibold">Email Anda</label>
                            <input type="email" id="email" name="email" class="form-control p-3 rounded-lg border-gray-300" required>
                        </div>

                        <!-- Seat Selection Section -->
                        <h3 class="text-xl font-semibold text-primary-dark mb-4">Pilih Kursi</h3>
                        <div class="seating-section shadow-inner">
                            <div class="screen"></div>
                            <div class="screen-label">LAYAR</div>

                            <div class="seats-grid">
                                
                                <!-- Header Kolom Kursi -->
                                <div class="row-label"></div>
                                @foreach (range(1, 12) as $seatNumber)
                                    <div class="row-label">{{ $seatNumber }}</div>
                                @endforeach
                                <div class="row-label"></div>

                                <!-- Kursi Baris A sampai G -->
                                @foreach (range('A', 'G') as $row)
                                    <!-- Label Baris Kiri -->
                                    <div class="row-label">{{ $row }}</div>
                                    @foreach (range(1, 12) as $seatNumber)
                                        <div class="seat-wrapper">
                                            <input type="checkbox" id="seat{{ $row }}{{ $seatNumber }}" 
                                                   class="seat-input" data-seat="{{ $row }}{{ $seatNumber }}" 
                                                   data-row="{{ $row }}" data-number="{{ $seatNumber }}">
                                            <label for="seat{{ $row }}{{ $seatNumber }}" 
                                                   class="seat-visual">{{ $row }}</label>
                                        </div>
                                    @endforeach
                                    <!-- Label Baris Kanan -->
                                    <div class="row-label">{{ $row }}</div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Hidden Quantity Input -->
                        <input type="hidden" id="quantity" name="quantity" value="0">

                        <div class="mt-6">
                            <button type="submit" id="submit-button" class="btn bg-secondary-red text-white hover:bg-red-700 font-bold py-3 w-full rounded-lg shadow-md transition duration-200" disabled>
                                Pesan Tiket (Rp 0)
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-md-5 mt-5 md:mt-0">
                    <!-- ORDER SUMMARY -->
                    <div class="order-summary">
                        <h3 class="text-2xl font-bold mb-4">Ringkasan Pesanan</h3>
                        <p class="mb-2">Film: <span class="font-semibold text-accent-gold">{{ $movieTitle }}</span></p>
                        <p class="mb-2">Harga per Tiket: <span class="font-semibold text-accent-gold" id="price-per-ticket">Rp 50.000</span></p>
                        <hr class="border-gray-700 my-3">
                        
                        <p class="mb-2">Total Tiket: <span class="font-bold text-accent-gold" id="total-quantity">0</span></p>
                        <p class="mb-4">Kursi Dipilih: <span class="font-bold text-accent-gold" id="selected-seats-display">Belum ada</span></p>
                        
                        <div class="mt-4 pt-3 border-t border-gray-700">
                            <p class="text-xl font-extrabold">Total Pembayaran:</p>
                            <span class="text-3xl font-extrabold text-secondary-red" id="total-price">Rp 0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS Fungsionalitas Kursi -->
    <script>
        const seatInputs = document.querySelectorAll('.seat-input');
        const selectedSeatsDisplay = document.getElementById('selected-seats-display');
        const totalQuantity = document.getElementById('total-quantity');
        const totalCostElement = document.getElementById('total-price');
        const submitButton = document.getElementById('submit-button');
        const hiddenQuantityInput = document.getElementById('quantity');
        const hiddenSeatsInput = document.getElementById('selected_seats_input');
        
        const PRICE_PER_TICKET = 50000; // Harga default

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(number);
        }

        function updateSummary() {
            const selectedSeats = Array.from(seatInputs)
                .filter(input => input.checked)
                .map(input => input.dataset.seat); // Ambil data-seat: A1, B5, dll.

            const quantity = selectedSeats.length;
            const totalPrice = quantity * PRICE_PER_TICKET;

            // Update display
            totalQuantity.textContent = quantity;
            totalCostElement.textContent = formatRupiah(totalPrice);
            selectedSeatsDisplay.textContent = quantity > 0 ? selectedSeats.join(', ') : 'Belum ada';
            
            // Update hidden form fields for submission
            hiddenQuantityInput.value = quantity;
            hiddenSeatsInput.value = selectedSeats.join(',');

            // Update button state and text
            submitButton.disabled = quantity === 0;
            submitButton.textContent = `Pesan Tiket (${formatRupiah(totalPrice)})`;
        }

        // Initialize display on load
        updateSummary();

        // Event listener for all seats
        seatInputs.forEach(input => {
            input.addEventListener('change', updateSummary);
        });
    </script>
</body>
</html>
