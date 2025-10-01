document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    });
  });

document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelector(".slides");
    const dots = document.querySelectorAll(".dot");
    const prevBtn = document.getElementById("prev");
    const nextBtn = document.getElementById("next");
  
    let currentSlide = 0;
  
    const updateSlide = () => {
      // Geser slide berdasarkan index saat ini
      slides.style.transform = `translateX(-${currentSlide * 100}%)`;
  
      // Update dot aktif
      dots.forEach((dot, index) => {
        dot.classList.toggle("active", index === currentSlide);
      });
    };
  
    // Event listener tombol panah
    prevBtn.addEventListener("click", () => {
      currentSlide = (currentSlide - 1 + dots.length) % dots.length;
      updateSlide();
    });
  
    nextBtn.addEventListener("click", () => {
      currentSlide = (currentSlide + 1) % dots.length;
      updateSlide();
    });
  
    // Event listener pada titik
    dots.forEach((dot, index) => {
      dot.addEventListener("click", () => {
        currentSlide = index;
        updateSlide();
      });
    });
});

// Validasi Tanggal (Hanya Hari Ini atau Mendatang)
const dateInput = document.getElementById('date');
const today = new Date().toISOString().split('T')[0];
dateInput.setAttribute('min', today);

// Pilihan Kursi (Interaksi)
const seats = document.querySelectorAll('.seat.available');

// Tambahkan Logika untuk Cinema dan Time
document.getElementById('cinema').addEventListener('change', () => {
    const selectedCinema = document.getElementById('cinema').value;
    console.log("Selected Cinema: ", selectedCinema);
});

document.getElementById('time').addEventListener('change', () => {
    const selectedTime = document.getElementById('time').value;
    console.log("Selected Time: ", selectedTime);
});

document.querySelectorAll('.seat.available').forEach((seat) => {
  seat.addEventListener('click', function() {
      // Jika kursi belum dipilih
      if (!seat.classList.contains('selected')) {
          // Pilih kursi, tambahkan kelas 'selected'
          seat.classList.add('selected');
      } else {
          // Jika kursi sudah dipilih, batal pilih kursi tersebut
          seat.classList.remove('selected');
      }
  });
});
document.querySelectorAll('.view-ticket').forEach(button => {
  button.addEventListener('click', function() {
    alert("Redirecting to ticket details page...");
    // Bisa menambahkan logika untuk mengarahkan ke halaman detail tiket
    window.location.href = 'ticket-details.html';
  });
});








  
  