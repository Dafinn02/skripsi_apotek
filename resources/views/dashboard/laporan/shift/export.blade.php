 <table>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kasir</th>
                    <th>Shift</th>
                    <th>Dibuka</th>
                    <th>Ditutup</th>
                    <th>Saldo Awal</th>
                    <th>Saldo Akhir</th>
                  </tr>
                </thead>
                @foreach($data as $key => $item)
                  <tr>  
                    <td>{{$key+1}}</td>
                    <td>{{$item['user_name']}}</td>
                    <td>{{$item['shift_name']}} ( {{$item['start_time']}} - {{$item['end_time']}} ) </td>
                    <td>{{ \Carbon\Carbon::make($item['date_start'])->format('d F Y')}} {{$item['start']}}</td>
                    <td>{{ \Carbon\Carbon::make($item['date_end'])->format('d F Y')}} {{$item['end']}}</td>
                    <td>Rp {{number_format($item['cash_in_hand'], 0, ",", ".")}}</td>
                    <td>Rp {{number_format($item['end_cash'], 0, ",", ".")}}</td>
                  </tr>
                @endforeach
                <tbody>
                </tbody>