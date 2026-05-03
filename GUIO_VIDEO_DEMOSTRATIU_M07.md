# Guio del video demostratiu M07

Durada recomanada: 2 o 3 minuts.

Objectiu del video: demostrar el funcionament del gestor Digital Signage de M07.

## Preparacio abans de gravar

Arrenca el servidor Laravel:

```powershell
& 'C:\xampp\php\php.exe' artisan serve --host=127.0.0.1 --port=8000
```

Obre aquestes pestanyes al navegador:

```txt
http://127.0.0.1:8000/admin/screens
http://127.0.0.1:8000/admin/manual-slides
http://127.0.0.1:8000/api/screens/1/content
```

Abans de començar, deixa el projecte en aquest estat:

- Pantalla no bloquejada.
- Contingut manual actiu.
- Contingut manual no fixat.
- Ordre configurat com a manuals abans de les noticies.
- La API ha de mostrar contingut manual i noticies web.

## 0:00 - 0:20 Introduccio

Pantalla recomanada: pagina inicial o README.

Text per dir:

> Bon dia, en aquest video mostrare el funcionament del projecte M07 Digital Signage per a l'Edifici H de l'IES Mollerussa.
>
> El projecte esta fet amb Laravel i esta separat en dues parts principals: un panell d'administracio fet amb Blade i una API REST que retorna el contingut consolidat per a cada pantalla.
>
> El visor final de les pantalles es fara mes endavant al modul M09.

## 0:20 - 0:50 Gestio de pantalles

Obre:

```txt
http://127.0.0.1:8000/admin/screens
```

Text per dir:

> Aqui tenim el gestor Blade de pantalles.
>
> Des d'aquesta vista puc veure les pantalles configurades, crear-ne de noves, editar-les o eliminar-les.
>
> Cada pantalla te un nom, una ubicacio, un ordre de visualitzacio, un temps de refresc i tambe es pot bloquejar remotament.

Accio:

Entra a editar la pantalla principal.

Text per dir:

> En aquesta pantalla puc configurar si els continguts manuals es mostren abans o despres de les noticies de la web.
>
> Tambe puc definir el missatge de bloqueig, per exemple "Fora de servei".

Important: no bloquegis encara la pantalla.

## 0:50 - 1:20 API amb noticies web

Obre:

```txt
http://127.0.0.1:8000/api/screens/1/content
```

Text per dir:

> Aquesta es la resposta JSON de la API REST.
>
> Aquesta API es la que consumira el visor de M09.
>
> Es pot veure que retorna les dades de la pantalla, si esta bloquejada o no, i una llista d'elements.
>
> Primer apareix el contingut manual i despres apareixen noticies amb el tipus "news".
>
> Aquestes noticies venen automaticament de la web de l'institut.

Assenyala al navegador:

```json
"type": "news"
```

Text per dir:

> La URL utilitzada es la que demana l'enunciat:
>
> https://agora.xtec.cat/ies-mollerussa/wp-json/wp/v2/posts?per_page=5

## 1:20 - 1:55 Insercio manual i canvi d'ordre

Obre:

```txt
http://127.0.0.1:8000/admin/manual-slides
```

Text per dir:

> Ara entro al gestor de continguts manuals.
>
> Aquests continguts es creen amb formularis Blade normals, no amb la API.
>
> Puc indicar el titol, el text, la pantalla associada, l'ordre, si esta actiu i si esta fixat.

Accio:

Crea un contingut nou o edita el contingut existent.

Exemple de dades:

```txt
Titol: Avis important
Text: Aquest es un missatge manual creat des del panell.
Actiu: marcat
Fixat: no marcat
```

Guarda el formulari.

Despres obre:

```txt
http://127.0.0.1:8000/admin/screens/1/edit
```

Canvia l'ordre a:

```txt
Despres de les noticies web
```

Text per dir:

> Ara canvio l'ordre perque els continguts manuals surtin despres de les noticies web.

Guarda i torna a obrir:

```txt
http://127.0.0.1:8000/api/screens/1/content
```

Text per dir:

> Ara es pot comprovar que l'ordre ha canviat.
>
> Primer surten les noticies de la web i despres els continguts manuals.

## 1:55 - 2:25 Contingut fixat

Obre:

```txt
http://127.0.0.1:8000/admin/manual-slides
```

Accio:

Edita un contingut manual i marca l'opcio:

```txt
Fixat
```

Text per dir:

> Ara marco aquest contingut com a fixat.
>
> Segons l'enunciat, si hi ha un contingut manual fixat, nomes s'ha de mostrar aquest contingut.
>
> La resta de manuals i les noticies de la web han de quedar amagades.

Guarda i torna a obrir:

```txt
http://127.0.0.1:8000/api/screens/1/content
```

Text per dir:

> Ara la API retorna "only_pinned" amb valor true.
>
> Dins de la llista d'items nomes apareix el contingut manual fixat.
>
> Les noticies ja no es mostren.
>
> Aixo confirma que la regla de fixar continguts funciona correctament.

Assenyala al navegador:

```json
"only_pinned": true
```

## 2:25 - 2:55 Bloqueig de pantalla

Obre:

```txt
http://127.0.0.1:8000/admin/screens/1/edit
```

Accio:

Marca:

```txt
Pantalla bloquejada
```

Assegura't que el missatge sigui:

```txt
Fora de servei
```

Guarda i torna a obrir:

```txt
http://127.0.0.1:8000/api/screens/1/content
```

Text per dir:

> Finalment, provo el bloqueig remot de la pantalla.
>
> Marco la pantalla com a bloquejada i guardo els canvis.
>
> Quan torno a consultar la API, ara retorna "blocked" amb valor true, el missatge "Fora de servei" i la llista d'elements queda buida.
>
> Aixo permet que el futur visor de M09 mostri una pantalla de fora de servei.

Assenyala al navegador:

```json
"blocked": true
```

## 2:55 - 3:10 Tancament

Text per dir:

> Amb aixo queda demostrat el funcionament principal de M07.
>
> El projecte permet gestionar pantalles i continguts manuals amb Blade, consumir noticies automaticament, canviar l'ordre dels continguts, fixar entrades manuals i bloquejar pantalles remotament.
>
> La part visual del slideshow queda preparada per consumir aquesta API al modul M09.

## Checklist final del video

Durant el video s'ha de veure:

- El panell `/admin/screens`.
- El panell `/admin/manual-slides`.
- La API `/api/screens/1/content`.
- Almenys una noticia amb `"type": "news"`.
- El cas de contingut fixat amb `"only_pinned": true`.
- El cas de pantalla bloquejada amb `"blocked": true`.

## Estat recomanat despres de gravar

Quan acabis el video, pots deixar el projecte en estat normal:

- Pantalla no bloquejada.
- Continguts manuals actius.
- Continguts manuals no fixats.
- Ordre segons prefereixis per defecte.
