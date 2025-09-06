<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->


# 🎬 Progetto Laravel + React

## 📖 Consegna
L’obiettivo di questo progetto è realizzare un’applicazione completa composta da:
- Un **backoffice in Laravel** con autenticazione tramite Laravel Breeze, per la gestione CRUD di un’entità scelta (es. Film, Videogiochi, Album, ecc.) con almeno una relazione con un’altra entità.
- Un **frontend in React** accessibile agli utenti guest, che permette di:
  - Visualizzare la lista degli elementi
  - Consultare i dettagli di un singolo elemento
  - Mostrare le informazioni collegate tramite relazione (es. generi, categorie, console)

Il backend espone un set di **API REST**, consumate dal frontend tramite chiamate AJAX.

---

## 🛠️ Scelte progettuali
Per lo sviluppo del progetto ho scelto di lavorare sull’entità **Movies** 🎬, con la seguente struttura:
- **Movies** → contiene titolo, descrizione,regista, immagine di copertina, anno di uscita  
- **Genres** → relazione *many-to-many* con i film (un film può avere più generi, un genere può appartenere a più film)
- **Reviews** → relazione *one-to-many* con i film (un film può avere più recensioni, una recensione può appartenere ad un film) → relazione *one-to-many* con i gli users(un user può avere più recensioni, una recensione può appartenere ad un solo user)
- **Likes** → relazione *many-to-many* con i tra movies e users (tabella pivot)

### Motivazioni
- L’entità *Movies* è semplice ma realistica, perfetta per mostrare CRUD e relazioni.  
- La relazione *Film ↔ Generi* permette di gestire tag multipli e di avere un frontend più interessante.  
- L’uso di **Laravel Breeze** ha semplificato l’implementazione dell’autenticazione e gestione utenti.  
- **React** è stato scelto per il frontend per creare un’interfaccia moderna, dinamica e facilmente estendibile.

---

## ⚙️ Tecnologie utilizzate
### Backend
- [Laravel 10](https://laravel.com/) → framework backend
- [Laravel Breeze](https://laravel.com/docs/breeze) → autenticazione
- [MySQL](https://www.mysql.com/) → database relazionale
- [Eloquent ORM](https://laravel.com/docs/eloquent) → gestione modelli e relazioni
- [Blade](https://laravel.com/docs/blade) → interfaccia backoffice

### Frontend
- [React](https://react.dev/) → UI dinamica
- [React Router](https://reactrouter.com/) → navigazione client-side
- [Axios](https://axios-http.com/) → chiamate API
- [Bootstrap](https://getbootstrap.com/) → layout e componenti

---

## 📸 Screenshot

### Login
![Login](./docs/screenshots/Cattura9.JPG)

### Dashboard (Backoffice)
![Dashboard](./docs/screenshots/Cattura6.jpg)

### Lista Film (Frontend React)
![Lista Film](./docs/screenshots/Cattura7.jpg)

### Dettaglio Film con Generi
![Dettaglio Film](./docs/screenshots/Cattura2.jpg)

---


