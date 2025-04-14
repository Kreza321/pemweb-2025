## CATATAN SI AMIN 

**PROJEK UNTUK UTS DAN UAS**
**UTS**
Membuat sebuah company profile 
**UAS**
Masing-Masing akan diberikan 1 kasus 

**JAM MASUK DAN SAM ISTIRAHAT**
 9-12(ISTIRAHAT DZUHUR)
 13-15.30(SHALAT ASHAR)
 16-18



services:
  web:
    image: nginx:latest
    ports:
    - "80:80"
    volumes:
    - ./nginx/nginx.conf:/etc?nginx/conf.d/default.conf
    - ./src/index.html:/usr/share/nginx/html
didalam code ini ada beberapa fungsi seperti
1. services :
Konfigurasi ini menentukan layanan (service) yang akan dijalankan di dalam Docker. Dalam hal ini, layanan yang dibuat adalah web server menggunakan Nginx.
2. web :
Service ini akan menjalankan Nginx sebagai server web.
3. ports :
Menghubungkan port 80 di komputer host dengan port 80 di container.
Artinya, jika kamu membuka http://localhost di browser, kamu akan mengakses server web Nginx di dalam container.

COMPOSE_PROJECT_NAME=esgul
REPOSITORY_NAME=pemweb
IMAGE_TAG=latest
disini saya akan menjelaskan 
1. COMPOSE_PROJECT_NAME=esgul 
disini untuk menamakan project disini saya menamakan esgul
2. REPOSITORY_NAME=pemweb
disini untuk menamakan repository disini saya menamakan pemweb
3. IMAGE_TAG=latest
disini untuk menamakan tag image disini saya menamakan latest

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tag Div</title>
</head>
<body>
    <div>
        This is a div element.
        <p> This is a paragraph inside the div.</p>
    </div>
</body>
</html>

dibagian <title>Tag Div</title> disini akan menjadi judul pada tab browser
<body> akan menampilkan semua yang akan ditampilkan di browser/halaman web
    <div> 
        This is a div element.
        <p> This is a paragraph inside the div.</p>
    </div>

   <p></p> digunakan untuk menampilkan teks dalam format paragraf.
   <div> digunakan untuk menampilkan teks dalam format kotak.
   <a href="https://www.esaunggul.ac.id" target="_blank">Kunjungi Halaman</a> untuk menyisipkan link
   <ul class="sample-list">
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
            <li>Item 4</li>
        </ul> untuk membuat pointer
    <img src="../assets/esgul.png" alt="Sample Image" class="sample-image"> untuk menaruh gambar