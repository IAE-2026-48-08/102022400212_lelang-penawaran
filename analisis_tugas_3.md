### Transaksi yang Dipilih -> `POST /api/v1/bids` (Mengajukan Penawaran)

Endpoint ini dipilih sebagai endpoint yang penting karena dia sendiri yang POST (menambahkan sesuatu) yang mengubah kondisi jadinya bakal memenuhi dua kategori penilaian sekaligus: transaksi yang diaudit (SOAP) dan transaksi yang disebarluaskan (RabbitMQ).

*Mengapa diaudit SOAP:*
- Setiap penawaran yang masuk mengubah keadaan lelang (siapa yang sedang memimpin penawaran).
- Nilai `bid_amount` sebagai pokok dari (Mengajukan Penawaran), sehingga harus tercatat di sistem audit terpusat agar nantinya tidak bisa dimanipulasi.
- Server dosen mengembalikan `ReceiptNumber` sebagai bukti audit resmi, yang disimpan secara lokal di kolom `bids.soap_receipt_number`.

*Mengapa disebarkan RabbitMQ:*
- Penawaran baru perlu segera diketahui oleh service lain (misalnya: service katalog untuk update status item, notifikasi untuk memberitahu peserta lain bahwa mereka tersalip, dan service pemenang untuk mempersiapkan proses checkout jika lelang berakhir).
- Komunikasi ini bersifat asinkron, service penawaran tidak perlu menunggu respons dari service lain, cukup broadcast `bid.placed` dan lanjut memproses request user.

Sebaliknya, endpoint `GET /api/v1/bids` dan `GET /api/v1/bids/{id}` tidak dipilih karena mereka hanya GET (read), sehingga tidak mengubah kondisi apapun jadinya mereka tidak memerlukan audit SOAP maupun broadcast AMQP.

---

![Sequence Diagram Interaksi Penawaran Service Dengan Layanan Terpusat](./SQ_IAE.png)