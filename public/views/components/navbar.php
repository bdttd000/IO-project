<header class="header" id="header">
    <div class="drop-shadow">
        <nav class="nav container">
            <div class="burger-button">
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
                <li>Glówna</li>
                <li>Poczekalnia</li>
                <li>Losowy mem</li>
                <li>Dodaj mema</li>
                <li>Ulubione</li>
                <li>Profil</li>
            </ul>
            <?php
            if ($userIsAuthenticated) {
                echo '<a href="logout">Wyloguj</a>';
            } else {
                echo '<a href="login">Zaloguj</a>';
            }
            ?>
        </nav>
    </div>
</header>