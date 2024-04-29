<table>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>PIC</th>
                    <th>Produk</th>
                    <th>Kuantiti</th>
                    <th>Tanggal</th>
                    <th>Sumber</th>
                  </tr>
                </thead>
                @foreach($data as $key => $item)
                  <tr>  
                    <td>{{$key+1}}</td>
                    <td>{{$item['pic']}}</td>
                    <td>{{$item['product_name']}} ({{$item['product_code']}})</td>
                    <td>{{$item['qty']}}</td>
                    <td>{{ \Carbon\Carbon::make($item['created_at'])->format('d F Y H:i:s')}}</td>
                    <td>
                      Transaksi #{{$item['transaction_id']}} 
                    </td>
                  </tr>
                @endforeach
                <tbody>
                </tbody>
              </table>