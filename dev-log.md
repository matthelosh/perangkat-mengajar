#Sekedar
Jumat, 01. Mei 2020 06:31 
##Ide
1.  Tambahkan wali kelas ke dalam session
Tambahkan variable ke dalam Global Session Helper di DashController 
Method:
	session(['isWali' => true]);
	Meskipun hasilnya kurang memuaskan, karena di dalam sesi ternyata variable tersebut terpecah menjadi [0=>'isWali', 1 => true]); belum menemukan solusinya, tetapi dapat dipakai. ;)
	Untuk logout, tambahkan session()->flush(); atau session()->remove('key');
## Jurnal Mengajar (Guru)
Senin, 04. Mei 2020 09:28 PM
1.  Jika pembelajaran tematik
- 	Tampilkan multiselect tema dan subtema
Senin, 18 Mei 2020 04:12
1. Mengambil data mapel sesuai subtema
Pemetaan -> mapels
            -> kode_mapel
            -> teks_mapel
                -> kds
                    -> kode_kd
                    -> teks_kd
