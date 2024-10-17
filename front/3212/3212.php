<?php
if (!class_exists('lessc')) {
    require_once(dirname($_SERVER['SCRIPT_FILENAME']) . '/libs/lessc.inc.php');
}
$less = new lessc;
$less->compileFile('less/3212.less', 'css/3212.css');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/3212.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div id="qodef-page-footer-top-area">
        <div class="qodef-content-grid">
            <div class="qodef-grid qodef-layout--columns qodef-col-num--2">
                <div class="qodef-grid-inner">
                    <div class="qodef-grid-item">
                        <div class="widget_text widget_custom_html">
                            <div class="qodef-custom-footer-logo">
                                <img src="https://emeritus.qodeinteractive.com/wp-content/uploads/2020/11/side-area-logo.jpg" alt="a" width="75">
                                <h5>Emeritus Education System</h5>
                            </div>
                        </div>
                    </div>
                    <div class="qodef-grid-item">
                        <div class="qodef-separator">
                            <div class="qodef-m-line"></div>
                        </div>
                        <div class="widget_text widget_custom_html">
                            <p class="alright">© 2021 Qode Interactive, All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="column">
                <h3>Studies</h3>
                <ul>
                    <li>Bachelor</li>
                    <li>Master</li>
                    <li>Undergraduate</li>
                    <li>Postgraduate</li>
                    <li>Study online</li>
                </ul>
            </div>
            <div class="column">
                <h3>Life</h3>
                <ul>
                    <li>College Campus</li>
                    <li>Sport Center</li>
                    <li>Sport Center</li>
                    <li>Facilities</li>
                    <li>Take a tour</li>
                </ul>
            </div>
            <div class="column">
                <h3>Programs</h3>
                <ul>
                    <li>The Arts</li>
                    <li>Human Sciences</li>
                    <li>Economics</li>
                    <li>Natural Sciences</li>
                    <li>Business</li>
                </ul>
            </div>
            <div class="column">
                <h3>Contact</h3>
                <p>1028 Richison Drive</p>
                <p>emeritus@example.com</p>
                <p>+0800 327 8534</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>