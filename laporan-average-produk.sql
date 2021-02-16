SELECT kode_produk, nama_produk, nama_supplier, qtymasuk/jumlah_produk as ave_produk from(
SELECT s.kode_produk,p.nama_produk, sup.nama_supplier, SUM(qty_stok) as qtymasuk , COUNT(p.id) jumlah_produk FROM `aktivitas_stok` as s
left join produk as p on p.id= s.kode_produk
left join supplier as sup on sup.kode_supplier=s.kode_user
WHERE status=1
GROUP BY p.id)tab