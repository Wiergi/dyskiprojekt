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
        <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.76/build/spline-viewer.js" async></script>
        <spline-viewer loading-anim-type="spinner-big-dark" url="https://prod.spline.design/c7zyhlYqFpTt-vwP/scene.splinecode"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAANCAYAAADISGwcAAAG1ElEQVR4AQCBAH7/ADMvLQ4zLy0LMy8tBTMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tBDMvLQ0zLy0WMy8tHDMvLR4zLy0cMy8tFzMvLQ4zLy0DMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tAzMvLQozLy0OAIEAfv8AMy8tAjMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0BMy8tDDMvLRUzLy0cMy8tHjMvLRwzLy0WMy8tDTMvLQEzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQEAgQB+/wAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQgzLy0UMy8tHzMvLSYzLy0pMy8tJzMvLSEzLy0XMy8tCTMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tAACBAH7/ADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQUzLy0SMy8tITMvLS8zLy07My8tRDMvLUczLy1GMy8tPzMvLTQzLy0lMy8tFTMvLQUzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AAIEAfv8AMy8tDTMvLQwzLy0JMy8tBjMvLQUzLy0FMy8tCDMvLQ8zLy0ZMy8tJzMvLTczLy1IMy8tWDMvLWYzLy1wMy8tdDMvLXMzLy1sMy8tYDMvLVAzLy0+My8tLDMvLRwzLy0OMy8tBTMvLQAzLy0AMy8tADMvLQIzLy0GMy8tCTMvLQsAgQB+/wAzLy0gMy8tHzMvLR0zLy0cMy8tGzMvLR0zLy0hMy8tKjMvLTYzLy1GMy8tWDMvLWozLy18My8tizMvLZUzLy2aMy8tmTMvLZIzLy2GMy8tdTMvLWMzLy1QMy8tPjMvLS8zLy0jMy8tHDMvLRgzLy0YMy8tGjMvLR0zLy0gMy8tIQCBAH7/ADMvLSIzLy0hMy8tIDMvLR4zLy0eMy8tIDMvLSUzLy0uMy8tOzMvLUszLy1eMy8tcTMvLYMzLy2TMy8tnjMvLaMzLy2jMy8tnDMvLZAzLy1/My8tbTMvLVkzLy1HMy8tNzMvLSszLy0kMy8tIDMvLR8zLy0gMy8tIzMvLSUzLy0nAIEAfv8AMy8tDjMvLQ0zLy0LMy8tCTMvLQgzLy0JMy8tDjMvLRYzLy0iMy8tMjMvLUQzLy1XMy8taDMvLXgzLy2DMy8tiTMvLYgzLy2CMy8tdjMvLWczLy1VMy8tQjMvLTEzLy0iMy8tFzMvLRAzLy0MMy8tDDMvLQ4zLy0RMy8tFDMvLRUAgQB+/wAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0IMy8tGDMvLSozLy06My8tSTMvLVMzLy1ZMy8tWTMvLVMzLy1IMy8tOjMvLSkzLy0YMy8tCTMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tAACBAH7/ADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tBDMvLRIzLy0fMy8tKTMvLS4zLy0uMy8tKTMvLR8zLy0SMy8tAzMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AAIEAfv8AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tAzMvLQ8zLy0XMy8tGzMvLRszLy0WMy8tDjMvLQIzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAAgQB+/wAzLy0PMy8tCzMvLQUzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0LMy8tFTMvLRwzLy0gMy8tHzMvLRszLy0TMy8tCTMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQAzLy0GMy8tCQGBAH7/ADMvLSgzLy0kMy8tHTMvLRQzLy0LMy8tAjMvLQAzLy0AMy8tADMvLQAzLy0EMy8tDTMvLRczLy0gMy8tJjMvLSozLy0pMy8tJTMvLR0zLy0UMy8tCTMvLQAzLy0AMy8tADMvLQAzLy0AMy8tADMvLQMzLy0MMy8tFTMvLRszLy0fRCMSB3VDaasAAAAASUVORK5CYII=" alt="Spline preview" style="width: 100%; height: 100%;"/></spline-viewer>
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
        </div>
</section>


<section class="about-store">
    <div class="container">
    <section class="about-company">
    <div class="container">
        <div class="company-info">
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

<script src="script.js">
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
</script>
</body>
</html>
