            </main>
        </div>
        
        <footer class="app-footer">
            <div class="footer-content">
                <div class="footer-copyright">
                    &copy; <?php echo date('Y'); ?> - Praktikum PHP OOP Lanjutan | Universitas Pelita Bangsa
                </div>
                <div class="footer-links">
                    <a href="https://pelitabangsa.ac.id" target="_blank">
                        <i class="fas fa-external-link-alt"></i> Website Kampus
                    </a>
                    <a href="mailto:agung@pelitabangsa.ac.id">
                        <i class="fas fa-envelope"></i> Kontak Dosen
                    </a>
                    <a href="#">
                        <i class="fas fa-question-circle"></i> Bantuan
                    </a>
                </div>
            </div>
        </footer>
    </div>
    
    <script>
        // Simple JavaScript untuk interaksi
        document.addEventListener('DOMContentLoaded', function() {
            // Alert auto dismiss
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateX(-20px)';
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            });
            
            // Confirm dialog untuk delete
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    if (!confirm('Yakin ingin menghapus data ini?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>