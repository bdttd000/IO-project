## Cel projektu: Stworzenie strony z memami

### Zaimplementowane technologie

- HTML
- CSS
- PHP
- Docker

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

## Dodatkowe informacje

...
