document.addEventListener('DOMContentLoaded', () => {
  // Inisialisasi Feather Icons
  feather.replace();

  // Tombol Back to Top
  const backToTopBtn = document.getElementById('backToTop');

  // Munculkan tombol saat scroll ke bawah
  window.addEventListener('scroll', () => {
    if (window.scrollY > 200) {
      backToTopBtn.style.display = 'block';
    } else {
      backToTopBtn.style.display = 'none';
    }
  });

  // Fungsi scroll ke atas
  backToTopBtn.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth',
    });
  });

  // Hover animasi ikon
  const icons = document.querySelectorAll('.icons i');
  icons.forEach((icon) => {
    icon.addEventListener('mouseover', () => {
      icon.style.transform = 'scale(1.2)';
    });

    icon.addEventListener('mouseout', () => {
      icon.style.transform = 'scale(1)';
    });
  });
});
