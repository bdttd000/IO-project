## Cel projektu: Stworzenie strony z memami

### Zaimplementowane technologie

HTML - język znaczników używanym do tworzenia struktur i zawartości stron internetowych. Pozwala na definiowanie elementów takich jak nagłówki, paragrafy, listy, tabele, obrazy i linki. HTML jest podstawowym składnikiem stron internetowych i jest interpretowany przez przeglądarki internetowe.

CSS - język używanym do opisywania wyglądu i formatowania stron internetowych napisanych w HTML. Pozwala na kontrolę takich aspektów jak kolory, czcionki, marginesy, wyrównanie, tło i wiele innych. Dzięki CSS możemy oddzielić prezentację strony od jej zawartości, co ułatwia utrzymanie i modyfikację stylu strony.

PHP - język programowania często używanym do tworzenia stron internetowych dynamicznych. PHP pozwala na generowanie dynamicznej zawartości, przetwarzanie formularzy, manipulację plikami, interakcję z bazami danych i wiele innych. Skrypty PHP są wykonywane po stronie serwera i wynik ich działania jest przesyłany do przeglądarki.

Docker - platforma open-source do wdrażania i uruchamiania aplikacji w kontenerach. Kontenery Docker są lekkimi, przenośnymi i izolowanymi jednostkami, które zawierają wszystko, co jest potrzebne do uruchomienia aplikacji, włącznie z kodem, zależnościami i konfiguracją. Dzięki Dockerowi można łatwo uruchomić aplikację na różnych środowiskach, niezależnie od systemu operacyjnego czy konfiguracji sprzętowej.

PostgreSQL - potężny, otwartoźródłowy system zarządzania bazą danych relacyjnych. Posiada wiele zaawansowanych funkcji, takich jak transakcje, klucze obce, indeksy, widoki i triggery. PostgreSQL obsługuje standardowy język zapytań SQL oraz oferuje rozszerzenia, które umożliwiają bardziej zaawansowane operacje i funkcje.

### Struktura strony

...

### Funkcjonalności

...

### Diagramy

#### Diagram ERD

<img src="./readme-images/diagram_erd.png" width=800px />

#### Diagram UML

<img src="./readme-images/diagram_uml.png" width=800px />

### Figma

[kliknij tutaj](https://www.figma.com/file/t94vF4c78WgwzIS14Ocx5m/IO?node-id=1%3A8&t=epHnj09kp8rHfNhz-1)

## Format Pracy

#### Git workflow to sposób organizacji pracy z systemem kontroli wersji Git. Istnieje wiele różnych podejść do tego, ale jednym z popularnych modeli jest GitFlow. Oto krótka informacja na temat działania GitFlow:

- Głównym elementem GitFlow są dwie gałęzie: "master" i "develop". Gałąź "master" zawiera stabilny kod produkcyjny, natomiast gałąź "develop" służy do integracji kodu.

- Aby rozpocząć pracę nad nowym zadaniem, tworzymy gałąź funkcji od gałęzi "develop". Ta gałąź jest tworzona dla każdej nowej funkcji, której praca jest rozpoczynana.

- Kiedy praca nad funkcją zostanie ukończona, gałąź funkcji jest scalana z gałęzią "develop". W ten sposób wprowadzamy zmiany do głównej gałęzi projektu.

- Przed wprowadzeniem zmian z gałęzi "develop" do "master" tworzona jest gałąź "release". Na tej gałęzi dokonywane są ostatnie poprawki, testy i przygotowania przed wydaniem nowej wersji.

- Po zakończeniu prac na gałęzi "release", jest ona scalana z gałęzią "master", a także z gałęzią "develop". Dodatkowo, po scaleniu z gałęzią "master", oznaczamy ten punkt jako nową wersję oprogramowania.

- Jeśli wystąpią błędy lub problemy po wydaniu wersji, naprawki są wykonywane na gałęzi "hotfix". Gałąź "hotfix" jest tworzona bezpośrednio z gałęzi "master", aby umożliwić szybkie wprowadzenie poprawek do stabilnej wersji.

- Po naprawieniu błędu na gałęzi "hotfix", zmiany są scalane z gałęzią "master" i "develop". Po scaleniu z "master" oznaczamy ten punkt jako nową wersję.

GitFlow pomaga w zorganizowaniu pracy zespołu, umożliwiając równoczesne tworzenie nowych funkcji, poprawki błędów oraz utrzymanie stabilnej wersji produkcyjnej.

##### Z racji poziomu zaawansowania projektu oraz faktu, iż jest to dopiero prototyp, ominiemy gałęzie takie jak release oraz hotfix.

<img src="./readme-images/workflow.png" width=800px />

## Kierunek rozwoju

Aplikacja przez swoją łatwą skalowalność może w przyszłości wiele funckcji i nowych rozwiązań dla starych metod, oto niektóre z nich:

- Przeglądanie memów w formie przesuwania obrazka (głównie dla użytkowników mobilnych).

- Dodanie w pełni działającego panelu admina.

- Dodanie ciasteczek spełniających rolę pozyskania teści wyszukiwanych przez użytkownika.

- Podział memów na podkategorie.

- Możliwość odpowiadania na komentarze.

- Możliwość reagowania na komentarze.

- Dodanie sekcji premium oraz kont bez reklam.

- Dodanie wyszukiwania memów przez wpisanie tytułu.

- Dodanie kolejnych rozszerzeń plików (.mp4 / .gif).

- Dodanie filtrowania przez rodzaj mema (obrazek / text / gif).

- Rejestracja / logowanie za pomocą stron takich jak facebook.

- Punkty użytkownika dla najbardziej rozchwytywanych.

- Specjalne reakcje na memy.

Oraz wiele, wiele więcej...

## Dodatkowe informacje

...
