<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\User;
use App\Models\Profile;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the Application's database with comprehensive, rich, and realistic library data.
     *
     * @return void
     */
    public function run()
    {
        // 1. Matikan foreign key check untuk truncate data lama secara bersih
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('riwayat_pinjam')->truncate();
        DB::table('kategori_buku')->truncate();
        DB::table('profile')->truncate();
        DB::table('buku')->truncate();
        DB::table('kategori')->truncate();
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. SEED KATEGORI BUKU (12 Kategori Komprehensif)
        $kategoriData = [
            1 => [
                'nama' => 'Teknologi & Pemrograman',
                'deskripsi' => 'Buku-buku tentang software engineering, kecerdasan buatan, web development, cloud computing, dan arsitektur sistem modern.'
            ],
            2 => [
                'nama' => 'Novel & Sastra',
                'deskripsi' => 'Karya sastra klasik dan kontemporer, fiksi inspiratif, prosa nusantara, dan drama kehidupan berbobot.'
            ],
            3 => [
                'nama' => 'Bisnis, Manajemen & Investasi',
                'deskripsi' => 'Panduan investasi saham, analisis keuangan, strategi startup, kepemimpinan modern, dan manajemen operasional.'
            ],
            4 => [
                'nama' => 'Psikologi & Self-Improvement',
                'deskripsi' => 'Buku pengembangan diri, pembentukan kebiasaan positif, produktivitas, ketahanan mental, dan kecerdasan emosional.'
            ],
            5 => [
                'nama' => 'Sains & Alam',
                'deskripsi' => 'Eksplorasi kosmologi, fisika teoretis, biologi evolusi, neurosains, dan keajaiban fenomena sains modern.'
            ],
            6 => [
                'nama' => 'Sejarah & Filsafat',
                'deskripsi' => 'Catatan peradaban umat manusia, revolusi industri, pemikiran filsuf dunia, dan dialektika sejarah nusantara.'
            ],
            7 => [
                'nama' => 'Desain & Seni Visual',
                'deskripsi' => 'Prinsip desain grafis, UX/UI digital, interaksi manusia-komputer, estetika tipografi, dan komposisi visual.'
            ],
            8 => [
                'nama' => 'Fiksi Ilmiah (Sci-Fi)',
                'deskripsi' => 'Petualangan masa depan futuristik, kolonisasi antariksa, distopia kecerdasan buatan, dan penjelajahan galaksi.'
            ],
            9 => [
                'nama' => 'Kesehatan & Kedokteran',
                'deskripsi' => 'Buku teks ilmu medis dasar, anatomi klinis, farmakologi, nutrisi seimbang, dan kesehatan masyarakat global.'
            ],
            10 => [
                'nama' => 'Hukum & Tata Negara',
                'deskripsi' => 'Kompilasi hukum perdata, hukum pidana, tata kelola pemerintahan, konstitusi, dan hak asasi manusia.'
            ],
            11 => [
                'nama' => 'Pendidikan & Pedagogi',
                'deskripsi' => 'Metodologi pengajaran interaktif, kurikulum merdeka, psikologi pendidikan anak, dan manajemen institusi sekolah.'
            ],
            12 => [
                'nama' => 'Komik, Komedi & Grafis',
                'deskripsi' => 'Kisah komedi reflektif, novel grafis humoris, satir sosial, dan kumpulan cerita ringan pembangun keceriaan.'
            ],
        ];

        $kategoriModels = [];
        foreach ($kategoriData as $id => $k) {
            $kategoriModels[$id] = Kategori::create([
                'id' => $id,
                'nama' => $k['nama'],
                'deskripsi' => $k['deskripsi']
            ]);
        }

        // 3. SEED USERS & PROFILES (1 Admin + 15 Anggota Mahasiswa Lengkap)
        $usersData = [
            // Admin
            [
                'id' => 1,
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'isAdmin' => '1',
                'profile' => [
                    'npm' => 'ADM001',
                    'prodi' => 'Sistem Informasi Perpustakaan',
                    'alamat' => 'Gedung Rektorat Lt. 2, Kampus Utama',
                    'noTelp' => '081299900001',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 1 (Dimas)
            [
                'id' => 2,
                'name' => 'Dimas Pratama',
                'email' => 'dimas@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'A11202150273',
                    'prodi' => 'Teknik Informatika',
                    'alamat' => 'Jl. Pandanaran No. 45, Semarang',
                    'noTelp' => '085325551269',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 2
            [
                'id' => 3,
                'name' => 'Siti Rahmawati',
                'email' => 'siti.rahma@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'B22202210105',
                    'prodi' => 'Pendidikan Kedokteran',
                    'alamat' => 'Jl. Diponegoro No. 12, Surabaya',
                    'noTelp' => '081335962458',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 3
            [
                'id' => 4,
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'C33202040019',
                    'prodi' => 'Ilmu Komunikasi',
                    'alamat' => 'Jl. Gatot Subroto No. 88, Jakarta Selatan',
                    'noTelp' => '081277889900',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 4
            [
                'id' => 5,
                'name' => 'Aisyah Putri Kusuma',
                'email' => 'aisyah.kusuma@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'D44202130122',
                    'prodi' => 'Psikologi Klinis',
                    'alamat' => 'Jl. Kaliurang KM 5.5, Yogyakarta',
                    'noTelp' => '082144556677',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 5
            [
                'id' => 6,
                'name' => 'Muhammad Rizky',
                'email' => 'rizky.m@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'E55202160088',
                    'prodi' => 'Teknik Elektro',
                    'alamat' => 'Jl. Dago Asri No. 17, Bandung',
                    'noTelp' => '081988223344',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 6
            [
                'id' => 7,
                'name' => 'Nabila Zahra',
                'email' => 'nabila.zahra@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'F66202270031',
                    'prodi' => 'Manajemen Bisnis',
                    'alamat' => 'Jl. Basuki Rahmat No. 104, Surabaya',
                    'noTelp' => '087766554433',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 7
            [
                'id' => 8,
                'name' => 'Fajar Nugraha',
                'email' => 'fajar.nugraha@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'G77202180045',
                    'prodi' => 'Ilmu Komputer',
                    'alamat' => 'Jl. Gejayan No. 23, Yogyakarta',
                    'noTelp' => '081399887766',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 8
            [
                'id' => 9,
                'name' => 'Dewi Lestari Anindya',
                'email' => 'dewi.anindya@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'H88202020014',
                    'prodi' => 'Sastra Indonesia',
                    'alamat' => 'Jl. Pemuda No. 71, Semarang',
                    'noTelp' => '085211223344',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 9
            [
                'id' => 10,
                'name' => 'Rian Hidayat',
                'email' => 'rian.hidayat@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'I99202290062',
                    'prodi' => 'Ilmu Hukum',
                    'alamat' => 'Jl. Pahlawan No. 34, Bogor',
                    'noTelp' => '081233445566',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 10
            [
                'id' => 11,
                'name' => 'Clara Angelina',
                'email' => 'clara.angelina@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'J10202110078',
                    'prodi' => 'Desain Komunikasi Visual',
                    'alamat' => 'Jl. Riau No. 56, Bandung',
                    'noTelp' => '087822334455',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 11
            [
                'id' => 12,
                'name' => 'Farhan Alamsyah',
                'email' => 'farhan.alam@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'K11202230055',
                    'prodi' => 'Teknik Sipil',
                    'alamat' => 'Jl. Veteran No. 19, Malang',
                    'noTelp' => '085733221100',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 12
            [
                'id' => 13,
                'name' => 'Anisa Maharani',
                'email' => 'anisa.maharani@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'L12202050091',
                    'prodi' => 'Farmasi',
                    'alamat' => 'Jl. Gajah Mada No. 80, Solo',
                    'noTelp' => '081299881122',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 13
            [
                'id' => 14,
                'name' => 'Hendro Wijaya',
                'email' => 'hendro.wijaya@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'M13202140027',
                    'prodi' => 'Akuntansi Bisnis',
                    'alamat' => 'Jl. Sudirman No. 142, Jakarta Pusat',
                    'noTelp' => '082166778899',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 14
            [
                'id' => 15,
                'name' => 'Tiara Andini Putri',
                'email' => 'tiara.andini@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'N14202280016',
                    'prodi' => 'Hubungan Internasional',
                    'alamat' => 'Jl. Setiabudi No. 90, Bandung',
                    'noTelp' => '081344556688',
                    'photo_profile' => 'boy.png'
                ]
            ],
            // Anggota 15
            [
                'id' => 16,
                'name' => 'Reza Kurniawan',
                'email' => 'reza.kurniawan@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => '0',
                'profile' => [
                    'npm' => 'O15202170063',
                    'prodi' => 'Sistem Informasi',
                    'alamat' => 'Jl. Imogiri Timur KM 7, Bantul',
                    'noTelp' => '087799001122',
                    'photo_profile' => 'boy.png'
                ]
            ],
        ];

        foreach ($usersData as $u) {
            $userModel = User::create([
                'id' => $u['id'],
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => $u['password'],
                'isAdmin' => $u['isAdmin'],
            ]);

            Profile::create([
                'users_id' => $userModel->id,
                'npm' => $u['profile']['npm'],
                'prodi' => $u['profile']['prodi'],
                'alamat' => $u['profile']['alamat'],
                'noTelp' => $u['profile']['noTelp'],
                'photoProfile' => $u['profile']['photo_profile'],
            ]);
        }

        // 4. SEED KOLEKSI BUKU (32 Buku Beragam Kategori, Lengkap Metadata & Sinopsis)
        $bukuList = [
            // TEKNOLOGI & PEMROGRAMAN
            [
                'id' => 1,
                'kode_buku' => 'TEK-001',
                'judul' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'pengarang' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => '2008',
                'gambar' => 'submission_20_20_coverImage_en_US_t.jpg',
                'kategori' => [1],
                'deskripsi' => 'Buku panduan legendaris karya Uncle Bob yang mengajarkan prinsip-prinsip penulisan kode bersih, refactoring, test-driven development, penamaan variabel yang bermakna, serta desain fungsi modular yang mudah dirawat.'
            ],
            [
                'id' => 2,
                'kode_buku' => 'TEK-002',
                'judul' => 'Designing Data-Intensive Applications',
                'pengarang' => 'Martin Kleppmann',
                'penerbit' => "O'Reilly Media",
                'tahun_terbit' => '2017',
                'gambar' => 'rba-007--.jpg',
                'kategori' => [1],
                'deskripsi' => 'Karya komprehensif tentang arsitektur sistem terdistribusi, replikasi data, partisi, konsistensi data, event streams, batch processing, dan teknologi database modern seperti NoSQL, Kafka, dan GraphQL.'
            ],
            [
                'id' => 3,
                'kode_buku' => 'TEK-003',
                'judul' => 'The Pragmatic Programmer: Your Journey To Mastery',
                'pengarang' => 'David Thomas & Andrew Hunt',
                'penerbit' => 'Addison-Wesley',
                'tahun_terbit' => '2019',
                'gambar' => "Harry_Potter_and_the_Sorcerer's_Stone.jpg",
                'kategori' => [1],
                'deskripsi' => 'Panduan fundamental mengenai filosofi pengembangan perangkat lunak pragmatis, tips efisiensi kerja tim rekayasa perangkat lunak, automasi tugas berulang, dan mitigasi risiko bug dalam arsitektur software komersial.'
            ],
            [
                'id' => 4,
                'kode_buku' => 'TEK-004',
                'judul' => 'Refactoring: Improving the Design of Existing Code',
                'pengarang' => 'Martin Fowler',
                'penerbit' => 'Addison-Wesley Professional',
                'tahun_terbit' => '2018',
                'gambar' => 'submission_20_20_coverImage_en_US_t.jpg',
                'kategori' => [1],
                'deskripsi' => 'Edisi kedua dari karya agung Martin Fowler yang membedah katalog teknik refactoring kode dengan JavaScript/TypeScript, mengenali code smell, serta meningkatkan kualitas kode tanpa mengubah perilaku eksternal.'
            ],
            [
                'id' => 5,
                'kode_buku' => 'TEK-005',
                'judul' => 'Algoritma dan Pemrograman Modern dengan Java',
                'pengarang' => 'Lamhot Sitorus',
                'penerbit' => 'Andi Offset',
                'tahun_terbit' => '2020',
                'gambar' => 'submission_20_20_coverImage_en_US_t.jpg',
                'kategori' => [1],
                'deskripsi' => 'Buku pegangan mahasiswa ilmu komputer dan informatika yang menyajikan struktur data dasar, rekursi, algoritma pencarian dan pengurutan, hingga paradigma OOP menggunakan bahasa Java kontemporer.'
            ],
            [
                'id' => 6,
                'kode_buku' => 'TEK-006',
                'judul' => 'Building Microservices: Designing Fine-Grained Systems',
                'pengarang' => 'Sam Newman',
                'penerbit' => "O'Reilly Media",
                'tahun_terbit' => '2021',
                'gambar' => 'rba-007--.jpg',
                'kategori' => [1],
                'deskripsi' => 'Panduan holistik untuk merancang, mengintegrasikan, memantau, dan mengamankan layanan arsitektur microservices berbasis kontainerisasi, Kubernetes, CI/CD pipeline, dan service mesh.'
            ],

            // NOVEL & SASTRA
            [
                'id' => 7,
                'kode_buku' => 'NVL-001',
                'judul' => 'Laskar Pelangi',
                'pengarang' => 'Andrea Hirata',
                'penerbit' => 'Bentang Pustaka',
                'tahun_terbit' => '2005',
                'gambar' => 'LaskarPelangi.webp',
                'kategori' => [2],
                'deskripsi' => 'Kisah epik 10 anak laskar pelangi di tanah Belitong yang berjuang meraih pendidikan di bawah asuhan Pak Harfan dan Bu Muslimah. Karya sastra Indonesia yang paling menginspirasi jutaan pembaca dunia.'
            ],
            [
                'id' => 8,
                'kode_buku' => 'NVL-002',
                'judul' => 'Bumi Manusia (Tetralogi Buru)',
                'pengarang' => 'Pramoedya Ananta Toer',
                'penerbit' => 'Hasta Mitra / Lentera Dipantara',
                'tahun_terbit' => '1980',
                'gambar' => '2b829f13b0072dfcdd239370eab12686.jpeg',
                'kategori' => [2, 6],
                'deskripsi' => 'Roman sejarah monumental yang menceritakan dinamika Minke, seorang pribumi terpelajar di era Hindia Belanda, dan perjuangan cinta serta harga diri bersama Annelies Mellema di bawah bayang-bayang diskriminasi kolonial.'
            ],
            [
                'id' => 9,
                'kode_buku' => 'NVL-003',
                'judul' => 'Hujan',
                'pengarang' => 'Tere Liye',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2016',
                'gambar' => 'Hujan.jpg',
                'kategori' => [2, 8],
                'deskripsi' => 'Novel distopia fiksi ilmiah berlatar tahun 2042 mengenai bencana letusan gunung purba, persahabatan, keteguhan hati, perpisahan, dan bagaimana manusia berdamai dengan kenangan masa lalunya.'
            ],
            [
                'id' => 10,
                'kode_buku' => 'NVL-004',
                'judul' => 'Laut Bercerita',
                'pengarang' => 'Leila S. Chudori',
                'penerbit' => 'Kepustakaan Populer Gramedia',
                'tahun_terbit' => '2017',
                'gambar' => '7d38a7c9-87c4-40d9-a6e3-03738486efd1.jpg',
                'kategori' => [2, 6],
                'deskripsi' => 'Mengangkat kisah kelam penghilangan paksa para aktivis mahasiswa era 1998 di Indonesia. Disampaikan lewat dua sudut pandang haru: Biru Laut dari dasar samudera dan Asmara Jati yang mencari kepastian keluarganya.'
            ],
            [
                'id' => 11,
                'kode_buku' => 'NVL-005',
                'judul' => 'Cantik Itu Luka',
                'pengarang' => 'Eka Kurniawan',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2002',
                'gambar' => 'Laskar_Pelangi_film.jpg',
                'kategori' => [2],
                'deskripsi' => 'Karya realisme magis Indonesia yang diakui dunia internasional. Mengisahkan kebangkitan Dewi Ayu dari kubur dan perjalanan hidup keluarganya di kota Halimunda yang sarat tragedi politik dan mitologi.'
            ],
            [
                'id' => 12,
                'kode_buku' => 'NVL-006',
                'judul' => 'Gadis Kretek',
                'pengarang' => 'Ratih Kumala',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2012',
                'gambar' => 'dilan.jpeg',
                'kategori' => [2, 6],
                'deskripsi' => 'Kisah pencarian sosok Jeng Yah yang mengungkap sejarah industri rokok kretek tradisional di Jawa, intrik bisnis keluarga, persaingan saus tembakau rahasia, serta kisah cinta lintas zaman yang memikat.'
            ],

            // PSIKOLOGI & SELF-IMPROVEMENT
            [
                'id' => 13,
                'kode_buku' => 'PSI-001',
                'judul' => 'Atomic Habits: Perubahan Kecil yang Memberikan Hasil Luar Biasa',
                'pengarang' => 'James Clear',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2019',
                'gambar' => 'dilan.jpeg',
                'kategori' => [4],
                'deskripsi' => 'Buku terlaris internasional yang mengupas kerangka empat hukum perubahan perilaku untuk membangun rutinitas positif dan menghancurkan kebiasaan buruk melalui perbaikan 1% setiap hari.'
            ],
            [
                'id' => 14,
                'kode_buku' => 'PSI-002',
                'judul' => 'Filosofi Teras: Panduan Stoikisme Hidup Tenang Abad Ini',
                'pengarang' => 'Henry Manampiring',
                'penerbit' => 'Buku Kompas',
                'tahun_terbit' => '2018',
                'gambar' => '220px-Marmut_Merah_Jambu.jpg',
                'kategori' => [4, 6],
                'deskripsi' => 'Pengenalan filosofi Stoa kuno asal Yunani-Romawi yang dikemas secara segar, relevan, dan membumi untuk membantu generasi muda mengendalikan emosi negatif dan fokus pada apa yang dapat dikendalikan.'
            ],
            [
                'id' => 15,
                'kode_buku' => 'PSI-003',
                'judul' => 'Thinking, Fast and Slow',
                'pengarang' => 'Daniel Kahneman',
                'penerbit' => 'Farrar, Straus and Giroux',
                'tahun_terbit' => '2011',
                'gambar' => 'rba-007--.jpg',
                'kategori' => [4, 5],
                'deskripsi' => 'Penelitian psikologi kognitif dan pemenang Nobel Ekonomi yang menjelaskan dua sistem berpikir manusia: Sistem 1 yang intuitif dan cepat, serta Sistem 2 yang analitis, lambat, namun sering luput karena bias kognitif.'
            ],
            [
                'id' => 16,
                'kode_buku' => 'PSI-004',
                'judul' => 'Berani Tidak Disukai',
                'pengarang' => 'Ichiro Kishimi & Fumitake Koga',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => '2019',
                'gambar' => 'submission_20_20_coverImage_en_US_t.jpg',
                'kategori' => [4, 6],
                'deskripsi' => 'Dialog filosofis antara seorang pemuda dan seorang filsuf yang menerapkan ajaran Alfred Adler tentang keberanian mengubah takdir, memisahkan tugas kehidupan, dan hidup bebas tanpa beban ekspektasi orang lain.'
            ],

            // BISNIS, MANAJEMEN & INVESTASI
            [
                'id' => 17,
                'kode_buku' => 'BSN-001',
                'judul' => 'The Psychology of Money: Timeless Lessons on Wealth, Greed, and Happiness',
                'pengarang' => 'Morgan Housel',
                'penerbit' => 'Harriman House',
                'tahun_terbit' => '2020',
                'gambar' => 'TheLordsOfTheRings.jpg',
                'kategori' => [3, 4],
                'deskripsi' => 'Kumpulan 19 cerita pendek yang mengeksplorasi cara aneh orang berpikir tentang uang dan mengajarkan bahwa keberhasilan finansial bukanlah ilmu matematika mutlak, melainkan keterampilan perilaku psikologis.'
            ],
            [
                'id' => 18,
                'kode_buku' => 'BSN-002',
                'judul' => 'Zero to One: Notes on Startups, or How to Build the Future',
                'pengarang' => 'Peter Thiel & Blake Masters',
                'penerbit' => 'Crown Business',
                'tahun_terbit' => '2014',
                'gambar' => 'submission_20_20_coverImage_en_US_t.jpg',
                'kategori' => [3],
                'deskripsi' => 'Wawasan mendalam dari pendiri PayPal tentang cara menciptakan inovasi vertikal baru dari nol menjadi satu, membangun keunggulan monopoli yang berkelanjutan, dan menghindari persaingan berdarah-darah.'
            ],
            [
                'id' => 19,
                'kode_buku' => 'BSN-003',
                'judul' => 'The Lean Startup: How Constant Innovation Creates Radically Successful Businesses',
                'pengarang' => 'Eric Ries',
                'penerbit' => 'Crown Currency',
                'tahun_terbit' => '2011',
                'gambar' => 'rba-007--.jpg',
                'kategori' => [3],
                'deskripsi' => 'Metodologi inovasi bisnis berbasis siklus cepat Build-Measure-Learn, pembuatan Minimum Viable Product (MVP), dan pembelajaran teruji untuk memangkas pemborosan waktu dan biaya dalam perintisan produk baru.'
            ],
            [
                'id' => 20,
                'kode_buku' => 'BSN-004',
                'judul' => 'Good to Great: Why Some Companies Make the Leap... and Others Don\'t',
                'pengarang' => 'Jim Collins',
                'penerbit' => 'HarperBusiness',
                'tahun_terbit' => '2001',
                'gambar' => 'TheLordsOfTheRings.jpg',
                'kategori' => [3],
                'deskripsi' => 'Riset komparatif selama lima tahun yang mengidentifikasi faktor kunci mengapa perusahaan biasa dapat bertransformasi menjadi korporasi raksasa dengan kepemimpinan Level 5 dan Konsep Landak (Hedgehog Concept).'
            ],

            // SAINS & ALAM
            [
                'id' => 21,
                'kode_buku' => 'SAI-001',
                'judul' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'pengarang' => 'Yuval Noah Harari',
                'penerbit' => 'Kepustakaan Populer Gramedia',
                'tahun_terbit' => '2014',
                'gambar' => 'rba-007--.jpg',
                'kategori' => [5, 6],
                'deskripsi' => 'Penelusuran sejarah manusia dari zaman kera purba di Afrika hingga menjadi penguasa bumi melalui revolusi kognitif, revolusi pertanian, penyatuan umat manusia, dan revolusi sains modern.'
            ],
            [
                'id' => 22,
                'kode_buku' => 'SAI-002',
                'judul' => 'Cosmos: Penjelajahan Antariksa dan Evolusi Bintang',
                'pengarang' => 'Carl Sagan',
                'penerbit' => 'Kepustakaan Populer Gramedia',
                'tahun_terbit' => '1980',
                'gambar' => "Harry_Potter_and_the_Sorcerer's_Stone.jpg",
                'kategori' => [5],
                'deskripsi' => 'Karya sains klasik yang membawa pembaca menjelajahi 15 miliar tahun evolusi alam semesta, kelahiran galaksi, peradaban kuno, dan tempat kita yang amat kecil di tengah luasnya semesta kosmologis.'
            ],
            [
                'id' => 23,
                'kode_buku' => 'SAI-003',
                'judul' => 'A Brief History of Time: Dari Dentuman Besar hingga Lubang Hitam',
                'pengarang' => 'Stephen Hawking',
                'penerbit' => 'Bantam Books',
                'tahun_terbit' => '1988',
                'gambar' => 'TheLordsOfTheRings.jpg',
                'kategori' => [5],
                'deskripsi' => 'Fisikawan terkemuka Stephen Hawking menjelaskan konsep ruang dan waktu, mekanika kuantum, gravitasi, teori relativitas umum, dan misteri singularitas lubang hitam secara lugas bagi masyarakat awam.'
            ],

            // DESAIN & SENI VISUAL
            [
                'id' => 24,
                'kode_buku' => 'DSN-001',
                'judul' => 'The Design of Everyday Things: Revised and Expanded Edition',
                'pengarang' => 'Don Norman',
                'penerbit' => 'Basic Books',
                'tahun_terbit' => '2013',
                'gambar' => '7d38a7c9-87c4-40d9-a6e3-03738486efd1.jpg',
                'kategori' => [7],
                'deskripsi' => 'Kitab wajib desainer produk yang membedah human-centered design, affordance, signifiers, feedback loop, dan mengapa banyak produk sehari-hari seperti pintu dan teko membingungkan penggunanya.'
            ],
            [
                'id' => 25,
                'kode_buku' => 'DSN-002',
                'judul' => 'Don\'t Make Me Think, Revisited: Panduan Usability Web & Mobile',
                'pengarang' => 'Steve Krug',
                'penerbit' => 'New Riders',
                'tahun_terbit' => '2014',
                'gambar' => 'submission_20_20_coverImage_en_US_t.jpg',
                'kategori' => [7, 1],
                'deskripsi' => 'Buku ringkas penuh ilustrasi yang mengajarkan prinsip navigasi intuitif pada situs web dan aplikasi digital, uji keterpakaian (usability test), dan desain tata letak yang tidak membebani kognisi pengguna.'
            ],
            [
                'id' => 26,
                'kode_buku' => 'DSN-003',
                'judul' => 'Sprint: How to Solve Big Problems and Test New Ideas in Just Five Days',
                'pengarang' => 'Jake Knapp & John Zeratsky',
                'penerbit' => 'Simon & Schuster',
                'tahun_terbit' => '2016',
                'gambar' => 'rba-007--.jpg',
                'kategori' => [7, 3],
                'deskripsi' => 'Metode desain cepat 5 hari dari Google Ventures yang memandu tim mendefinisikan masalah, membuat sketsa solusi, memilih ide terbaik, memproduksi prototipe interaktif, dan mengujinya ke pengguna nyata.'
            ],

            // FIKSI ILMIAH (SCI-FI)
            [
                'id' => 27,
                'kode_buku' => 'SCF-001',
                'judul' => 'Dune: Kronik Planet Gurun Arrakis',
                'pengarang' => 'Frank Herbert',
                'penerbit' => 'Chilton Books',
                'tahun_terbit' => '1965',
                'gambar' => 'TheLordsOfTheRings.jpg',
                'kategori' => [8, 2],
                'deskripsi' => 'Mahakarya fiksi ilmiah epik tentang perebutan rempah-rempah melange di planet gurun Arrakis, intrik kekaisaran galaksi, ordo mistis Bene Gesserit, dan kebangkitan mesias Paul Atreides.'
            ],
            [
                'id' => 28,
                'kode_buku' => 'SCF-002',
                'judul' => '1984: Catatan Distopia Pengawasan Total Big Brother',
                'pengarang' => 'George Orwell',
                'penerbit' => 'Secker & Warburg',
                'tahun_terbit' => '1949',
                'gambar' => "Harry_Potter_and_the_Sorcerer's_Stone.jpg",
                'kategori' => [8, 2, 6],
                'deskripsi' => 'Novel distopia politik paling berpengaruh di dunia yang melukiskan kehidupan Winston Smith di Oceania, di mana Partai dan Big Brother mengontrol sejarah, bahasa (Newspeak), dan pikiran tiap warganya.'
            ],
            [
                'id' => 29,
                'kode_buku' => 'SCF-003',
                'judul' => 'Foundation: Runtuhnya Kekaisaran Galaksi',
                'pengarang' => 'Isaac Asimov',
                'penerbit' => 'Gnome Press',
                'tahun_terbit' => '1951',
                'gambar' => 'TheLordsOfTheRings.jpg',
                'kategori' => [8, 2],
                'deskripsi' => 'Saga sci-fi legendaris tentang Hari Seldon dan ilmu psikosejarah yang meramalkan keruntuhan kekaisaran galaksi serta mendirikan Yayasan untuk memangkas zaman kegelapan dari 30.000 tahun menjadi 1.000 tahun.'
            ],

            // KESEHATAN, HUKUM & PENDIDIKAN
            [
                'id' => 30,
                'kode_buku' => 'MED-001',
                'judul' => 'Atlas Anatomi Manusia Sobotta: Dasar Kedokteran Klinis',
                'pengarang' => 'Friedrich Paulsen & Jens Waschke',
                'penerbit' => 'Elsevier Health Sciences',
                'tahun_terbit' => '2019',
                'gambar' => '2b829f13b0072dfcdd239370eab12686.jpeg',
                'kategori' => [9],
                'deskripsi' => 'Buku atlas rujukan standar kedokteran dunia yang menyajikan ilustrasi diseksi mendalam, topografi otot, saraf, sistem peredaran darah, dan organ tubuh manusia dengan presisi medis tinggi.'
            ],
            [
                'id' => 31,
                'kode_buku' => 'HKM-001',
                'judul' => 'Pengantar Ilmu Hukum Indonesia & Asas-Asas Hukum Positif',
                'pengarang' => 'Prof. Dr. Peter Mahmud Marzuki',
                'penerbit' => 'Kencana Prenada Media Group',
                'tahun_terbit' => '2018',
                'gambar' => 'submission_20_20_coverImage_en_US_t.jpg',
                'kategori' => [10],
                'deskripsi' => 'Rujukan komprehensif mahasiswa fakultas hukum yang mengupas ontologi ilmu hukum, sistem norma perundang-undangan, klasifikasi hukum privat dan publik, serta penegakan keadilan di Indonesia.'
            ],
            [
                'id' => 32,
                'kode_buku' => 'PDK-001',
                'judul' => 'Pendidikan Kaum Tertindas (Pedagogy of the Oppressed)',
                'pengarang' => 'Paulo Freire',
                'penerbit' => 'LP3ES',
                'tahun_terbit' => '2019',
                'gambar' => 'LaskarPelangi.webp',
                'kategori' => [11, 6],
                'deskripsi' => 'Karya kritis pedagogi global yang mengkritik model pengajaran "bank" di mana siswa pasif menerima doktrin, dan menawarkan pendekatan dialogis pembebasan berpikir yang menumbuhkan kesadaran kritis.'
            ],
        ];

        foreach ($bukuList as $b) {
            $bukuModel = Buku::create([
                'id' => $b['id'],
                'kode_buku' => $b['kode_buku'],
                'judul' => $b['judul'],
                'pengarang' => $b['pengarang'],
                'penerbit' => $b['penerbit'],
                'tahun_terbit' => $b['tahun_terbit'],
                'gambar' => $b['gambar'],
                'deskripsi' => $b['deskripsi'],
            ]);

            // Hubungkan kategori ke tabel pivot kategori_buku
            foreach ($b['kategori'] as $kategoriId) {
                DB::table('kategori_buku')->insert([
                    'buku_id' => $bukuModel->id,
                    'kategori_id' => $kategoriId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 5. SEED SIRKULASI PEMINJAMAN (24 Data Transaksi Nyata & Seimbang)
        // Sebagian sudah dikembalikan (ada tanggal_pengembalian), sebagian aktif (sedang dipinjam)
        $peminjamanList = [
            // Selesai dikembalikan
            [
                'users_id' => 2, // Dimas
                'buku_id' => 1,  // Clean Code
                'tanggal_pinjam' => '2026-09-01',
                'tanggal_wajib_kembali' => '2026-09-08',
                'tanggal_pengembalian' => '2026-09-07',
            ],
            [
                'users_id' => 3, // Siti Rahmawati
                'buku_id' => 13, // Atomic Habits
                'tanggal_pinjam' => '2026-09-05',
                'tanggal_wajib_kembali' => '2026-09-12',
                'tanggal_pengembalian' => '2026-09-11',
            ],
            [
                'users_id' => 4, // Budi Santoso
                'buku_id' => 17, // The Psychology of Money
                'tanggal_pinjam' => '2026-09-10',
                'tanggal_wajib_kembali' => '2026-09-17',
                'tanggal_pengembalian' => '2026-09-16',
            ],
            [
                'users_id' => 5, // Aisyah Putri
                'buku_id' => 14, // Filosofi Teras
                'tanggal_pinjam' => '2026-09-14',
                'tanggal_wajib_kembali' => '2026-09-21',
                'tanggal_pengembalian' => '2026-09-20',
            ],
            [
                'users_id' => 6, // Muhammad Rizky
                'buku_id' => 21, // Sapiens
                'tanggal_pinjam' => '2026-09-18',
                'tanggal_wajib_kembali' => '2026-09-25',
                'tanggal_pengembalian' => '2026-09-24',
            ],
            [
                'users_id' => 7, // Nabila Zahra
                'buku_id' => 18, // Zero to One
                'tanggal_pinjam' => '2026-09-22',
                'tanggal_wajib_kembali' => '2026-09-29',
                'tanggal_pengembalian' => '2026-09-28',
            ],
            [
                'users_id' => 8, // Fajar Nugraha
                'buku_id' => 3,  // Pragmatic Programmer
                'tanggal_pinjam' => '2026-09-25',
                'tanggal_wajib_kembali' => '2026-10-02',
                'tanggal_pengembalian' => '2026-10-01',
            ],
            [
                'users_id' => 9, // Dewi Lestari
                'buku_id' => 7,  // Laskar Pelangi
                'tanggal_pinjam' => '2026-09-28',
                'tanggal_wajib_kembali' => '2026-10-05',
                'tanggal_pengembalian' => '2026-10-04',
            ],
            [
                'users_id' => 10, // Rian Hidayat
                'buku_id' => 31, // Pengantar Ilmu Hukum
                'tanggal_pinjam' => '2026-10-01',
                'tanggal_wajib_kembali' => '2026-10-08',
                'tanggal_pengembalian' => '2026-10-07',
            ],
            [
                'users_id' => 11, // Clara Angelina
                'buku_id' => 24, // Design of Everyday Things
                'tanggal_pinjam' => '2026-10-03',
                'tanggal_wajib_kembali' => '2026-10-10',
                'tanggal_pengembalian' => '2026-10-09',
            ],
            [
                'users_id' => 12, // Farhan Alamsyah
                'buku_id' => 28, // 1984
                'tanggal_pinjam' => '2026-10-06',
                'tanggal_wajib_kembali' => '2026-10-13',
                'tanggal_pengembalian' => '2026-10-12',
            ],
            [
                'users_id' => 13, // Anisa Maharani
                'buku_id' => 30, // Sobotta
                'tanggal_pinjam' => '2026-10-08',
                'tanggal_wajib_kembali' => '2026-10-15',
                'tanggal_pengembalian' => '2026-10-14',
            ],
            [
                'users_id' => 14, // Hendro Wijaya
                'buku_id' => 19, // The Lean Startup
                'tanggal_pinjam' => '2026-10-10',
                'tanggal_wajib_kembali' => '2026-10-17',
                'tanggal_pengembalian' => '2026-10-16',
            ],
            [
                'users_id' => 15, // Tiara Andini
                'buku_id' => 10, // Laut Bercerita
                'tanggal_pinjam' => '2026-10-12',
                'tanggal_wajib_kembali' => '2026-10-19',
                'tanggal_pengembalian' => '2026-10-18',
            ],

            // Transaksi Aktif Saat Ini (Sedang Dipinjam)
            [
                'users_id' => 2, // Dimas
                'buku_id' => 2,  // Designing Data-Intensive Applications
                'tanggal_pinjam' => '2026-10-19',
                'tanggal_wajib_kembali' => '2026-10-26',
                'tanggal_pengembalian' => null,
            ],
            [
                'users_id' => 2, // Dimas (meminjam 2 buku)
                'buku_id' => 4,  // Refactoring Fowler
                'tanggal_pinjam' => '2026-10-22',
                'tanggal_wajib_kembali' => '2026-10-29',
                'tanggal_pengembalian' => null,
            ],
            [
                'users_id' => 3, // Siti Rahmawati
                'buku_id' => 8,  // Bumi Manusia
                'tanggal_pinjam' => '2026-10-20',
                'tanggal_wajib_kembali' => '2026-10-27',
                'tanggal_pengembalian' => null,
            ],
            [
                'users_id' => 4, // Budi Santoso
                'buku_id' => 9,  // Hujan Tere Liye
                'tanggal_pinjam' => '2026-10-21',
                'tanggal_wajib_kembali' => '2026-10-28',
                'tanggal_pengembalian' => null,
            ],
            [
                'users_id' => 5, // Aisyah Putri
                'buku_id' => 15, // Thinking Fast and Slow
                'tanggal_pinjam' => '2026-10-23',
                'tanggal_wajib_kembali' => '2026-10-30',
                'tanggal_pengembalian' => null,
            ],
            [
                'users_id' => 6, // Muhammad Rizky
                'buku_id' => 22, // Cosmos Carl Sagan
                'tanggal_pinjam' => '2026-10-18',
                'tanggal_wajib_kembali' => '2026-10-25',
                'tanggal_pengembalian' => null,
            ],
            [
                'users_id' => 7, // Nabila Zahra
                'buku_id' => 20, // Good to Great
                'tanggal_pinjam' => '2026-10-24',
                'tanggal_wajib_kembali' => '2026-10-31',
                'tanggal_pengembalian' => null,
            ],
            [
                'users_id' => 8, // Fajar Nugraha
                'buku_id' => 6,  // Building Microservices
                'tanggal_pinjam' => '2026-10-24',
                'tanggal_wajib_kembali' => '2026-10-31',
                'tanggal_pengembalian' => null,
            ],
            [
                'users_id' => 11, // Clara Angelina
                'buku_id' => 25, // Don't Make Me Think
                'tanggal_pinjam' => '2026-10-23',
                'tanggal_wajib_kembali' => '2026-10-30',
                'tanggal_pengembalian' => null,
            ],
            [
                'users_id' => 16, // Reza Kurniawan
                'buku_id' => 27, // Dune
                'tanggal_pinjam' => '2026-10-22',
                'tanggal_wajib_kembali' => '2026-10-29',
                'tanggal_pengembalian' => null,
            ],
        ];

        foreach ($peminjamanList as $p) {
            Peminjaman::create([
                'users_id' => $p['users_id'],
                'buku_id' => $p['buku_id'],
                'tanggal_pinjam' => $p['tanggal_pinjam'],
                'tanggal_wajib_kembali' => $p['tanggal_wajib_kembali'],
                'tanggal_pengembalian' => $p['tanggal_pengembalian'],
            ]);
        }
    }
}
