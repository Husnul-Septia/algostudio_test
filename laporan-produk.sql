create view laporan_produk_a as (select kode_produk, nama_produk, SUM(masuk) masuk, SUM(keluar)stokkeluar , sisa_stok from (

select kode_produk, p.nama_produk, sum(qty_stok)masuk, '0' keluar, sisa_stok from aktivitas_stok as s
LEFT join produk as p on p.id=s.kode_produk
WHERE status = 1 and (tanggal_aktivitas BETWEEN '2021-02-01 00:00:00' and '2021-02-30 00:00:00' )
group by kode_produk

union 

select kode_produk, p.nama_produk, '0' as masuk,sum(qty_stok)keluar, sisa_stok from aktivitas_stok as s
LEFT join produk as p on p.id=s.kode_produk
WHERE status = 2 and (tanggal_aktivitas BETWEEN '2021-02-01 00:00:00' and '2021-02-30 00:00:00' )
group by kode_produk)tea
group by kode_produk)

