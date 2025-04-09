<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dyski</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <nav class="navbar">
        <input type="checkbox" id="sidebar-active">
        <label for="sidebar-active" class="open-sidebar-button">
        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="undefined"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
        </label>
        <label id="overlay" for="sidebar-active"></label>
        
    <div class="navbar_container">
            <label for="sidebar-active" class="close-sidebar-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="undefined"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
            </label>  
            <a href="index.php" class="home-link" id="home-page"><img src="photos/logo.svg" alt="LOGO"  id="logo" height="80"></a>
            <a href="#about" class="about-link" id="about-page">About us</a>
            <a href="produkty.php" class="ulsugi-link" id="assortment">Our assortment</a>
            <a href="#contact" class="contact-link" id="contact-page">Contact</a>
            <a href="koszyk.php" class="button" id="cart-page"><img src="photos/cart.svg" alt="cart" class="cart" height="60px"></a>
    </div>
</nav>
    <div class="tło">
        <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.75/build/spline-viewer.js"></script>
        <spline-viewer loading-anim-type="none" url="https://prod.spline.design/7-VPo83PtXxNG7gw/scene.splinecode"></spline-viewer>
    </div>
    <div class="dysk">
    <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.82/build/spline-viewer.js" async></script>
    <spline-viewer loading-anim-type="spinner-big-dark" url="https://prod.spline.design/c7zyhlYqFpTt-vwP/scene.splinecode"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAANCAYAAADISGwcAAAG1ElEQVR4AQCBAH7/AEk9LwpJPS8HST0vAUk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAkk9LwxJPS8VST0vG0k9Lx5JPS8dST0vF0k9Lw9JPS8EST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vB0k9Lw9JPS8SAIEAfv8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vC0k9LxVJPS8bST0vHkk9Lx1JPS8XST0vDkk9LwJJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAUk9LwQAgQB+/wBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwdJPS8UST0vHkk9LyZJPS8pST0vJ0k9LyFJPS8XST0vCkk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAACBAH7/AEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwVJPS8TST0vIUk9Ly9JPS87ST0vREk9L0dJPS9GST0vP0k9LzRJPS8lST0vFUk9LwVJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AAIEAfv8AST0vEEk9Lw5JPS8MST0vCUk9LwdJPS8HST0vCkk9LxFJPS8bST0vKUk9LzlJPS9JST0vWUk9L2dJPS9wST0vdEk9L3JJPS9rST0vX0k9L09JPS89ST0vK0k9LxpJPS8NST0vA0k9LwBJPS8AST0vAEk9LwBJPS8DST0vB0k9LwkAgQB+/wBJPS8kST0vI0k9LyFJPS8fST0vH0k9LyBJPS8lST0vLUk9LzlJPS9IST0vWkk9L2xJPS99ST0vjEk9L5ZJPS+aST0vmUk9L5FJPS+FST0vdEk9L2FJPS9OST0vO0k9LyxJPS8gST0vGEk9LxVJPS8UST0vFkk9LxlJPS8cST0vHQCBAH7/AEk9LydJPS8mST0vJEk9LyJJPS8iST0vJEk9LylJPS8xST0vPkk9L05JPS9gST0vc0k9L4VJPS+UST0vn0k9L6RJPS+iST0vm0k9L49JPS9+ST0va0k9L1dJPS9EST0vNEk9LyhJPS8gST0vHEk9LxtJPS8cST0vH0k9LyFJPS8iAIEAfv8AST0vEkk9LxFJPS8PST0vDUk9LwxJPS8NST0vEUk9LxlJPS8lST0vNEk9L0ZJPS9YST0vakk9L3lJPS+DST0viUk9L4hJPS+BST0vdUk9L2VJPS9TST0vQEk9Ly5JPS8fST0vFEk9LwxJPS8JST0vCEk9LwpJPS8NST0vEEk9LxEAgQB+/wBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8KST0vGkk9LytJPS87ST0vSUk9L1RJPS9ZST0vWEk9L1JJPS9HST0vOUk9LyhJPS8XST0vB0k9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAACBAH7/AEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vBEk9LxNJPS8gST0vKUk9Ly5JPS8uST0vKUk9Lx9JPS8SST0vA0k9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AAIEAfv8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vA0k9Lw5JPS8XST0vG0k9LxtJPS8XST0vDkk9LwNJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwAAgQB+/wBJPS8LST0vCEk9LwJJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8KST0vFEk9LxtJPS8fST0vH0k9LxtJPS8UST0vCkk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwBJPS8AST0vAEk9LwNJPS8JST0vDQGBAH7/AEk9LyNJPS8gST0vGUk9LxBJPS8HST0vAEk9LwBJPS8AST0vAEk9LwBJPS8CST0vC0k9LxVJPS8fST0vJkk9LylJPS8pST0vJkk9Lx9JPS8VST0vC0k9LwJJPS8AST0vAEk9LwBJPS8AST0vAEk9LwdJPS8QST0vGUk9LyBJPS8jD7pPzGd2jVAAAAAASUVORK5CYII=" alt="Spline preview" style="width: 100%; height: 100%;"/></spline-viewer>
    </div>
    <div class="banner">
    <video autoplay muted loop playsinline class="banner-video">
        <source src="photos/video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="banner-content">
        <a href="produkty.php" class="explore-button">Explore</a>
    </div>
