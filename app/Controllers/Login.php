<?php

namespace App\Controllers;
use App\Models\Admin_model;
use CodeIgniter\Controller;

class Login extends Dashboard
{
    public function index()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password')
        ];
    
        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://192.168.18.158:5000/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);
    
        if ($err) {
            echo "Error: " . $err;
        } else {
            $responseData = json_decode($response, true);
    
            if (isset($responseData['msg']) && $responseData['msg'] === 'DATA ADA') {
                if ($responseData['level'] === 'admin') {
                    session()->set('id_pegawai', $responseData['id_pegawai']);
                    session()->set('nama', $responseData['nama']);
                    session()->set('level', 'admin'); // Set session level admin
                    setcookie('id_pegawai', $responseData['id_pegawai'], time() + (7 * 24 * 60 * 60), '/');
                    setcookie('nama', $responseData['nama'], time() + (7 * 24 * 60 * 60), '/');
                    setcookie('level', 'admin', time() + (7 * 24 * 60 * 60), '/');
            
                    return redirect()->to('/admin')->withCookies(); // Mengarahkan ke controller Admin (sesuaikan dengan nama controller Anda)
                } elseif ($responseData['level'] === 'pegawai') {
                    session()->set('id_pegawai', $responseData['id_pegawai']);
                    session()->set('nama', $responseData['nama']);
                    session()->set('level', 'pegawai'); // Set session level pegawai
                    setcookie('id_pegawai', $responseData['id_pegawai'], time() + (7 * 24 * 60 * 60), '/');
                    setcookie('nama', $responseData['nama'], time() + (7 * 24 * 60 * 60), '/');
                    setcookie('level', 'pegawai', time() + (7 * 24 * 60 * 60), '/');
            
                    
                    return redirect()->to('/dashboard')->withCookies(); // Mengarahkan ke controller Dashboard dan metode index
                } else {
                    echo '<script>alert("Anda tidak memiliki izin admin"); window.location.href="/Login";</script>';
                    return;
                }
                
            } elseif (isset($responseData['msg']) && $responseData['msg'] === 'DATA TIDAK ADA') {
                echo '<script>alert("Username atau Password Salah"); window.location.href="/Login";</script>';
                return; // Removed leading slash from view path
            }else {
                return view('project/login'); // Removed leading slash from view path
            }
        }
    }
    public function logout()
    {
        // Hapus sesi
        session()->destroy();
        
        // Hapus cookie (jika ada)
        setcookie('id_pegawai', '', time() - 3600, '/');
        setcookie('nama', '', time() - 3600, '/');
        setcookie('level', '', time() - 3600, '/');

        // Redirect ke halaman login
        return redirect()->to('/Login');
    }

}