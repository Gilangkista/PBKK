# Dokumentasi Laravel11
502522117 - Gilang Kista ramadhan


Tamilan Web terakhir:
![Alt Text](https://github.com/Gilangkista/PBKK/blob/main/Screenshot%202024-10-17%20005738.png?raw=true)
![Alt Text](https://github.com/Gilangkista/PBKK/blob/main/Screenshot%202024-10-17%20005755.png?raw=true)
![Alt Text](https://github.com/Gilangkista/PBKK/blob/main/Screenshot%202024-10-17%20005815.png?raw=true)



### Menambahkan Route dan View
Pada tahap ini, kita memulai dengan menambahkan beberapa route ke dalam file web.php. Setiap route tersebut mengarahkan ke halaman tertentu seperti home, blog, about, dan contact. Ini adalah langkah dasar dalam Laravel untuk mengatur navigasi antara halaman-halaman dalam aplikasi.
```
Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About']); 
});

Route::get('/blog', function () {
    return view('blog', ['title' => 'Blog']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

```
Pada contoh di atas, setiap route akan memanggil halaman dengan view tertentu dan mengirimkan variabel title untuk digunakan dalam tampilan.

### Tailwind UI
Untuk mempercantik tampilan web, kita menggunakan Tailwind CSS. Tailwind CSS adalah framework CSS yang sangat berguna karena memungkinkan kita untuk membangun komponen antarmuka dengan cepat melalui utility-first classes.

Salah satu bagian yang sering digunakan dalam proyek Laravel adalah Navbar. Agar lebih efisien, kita menggunakan komponen dari Tailwind UI. Namun, jika semua kode diletakkan langsung di setiap view, itu akan menghasilkan kode yang berulang (redundant). Maka dari itu, langkah berikutnya adalah membuat Blade Component untuk menyederhanakan kode dan membuatnya lebih modular.

### Menggunakan Blade dan Blade Component
Blade adalah templating engine di Laravel yang memungkinkan kita membuat tampilan yang dinamis dan mudah dikelola. Dengan Blade Component, kita bisa menghindari penulisan ulang kode yang sama pada berbagai halaman. Berikut beberapa komponen yang dibuat:

1. Navbar Component: Berisi kode navigasi dari Tailwind.
2. Layout Component: Berfungsi untuk menyimpan struktur HTML umum dari setiap halaman.
3. Nav-Link Component: Menangani interaksi seperti saat link di-hover atau saat berada di halaman aktif.
4. Header Component: Memanfaatkan $slot untuk menampilkan judul halaman yang dinamis.

Dengan komponen ini, setiap view hanya memuat konten utama, sementara struktur HTML dan navigasi diambil dari komponen-komponen tersebut.

### Database & Migration
Pada tahap ini, kita mulai menggunakan database untuk menyimpan data. Laravel menyediakan fitur migration untuk memudahkan kita membuat, memodifikasi, dan mengelola tabel di database. Sebagai contoh, kita membuat tabel posts untuk menyimpan artikel dengan atribut-atribut seperti title, body, author, dan category.

Menggunakan SQLite sangat praktis pada tahap awal pengembangan karena tidak membutuhkan konfigurasi server database yang rumit. Dengan migration, kita bisa membuat dan memperbarui tabel hanya dengan menjalankan perintah php artisan migrate.

### Eloquent ORM & Post Model
Eloquent ORM adalah fitur di Laravel yang memudahkan kita berinteraksi dengan database menggunakan model. Pada tahap ini, kita membuat Post Model untuk berhubungan dengan tabel posts. Model ini memungkinkan kita melakukan operasi seperti menyimpan, memperbarui, dan menghapus data tanpa harus menulis query SQL secara manual.

Dengan Route Model Binding, kita bisa memanfaatkan parameter seperti slug untuk mengambil data tertentu dari database. Misalnya:
```
Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', ['title' => 'Single Post', 'post' => $post]);
});
```

### Model Factories
Untuk mempercepat pengisian data pada tabel posts, kita menggunakan Model Factories. Dengan bantuan Faker (library yang menghasilkan data acak), kita bisa membuat banyak data secara otomatis, seperti artikel dan pengguna.

Contoh factory untuk membuat artikel:
```
Post::factory()->count(10)->create();
```

Selain mempersingkat waktu, factories juga berguna untuk melakukan testing aplikasi karena kita bisa membuat skenario dengan data yang konsisten.

### Eloquent Relationship
Pada tahap ini, kita membahas relasi antar model. Misalnya, setiap artikel (post) akan memiliki penulis (author), dan setiap penulis bisa memiliki banyak artikel. Relasi ini diatur dengan menambahkan fungsi-fungsi berikut di model Post dan User:

```
public function author()
{
    return $this->belongsTo(User::class);
}
```
```
public function posts()
{
    return $this->hasMany(Post::class);
}
```
Relasi ini juga direpresentasikan di tabel dengan menggunakan foreign key untuk menghubungkan kedua tabel.

### Post Categories
Setiap artikel juga bisa memiliki kategori. Untuk itu, kita membuat model, migrasi, dan factory untuk Category. Relasi antara Post dan Category adalah many-to-one, di mana setiap artikel memiliki satu kategori, dan setiap kategori bisa memiliki banyak artikel.

### Database Seeder
Pada tahap ini, kita mengisi database secara otomatis menggunakan seeder. Dengan seeder, kita bisa memasukkan data awal ke dalam tabel tanpa perlu melakukannya secara manual. Misalnya:
```
Category::factory()->count(5)->create();
User::factory()->count(10)->create();
Post::factory()->count(100)->create();
```
Seeder ini sangat berguna saat memulai proyek baru atau melakukan pengujian.

### N+1 Problem
Masalah N+1 terjadi saat kita melakukan banyak query secara berulang dalam sebuah loop. Laravel menyediakan eager loading untuk mengatasi masalah ini. Eager loading memungkinkan kita memuat data terkait sekaligus, sehingga mengurangi jumlah query.


```
$posts = Post::with('author', 'category')->get();
```

Dengan eager loading, kita bisa memastikan bahwa data penulis dan kategori dari setiap artikel dimuat dalam satu query.

### Redesign UI, Searching, dan Pagination
Tahap terakhir adalah memperbaiki tampilan halaman posts dan menambahkan fitur pencarian dan pagination. Pencarian dilakukan dengan memanfaatkan wildcard search pada judul artikel:
```
$posts = Post::where('title', 'like', '%' . request('search') . '%')->paginate(9);
```
Pagination memastikan bahwa hanya sejumlah artikel tertentu yang ditampilkan di setiap halaman, sehingga meningkatkan kinerja dan pengalaman pengguna.


Dengan begitu selesai sudah projek berdasarkan playlist Laravel11: Sandika Galih.

