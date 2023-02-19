<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
class smsApi extends Model
{
    use HasFactory;
    private $username;
    private $password;
    public function __construct()
    {
        $this->username = 'di80-travelc';
        $this->password = 'digimile';
    }
    public function registerApi($to,$otp)
    {
        $client = new Client;
        $message='Welcome to Travel Cloth. Please verify the '.$otp.' OTP';
        $response = $client->get('http://alerts.digimiles.in/sendsms/bulksms?username='.$this->username.'&password='.$this->password.'&type=0&dlr=1&destination='.$to.'&source=TRVELC&message='.$message.'&entityid=110100001660&tempid=1107162270368740668', [
            'connect_timeout' => 10
        ]);
        return $response->getStatusCode();
    }
    public function forgotPasswordApi($to,$otp)
    {
        $client = new Client;
        $message='Welcome to Travel Cloth. Please use the '.$otp.' password to Sign in.';
        $response = $client->get('http://alerts.digimiles.in/sendsms/bulksms?username='.$this->username.'&password='.$this->password.'&type=0&dlr=1&destination='.$to.'&source=TRVELC&message='.$message.'&entityid=110100001660&tempid=1107162270394029861', [
            'connect_timeout' => 10
        ]);
        return $response->getStatusCode();
    }
}
