<header class="header" id="header">
    <div class="drop-shadow">
        <nav class="nav container">
            <div class="burger-button" id="navbar-burger">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="navbar-brand">
                <h2 class="navbar-brand-name">MEM</h2>
                <img class="navbar-brand-logo" src="public/img/logo.svg" alt="Logo memonks">
                <h2 class="navbar-brand-name">ONKS</h2>
            </div>
            <ul class="navbar-list">
                <li><a href="home">Główna</a></li>
                <li><a href="waitingRoom">Poczekalnia</a></li>
                <li><a href="meme">Losowy mem</a></li>
                <?php
                if ($SessionController->isLogged()) {
                    $userInfo = $userInfo ?: $SessionController->unserializeUser();

                    echo '
                    <li><a href="addMeme">Dodaj mema</a></li>
                    <li><a href="favorites">Ulubione</a></li>
                    <li><a href="profile?userid=' . $userInfo->getUserID() . '">Profil</a></li>
                    ';
                }
                ?>
            </ul>
            <?php
            if ($SessionController->isLogged()) {
                echo '
                <a class="navbar-list-d-none-sx" href="logout">Wyloguj</a>
                ';
            } else {
                echo '
                <div class="navbar-list-d-none-sx">
                <a href="login">Zaloguj</a>
                <a href="register">Zarejestruj</a>
                </div>
                ';
            }
            ?>
        </nav>
    </div>
</header>