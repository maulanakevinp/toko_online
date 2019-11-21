<h3>Surat Tagihan atas nama {{ $nama }}</h3>
<p>Untuk melanjutkan ke pembayaran klik link dibawah ini</p><br>
<a href="{{ route('orders.payment',$invoice) }}">{{ route('orders.payment',$invoice) }}</a>
