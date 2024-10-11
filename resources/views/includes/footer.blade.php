<!-- <footer>
    <div class="footer-content">
        <p>&copy; 2024 Your Company Name. All rights reserved.</p>
        <ul class="footer-links">
            <li><a href="#privacy">Privacy Policy</a></li>
            <li><a href="#terms">Terms of Service</a></li>
            <li><a href="#contact">Contact Us</a></li>
        </ul>
    </div>
</footer> -->
<script>
    const mobileMenu = document.getElementById('mobile-menu');
    const menu = document.querySelector('.menu');

    mobileMenu.addEventListener('click', () => {
        menu.classList.toggle('active');
    });

    // Function to set the active menu link
    function setActiveMenuLink() {
        const links = document.querySelectorAll('.menu-link');
        const currentHash = window.location.hash;

        links.forEach(link => {
            link.classList.remove('active');

            if (link.getAttribute('href') === currentHash) {
                link.classList.add('active');
            }
        });
    }
    window.addEventListener('load', setActiveMenuLink);
    window.addEventListener('hashchange', setActiveMenuLink);
</script>



