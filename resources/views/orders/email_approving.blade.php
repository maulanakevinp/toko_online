<h3>Data Pemesan atas nama {{ $nama }}</h3>
<h4>ID Pesanan : {{ $invoice }}</h4>
<p>Untuk melihat data pesanan klik link dibawah ini</p><br>
<a href="{{ route('orders.payment',$invoice) }}">{{ route('orders.payment',$invoice) }}</a>