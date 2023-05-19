<div class="sidebar-shadow"></div>
<div class="sidebar">
    <div class="sidebar-icons">
        <ul class="sidebar-icon-list">
            <li><a href="home"><img src="public/img/sidebar/home.svg" alt="home"></a></li>
            <li><a href="waiting-room"><img src="public/img/sidebar/waiting-room.svg" alt="waiting-room"></a></li>
            <li><a href="random-meme"><img src="public/img/sidebar/random-meme.svg" alt="random-meme"></a></li>
            <?php
            if ($userIsAuthenticated) {
                echo '
                <li><a href="favorites"><img src="public/img/sidebar/favorites.svg" alt="favorites"></a></li>
                <li><a href="add-meme"><img src="public/img/sidebar/add-meme.svg" alt="add-meme"></a></li>
                ';
            }
            ?>
        </ul>
        <ul class="sidebar-icon-list">
            <li>
                <label class="toggleButton">
                    <input type="checkbox" id="toggleCheckbox">
                    <span id="toggleButton" class="toggleButton-slider toggleButton-round"></span>
                </label>
            </li>
            <?php
            if ($userIsAuthenticated) {
                echo '
                <li><a href="profile"><img src="public/img/sidebar/profile.svg" alt="profile"></a></li>
                <li><a href="logout"><img src="public/img/sidebar/logout.svg" alt="logout"></a></li>
                ';
            } else {
                echo '
                <li><a href="login"><img src="public/img/sidebar/login.svg" alt="login"></a></li>
                <li><a href="register"><img src="public/img/sidebar/register.svg" alt="register"></a></li>
                ';
            }
            ?>
        </ul>
        <ul class="sidebar-icon-list d-none-sx">
            <li><img class="sidebar-arrow sidebar-toggle" id="sidebar-arrow" src="public/img/sidebar/arrow-right.svg"
                    alt="arrow-right"></li>
        </ul>
        <ul class="sidebar-icon-list d-show-sx">
            <li><img class="sidebar-arrow sidebar-toggle" src="public/img/sidebar/arrow-left.svg" alt="arrow-right">
            </li>
        </ul>
    </div>
    <div class="sidebar-content">
        <ul class="sidebar-content-list">
            <li><a href="home">Główna</a></li>
            <li><a href="waiting-room">Poczekalnia</a></li>
            <li><a href="random-meme">Losowy mem</a></li>
            <?php
            if ($userIsAuthenticated) {
                echo '
                <li><a href="favorites">Ulubione</a></li>
                <li><a href="add-meme">Dodaj mema</a></li>
                ';
            }
            ?>
        </ul>
        <ul class="sidebar-content-list">
            <li onclick="listenToggleText()">Zmień motyw</li>
            <?php
            if ($userIsAuthenticated) {
                echo '
                <li><a href="profile">Profil</a></li>
                <li><a href="logout">Wyloguj</a></li>
                ';
            } else {
                echo '
                <li><a href="login">Zaloguj</a></li>
                <li><a href="register">Zarejestruj</a></li>
                ';
            }
            ?>

        </ul>
        <ul class="sidebar-content-list d-none-sx">
            <li class="sidebar-toggle" id="sidebar-arrow-text">Zatrzymaj</li>
        </ul>
        <ul class="sidebar-content-list d-show-sx">
            <li class="sidebar-toggle">Schowaj</li>
        </ul>
    </div>
</div>