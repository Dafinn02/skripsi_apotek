<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class checkExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check obat yang akan kadaluarsa dalam 5 hari kedepan!';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $itemOnWareHouse = DB::table('warehouse_rack_products')
                            ->select('kadaluarsa','id')
                            ->get();
        $now = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $itemKadaluarsa = 0;
        $itemProdukKadaluarsa = [];
        foreach ($itemOnWareHouse as $key => $value) 
        {
            $kadal = Carbon::parse($value->kadaluarsa);
            $check = $kadal->diffInDays($now);
            if($check <= 5)
            {
                $itemKadaluarsa++;
                $dataKadal = DB::table('warehouse_rack_products as wrp')
                             ->join('products as pd','pd.id','=','wrp.product_id')
                             ->join('warehouses as whs','whs.id','=','wrp.warehouse_id')
                             ->join('racks as rack','rack.id','=','wrp.rack_id')
                             ->where('wrp.id',$value->id)
                             ->select('pd.name as product_name'
                                     ,'whs.name as warehouse_name'
                                     ,'rack.name as rack_name'
                                     ,'wrp.qty')
                             ->first();
                $dataKadal = json_decode(json_encode($dataKadal),true);
                $dataKadal['kadaluarsa'] = $check;
                $itemProdukKadaluarsa[$key] = $dataKadal;
            }
        }
        if($itemKadaluarsa > 0)
        {
            $user = DB::table('users')->where('email','!=',null)->first();
            if($user)
            {
                $email = $user->email;
                require base_path("vendor/autoload.php");
                $mail = new PHPMailer(true); // Passing `true` enables exceptions

                try {

                    // Email server settings
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; //  smtp host
                    $mail->SMTPAuth = true;
                    $mail->Username = 'malangtechindo@gmail.com'; //  sender username
                    $mail->Password = 'ombktkoztklttvqj'; // sender password
                    $mail->SMTPSecure = 'ssl'; // encryption - ssl/tls
                    $mail->Port = 465; // port - 587/465

                    $mail->setFrom('apoteksumekar@bumd.com', 'Admin Apotek BUMD Sumekar');

                    $mail->addAddress($email);
                    $mail->addCC($email);
                    $mail->addBCC($email);

                    $mail->addReplyTo('apoteksumekar@bumd.com', 'Admin Apotek BUMD Sumekar');

                    $mail->isHTML(true); // Set email content format to HTML

                    $mail->Subject = "Pemberitahuan kadaluarsa Obat!";
                    $mail->Body = view('dashboard.kadaluarsa-email', 
                                      ['itemProdukKadaluarsa' => $itemProdukKadaluarsa])
                                ->render();

                    if (!$mail->send()) {
                        dd($mail->ErrorInfo);
                    } else {
                        dd('Email has been sent.');
                    }

                } catch (\Exception $e) {
                    dd($e->getMessage() .' | '.$e->getLine());
                }
            }
        }
    }
}