</div>
<section class="slider">
        <h2>OUR PARTNERS</h2>
        <div class="slide">
            <div class="logos-slides">
                <img src="photos/zdj.svg" alt="Logo 1">
                <img src="photos/zdj2.svg" alt="Logo 2">
                <img src="photos/zdj3.svg" alt="Logo 3">
                <img src="photos/zdj4.svg" alt="Logo 4">
                <img src="photos/zdj5.svg" alt="Logo 5">
                <img src="photos/zdj6.svg" alt="Logo 6">
                <img src="photos/zdj7.svg" alt="Logo 7">
                <img src="photos/zdj8.svg" alt="Logo 8">
            </div>
            <div class="logos-slides">
                <img src="photos/zdj.svg" alt="Logo 1">
                <img src="photos/zdj2.svg" alt="Logo 2">
                <img src="photos/zdj3.svg" alt="Logo 3">
                <img src="photos/zdj4.svg" alt="Logo 4">
                <img src="photos/zdj5.svg" alt="Logo 5">
                <img src="photos/zdj6.svg" alt="Logo 6">
                <img src="photos/zdj7.svg" alt="Logo 7">
                <img src="photos/zdj8.svg" alt="Logo 8">
            </div>
            <div class="logos-slides">
                <img src="photos/zdj.svg" alt="Logo 1">
                <img src="photos/zdj2.svg" alt="Logo 2">
                <img src="photos/zdj3.svg" alt="Logo 3">
                <img src="photos/zdj4.svg" alt="Logo 4">
                <img src="photos/zdj5.svg" alt="Logo 5">
                <img src="photos/zdj6.svg" alt="Logo 6">
                <img src="photos/zdj7.svg" alt="Logo 7">
                <img src="photos/zdj8.svg" alt="Logo 8">
            </div>
        </div>
</section>


<section class="about-store">
    <div class="container">
    <section class="about-company">
    <div class="container">
        <div class="company-info">
            <h1>WE DON'T FORGET</h1>
            <h3>About us</h3>
            <p>We are a company that specializes in the sale of high-quality disks. Our products are designed to meet the needs of both professional and amateur users. We offer a wide range of disks for various applications, including hard drives, solid-state drives, and optical disks.</p>

        </div>
        <div class="company-video">
            <video autoplay muted loop playsinline>
                <source src="photos/video1.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</section>
