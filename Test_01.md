# ```file_exists``` &raquo; performance

Trywialny temat: porównanie czasu wykonania poszczególnych funkcji sprawdzających dostępność pliku.

Testy zostały przeprowadzone na wersji php:
![php_version](http://q.i-systems.pl/file/71f6114b.png "php version")

W każdej iteracji funckja sprawdzała jeden losowy plik spośród 20 tysięcy istniejących. Po każdym wykonaniu funkcji wywoływano funkcję ```clearstatcache```w celu opróżnienia cache. Wyniki prezentują się następująco:

![Performance](http://q.i-systems.pl/file/ad7c4864.png "performance")

W zestawieniu znalazła się również funkcja ```stream_resolve_include_path``` ze względu na http://php.net/file_exists

> Warning This function returns FALSE for files inaccessible due to safe mode restrictions. However these files still can be included if they are located in safe_mode_include_dir.

Oznacza to, że przed ewentualnym includem powinno się wykorzystywać: http://php.net/stream_resolve_include_path

> Resolve filename against the include path according to the same rules as fopen()/ include.