<section class="horizontal-roadmap-section">
        <div class="container">
            <h2>Our Evolution</h2>
            
            <div class="horizontal-roadmap">
                <div class="timeline-line"></div>
                <div class="timeline-progress" id="timelineProgress"></div>
                
                <div class="roadmap-container" id="roadmapContainer">
                    <div class="roadmap-item active">
                        <div class="roadmap-content">
                            <div class="roadmap-year">2005</div>
                            <h3 class="roadmap-title">Beginnings – A Passion for Technology</h3>
                            <p class="roadmap-text">In 2005, a group of tech enthusiasts fascinated by data storage decided to create a place where customers could find the best memory drives. In a small garage in Warsaw, the idea for WDC was born—a company that would revolutionize the disk market in Poland.</p>
                        </div>
                    </div>
                    
                    <div class="roadmap-item">
                        <div class="roadmap-content">
                            <div class="roadmap-year">2010-2012</div>
                            <h3 class="roadmap-title">Growth – From a Small Shop to a Market Leader</h3>
                            <p class="roadmap-text">The early years were tough—we mostly sold used HDDs and CD/DVD drives. However, thanks to product quality and honest customer service, we quickly gained trust. In 2010, we opened our first brick-and-mortar store, and in 2012, we launched an online shop, allowing us to reach customers across Poland.</p>
                        </div>
                    </div>
                    
                    <div class="roadmap-item">
                        <div class="roadmap-content">
                            <div class="roadmap-year">2018</div>
                            <h3 class="roadmap-title">Innovation – Toward the Future</h3>
                            <p class="roadmap-text">As SSDs began dominating the market, we adapted quickly, offering cutting-edge storage solutions for gamers, businesses, and data centers. In 2018, we became an official distributor for top brands like Samsung, WD, and Seagate, solidifying our reputation as a reliable tech partner.</p>
                        </div>
                    </div>
                    
                    <div class="roadmap-item">
                        <div class="roadmap-content">
                            <div class="roadmap-year">Today</div>
                            <h3 class="roadmap-title">More Than Just Disks</h3>
                            <p class="roadmap-text">WDC isn't just about selling storage—we educate customers on data security, help businesses optimize their storage infrastructure, and support eco-friendly recycling of old drives. Our mission remains the same: delivering speed, reliability, and peace of mind in the digital age.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="nav-arrows">
                <div class="arrow" id="prevBtn">←</div>
                <div class="arrow" id="nextBtn">→</div>
            </div>
        </div>
        <footer>
        <div class="footer__container">
        <div class="footer__links">
            <div class="footer__link--wrapper">
                <div class="footer__link--items">
                    <h2>US</h2>
                    <a href="#">From 2005</a>
                    <a href="#">Your favorite shop</a>
                    <a href="#">Phone: 76 7232307</a>
                    <a href="#"></a>email: YourDISCS@gmail.com</a>
                    <a href="adminpanel/index.php">Admin Panel</a>
                </div>
                <div class="footer__link--items">
                    <h2>Ours social Media </h2>
                    <a href="https://www.facebook.com/bartek.wiergan/">Facebook</a>
                    <a href="https://www.instagram.com/wiergi_/?hl=pl">Instagram</a>
                </div>
            </div>
        </div>
        <section class="social__media">
            <div class="social__media--wrap">
                <div class="footer__logo">
                    <a href="" id="footer__logo">WDC</a>
                </div>
                <p class="website__rights">© Bartosz Wiergan</p>
                <div class="social__icons">
                    <a href="https://www.facebook.com/bartek.wiergan/" class="social__icon--link" target="_blank"><img class="fab fa-facebook"></img></a>
                    <a href="https://www.instagram.com/wiergi_/?hl=pl" class="social__icon--link" target="_blank"><i class="fab fa-instagram"></i></a>
                
                </div>
            </div>
        </section>
    </div>
</footer>
<script>
document.addEventListener("scroll", function() {
    const banner = document.querySelector(".banner");

    if (window.scrollY >= banner.offsetTop - window.innerHeight/2) {
        banner.classList.add("scrolled");
        console.log("Klasa .scrolled dodana:", banner.classList.contains("scrolled"));
    } else {
        banner.classList.remove("scrolled");
        console.log("Klasa .scrolled usunięta:", banner.classList.contains("scrolled"));
    }
});

const container = document.getElementById('roadmapContainer');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const timelineProgress = document.getElementById('timelineProgress');
const items = document.querySelectorAll('.roadmap-item');

// Initialize first item as active
let activeIndex = 0;
updateActiveItem();

// Calculate progress bar width
function updateProgress() {
    const scrollWidth = container.scrollWidth - container.clientWidth;
    const scrollPosition = container.scrollLeft;
    const progress = (scrollPosition / scrollWidth) * 100;
    timelineProgress.style.width = `${progress}%`;
}

// Update active item based on scroll position
function updateActiveItem() {
    const containerRect = container.getBoundingClientRect();
    const containerCenter = containerRect.left + containerRect.width / 2;
    
    items.forEach((item, index) => {
        const itemRect = item.getBoundingClientRect();
        const itemCenter = itemRect.left + itemRect.width / 2;
        
        if (Math.abs(itemCenter - containerCenter) < itemRect.width / 2) {
            item.classList.add('active');
            activeIndex = index;
        } else {
            item.classList.remove('active');
        }
    });
}

// Navigation controls
nextBtn.addEventListener('click', () => {
    container.scrollBy({
        left: 400,
        behavior: 'smooth'
    });
});

prevBtn.addEventListener('click', () => {
    container.scrollBy({
        left: -400,
        behavior: 'smooth'
    });
});

// Update on scroll
container.addEventListener('scroll', () => {
    updateProgress();
    updateActiveItem();
});

// Handle keyboard navigation
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight') {
        container.scrollBy({
            left: 400,
            behavior: 'smooth'
        });
    } else if (e.key === 'ArrowLeft') {
        container.scrollBy({
            left: -400,
            behavior: 'smooth'
        });
    }
});
</script>
</body>
</html>
